<div class="">
    <?php echo $this->Form->create(false, array('type' => 'get', 'class' => 'form-search', 'role' => 'search'));?>
    <div class="row">
        <div class="col-md-1 col-sm-1 form-search-control">
            <label class="control-label my_header pull-right">Month</label>
        </div>
        <div class="col-md-1 col-sm-1 form-search-control">
            <?php echo $this->Form->input('month', array('options' => $monthOptions, 'value' => isset($monthValue) ? $monthValue : date('m'),  'class' => 'form-control', 'label' => false, 'id' => 'monthOptions')); ?>
        </div>
        <div class="col-md-1 col-sm-1 form-search-control">
            <label class="control-label my_header pull-right">Year</label>
        </div>
        <div class="col-md-2 col-sm-2 form-search-control">
            <?php echo $this->Form->input('year', array('options' => $yearOptions, 'value' => isset($yearValue) ? $yearValue : date('Y'), 'class' => 'form-control', 'label' => false, 'id' => 'yearOptions')); ?>
        </div>
        <div class="col-md-2 col-sm-2 form-search-control">
            <?php echo $this->Form->submit('Search', array('class' => 'btn btn-md btn-success', 'style' => 'width:100%')); ?>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
    <br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Transactions
                <a class="btn btn-success pull-right" href="<?php echo Router::Url(['controller' => 'transactions', 'action' => 'add']); ?>" style="margin-top: -8px;">Add Transaction</a>
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <?php
                $income = 0;
                $expense = 0;
                    foreach ($allTransactions as $date => $transactionByDate) {
                        foreach ($transactionByDate as $transaction) {
                            if ($transaction['Category']['type'] == 1) {
                                $income += $transaction['Transaction']['amount_money'];
                            }
                            if ($transaction['Category']['type'] == 2) {
                                $expense += $transaction['Transaction']['amount_money'];
                            }
                        }
                    }
                ?>
                <thead>
                    <tr>
                        <td>
                            <table width="100%">
                                <tr>
                                    <td>Income:</td>
                                    <td class="text-info"><?php echo $income ?></td>
                                </tr>
                                <tr>
                                    <td>Expense:</td>
                                    <td class="text-danger"><?php echo $expense ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php echo $income - $expense ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($allTransactions as $date => $transactionByDate) : ?>
                    <tr>
                        <td>
                            <p class="text-success"><?php echo $date ?></p>
                            <table style="width:100%">
                                <?php foreach ($transactionByDate as $transaction) : ?>
                                <tr>
                                    <td style="width:20%">
                                        <?php echo $this->Html->image($transaction['Category']['photo'] ? '/'.Configure::read('img_folder.category') . '' . $transaction['Category']['photo'] :
                                        Configure::read('img_folder.category') . 'photo.jpeg', array('class' => 'img-circle header-img')); ?>
                                        <?php echo $transaction['Category']['name'] ? $transaction['Category']['name'] : '' ?>
                                    </td>
                                    <td style="width:20%">
                                        <?php echo $transaction['Transaction']['description'] ? $transaction['Transaction']['description'] : '' ?>
                                    </td>
                                    <td style="width:20%">
                                        <?php 
                                        if ($transaction['Category']['id'] == 1) {
                                            echo "Borrow from";
                                        } elseif ($transaction['Category']['id'] == 2) {
                                            echo "Lend to";
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                        <?php echo $transaction['Transaction']['person_name'] ? $transaction['Transaction']['person_name'] : '' ?>
                                    </td>
                                    <td style="width:20%"><?php echo $transaction['Transaction']['amount_money'] ? $transaction['Transaction']['amount_money'] : '' ?></td>
                                    <td class="text-center" style="width:20%">
                                        <a class="btn btn-warning" href="<?php echo Router::Url(['controller' => 'transactions', 'action' => 'edit', $transaction['Transaction']['id']]); ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                        <a class="btn btn-danger" id="delete<?php echo $transaction['Transaction']['id'] ?>">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </a>
                                    </td>
                                </tr>
                                <script type="text/javascript">
                                    $(document).ready(function() {
                                    $("#delete<?php echo $transaction['Transaction']['id'] ?>").click(function() {
                                        jQuery.ajax({
                                            type:'DELETE',
                                            async: true,
                                            cache: false,
                                            url: '<?php echo Router::Url(['controller' => 'transactions', 'action' => 'deleteTransaction', $transaction['Transaction']['id']], TRUE); ?>',
                                            success: function(response) {
                                                console.log(response);
                                                window.location = '<?php echo Router::Url(['controller' => 'transactions', 'action' => 'index'], TRUE); ?>';
                                            },
                                            data:jQuery('form').serialize()
                                        });
                                        return false;
                                    });
                                    });
                                </script>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
