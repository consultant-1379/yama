<?php
App::uses('AppController', 'Controller');
/**
 * Pmachines Controller
 *
 * @property Pmachine $Pmachine
 */
class HostsController extends AppController {
    
    public $uses = array('Pmachine','Vapps','Vapptemplate');    
    
    public function getHosts() {                              
	$machine_type_id = $this->request->data['Lease']['machine_type_id'];   
        $machine_types=Configure::read('MachineTypes');
        if($machine_type_id == $machine_types['VAPP'])
        {
            $this->Vapps->setDataSource('vappDB');
            $hosts = $this->Vapps->find('list'); 
        }                
        else if($machine_type_id == $machine_types['PHYSICAL'])
        {
            $hosts = $this->Pmachine->find('list'); 
        }
        else if($machine_type_id == $machine_types['VAPPTEMP'])
        {
            $hosts = $this->Vapptemplate->find('list'); 
        }
        $this->set('hosts',$hosts);
        $this->layout = 'ajax';
    }
}
