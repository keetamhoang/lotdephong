<?php $this->assign('title', $title); ?>

<div id="main">
    <div id="left">
        <h1 style="margin-bottom: 18px;"><?= $titleCategory; ?></h1>
        <div class="posts categories">
            <?php
            if ($categoryList) {
                foreach($categoryList as $category) { ?>
                    <div class="post post-category">
                        <div class="img img-wrap">
                            <?= $this->Html->link(
                                $this->Html->image(
                                    'main/posts/'.$category['Category']['img'],
                                    array('alt' => $category['Category']['name'])
                                ),
                                array(
                                    'controller' => false,
                                    'action' => 'danh-muc',
                                    $category['Category']['slug']
                                ),
                                array(
                                    'escape' => false
                                )
                            ); ?>
                        </div>
                        <div class="txt">
                            <?= $this->Html->link(
                                $category['Category']['name'],
                                array(
                                    'controller' => false,
                                    'action' => 'danh-muc',
                                    $category['Category']['slug']
                                ),
                                array(
                                    'class' => 'title'
                                )
                            ); ?>

                            <p class="desc">
                                <?= htmlspecialchars_decode($category['Category']['description']) ?>
                            </p>
                            <div class="clearfix">
                                <div class="view-details">
                                    <?= $this->Html->link(
                                        'Xem chi tiết <i class="fa fa-angle-double-right"></i>',
                                        array(
                                            'controller' => false,
                                            'action' => 'danh-muc',
                                            $category['Category']['slug']
                                        ),
                                        array('escape' => false)
                                    ); ?>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                <?php }
            } else { ?>
                <div>
                    Chưa có dữ liệu cho mục này. Trở về <?= $this->Html->link('Trang chủ', array(
                        'controller' => 'pages',
                        'action' => 'index'
                    )); ?>
                </div>
            <?php }
            ?>
            <?php
            $this->Paginator->options(array(
                'url'=> array(
                    'controller' => 'categories',
                    'action' => 'index'
                )));
            ?>
            <?php echo $this->Paginator->next('Trang sau <i class="fa fa-angle-double-right"></i>',
                array('tag' => false, 'escape' => false, 'class' => 'next-btn'), null, array('class' => 'disabled')); ?>

        </div>

        <?= $this->element('footer'); ?>

    </div>
    <div id="right">
        <div class="fixed-holder" data-fixedtop="45"></div>
        <div class="fixed-right">
            <div class="right-box">

                <?= $this->element('sidebar'); ?>

            </div>
        </div
    </div>
    <div class="clearfix"></div>
</div>