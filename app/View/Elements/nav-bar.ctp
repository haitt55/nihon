<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= Router::Url(['controller' => 'pages', 'action' => 'display', 'home'], TRUE); ?>"><i class="glyphicon glyphicon-home"></i>&nbsp;&nbsp;Money Lover</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <?php if(isset($auth)): ?>
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo isset($auth) ? $auth['username'] : '' ?>&nbsp;&nbsp;<i class="glyphicon glyphicon-user"></i></a>
                    <ul class="dropdown-menu" style="min-width: 200px">
                        <li><a href="<?= Router::Url(['controller' => 'users', 'action' => 'view', isset($auth['id']) ? $auth['id'] : ''], TRUE); ?>"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Profile</a></li>
                        <li><a href="<?= Router::Url(['controller' => 'users', 'action' => 'change_password', isset($auth['id']) ? $auth['id'] : ''], TRUE); ?>"><i class="glyphicon glyphicon-edit"></i>&nbsp;&nbsp;Change Password</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?= Router::Url(['controller' => 'users', 'action' => 'logout'], TRUE); ?>"><i class="glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;Logout</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li><a href="<?= Router::Url(['controller' => 'users', 'action' => 'login'], TRUE); ?>">Login</a></li>
                <?php endif; ?>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>