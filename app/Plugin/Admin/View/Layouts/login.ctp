<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="vi" lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content=""  />
    <?php echo $this->Html->meta('icon', '/img/favicon.ico', array('type' => 'icon'));?>
    <title>Đăng nhập vào hệ thống</title>
    <!--css-->
    <?php echo $this->Html->css(array(
        'bootstrap',
        'Admin.sb-admin',
        'font-awesome',
    )); ?>
    <!--JS-->
    <?php echo $this->Html->script(array('jquery.min')); ?>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <?php echo $this->fetch('content'); ?>

        </div>
    </div>
</div>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>