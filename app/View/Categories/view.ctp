<?php $this->assign('title', $title); ?>

<h1 style="margin-bottom: 18px;"><?= $titleCategory; ?></h1>
<!--nocache-->
<?php if (!empty($eventsList)): ?>
    <section id="blog-landing">
    <?php foreach($eventsList as $eachEvent): ?>
        <article class="white-panel">
            <?php
            $time = $eachEvent['Event']['updated_at'];
            $time = $this->Translate->trans($time);
            ?>
            <?= $this->Html->link(
                $this->Html->image('main/posts/'.$eachEvent['Event']['img']).
                '<h1>'.$eachEvent['Event']['name'].'</h1>'.
                '<p class="content-event">'.htmlspecialchars_decode($eachEvent['Event']['description']).'</p>'.
                '<div class="show-info">'.
                '<div class="col-lg-8 time-update">'.
                '<p><i class="fa fa-refresh"></i> '.$time.'</p>'.
                '</div>'.
                '<div class="col-lg-4 social-count">'.
                '<p>'.
                '<span>'.$eachEvent['Event']['count_post'].' <i class="fa fa-file-text"></i></span>'.
                '<span>'.$eachEvent['Event']['count_cmt'].' <i class="fa fa-comments-o"></i></span>'.
                '</p>'.
                '</div>'.
                '</div>',
                array('controller' => 'su-kien', 'action' => $eachEvent['Event']['slug']),
                array('escape' => false)
            ) ?>

        </article>
    <?php endforeach ?>
</section>
<section>
    <div class="next-home">
        <?php
        $this->Paginator->options(array(
            'url'=> array(
                'controller' => 'categories',
                'action' => 'view',
                'category' => $slugCategory
            )));
        ?>
        <?php echo $this->Paginator->next('Xem thêm, còn nhiều thứ để hóng lắm',
            array('tag' => false, 'escape' => false, 'class' => 'next-btn'), null, array('class' => 'disabled')); ?>
    </div>
</section>
<?php else: ?>
    <div>
        Chưa có dữ liệu cho mục này. Trở về <?= $this->Html->link('Trang chủ', array(
            'controller' => 'pages',
            'action' => 'index'
        )); ?>
    </div>
<?php endif ?>
<!--/nocache-->
<section>
    <?= $this->element('footer'); ?>
</section>
