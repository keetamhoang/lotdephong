<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Trang Quản Trị</title>

    <?php
    echo $this->Html->meta('icon', '/img/favicon.ico', array('type' => 'icon'));
    echo $this->Html->meta('description', 'Cùng chia sẻ, bàn luận những sự kiện đang hot nhất trên mạng.');
    echo $this->Html->meta(array('property' => 'og:type', 'type' => 'meta', 'content' => 'website', 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:url', 'type' => 'meta', 'content' => 'http://xxx.com', 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:title', 'type' => 'meta', 'content' => 'http://cogitop.com', 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:description', 'type' => 'meta', 'content' => 'Cùng chia sẻ, bàn luận những sự kiện đang hot nhất trên mạng.', 'rel' => null));
    ?>

<!--    --><?php // echo $this->Html->meta('icon'); ?>

    <?php echo $this->Html->css(array(
        'bootstrap',
        'Admin.sb-admin',
        'font-awesome',
        'Admin.style'
    )); ?>

    <?php echo $this->Html->script(array(
        'jquery.min',
        'bootstrap.min',
        'Admin.backend'
    )); ?>

</head>

<body>

    <div id="wrapper">

        <?= $this->element('Admin.navbar'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?= $this->element('Admin.heading'); ?>

                <?= $this->fetch('content'); ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>
<?php //echo $this->element('sql_dump'); ?>
</html>