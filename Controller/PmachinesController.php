<?php
App::uses('AppController', 'Controller');
/**
 * Pmachines Controller
 *
 * @property Pmachine $Pmachine
 */
class PmachinesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Pmachine->recursive = 0;
		$this->set('pmachines', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Pmachine->exists($id)) {
			throw new NotFoundException(__('Invalid pmachine'));
		}
		$options = array('conditions' => array('Pmachine.' . $this->Pmachine->primaryKey => $id));
		$this->set('pmachine', $this->Pmachine->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Pmachine->create();
			if ($this->Pmachine->save($this->request->data)) {
				$this->Session->setFlash(__('The pmachine has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pmachine could not be saved. Please, try again.'));
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
		if (!$this->Pmachine->exists($id)) {
			throw new NotFoundException(__('Invalid pmachine'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Pmachine->save($this->request->data)) {
				$this->Session->setFlash(__('The pmachine has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pmachine could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Pmachine.' . $this->Pmachine->primaryKey => $id));
			$this->request->data = $this->Pmachine->find('first', $options);
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
		$this->Pmachine->id = $id;
		if (!$this->Pmachine->exists()) {
			throw new NotFoundException(__('Invalid pmachine'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Pmachine->delete()) {
			$this->Session->setFlash(__('Pmachine deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Pmachine was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
