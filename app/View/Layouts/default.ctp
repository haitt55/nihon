<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/dashboard.css" />
        <link rel="stylesheet" type="text/css" href="/style.css" />

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
                <?php echo $this->element('side-bar'); ?>
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    <div id="container" class="container">
                        <div id="content">

                            <?php echo $this->Session->flash(); echo '<br>'; ?>
                            
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
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
</html>

