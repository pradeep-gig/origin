<?php
echo $this->Html->css('style');
echo $this->fetch('css');
?>
<div>
	<p>If you dont have an account, create one for you now <?php echo $this->Html->link(__('Sign in'), array('action' => 'add')); ?></p>
</div>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
<fieldset>
<legend>
<?php echo __('Please enter your username and password'); ?>
</legend>
<?php echo $this->Form->input('username');
echo $this->Form->input('password');
?>
</fieldset>
	<?php echo $this->Form->end(__('Login')); ?>
</div>