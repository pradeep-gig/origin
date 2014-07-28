<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->Html->script('jquery-2.1.1');
		echo $this->Html->script('profile-menu');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Welcome To our Blog<span>
				<?php if(!isset($user_id) && $user_id == NULL) { ?>
						<div class="login-div">
							<h5><?php echo $this->HTML->link('Log in', array('controller' => 'users', 'action' => 'login'), array('class' => 'login')); ?></h5>	
						</div>
				<?php } ?>

				<?php if(isset($user_id) && $user_id != NULL){ ?>
			<div class="user">
				<h5><a href="#">Hi,<?php echo $username;?> <b class="caret"></b></a></h5>

			</div>
			<?php } ?>	
			
			</span></h1>
		</div>

	</div>

		<div id="content">
			<div class="drop-down">
				<ul>
					<li>
						<?php echo $this->HTML->link('Home', array('controller' => 'posts',
				 		'action' => 'index'), array("class" => "a")); ?>
					</li>
					<li>
						<?php echo $this->HTML->link('Log Out', array('controller' => 'users',
				 		'action' => 'logout'), array("class" => "a")); ?> 
					</li>
					<li>
						<?php if($role == "admin"){ ?>
							<?php echo $this->HTML->link('User Settings', array('controller' => 'users',
				 			'action' => 'index'), array("class" => "a")); ?>
				 		<?php } elseif($role == "author"){ ?>
				 			<?php echo $this->HTML->link('User Settings', array('controller' => 'users',
				 			'action' => 'useredit'), array("class" => "a")); ?>
				 			<?php } ?>
				 	</li>
				</ul>
				
			</div>

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
				
		</div>
</body>
</html>
