<?php
	class PostsController extends AppController {
		public $helpers = array('HTML', 'Form', 'Session');
		public $components =array('Session');
		public function beforeFilter() {
			$this->Auth->allow('index', 'view');
		}

		public function index() {

			$this->set('posts', $this->Post->find('all'));
			$user_id = $this->Auth->user('id');
			$this->set('user_id', $user_id);
			$username = $this->Auth->user('username');
			$this->set('username', $username);
			$role = $this->Auth->user('role');
			$this->set('role', $role);
		}


		public function view($id = null) {
			$user_id = $this->Auth->user('id');
			$this->set('user_id', $user_id);
			if(!$id) {
				throw new NotFoundException(__('Invalid post'));
			}
			$post = $this->Post->findById($id);
			if(!$post) {
				throw new NotFoundException(__('Invalid post'));
			}
			$this->set('post', $post);
		}
		public function add() {
			$user_id = $this->Auth->user('id');
			$this->set('user_id', $user_id);
			if($this->request->is('post')) {
				$this->request->data['Post']['user_id'] = $this->Auth->user('id');
				if($this->Post->save($this->request->data)) {
					$this->Session->setFlash(__('Your post has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add your post.'));
			}
		}
		public function edit($id = null) {
			$user_id = $this->Auth->user('id');
			$this->set('user_id', $user_id);
			if(!$id) {
				throw new NotFoundException(__('Invalid post'));
			}
			$post = $this->Post->findById($id);
			if(!$post){
				throw new NotFoundException(__('Invalid post'));
			}
			if($this->request->is(array('post', 'put'))) {
				$this->Post->id = $id;
				if($this->Post->save($this->request->data)) {
					$this->Session->setFlash(__('Your post has been updated.'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to update your post.'));
			}
			if(!$this->request->data) {
				$this->request->data = $post;
			}
		}
		public function delete($id) {
			if($this->request->is('get')) {
				throw new MethodNotAllowedException();
			}
			if($this->Post->delete($id)) {
				$this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)));
				return $this->redirect(array('action' => 'index'));
			}
		}
		public function isAuthorized($user) {
			// All registered users can add posts
			if ($this->action === 'add') {
				return true;
			}
			// The owner of a post can edit and delete it
			if (in_array($this->action, array('edit', 'delete'))) {
				$postId = (int) $this->request->params['pass'][0];
				if ($this->Post->isOwnedBy($postId, $user['id'])) {
					return true;
				}
			}
			return parent::isAuthorized($user);
				if($this->action === add) {
					return true;
				}
			if(in_array($this->action, array('edit', 'delete'))) {
				$postId = (int) $this->request->params['pass'][0];
				if($this->Post->isownedBy($postId, $user['id']));{
					return true;				
				}
			}	
		}
	}
?> 