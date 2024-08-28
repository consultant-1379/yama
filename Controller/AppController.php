<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array('DebugKit.Toolbar',
                               'Session',
                               'RequestHandler',
                               'Auth' => array(
					'loginRedirect' => array('controller' => 'Leases', 'action' => 'index'),
					'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
					'authError' => "You don't have permission to access that page, please contact your team co-ordinator to give you access if required.",
					'authorize' => array('Controller'),
                                )
                            );
    public $paginate = array('limit' => 10);

    public function isAuthorized($user) {
// 		if ($user['is_admin']) {
// 			return true;
// 		}
// 		return false;
                return true;

    }

    public function beforeFilter()
    {

        // Forcibly login rest users
        if (isset($this->params['ext']) && ($this->params['ext'] == 'xml' || $this->params['ext'] == 'json'))
        {
            $this->Auth->authenticate = array(
                'Basic',
                'Ldap' => array('userModel' => 'Ldap')
            );
            $data['User']['username'] = env('PHP_AUTH_USER');
            $data['User']['password'] = env('PHP_AUTH_PW');
            $this->request->data=$data;
            $this->Auth->initialize($this);
            if (!$this->Auth->login()) {
                throw new ForbiddenException();
            }
        }
        else
         {
            //CakeLog::write('debug', 'INdide Ldap Authenticate');
            $this->Auth->authenticate = array(
                'Form',
                'Ldap' => array('userModel' => 'Ldap')
            );
         }


        $this->set('logged_in', $this->Auth->loggedIn());
        $this->set('current_user', $this->Auth->user());

        Configure::write('spp.url','https://' . strtok(shell_exec('hostname -f'), "\n"));
        Configure::write('spp.hostname',strtok(shell_exec('hostname -s'), "\n"));
        Configure::write('yama.url','http://' . strtok(shell_exec('hostname -f'), "\n") . ':8080');
    }


}
