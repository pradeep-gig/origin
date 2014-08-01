<?php
echo $this->Html->css('blogpost-style');
echo $this->Html->css('jquery-ui');

echo $this->Html->script('add-post');
echo $this->Html->script('jquery-ui');
echo $this->Html->script('edit-post');

echo $this->fetch('css');
echo $this->fetch('script');
?>
<?php if(!isset($user_id) && $user_id == NULL) { ?>
<span>To add your post login to your account!!!</span>
<?php } ?>
<?php foreach ($posts as $post): ?>
<form class="form-body">
	
	<div class="blogpost-body">
		<p class="post-title"><?php echo $post['Post']['title']; ?>:</p>
		<p class="post-body"><?php echo $post['Post']['body']; ?></p>
		<div class="created-by">
			Author:<?php echo $post['User']['username']; ?><br>
			Created-On:<?php echo $post['Post']['created']; ?>
		</div>
		<?php
		if(isset($username) && $username != NULL)
		{
		if($role == "admin") { ?>
			<?php 
			echo "<button id='dialog-form' class = 'edit-button'>Edit</button>";
			echo $this->Form->input('id', array('type' => 'hidden', 'class' => 'post-id', 'value' => $post['Post']['id']));
			?>
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure', 'class'=> 'delete-button')); ?>
		<?php }
		elseif($username == $post['User']['username']) { ?>
			<?php echo "<a href='#' class = 'edit-button'>Edit</a>";
			echo $this->Form->input('id', array('type' => 'hidden', 'class' => 'post-id', 'value' => $post['Post']['id']));
			?>
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure', 'class'=> 'delete-button')); ?>
		<?php } 
		} ?> 
		
	</div>	
</form>
<?php endforeach; ?>
	<?php unset($post); ?>
	<?php
		if(isset($username) && $username != NULL)
		{ ?>
<span>To add a new post click here</span>
<?php echo $this->HTML->link('Add Post', array('controller' => 'posts', 'action' => 'add'), array('class' => 'button')); ?>
<?php } ?>
<div class="add-post">
	<?php
		echo $this->Form->create('Post', array('action' => 'add'));
		echo $this->Form->input('title');
		echo $this->Form->input('body', array('rows' => '3'));
		echo $this->Form->end('Save Post');
	?>
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
