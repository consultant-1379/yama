<?php
App::uses('AppController', 'Controller');
/**
 * Vapptemplates Controller
 *
 * @property Vapptemplate $Vapptemplate
 */
class VapptemplatesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
                //$vapptemplates = $this->Vapptemplate->find('all');
		$this->Vapptemplate->recursive = 0;
		$this->set('vapptemplates', $this->paginate());
                
//                $this->set(array(
//                     'vapptemplates' => $vapptemplates,
//                    '_serialize' => array('vapptemplates')
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
		if (!$this->Vapptemplate->exists($id)) {
			throw new NotFoundException(__('Invalid vapptemplate'));
		}
		$options = array('conditions' => array('Vapptemplate.' . $this->Vapptemplate->primaryKey => $id));
		$this->set('vapptemplate', $this->Vapptemplate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Vapptemplate->create();
			if ($this->Vapptemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The vapptemplate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vapptemplate could not be saved. Please, try again.'));
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
		if (!$this->Vapptemplate->exists($id)) {
			throw new NotFoundException(__('Invalid vapptemplate'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Vapptemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The vapptemplate has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vapptemplate could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Vapptemplate.' . $this->Vapptemplate->primaryKey => $id));
			$this->request->data = $this->Vapptemplate->find('first', $options);
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
		$this->Vapptemplate->id = $id;
		if (!$this->Vapptemplate->exists()) {
			throw new NotFoundException(__('Invalid vapptemplate'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Vapptemplate->delete()) {
			$this->Session->setFlash(__('Vapptemplate deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Vapptemplate was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
