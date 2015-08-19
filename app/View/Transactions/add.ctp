<div class="container">
    <div class="row">
        <?php echo $this->Form->create('Transaction', array('type'=>'file')); ?>
        <form role="form">
            <fieldset>
                <legend><?php echo __('Add new transaction'); ?></legend>
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
                        <label class="control-label my_header pull-right">Type</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('type', array('value' => 0, 'type' => 'select', 'options' => $categoryTypeOptions, 'class' => 'form-control', 'label' => false, 'id' => 'categoryType')); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Category</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('category_id', array('value' => 0, 'options' => $categoryOptions, 'class' => 'form-control', 'label' => false, 'id' => 'categoryOptions')); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->submit('Add Transaction', array('class' => 'btn btn-lg btn-success')); ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    $("#categoryType").change(function() {
        var type = $(this).val();
        if (type === '<?= Category::INCOME ?>') {
            url = '<?= Router::Url(['controller' => 'categories', 'action' => 'getCategoryOptions', Category::INCOME], TRUE); ?>';
        } else if (type === '<?= Category::EXPENSE ?>') {
            url = '<?= Router::Url(['controller' => 'categories', 'action' => 'getCategoryOptions', Category::EXPENSE], TRUE); ?>';
        } else if (type === '<?= Category::SAVE ?>') {
            url = '<?= Router::Url(['controller' => 'categories', 'action' => 'getCategoryOptions', Category::SAVE], TRUE); ?>';
        } else {
            url = '';
        }
        console.log(url);
        jQuery.ajax({
            type:'POST',
            async: true,
            cache: false,
            url: url,
            success: function(response) {
                console.log(response);
                jQuery('#').val(response);
            },
            data:jQuery('form').serialize()
        });
        return false;
    });
});
</script>
