<?php
echo $this->Html->css('style');
echo $this->fetch('css');
?>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
<fieldset>
<legend><?php echo __('Sign in'); ?></legend>
<?php echo $this->Form->input('username');
echo $this->Form->input('password');
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>