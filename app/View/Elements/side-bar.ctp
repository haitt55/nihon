<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="active dropdown">
            <a id="currentWallet" href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo $curretWallet ? ($curretWallet['photo'] ? Configure::read('img_folder.wallet') . '' . $curretWallet['photo'] :
                            Configure::read('img_folder.wallet') . 'index.jpeg') : '/img/wallets/index.jpeg'; ?>
                            <?php echo '' ?>"
                    class="img-circle header-img">
                <h5 style="float:left"><b><?php echo $curretWallet ? $curretWallet['name'] : 'Hello' ?>&nbsp;</b></h5>
                <h5 class="text-warning">1000000000</h5>
                <span class="sr-only">(current)</span>
            </a>
            <ul class="dropdown-menu" style="min-width: 100%">
                <li>
                    <a href="/wallets/total/">
                        <img src="<?php echo Configure::read('img_folder.wallet') . 'index.jpeg' ?>" class="img-circle">
                        Total
                    </a>
                </li>
                <?php foreach ($allWallets as $wallet): ?>
                <li>
                    <a id="wallet<?php echo $wallet['Wallet']['id'] ?>" href="javascript:void(0);" style="float: left; width:85%">
                        <img src="<?php echo $wallet['Wallet']['photo'] ? Configure::read('img_folder.wallet') . '' . $wallet['Wallet']['photo'] :
                            Configure::read('img_folder.wallet') . 'index.jpeg'; ?>" 
                            class="img-circle">
                    <?php echo $wallet['Wallet']['name']; ?>
                    </a>
                    <span class="glyphicon glyphicon-pencil pull-right" id="option<?php echo $wallet['Wallet']['id']?>"></span>
                    <ul class=" nav nav-pills dropdown-menu sub-menu">
                        <li><a href="#">Dropdown link</a></li>
                        <li><a href="#">Dropdown link</a></li>
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
                <li><a href="/wallets/add"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;<b class="my_success">Add Wallet</b></a></li>
            </ul>
        </li>
        <li><a href="#">Depts</a></li>
        <li><a href="#">Loans</a></li>
        <li><a href="#">Categories</a></li>
        <li><a href="#">Export</a></li>
    </ul>
</div>