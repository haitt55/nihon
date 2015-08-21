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
                <div class="form-group row hidden" id="person">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Person name</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('person_name', array('class' => 'form-control', 'label' => false)); ?>
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
    $('#datepicker').datepicker({
        format: "yyyy-mm-dd"
    });  
    var change = function (val)
    {
        if (val === '1' || val === '2') {
            $('#person').removeClass('hidden');
        } else {
            $('#person').addClass('hidden');
        }
    };
    
    change($('#categoryOptions').val());
    
    $('#categoryOptions').change(function() {
        change($(this).val());
    });
    
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
                var data = JSON.parse(response);
                opt="";
                for(i in data){
                  opt+="<option value='"+i+"' >"+data[i]+"</option>";
                }
                jQuery('#categoryOptions').html(opt);
            },
            data:jQuery('form').serialize()
        });
        return false;
    });
});
</script>