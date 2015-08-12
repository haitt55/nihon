<div class="container">
    <div class="row">
        <?php echo $this->Form->create('User'); ?>
        <form role="form">
            <fieldset>
                <legend><?php echo __('Edit User'); ?></legend>
                <?php echo $this->Form->input('id'); ?>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">First name</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('first_name', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Last name</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('last_name', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Email</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('email', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Phone number</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('phone_number', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Age</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('age', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Address</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('address', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Major</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('major', array('class' => 'form-control', 'label' => false)); ?>
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
