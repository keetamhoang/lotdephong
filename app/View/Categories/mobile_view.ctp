<?php $this->assign('title', $title); ?>

<div class="title-h2">
    <h2 class="list-header"><?= $titleCategory; ?></h2>
</div>

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
                    '<div class="time-update">'.
                    '<p><i class="fa fa-refresh"></i> '.$time.'</p>'.
                    '</div>'.
                    '<div class="social-count">'.
                    '<p>'.
                    '<span>'.$eachEvent['Event']['count_post'].' <i class="fa fa-file-text"></i></span> '.
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
        <div class="next-btn">
            <?php
            $this->Paginator->options(array(
                'url'=> array(
                    'controller' => 'categories',
                    'action' => 'view',
                    'category' => $slugCategory
                )));
            ?>
            <?php echo $this->Paginator->next('Xem thêm',
                array('tag' => false, 'escape' => false, 'class' => 'next-link'), null, array('class' => 'disabled')); ?>
        </div>
    </section>
<?php else: ?>
    <div style="background: #FFF; padding: 10px">
        Chưa có dữ liệu cho mục này. Trở về <?= $this->Html->link('Trang chủ', array(
            'controller' => 'pages',
            'action' => 'index'
        )); ?>
    </div>
<?php endif ?>
<!--/nocache-->
<section>
    <?= $this->element('mobile_footer') ?>
</section>