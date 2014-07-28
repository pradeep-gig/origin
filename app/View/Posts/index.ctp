<?php
echo $this->Html->css('blogpost-style');
echo $this->fetch('css');
?>
<?php
		if(isset($username) && $username != NULL)
		{ ?>
<span>To add a new post click here</span>
<?php echo $this->HTML->link('Add Post', array('controller' => 'posts', 'action' => 'add'), array('class' => 'button')); ?>
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
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']), array('class' => 'edit-button'));?>
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure', 'class'=> 'delete-button')); ?>
		<?php }
		elseif($username == $post['User']['username']) { ?>
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']), array('class' => 'edit-button'));?>
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure', 'class'=> 'delete-button')); ?>
		<?php } 
		} ?> 
		
	</div>	
</form>
<?php endforeach; ?>
	<?php unset($post); ?>