<?php
App::uses('AppController', 'Controller');
/**
 * LeaseTypes Controller
 *
 * @property LeaseType $LeaseType
 */
class LeaseTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->LeaseType->recursive = 0;
		$this->set('leaseTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LeaseType->exists($id)) {
			throw new NotFoundException(__('Invalid lease type'));
		}
		$options = array('conditions' => array('LeaseType.' . $this->LeaseType->primaryKey => $id));
		$this->set('leaseType', $this->LeaseType->find('first', $options));
                $this->LeaseType->bindModel(array('hasMany' => array(
                        'Lease' => array(
                                'className' => 'Lease',
                                'foreignKey' => 'lease_type_id',
                                'dependent' => false,                            
                        ))));  
                $this->paginate = array( 
                    'Lease' => array( 
                            'limit' => 10, 
                            'conditions' => array('Lease.lease_type_id' => $id))
                        ); 
                $this->set('leases', $this->paginate('Lease'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->LeaseType->create();
			if ($this->LeaseType->save($this->request->data)) {
				$this->Session->setFlash(__('The lease type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lease type could not be saved. Please, try again.'));
			}
		}
		$machineTypes = $this->LeaseType->MachineType->find('list');
		$this->set(compact('machineTypes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->LeaseType->exists($id)) {
			throw new NotFoundException(__('Invalid lease type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->LeaseType->save($this->request->data)) {
				$this->Session->setFlash(__('The lease type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The lease type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LeaseType.' . $this->LeaseType->primaryKey => $id));
			$this->request->data = $this->LeaseType->find('first', $options);
		}
		$machineTypes = $this->LeaseType->MachineType->find('list');
		$this->set(compact('machineTypes'));
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
		$this->LeaseType->id = $id;
		if (!$this->LeaseType->exists()) {
			throw new NotFoundException(__('Invalid lease type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LeaseType->delete()) {
			$this->Session->setFlash(__('Lease type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Lease type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        public function getByMachineType() {
		$machine_type_id = $this->request->data['Lease']['machine_type_id'];                                 
                $lease_types = $this->LeaseType->find('list', array(
			'conditions' => array('LeaseType.machine_type_id' => $machine_type_id),
			'recursive' => -1
			));
 
                $this->set('lease_types',$lease_types);
                $this->layout = 'ajax';
	}
}
