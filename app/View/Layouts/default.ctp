<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php echo $this->Html->css('bootstrap.min'); ?>
        <?php echo $this->Html->css('bootstrap-theme.min'); ?>
        <?php echo $this->Html->css('dashboard'); ?>
        <?php echo $this->Html->css('datepicker'); ?>
        <link rel="stylesheet" type="text/css" href="/style.css" />
        
        <?php echo $this->Html->script('jquery'); ?>

        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $this->fetch('title'); ?>
        </title>
        <?php
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        ?>
    </head>
    <body style="background-color: #ecf0f1">
        <?php echo $this->element('nav-bar', array('auth' => $auth)); ?>
        <div class="container-fluid">
            <div class="row">
                <?php echo $this->element('side-bar', array(
                    'curretWallet' => isset($curretWallet) ? $curretWallet : '',
                    'allWallets' => isset($allWallets) ? $allWallets : '')); ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <div class="">
                        <div id="content">

                            <?php echo $this->Session->flash(); ?>
                            
                            <?php echo $this->fetch('content'); ?>
                        </div>
                        <div id="footer">
                            <?php echo $this->element('sql_dump'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php echo $this->Html->script('bootstrap-datepicker'); ?>
<?php echo $this->Html->script('bootstrap.min'); ?>
</html>

