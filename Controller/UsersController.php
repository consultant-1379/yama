<?php

class UsersController extends AppController {

    public $name = 'Users';

    //public $uses = array('Adminuser');

    public function beforeFilter() {
        parent::beforeFilter(); //--> permissions fields not needed for this controller.
        $this->Auth->allow("login", "logout", "add");
    }

    public function isAuthorized($user) {
        if ($user['is_admin']) {
            return true;
        }
        if (in_array($this->action, array('login', 'logout'))) {
            return true;
        }
        return false;
    }

    public function login() {
        if ($this->Auth->loggedIn()) {
            Cakelog::write('debug', 'im here!');
            // The user is already logged in
            //$this->Session->setFlash('Your already logged in','flash_good');
            return $this->redirect($this->Auth->redirect());
        } else {
            if ($this->request->is('post')) {

                if ($this->Auth->login()) {
                    $user = $this->Auth->user();
                    $username = $user['username'];
                    CakeLog::write('debug', 'user name is : ' . $username);
                    $usernameQuery = array('conditions' => array('Adminuser.signumid' => $username));
                    $query = ClassRegistry::init('Adminuser')->find('first', $usernameQuery);
                    CakeLog::write('debug', 'this is the query ' . 'myArray :' . print_r($query, true));
                    CakeLog::write('debug', 'username is :' . print_r($user, true));
                    if (!$user['is_admin']) {
                        //check the username against the signum_id in db 
                        if ($username != $query['Adminuser']['signumid']) {
                            CakeLog::write('debug', 'checks username:' );
                            $this->Session->setFlash('You do not have administrator rights', 'flash_bad');
                            // $this->redirect(array('controller' => 'user', 'action' => 'login'));
                            return $this->redirect($this->Auth->logout());
                        }
                        else
                            return $this->redirect($this->Auth->redirect());
                    }
                    else
                        return $this->redirect($this->Auth->redirect());
                } else {
                    $this->Session->setFlash('Password may not be correct.', 'flash_bad');
                }
            }
        }
        $this->set("title_for_layout", "Login");
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->User->find('all'));
    }

    public function view($id = null) {
        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }

        if (!$id) {
            $this->Session->setFlash('Invalid user', 'flash_bad');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('user', $this->User->read());
    }

    public function add() {
        if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved', 'flash_good');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_bad');
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved', 'flash_good');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'flash_bad');
            }
        } else {
            $this->request->data = $this->User->read();
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if (!$id) {
            $this->Session->setFlash('Invalid id for user', 'flash_bad');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash('User deleted', 'flash_good');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash('User was not deleted', 'flash_bad');
        $this->redirect(array('action' => 'index'));
    }

}
?>

