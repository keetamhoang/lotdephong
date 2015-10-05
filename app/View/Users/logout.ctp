<?php echo $this->Facebook->html(); ?>
<?php echo $this->Facebook->logout(array('label' => 'Logout', 'redirect' => array('controller' => 'users', 'action' => 'logout'))); ?>
<?php echo $this->Facebook->init(); ?>