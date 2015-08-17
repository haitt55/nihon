<div class="container">
    <div class="row">
        <?php echo $this->Form->create('User'); ?>
        <form role="form">
            <fieldset>
                <legend><?php echo __('Forgot Password'); ?></legend>
                <p class="my_header">Please enter your email and we will send email to guide getting back the password.</p>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Your email</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('email', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->submit('Send', array('class' => 'btn btn-lg btn-success')); ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
