<div class="container">
    <div class="row">
        <?php echo $this->Form->create('Wallet', array('type'=>'file')); ?>
        <form role="form">
            <fieldset>
                <legend><?php echo __('Update wallet info'); ?></legend>
                <?php echo $this->Form->input('id'); ?>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Wallet's name</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('name', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Type of money</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('money_type', array('options' => $moneyTypeOptions, 'class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Photo</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('photo', array('type'=>'file', 'label' => false)); ?>
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
