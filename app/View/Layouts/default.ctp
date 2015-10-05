<!DOCTYPE html>
<html>
<head>
    <?php
    echo $this->Html->charset();
    echo $this->Html->meta('language', 'vi');
    echo $this->Html->meta('viewport', 'width=device-width, initial-scale=1, maximum-scale=1');
    ?>
    <title><?php echo $this->fetch('title'); ?></title>
    <meta name="description" content="Cùng lót dép hóng những sự kiện hot nhất, hay nhất hiện nay của cộng đồng mạng">
    <meta name="keywords" content="sự kiện hot, lót dép hóng, lot dep hong, hóng hớt, hóng, sự kiện nóng, lotdephong.com">
    <?php
    if (!$this->fetch('image')) {
        $this->assign('image', 'img/cover.png');
    }
    echo $this->Html->meta(array('property' => 'og:type', 'type' => 'meta', 'content' => 'website', 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:url', 'type' => 'meta', 'content' => 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:title', 'type' => 'meta', 'content' => $this->fetch('title'), 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:image', 'type' => 'meta', 'content' => $this->fetch('image'), 'rel' => null));
    echo $this->Html->meta(array('property' => 'og:description', 'type' => 'meta', 'content' => 'Cùng hóng và chia sẻ, bình luận những sự kiện đang hot nhất trên mạng.', 'rel' => null));
    ?>
    <?php
    echo $this->Html->meta('icon', '/img/favicon.ico', array('type' => 'icon'));
    echo $this->Html->css(array('bootstrap', 'font-awesome', 'default', 'style'));
    echo $this->Html->script(array('jquery.min', 'bootstrap.min', 'slick.min', 'frontend'));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');

    echo $this->element('fb_plugin');
    ?>

</head>

<body>

<?= $this->element('header'); ?>

<div class="container">

    <?= $this->fetch('content'); ?>

</div>

<?php //echo $this->element('sql_dump'); ?>
<?= $this->Html->script(array('pinterestgrid')); ?>
<script>
    function fixHeight() {
        var artical_17 = $('#blog-landing .white-panel').last();
        var artical_18 = artical_17.prev();
        var artical_19 = artical_18.prev();

        if (artical_17.length) {
            var height_17 = artical_17.css('top').match(/\d+/);
            var height_18 = artical_18.css('top').match(/\d+/);
            var height_19 = 0;
            if (artical_19.length) {
                height_19 = artical_19.css('top').match(/\d+/);
            }
            var height_blog = $('#blog-landing').css('height').match(/\d+/);

            var h17 = artical_17.height();
            var h18 = artical_18.height();
            var h19 = artical_19.height();

            var max = parseFloat(height_17) + parseFloat(h17);
            if ((parseFloat(height_18) + parseFloat(h18)) > max) {
                max = parseFloat(height_18) + parseFloat(h18);
            }
            if ((parseFloat(height_19) + parseFloat(h19)) > max) {
                max = parseFloat(height_19) + parseFloat(h19);
            }

            artical_17.css('height', parseFloat(max - height_17 + 20) + 'px');
            artical_18.css('height', parseFloat(max - height_18 + 20) + 'px');
            artical_19.css('height', parseFloat(max - height_19 + 20) + 'px');
        }
    }

    $(document).ready(function () {
        $('#blog-landing').pinterest_grid({
            no_columns: 3,
            padding_x: 10,
            padding_y: 10,
            margin_bottom: 50,
            single_column_breakpoint: 0
        });
    });

    $(window).load(function(e) {
        fixHeight();
    });
</script>
</body>

</html>
