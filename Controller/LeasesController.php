<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::import('Vendor', 'MultiRequest/config');
/**
 * Leases Controller
 *
 * @property Lease $Lease
 */
class LeasesController extends AppController {

    public $helpers = array('Js');
    public $uses = array('Lease','Pmachine','Vapps','Vapptemplate');
    //public $components = array('RequestHandler');

    public function beforeFilter() {
	parent::beforeFilter();
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
                //$leases = $this->Lease->find('all');
		$this->Lease->recursive = 0;
		$this->set('leases', $this->paginate());
//                $this->set(array(
//                     'leases' => $leases,
//                    '_serialize' => array('leases')
//        ));
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
			throw new NotFoundException(__('Invalid lease'));
		}
		$options = array('conditions' => array('Lease.' . $this->Lease->primaryKey => $id));
		$this->set('lease', $this->Lease->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Lease->create();
			if ($this->Lease->save($this->request->data)) {
				$this->Session->setFlash(__('The lease has been saved'));
                                $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lease could not be saved. Please, try again.'));
			}
		}
		//$leaseTypes = $this->Lease->LeaseType->find('list');
		$machineTypes = $this->Lease->MachineType->find('list');
		//$pmachines = $this->Lease->Pmachine->find('list');
                //$pmachines = $this->Lease->Pmachine->find('list');

                reset($machineTypes);
                $defaultmachinetype=key($machineTypes);

                $leaseTypes = $this->Lease->LeaseType->find('list', array(
			'conditions' => array('LeaseType.machine_type_id' => $defaultmachinetype),
			'recursive' => -1
			));
                $machine_types=Configure::read('MachineTypes');
                if($defaultmachinetype == $machine_types['VAPP'])
                {
                    $this->Vapps->setDataSource('vappDB');
                    $hosts = $this->Vapps->find('list');
                }
                else if($defaultmachinetype == $machine_types['PHYSICAL'])
                {
                    $hosts = $this->Pmachine->find('list');
                }
                else if($defaultmachinetype == $machine_types['VAPPTEMP'])
                {
                    $hosts = $this->Vapptemplate->find('list');
                }
                //$hosts = $this->Lease->Pmachine->find('list');
		//$this->set(compact('leaseTypes', 'machineTypes', 'pmachines'));
                $this->set(compact('leaseTypes', 'machineTypes' ,'hosts'));
	}

        //Uses in Hosts(pmachines,vapp,vapptemplate) view file
        public function addsp($machine_type_id=null,$hostid = null) {
//		if (!$this->Lease->exists($id)) {
//			throw new NotFoundException(__('Invalid lease'));
//		}
                //CakeLog::write('debug', 'Add a new Lease'.$machine_type_id.'@@'.$hostid);
                $machine_types=Configure::read('MachineTypes');

                if ($this->request->is('post')) {
			$this->Lease->create();
			if ($this->Lease->save($this->request->data)) {
				$this->Session->setFlash(__('The lease has been saved'));
                                if($machine_type_id == $machine_types['PHYSICAL'])
                                    $this->redirect(array('controller' => 'pmachines','action' => 'view',$hostid));
                                if($machine_type_id == $machine_types['VAPP'])
                                    $this->redirect(array('controller' => 'vapps','action' => 'view',$hostid));
                                if($machine_type_id == $machine_types['VAPPTEMP'])
                                    $this->redirect(array('controller' => 'vapptemplates','action' => 'view',$hostid));

			} else {
				$this->Session->setFlash(__('The lease could not be saved. Please, try again.'));
			}
		}
		//$leaseTypes = $this->Lease->LeaseType->find('list');
		$machineTypes = $this->Lease->MachineType->find('list',array(
			'conditions' => array('MachineType.id' => $machine_type_id),
			'recursive' => -1
			));
                $leaseTypes = $this->Lease->LeaseType->find('list', array(
			'conditions' => array('LeaseType.machine_type_id' => $machine_type_id),
			'recursive' => -1
			));
                 if($machine_type_id == $machine_types['PHYSICAL'])
                    $hosts = $this->Pmachine->find('list',array(
                            'conditions' => array('Pmachine.id' => $hostid),
                            'recursive' => -1
                            ));
                 if($machine_type_id == $machine_types['VAPP'])
                 {
                    $this->Vapps->setDataSource('vappDB');
                    $hosts = $this->Vapps->find('list',array(
                            'conditions' => array('Vapps.id' => $hostid),
                            'recursive' => -1
                            ));
                 }
                 if($machine_type_id == $machine_types['VAPPTEMP'])
                    $hosts = $this->Vapptemplate->find('list',array(
                            'conditions' => array('Vapptemplate.id' => $hostid),
                            'recursive' => -1
                            ));
                //$hosts = $this->Lease->Pmachine->find('list');
		//$this->set(compact('leaseTypes', 'machineTypes', 'pmachines'));
                $this->set(compact('leaseTypes', 'machineTypes' ,'hosts'));
                $this->render('add');
	}

        public function addrest() {
            //CakeLog::write('debug', 'Add a new Lease thru REST'.'myArray'.print_r($this->request->data, true));
            $machine_types=Configure::read('MachineTypes');
            //$xmlArray = Xml::toArray(Xml::build($this->request->data));
            //$xml = Xml::fromArray($this->request->data);
            //CakeLog::write('debug', $xml->asXML());
            //echo $xml->asXML();

            //throw new InternalErrorException('Could Create the Lease'.$this->request->data['Lease']['machine_type_id']);
            $lengths = Configure::read('LeaseLengths');
            if(!$this->Lease->MachineType->hasAny(array(
                  'MachineType.id' => $this->request->data['Lease']['machine_type_id']
                )))
            {
                throw new InternalErrorException('Machine Type does not exist');
            }
            else if
                (!$this->Lease->LeaseType->hasAny(array(
                  'LeaseType.id' => $this->request->data['Lease']['lease_type_id'],
                  'LeaseType.machine_type_id' => $this->request->data['Lease']['machine_type_id']
                )))
            {
                throw new InternalErrorException('LeaseType for the given Machine Type does not exist');
            }
            else {
                if($this->request->data['Lease']['machine_type_id'] == $machine_types['PHYSICAL'])
                {
                    if(!$this->Pmachine->hasAny(array(
                        'Pmachine.id' => $this->request->data['Lease']['host_id']
                        ))){
                        throw new InternalErrorException('The provided Host does not exist in the physical Machines Database');
                    }
                }
                else if($this->request->data['Lease']['machine_type_id'] == $machine_types['VAPP'])
                {
                    $this->Vapps->setDataSource('vappDB');
                    if(!$this->Vapps->hasAny(array(
                        'Vapps.id' => $this->request->data['Lease']['host_id']
                        ))){
                        throw new InternalErrorException('The provided Host does not exist in the Virtual Machines Database');
                    }
                    if ($this->request->data['Lease']['emails'] == 'sync'){
                        if ($this->request->data['Lease']['lease_type_id'] == '2'){
                            $leaseLength = $lengths['SyncRuntime'];
                        } else {
                            $leaseLength = $lengths['SyncStorage'];
                        }
                    } else {
                        if ($this->request->data['Lease']['lease_type_id'] == '2'){
                            $leaseLength = $lengths['VappRuntime'];
                        } else {
                            $leaseLength = $lengths['VappStorage'];
                        }
                    }
                    $this->request->data['Lease']['expiry_date'] = date("Y-m-d", strtotime('+' . $leaseLength . ' days', strtotime('now')));
                }
                else if($this->request->data['Lease']['machine_type_id'] == $machine_types['VAPPTEMP'])
                {
                    if(!$this->Vapptemplate->hasAny(array(
                        'Vapptemplates.id' => $this->request->data['Lease']['host_id']
                        )))
                     throw new InternalErrorException('The provided Host does not exist in the vAppTemplates Database');
                }
            } if (!($this->request->data['Lease']['emails'] === "dummy@dummy.com")) {

                //$this->response->statusCode(503);
                $this->Lease->create();
                if ($this->Lease->save($this->request->data)) {
                    $message = 'New Lease: '.$this->Lease->id.' created';
                    $url = Configure::read('yama.url').'/renew/view/'.$this->Lease->id;
                    $this->set(array(
                        'message' => $message,
                        'url' => $url,
                        '_serialize' => array('message','url')
                    ));

                } else {
                    throw new InternalErrorException('Cannot Save the Lease');
                }
            } else {
                $message = 'No Lease created for: '.$this->Lease->id.'. Invalid email supplied ';
                $url = Configure::read('yama.url') . '/';
                $this->set(array(
                    'message' => $message,
                    'url' => $url,
                    '_serialize' => array('message','url')
                ));
            }
            $this->render('add');
        }

        public function addhost() {
            //CakeLog::write('debug', 'Add a new Lease thru REST'.'myArray'.print_r($this->request->data, true));
            //$xmlArray = Xml::toArray(Xml::build($this->request->data));
            //$xml = Xml::fromArray($this->request->data);
            //CakeLog::write('debug', $xml->asXML());
            //echo $xml->asXML();

            //throw new InternalErrorException('Could Create the Lease'.$this->request->data['Lease']['machine_type_id']);
            $machine_types=Configure::read('MachineTypes');
            if($this->request->data['Lease']['machine_type_id']!=$machine_types['VAPPTEMP'])
            {
                throw new InternalErrorException('Machine Type is not supported');
            }
            else if
                (!$this->Lease->LeaseType->hasAny(array(
                  'LeaseType.id' => $this->request->data['Lease']['lease_type_id'],
                  'LeaseType.machine_type_id' => $this->request->data['Lease']['machine_type_id']
                )))
            {
                throw new InternalErrorException('LeaseType for the given Machine Type does not exist');
            }

            $lengths = Configure::read('LeaseLengths');
            //$this->response->statusCode(503);
            $this->request->data['Lease']['expiry_date'] = date("Y-m-d", strtotime('+' . $lengths['VappTemplateStorage'] . ' days', strtotime('now')));
            $this->Vapptemplate->create();
            if ($this->Vapptemplate->save($this->request->data['Lease']['host'])) {
                $this->request->data['Lease']['host_id']=$this->Vapptemplate->id;
                $this->Lease->create();
                if($this->Lease->save($this->request->data))
                {
                    $message = 'New Lease: '.$this->Lease->id.' and new Vapptemplate: '.$this->request->data['Lease']['host_id'].' created';
                    $url = Configure::read('yama.url').'/renew/view/'.$this->Lease->id;
                    //CakeLog::write('debug', 'Add a new Lease thru REST'.'myArray'.print_r($this->request->data, true));
                    $this->set(array(
                        'message' => $message,
                        'url' => $url,
                        '_serialize' => array('message','url')
                    ));
                }
                else {
                    throw new InternalErrorException('Cannot Save the Lease');
                }
            } else {
                throw new InternalErrorException('Cannot create a vApptemplate');
            }


            $this->render('add');


        }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Lease->exists($id)) {
			throw new NotFoundException(__('Invalid lease'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lease->save($this->request->data)) {
				$this->Session->setFlash(__('The lease has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lease could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lease.' . $this->Lease->primaryKey => $id));
			$this->request->data = $this->Lease->find('first', $options);
		}
		//$leaseTypes = $this->Lease->LeaseType->find('list');
		$machineTypes = $this->Lease->MachineType->find('list');
                $machine_types=Configure::read('MachineTypes');
                reset($machineTypes);
                $defaultmachinetype=$this->request->data['MachineType']['id'];
                $leaseTypes = $this->Lease->LeaseType->find('list', array(
			'conditions' => array('LeaseType.machine_type_id' => $defaultmachinetype),
			'recursive' => -1
			));
                if($defaultmachinetype == $machine_types['VAPP'])
                {
                    $this->Vapps->setDataSource('vappDB');
                    $hosts = $this->Vapps->find('list');
                }
                else if($defaultmachinetype == $machine_types['PHYSICAL'])
                {
                    $hosts = $this->Pmachine->find('list');
                }
                else if($defaultmachinetype == $machine_types['VAPPTEMP'])
                {
                    $hosts = $this->Vapptemplate->find('list');
                }
                //$hosts = $this->Lease->Pmachine->find('list');
		//$this->set(compact('leaseTypes', 'machineTypes', 'pmachines'));
                $this->set(compact('leaseTypes', 'machineTypes' ,'hosts'));

	}
        //Uses in Hosts(pmachines,vapp,vapptemplate) view file
        public function editsp($machine_type_id=null,$hostid = null,$id = null) {
		if (!$this->Lease->exists($id)) {
			throw new NotFoundException(__('Invalid lease'));
		}
                $machine_types=Configure::read('MachineTypes');
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Lease->save($this->request->data)) {
				$this->Session->setFlash(__('The lease has been saved'));
				if($machine_type_id == $machine_types['PHYSICAL'])
                                     $this->redirect(array('controller' => 'pmachines','action' => 'view',$hostid));
                                if($machine_type_id == $machine_types['VAPP'])
                                     $this->redirect(array('controller' => 'vapps','action' => 'view',$hostid));
                                if($machine_type_id == $machine_types['VAPPTEMP'])
                                     $this->redirect(array('controller' => 'vapptemplates','action' => 'view',$hostid));
			} else {
				$this->Session->setFlash(__('The lease could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Lease.' . $this->Lease->primaryKey => $id));
			$this->request->data = $this->Lease->find('first', $options);
		}
		//$leaseTypes = $this->Lease->LeaseType->find('list');
		$machineTypes = $this->Lease->MachineType->find('list',array(
			'conditions' => array('MachineType.id' => $machine_type_id),
			'recursive' => -1
			));
                $leaseTypes = $this->Lease->LeaseType->find('list', array(
			'conditions' => array('LeaseType.machine_type_id' => $machine_type_id),
			'recursive' => -1
			));

                if($machine_type_id == $machine_types['PHYSICAL'])
                    $hosts = $this->Pmachine->find('list',array(
                            'conditions' => array('Pmachine.id' => $hostid),
                            'recursive' => -1
                            ));
                 if($machine_type_id == $machine_types['VAPP'])
                 {
                    $this->Vapps->setDataSource('vappDB');
                    $hosts = $this->Vapps->find('list',array(
                            'conditions' => array('Vapps.id' => $hostid),
                            'recursive' => -1
                            ));
                 }

                 if($machine_type_id == $machine_types['VAPPTEMP'])
                    $hosts = $this->Vapptemplate->find('list',array(
                            'conditions' => array('Vapptemplate.id' => $hostid),
                            'recursive' => -1
                            ));
                //$hosts = $this->Lease->Pmachine->find('list');
		//$this->set(compact('leaseTypes', 'machineTypes', 'pmachines'));
                $this->set(compact('leaseTypes', 'machineTypes' ,'hosts'));
                $this->render('edit');

	}

/**
* reset rest method
*
*/

    public function reset_api() {
       try {
            $lengths = Configure::read('LeaseLengths');
            $host = $this->request->data['Lease']['host_id'];
            $this->Vapps->setDataSource('vappDB');
            $host_id = $this->Vapps->findByvcd_id($host);
            $lease_type = $this->request->data['Lease']['lease_type_id'];
            $leases = $this->Lease->findAllByhost_id($host_id['Vapps']['id']);
            if (isset($leases) && $leases != Null) {
               foreach ($leases as $lease){
                  if ($lease['Lease']['lease_type_id'] == intval($lease_type)) {
                      if ($lease['Lease']['emails'] == 'sync'){
                         if ($lease_type == '2'){
                             $leaseLength = $lengths['SyncRuntime'];
                         } else {
                             $leaseLength = $lengths['SyncStorage'];
                         }
                      } else {
                         if ($lease_type == '2'){
                             $leaseLength = $lengths['VappRuntime'];
                         } else {
                             $leaseLength = $lengths['VappStorage'];
                         }
                      }
                      $this->Lease->id = $lease['Lease']['id'];
                      $this->Lease->saveField('expiry_date', date("Y-m-d", strtotime('+' . $leaseLength . ' days', strtotime('now'))));
                  }
             }
          }
          $this->set('Lease', "Lease has been updated");
          $this->set('_serialize', array('Lease'));
        } catch (Exception $e) {
            throw new BadRequestException('Something went wrong when saving the lease: ' . $e);
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
		$this->Lease->id = $id;
		if (!$this->Lease->exists()) {
			throw new NotFoundException(__('Invalid lease'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lease->delete()) {
			$this->Session->setFlash(__('Lease deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lease was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        //Uses in Hosts(pmachines,vapp,vapptemplate) view file
        public function deletesp($machine_type_id=null,$hostid = null,$id = null) {
		$this->Lease->id = $id;
		if (!$this->Lease->exists()) {
			throw new NotFoundException(__('Invalid lease'));
		}
                $machine_types=Configure::read('MachineTypes');
		$this->request->onlyAllow('post', 'delete');
		if ($this->Lease->delete()) {
			$this->Session->setFlash(__('Lease deleted'));
                        if($machine_type_id == $machine_types['PHYSICAL'])
                              $this->redirect(array('controller' => 'pmachines','action' => 'view',$hostid));
                        if($machine_type_id == $machine_types['VAPP'])
                              $this->redirect(array('controller' => 'vapps','action' => 'view',$hostid));
                        if($machine_type_id == $machine_types['VAPPTEMP'])
                              $this->redirect(array('controller' => 'vapptemplates','action' => 'view',$hostid));
			//$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lease was not deleted'));
		//$this->redirect(array('action' => 'index'));
                if($machine_type_id == $machine_types['PHYSICAL'])
                   $this->redirect(array('controller' => 'pmachines','action' => 'view',$hostid));
                if($machine_type_id == $machine_types['VAPP'])
                   $this->redirect(array('controller' => 'vapps','action' => 'view',$hostid));
                if($machine_type_id == $machine_types['VAPPTEMP'])
                   $this->redirect(array('controller' => 'vapptemplates','action' => 'view',$hostid));
	}

        public function deleteall($date = null) {

            if ($this->request->is('post') || $this->request->is('put')) {
                //CakeLog::write('debug', 'date'.$this->request->data['']);
                //CakeLog::write('debug', 'date'.'myArray'.print_r($this->request->data['Lease']['expiry_date'], true));
                $d=$this->request->data['Lease']['expiry_date'];
                $date=$d['year'].'-'.$d['month'].'-'.$d['day'];
                if ($this->Lease->deleteAll(array('DATE(Lease.expiry_date) <'=> $date,
                    'Lease.host_id NOT IN(SELECT id from cloudportal.vapps)',
                    'Lease.host_id NOT IN(SELECT id from vapptemplates)'),false))
                {
                    $this->Session->setFlash(__($this->Lease->getAffectedRows().' Leases deleted successfully'));
                    $this->redirect(array('action' => 'index'));
                }
                else {
    		    $this->Session->setFlash(__('The leases could not be deleted. Please, try again.'));
		}

	} else {

	}
    }

}
