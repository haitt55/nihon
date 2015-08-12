<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Login</h3>
                </div>
                <div class="panel-body">
                    <?php echo $this->Session->flash('auth'); ?>
                    <?php echo $this->Form->create('User'); ?>
                    <form role="form">
                        <fieldset>
                            <div class="form-group">
                                <?php echo $this->Form->input('username', array('id' => 'username', 'class' => 'form-control', 'placeholder' => 'Tên đăng nhập', 'autofocus' => true))?>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('password', array('id' => 'password', 'class' => 'form-control', 'placeholder' => 'Mật khẩu'))?>
                            </div>
                            <a href="/users/forgot_password">Forgot password?</a>
                            <?php echo $this->Form->submit('Login', array('class' => 'btn btn-lg btn-success btn-block')); ?>
                            <?php echo $this->Form->end() ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
