<?php
App::uses('AppController', 'Controller');
/**
 * MachineTypes Controller
 *
 * @property MachineType $MachineType
 */
class MachineTypesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->MachineType->recursive = 0;
		$this->set('machineTypes', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->MachineType->exists($id)) {
			throw new NotFoundException(__('Invalid machine type'));
		}
		$options = array('conditions' => array('MachineType.' . $this->MachineType->primaryKey => $id));
		$this->set('machineType', $this->MachineType->find('first', $options));
                $this->MachineType->bindModel(array('hasMany' => array(
                        'Lease' => array(
                                'className' => 'Lease',
                                'foreignKey' => 'machine_type_id',
                                'dependent' => false,                            
                        ))));  
                $this->paginate = array( 
                    'Lease' => array( 
                            'limit' => 10, 
                            'conditions' => array('Lease.machine_type_id' => $id))
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
			$this->MachineType->create();
			if ($this->MachineType->save($this->request->data)) {
				$this->Session->setFlash(__('The machine type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The machine type could not be saved. Please, try again.'));
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
		if (!$this->MachineType->exists($id)) {
			throw new NotFoundException(__('Invalid machine type'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->MachineType->save($this->request->data)) {
				$this->Session->setFlash(__('The machine type has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The machine type could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('MachineType.' . $this->MachineType->primaryKey => $id));
			$this->request->data = $this->MachineType->find('first', $options);
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
		$this->MachineType->id = $id;
		if (!$this->MachineType->exists()) {
			throw new NotFoundException(__('Invalid machine type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->MachineType->delete()) {
			$this->Session->setFlash(__('Machine type deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Machine type was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
