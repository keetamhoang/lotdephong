<!DOCTYPE html>
<html>
<head>
    <?php
    echo $this->Html->charset();
    echo $this->Html->meta('language', 'vi');
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $this->fetch('title'); ?></title>
    <?php
    echo $this->Html->meta('description', 'Cùng chia sẻ, bàn luận những sự kiện đang hot nhất trên mạng.');
    echo $this->Html->meta(array('property' => 'og:type', 'type' => 'meta', 'content' => 'website', 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:url', 'type' => 'meta', 'content' => 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:title', 'type' => 'meta', 'content' => $this->fetch('title'), 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:description', 'type' => 'meta', 'content' => 'Cùng chia sẻ, bàn luận những sự kiện đang hot nhất trên mạng.', 'rel' => null));
    ?>
    <?php
    echo $this->Html->meta('icon', '/img/favicon.ico', array('type' => 'icon'));
    echo $this->Html->css(array('bootstrap', 'font-awesome', 'mobile.min'));
    echo $this->Html->script(array('jquery.min', 'bootstrap.min', 'mobile'));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');

    echo $this->element('fb_plugin');
    ?>

</head>

<body>

<?= $this->element('header_mobile'); ?>

<div class="container">

    <?= $this->fetch('content'); ?>

</div>

</body>

</html>
