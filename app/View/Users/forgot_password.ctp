<div class="container">
    <div class="row">
        <?php echo $this->Form->create('User'); ?>
        <form role="form">
            <fieldset>
                <legend><?php echo __('Forgot Password'); ?></legend>
<!--                <p class="my_header">Please enter your username and we will send new password to your email.</p>
                <p class="my_header">Check your email and get new password.</p>-->
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Your username</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('username', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Your phone number</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('phone_number', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">New password</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('password', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Confirm Password</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('confirmpassword', array('class' => 'form-control', 'label' => false, 'type' => 'password')); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->submit('Save', array('class' => 'btn btn-lg btn-success')); ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
