<?php echo $this->Form->create(null, array('url' => '/users/register'));?>
<h2> Fill out the form below to register </h2>
<?php echo $this->Form->input('User.username') ?>
<?php echo $this->Form->input('User.password',array('size' => '30',)) ?>
<?php echo $this->Form->input('User.confirmpassword', array('size' => '30','type'=>'password',)) ?>
<?php echo $this->Form->input('User.email') ?>
<?php echo $this->Form->Submit('register') ?>
<?php echo $this->Form->end(); ?>