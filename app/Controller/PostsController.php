<?php
	class PostsController extends AppController {

		public function index() {

			$this->set('asdf', $this->Post->find('all'));
		}
	}
?> 