<div class="login-panel panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Đăng nhập vào hệ thống:</h3>
    </div>
    <div class="panel-body">
        <?php
        echo $this->Form->create('Manager'); ?>
        <fieldset>
            <?php echo $this->Session->flash(); ?>
            <div class="form-group">
                <?php echo $this->Form->input('email', array('class' => 'form-control', 'placeholder' => 'E-mail', 'div' => false, 'label' => false, 'autofocus' => '')); ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Mật khẩu', 'div' => false, 'label' => false)); ?>
            </div>
            <!-- Change this to a button or input when using this as a form -->
            <?php echo $this->Form->submit('Đăng nhập', array('class' => 'btn btn-lg btn-success btn-block', 'div' => false)); ?>
        </fieldset>

        <?php echo $this->Form->end(); ?>
    </div>
</div>