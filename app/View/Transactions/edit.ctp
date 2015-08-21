<div class="container">
    <div class="row">
        <?php echo $this->Form->create('Transaction', array('type'=>'file')); ?>
        <form role="form">
            <fieldset>
                <legend><?php echo __('Edit transaction'); ?></legend>
                <?php echo $this->Form->input('id') ?>
                <?php unset($categoryTypeOptions[0]); unset($categoryOptions[0]); ?>
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
                        <?php echo $this->Form->input('type', array('value' => $type, 'type' => 'select', 'options' => $categoryTypeOptions, 'class' => 'form-control', 'label' => false, 'id' => 'categoryType')); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <label class="control-label my_header pull-right">Category</label>
                    </div>
                    <div class="col-sm-4">
                        <?php echo $this->Form->input('category_id', array('options' => $categoryOptions, 'class' => 'form-control', 'label' => false, 'id' => 'categoryOptions')); ?>
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
                        <?php echo $this->Form->submit('Save', array('class' => 'btn btn-lg btn-success')); ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    
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
    
    var getCategories = function (type)
    {
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
    };
    
    $("#categoryType").change(function() {
        var type = $(this).val();
        getCategories(type);
    });
});
</script>