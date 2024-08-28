<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'MultiRequest/config');
/**
 * Every Lease will be associated with the Notification(Email)
 *
 * @property Lease $Lease
 */
class NotificationController extends AppController {

    
    public $uses = array('Notify'); 
    //public $components = array('RequestHandler');
    
    public function beforeFilter() {
	parent::beforeFilter();	
        $this->Auth->allow("notify");
    }


/**
 * notify method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function notify($id = null) {
            $lease_types=Configure::read('LeaseTypes');
            switch($id){
                case $lease_types['VAPPRUNTIME']:
                    $this->Notify->notify_runtimelease_expiry();
                    break;
                case $lease_types['VAPPSTORAGE']:
                    $this->Notify->notify_storagelease_expiry();
                    break;
                case $lease_types['CATVAPPSTORAGE']:
                    $this->Notify->notify_vapptemp_storagelease_expiry();
                    break;
                default:
                    $this->Notify->notify_runtimelease_expiry();
                    $this->Notify->notify_storagelease_expiry();
            }
	}   
        
}
