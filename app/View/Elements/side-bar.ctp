<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="active dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo $curretWallet ? ($curretWallet['photo'] ? Configure::read('img_folder.wallet') . '' . $curretWallet['photo'] :
                            Configure::read('img_folder.wallet') . 'index.jpeg') : '/img/wallets/index.jpeg'; ?>
                            <?php echo '' ?>"
                    class="img-circle header-img">
                <b><?php echo $curretWallet ? $curretWallet['name'] : 'Hello' ?></b>
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
                    <a href="javascript:void(0);" style="float: left; width:85%">
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

<script>
    $("#option1").click(function(){
        $('')
    });
</script>