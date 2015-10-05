<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="imagetoolbar" content="no">
    <?= $this->Html->meta('icon', '/img/favicon.ico', array('type' => 'icon')); ?>
    <meta name="robots" content="noindex,nofollow">
    <title>404 Không tìm thấy yêu cầu</title>

    <style>
        body {background: #f9fee8;margin: 0; padding: 20px; text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#666666;}
        .error_page {width: 600px; padding: 50px; margin: auto;}
        .error_page h1 {margin: 20px 0 0;}
        .error_page p {margin: 10px 0; padding: 0;}
        a {color: #9caa6d; text-decoration:none;}
        a:hover {color: #9caa6d; text-decoration:underline;}
    </style>

</head>

<body class="login">
<div class="error_page">
    <?= $this->Html->image('404.png', array('alt' => '404 không tìm thấy trang yêu cầu!')); ?>
    <h1>Hoy đi nha...</h1>
    <p>Không tìm thấy trang bạn đang yêu cầu.</p>
    <p>
        <?= $this->Html->link('Quay về trang chủ', array('plugin' => false, 'controller' => false, 'action' => 'index')) ?>
    </p>
</div>

</body></html>