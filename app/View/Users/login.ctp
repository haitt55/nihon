<?php echo $this->Form->create(null, array('url'=>'/users/login'));?>
<h2>Please log in.</h2>
<?php echo $this->Form->input('User.email') ?>
<?php echo $this->Form->input('User.password') ?>
<?php echo $this->Form->submit('login') ?>
<?php echo $this->Form->error('User.email', $login_error) ?>
<?php echo $this->Form->end(); ?> 