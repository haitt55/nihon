<div class="container">
    <div class="row">
        <?php echo $this->Form->create('Transaction', array('type'=>'file')); ?>
        <form role="form">
            <fieldset>
                <legend><?php echo __('Transfer money'); ?></legend>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Amount money</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('amount_money', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Transfer to</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('wallet_id', array('value' => 0, 'type' => 'select', 'options' => $walletOptions, 'class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Description</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('description', array('class' => 'form-control', 'label' => false)); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Date</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('add_date', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'id' => 'datepicker')); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->submit('Transfer', array('class' => 'btn btn-lg btn-success')); ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>