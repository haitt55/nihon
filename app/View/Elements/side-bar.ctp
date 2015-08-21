<div class="col-sm-3 col-md-2 sidebar" id="sidebar<?php echo isset($auth)? $auth['id'] : '' ?>">
    <ul class="nav nav-sidebar">
        <li class="active dropdown">
            <a id="currentWallet" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                <?php echo $this->Html->image($curretWallet ? ($curretWallet['photo'] ? '/'.Configure::read('img_folder.wallet') . '' . $curretWallet['photo'] :
                            Configure::read('img_folder.wallet') . 'index.jpeg') : '/img/wallets/index.jpeg', array('class' => 'img-circle header-img')); ?>
                <h5 style="float:left"><b><?php echo $curretWallet ? $curretWallet['name'] : '' ?>&nbsp;</b></h5>
                <?php 
                    if (isset($amountTotalIncomeCurrentWallet) && isset($amountTotalExpenseCurrentWallet)) {
                        $amountTotalMoneyCurrentWallet = $amountTotalIncomeCurrentWallet - $amountTotalExpenseCurrentWallet;
                    } else {
                        $amountTotalMoneyCurrentWallet = 0;
                    }
                ?>
                <h5 class="text-warning"><?php echo $amountTotalMoneyCurrentWallet; ?></h5>
                <span class="sr-only">(current)</span>
            </a>
            <ul class="dropdown-menu" style="min-width: 100%">
                <li>
                    <a href="<?= Router::Url(['controller' => 'wallets', 'action' => 'total'], TRUE); ?>">
                        <?php echo $this->Html->image('/'.Configure::read('img_folder.wallet') . 'index.jpeg', array('class' => 'img-circle')); ?>
                        <b style="float:left">Total&nbsp;</b>
                        <h5 class="text-warning" style="margin-top:2px"><?php echo $amountTotalAllWallet; ?></h5>
                    </a>
                </li>
                <?php foreach ($allWallets as $wallet): ?>
                <li>
                    <a id="wallet<?php echo $wallet['Wallet']['id'] ?>" href="javascript:void(0);" style="float: left; width:85%">
                        <?php echo $this->Html->image($wallet['Wallet']['photo'] ? '/'.Configure::read('img_folder.wallet') . '' . $wallet['Wallet']['photo'] :
                            '/'.Configure::read('img_folder.wallet') . 'index.jpeg', array('class' => 'img-circle')); ?>
                    <?php echo $wallet['Wallet']['name']; ?>
                    </a>
                    <span class="glyphicon glyphicon-pencil pull-right" style=":hover{background-color: #d35400}"></span>
                    <ul class="dropdown-menu sub-menu">
                        <li><a href="javascript:void(0);">Dropdown link</a></li>
                        <li><a href="javascript:void(0);">Dropdown link</a></li>
                    </ul>
                </li>
                <script>
                    $(document).ready(function() {
                        $("#wallet<?php echo $wallet['Wallet']['id']?>").click(function(){
                            jQuery.ajax({
                                type:'PUT',
                                async: true,
                                cache: false,
                                url: '<?= Router::Url(['controller' => 'wallets', 'action' => 'changeCurrentWallet', $wallet['Wallet']['id']], TRUE); ?>',
                                success: function(response) {
                                    console.log(response);
                                    window.location = '<?= Router::Url(['controller' => 'pages', 'action' => 'display', 'home'], TRUE); ?>';
                                    jQuery('#currentWallet').val(response);
                                },
                                data:jQuery('form').serialize()
                            });
                            return false;
                        });
                    }); 
                </script>
                <?php endforeach; ?>
                <li role="separator" class="divider"></li>
                <li><a href="<?= Router::Url(['controller' => 'wallets', 'action' => 'add'], TRUE); ?>"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;<b class="my_success">Add Wallet</b></a></li>
            </ul>
        </li>
        <li><a href="<?= Router::Url(['controller' => 'transactions', 'action' => 'index'], TRUE); ?>">Transactions</a></li>
        <li><a href="javascript:void(0);">Depts</a></li>
        <li><a href="javascript:void(0);">Loans</a></li>
        <li><a href="<?= Router::Url(['controller' => 'categories', 'action' => 'index'], TRUE); ?>">Categories</a></li>
        <li><a href="javascript:void(0);">Export</a></li>
    </ul>
</div>
<script>
$(document).ready(function() {
    var userId = $(".sidebar").attr('id').replace('sidebar','');
    if (userId === "") {
        $(".sidebar").addClass('hidden');
    } else {
        $(".sidebar").removeClass('hidden');
    }
}); 
</script>