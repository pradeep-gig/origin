<div ng-app = "livedisplay">
<?php
echo $this->Html->css('blogpost-style');
echo $this->Html->css('jquery-ui');

echo $this->Html->script('add-post');
echo $this->Html->script('jquery-ui');
echo $this->Html->script('edit-post');
echo $this->Html->script('angular.min');
echo $this->Html->script('app');


echo $this->fetch('css');
echo $this->fetch('script');
?>

		<?php if(!isset($user_id) && $user_id == NULL) { ?>
		<span>To add your post login to your account!!!</span>
		<?php } ?>
		<?php foreach ($posts as $post): ?>
		<div class="form-body">
			
			<div class="blogpost-body">
				<p class="post-title"><?php echo $post['Post']['title']; ?>:</p>
				<p class="post-body"><?php echo $post['Post']['body']; ?></p>
				<div class="created-by">
					<span class="author">Author:<?php echo $post['User']['username']; ?></span><br>
					<span class="date">Created-On:<?php echo $post['Post']['created']; ?></span>
				</div>
				<?php
				if(isset($username) && $username != NULL)
				{
				if($role == "admin") { ?>
					<?php 
					echo "<button id='dialog-form' class = 'edit-button'>Edit</button>";
					echo $this->Form->input('id', array('type' => 'hidden', 'class' => 'post-id', 'value' => $post['Post']['id']));
					?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']),array('class'=> 'delete-button '), __('Are you sure to delete  %s?', $post['Post']['id'])); ?>
					
				<?php }
				elseif($username == $post['User']['username']) { ?>
					<?php echo "<a href='#' class = 'edit-button'>Edit</a>";
					echo $this->Form->input('id', array('type' => 'hidden', 'class' => 'post-id', 'value' => $post['Post']['id']));
					?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array('class' => 'delete-button'), array(), __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
				<?php } 
				} ?> 
				
			</div>	
		</div>
		<?php endforeach; ?>
			<?php unset($post); ?>
			<div class="adding" ng-controller = "liveformController as live">
				<div class="liveform" >
					
					<div class="livepost">
						<p class="livepost-title">{{live.item.title}}</p>
						<p class="livepost-body">{{live.item.body}}</p>
					</div>	
				</div>
				
				<?php
					if(isset($username) && $username != NULL)
					{ ?>
					<span>To add a new post click here</span>
					<?php echo $this->HTML->link('Add Post', array('controller' => 'posts', 'action' => 'add'), array('class' => 'button')); ?>
					<?php } ?>
				<div class="add-post">
					<?php
						echo $this->Form->create('Post', array('action' => 'add'));
						echo $this->Form->input('title', array('ng-model' => 'live.item.title'));
						echo $this->Form->input('body', array('rows' => '3', 'ng-model' => 'live.item.body'));
						echo $this->Form->end('Save Post');
					?>
				</div>	
			</div>
			
		<div class="edit-post" title="Edit Post">
			<form>
				<p>Title</p>
				<input type="text" class="Epost-title">
				<p>Body</p>
				<textarea rows="4" cols="50" class="Epost-body"> </textarea>
				<input type="hidden" class="Epost-id">
				<input type="button" value="Save" id="Save-post">	
			</form>
			
		</div>
	
</div>
