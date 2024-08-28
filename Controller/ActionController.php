<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'MultiRequest/config');
/**
 *  Every Lease Type will be associated with the Action
 *
 * @property Lease $Lease
 */
class ActionController extends AppController {

    
    public $uses = array('Action'); 
    //public $components = array('RequestHandler');
    
    public function beforeFilter() {
	parent::beforeFilter();	
        $this->Auth->allow("doit");
    }


/**
 * notify method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function doit($id = null) {
            $lease_types=Configure::read('LeaseTypes');
            switch($id){
                case $lease_types['VAPPRUNTIME']:
                    $this->Action->suspend_vapps();
                    break;
                case $lease_types['VAPPSTORAGE']:
                    $this->Action->destroy_vapps();
                    break;
                case $lease_types['CATVAPPSTORAGE']:
                    $this->Action->destroy_vapptemplates();
                    break;
                default:
                    $this->Action->suspend_vapps();
                    $this->Action->destroy_vapps();
            }
	}   
        
}
