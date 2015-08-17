<div class="container">
    <div class="row">
        <?php echo $this->Form->create('User'); ?>
        <form role="form">
            <fieldset>
                <legend><?php echo __('Forgot Password'); ?></legend>
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
                        <?php echo $this->Form->submit('Reset Password', array('class' => 'btn btn-lg btn-success')); ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
