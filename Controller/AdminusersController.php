<?php
App::uses('AppController', 'Controller');
/**
 * Adminusers Controller
 *
 * @property Adminuser $Adminuser
 */
class AdminusersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Adminuser->recursive = 0;
		$this->set('adminusers', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Adminuser->exists($id)) {
			throw new NotFoundException(__('Invalid adminuser'));
		}
		$options = array('conditions' => array('Adminuser.' . $this->Adminuser->primaryKey => $id));
		$this->set('adminuser', $this->Adminuser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Adminuser->create();
			if ($this->Adminuser->save($this->request->data)) {
				$this->Session->setFlash(__('The adminuser has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The adminuser could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Adminuser->exists($id)) {
			throw new NotFoundException(__('Invalid adminuser'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Adminuser->save($this->request->data)) {
				$this->Session->setFlash(__('The adminuser has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The adminuser could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Adminuser.' . $this->Adminuser->primaryKey => $id));
			$this->request->data = $this->Adminuser->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Adminuser->id = $id;
		if (!$this->Adminuser->exists()) {
			throw new NotFoundException(__('Invalid adminuser'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Adminuser->delete()) {
			$this->Session->setFlash(__('Adminuser deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Adminuser was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
