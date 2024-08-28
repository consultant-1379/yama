<?php
App::uses('AppController', 'Controller');
/**
 * Vapps Controller
 *
 * @property Vapp $Vapp
 */
class VappsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Vapp->recursive = 0;
		$this->set('vapps', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Vapp->exists($id)) {
			throw new NotFoundException(__('Invalid vapp'));
		}
		$options = array('conditions' => array('Vapp.' . $this->Vapp->primaryKey => $id));
		$this->set('vapp', $this->Vapp->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Vapp->create();
			if ($this->Vapp->save($this->request->data)) {
				$this->Session->setFlash(__('The vapp has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vapp could not be saved. Please, try again.'));
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
		if (!$this->Vapp->exists($id)) {
			throw new NotFoundException(__('Invalid vapp'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Vapp->save($this->request->data)) {
				$this->Session->setFlash(__('The vapp has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vapp could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vapp.' . $this->Vapp->primaryKey => $id));
			$this->request->data = $this->Vapp->find('first', $options);
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
		$this->Vapp->id = $id;
		if (!$this->Vapp->exists()) {
			throw new NotFoundException(__('Invalid vapp'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Vapp->delete()) {
			$this->Session->setFlash(__('Vapp deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Vapp was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
