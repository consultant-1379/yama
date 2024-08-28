<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'MultiRequest/config');
/**
 * Leases Controller
 *
 * @property Lease $Lease
 */
class RenewController extends AppController {

    public $helpers = array('Js');
    public $uses = array('Lease','Pmachine','Vapp'); 
    //public $components = array('RequestHandler');
    
    public function beforeFilter() {
	//parent::beforeFilter();	
        $this->Auth->allow();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Lease->exists($id)) {
			//throw new NotFoundException(__('Invalid lease'));
                    $this->render('norecord');
		}
                else {
                    $lengths = Configure::read('LeaseLengths');
                    $options = array('conditions' => array('Lease.' . $this->Lease->primaryKey => $id));
                    $lease= $this->Lease->find('first', $options);                
                    $this->set('lease', $lease);
                    $expiryDate = date("Y-m-d",strtotime($lease['Lease']['expiry_date']));
                    $minDat =  date("Y-m-d", strtotime('now')) ;
                    $maxDat =  date("Y-m-d", strtotime('now')) ;
                    if($lease['LeaseType']['id'] == 1)
                    {
                        $max_extension="+" . $lengths['VappStorage'] . " days";
                    }
                    else
                    {
                        $max_extension="+" . $lengths['VappRuntime'] . " days";
                    }

                    if($maxDat > $expiryDate ) //Expiry Date already over
                    {
                        $minDat = $expiryDate;
                        $maxDat = date("Y-m-d", strtotime($max_extension,strtotime($expiryDate))) ;                    
                    }
                    else //Expiry Date is going to come
                    {
                        //minDat.setDate(maxDat);
                        //if()
                        $maxDat = date("Y-m-d", strtotime($max_extension,strtotime($maxDat))) ;                                        
                        if($maxDat < $expiryDate)
                            $maxDat=$expiryDate;                        
                     }                
                    $machine_types=Configure::read('MachineTypes');                    

                    if($lease['Lease']['machine_type_id'] == $machine_types['VAPP'])
                        {
                            $hosts=$this->Vapp->find('first', array(
                                    'conditions' => array('Vapp.id' => $lease['Lease']['host_id']),                                
                            ));
                            if(isset($hosts['Lease']))
                            {
                                $this->set('otherleases', $hosts['Lease']);

                                foreach ($hosts['Lease'] as $lease)
                                {
                                    //echo $lease['LeaseType']['id'] .' '.$lease['expiry_date'].'<br>';
                                    if(!($lease['id'] == $id))
                                    {
                                        //$otherleases[$lease['LeaseType']['lease_type_name']]=$lease['id']; 
                                        //$otherleases[$lease['id']]=$lease;
                                        if($lease['LeaseType']['id'] == 2)
                                        {
                                            $minDat=date("Y-m-d",strtotime($lease['expiry_date']));
                                        }

                                    }
                                }
                            }
                        }                 
                    $this->set('minDat', $minDat);
                    $this->set('maxDat', $maxDat);  
                }
                
	}


        
        public function renewlease() {                        
            
            CakeLog::write('debug', 'Submit a Lease thru REST'.'myArray'.print_r($this->request->data, true));
           // debug($this->request->data);
            //$xmlArray = Xml::toArray(Xml::build($this->request->data));
            //$xml = Xml::fromArray($this->request->data);
            //CakeLog::write('debug', $xml->asXML());
            //echo $xml->asXML();                            

            //throw new InternalErrorException('Could Create the Lease'.$this->request->data['Lease']['machine_type_id']);
//            if(!$this->Lease->MachineType->hasAny(array(
//                  'MachineType.id' => $this->request->data['Lease']['machine_type_id']
//                )))
//            {
//                //throw new InternalErrorException('Machine Type does not exist');
//                $this->Session->setFlash(__('Machine Type does not exist'));
//            }
//            else if
//                (!$this->Lease->LeaseType->hasAny(array(
//                  'LeaseType.id' => $this->request->data['Lease']['lease_type_id'],
//                  'LeaseType.machine_type_id' => $this->request->data['Lease']['machine_type_id']
//                )))
//            {
//                //throw new InternalErrorException('LeaseType for the given Machine Type does not exist');
//                $this->Session->setFlash(__('LeaseType for the given Machine Type does not exist'));
//            }
//            else {
//                if($this->request->data['Lease']['machine_type_id'] == 3)
//                {
//                    if(!$this->Pmachine->hasAny(array(
//                        'Pmachine.id' => $this->request->data['Lease']['host_id']
//                        )))
//                     //throw new InternalErrorException('The provided Host does not exist in the physical Machines Database');
//                        $this->Session->setFlash(__('The provided Host does not exist in the physical Machines Database'));
//                }
//                else if($this->request->data['Lease']['machine_type_id'] == 2)
//                {
//                    $this->Vapps->setDataSource('vappDB');
//                    if(!$this->Vapps->hasAny(array(
//                        'Vapps.id' => $this->request->data['Lease']['host_id']
//                        )))
//                     //throw new InternalErrorException('The provided Host does not exist in the Virtual Machines Database');  
//                    $this->Session->setFlash(__('The provided Host does not exist in the Virtual Machines Database'));
//                }
//            }


            if ($this->Lease->save($this->request->data)) {
                $message = 'Lease: '.$this->Lease->id.' Modified';
                $options = array('conditions' => array('Lease.' . $this->Lease->primaryKey => $this->request->data['Lease']['id']));
                $lease=$this->Lease->find('first', $options);
                $this->set('lease', $lease);

                $machine_types=Configure::read('MachineTypes');
                if($lease['MachineType']['id'] == $machine_types['VAPP'])
                    $host=$lease['Lease']['host']['Vapp']['vts_name'];
                elseif($lease['MachineType']['id'] == $machine_types['PHYSICAL'])
                    $host=$lease['Lease']['host']['Pmachine']['hostname'];
                elseif($lease['MachineType']['id'] == $machine_types['VAPPTEMP'])
                    $host=$lease['Lease']['host']['Vapptemplate']['name'];
                $this->set('host', $host);
                if(isset($this->request->data['storage_expiry_date']))
                {
                    $this->set('stor', $this->request->data['storage_expiry_date']);
                }
                
                
                //$this->Session->setFlash(__($message));
//                $this->set(array(
//                    'message' => $message,
//                    '_serialize' => array('message')                
//                ));
            } else {
                //throw new InternalErrorException('Cannot Save the Lease');                 
                $this->Session->setFlash(__('Cannot Save the Lease'));
            }


           // $this->render('status');       
            //$this->redirect(array('controller' => 'renew','action' => 'status'));
        }
        
        public function letitexpire() {                                   
            
            if ($this->Lease->save($this->request->data)) {
                $message = 'Lease: '.$this->Lease->id.' Modified';
                $options = array('conditions' => array('Lease.' . $this->Lease->primaryKey => $this->request->data['Lease']['id']));
		$this->set('lease', $this->Lease->find('first', $options));                

            } else {                
                $this->Session->setFlash(__('Cannot Save the Lease'));
            }           
        }
        
}
