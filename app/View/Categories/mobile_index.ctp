<?php $this->assign('title', $title); ?>

<div class="title-h2">
    <h2 class="list-header"><?= $titleCategory; ?></h2>
</div>
<div id="blog-landing">
    <?php if (!empty($categoryList)): ?>
        <?php foreach($categoryList as $category): ?>
            <div class="post post-category clearfix">
                <?= $this->Html->Link(
                    '<div class="img img-wrap">'.
                    $this->Html->image(
                        'main/posts/'.$category['Category']['img'],
                        array('alt' => $category['Category']['name'])
                    ).'</div>'.
                    '<div class="txt">'.
                        '<div class="title">'.$category['Category']['name'].
                    '</div>'.
                        '<p class="desc">'.htmlspecialchars_decode($category['Category']['description']).'</p>'.
                    '</div>',
                    array(
                        'controller' => false,
                        'action' => 'danh-muc',
                        $category['Category']['slug']
                    ),
                    array('escape' => false, 'class' => 'clearfix')
                ) ?>
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>

<div class="next-btn">
    <?php
    $this->Paginator->options(array(
        'url'=> array(
            'controller' => 'categories',
            'action' => 'index'
        )));

    echo $this->Paginator->next('Xem thêm',
        array('tag' => false, 'escape' => false, 'class' => 'next-link'), null, array('class' => 'disabled'));
    ?>
</div>

<?= $this->element('mobile_footer') ?>