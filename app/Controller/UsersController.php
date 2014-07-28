<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {


	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('add', 'logout');
	}
/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
			$user_id = $this->Auth->user('id');
			$this->set('user_id', $user_id);
			$username = $this->Auth->user('username');
			$this->set('username', $username);
			$role = $this->Auth->user('role');
			$this->set('role', $role);
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$user_id = $this->Auth->user('id');
			$this->set('user_id', $user_id);
			$role = $this->Auth->user('role');
			$this->set('role', $role);
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$user_id = $this->Auth->user('id');
			$this->set('user_id', $user_id);
		if ($this->request->is('post')) {
			$this->User->create();
			$this->request->data['User']['role']='author';
			$un = $this->request->data['User']['username'];
			$check_username = $this->User->find('first', array('conditions' => array('User.username' => $un)));
			if(empty($check_username))
			{

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}else{
			$this->Session->setFlash(__('The username already exist, try again with another name.'));
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
		$user_id = $this->Auth->user('id');
			$this->set('user_id', $user_id);
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				if($this->Auth->users['role'] == "admin"){
					return $this->redirect(array('action' => 'index'));	
				}else if($this->Auth->users['role'] == "author") {
					return $this->redirect(array('action' => 'view'));
				}
				
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function login() {
		$user_id = $this->Auth->user('id');
			$this->set('user_id', $user_id);
		if($this->request->is('post')) {
			if($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Invalid username and password, try again'));
		}
	}
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
