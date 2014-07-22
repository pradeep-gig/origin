<h1>Blog posts</h1>
<?php echo $this->HTML->link('Add Post', array('controller' => 'posts', 'action' => 'add')); ?>
<?php if($user_id != NULL){ ?>
	<h4 style="float: right"> <?php echo $this->HTML->link('Log Out', array('controller' => 'users', 'action' => 'logout')); ?> </h4>	
<?php }
?>
<table>
	<tr style="background: red">
		<th>Id</th>
		<th>Title</th>
		<th>Delete post</th>
		<th>Edit post</th>
		<th>Created</th>
	</tr>
		<!-- Here is where we loop through our $posts array, printing out post info -->
	<?php foreach ($posts as $post): ?>
	<tr style="background: orange">
		<td><?php echo $post['Post']['id']; ?></td>
		<td>
		<?php echo $this->Html->link($post['Post']['title'],
		array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
		</td>
		<td>
			<?php 
				echo $this->Form->postLink('Delete', array('action' => 'delete', $post['Post']['id']),
					array('confirm' => 'Are you sure')
					);
			 ?>
		</td>
		<td>
			<?php
				echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id']));
			?>
		</td>
		<td><?php echo $post['Post']['created']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($post); ?>
</table>