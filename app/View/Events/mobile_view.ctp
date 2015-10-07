<?php $this->assign('title', $title); ?>

<div class="post post-view">
    <div style="background: #FFF;padding: 0px 10px 1px;margin-bottom: -7px;">
        <h1 class="title-post"><?= htmlspecialchars_decode($event['Event']['name']); ?></h1>

        <!--nocache-->
        <?php if ($this->Session->check('Auth.Manager')) {
            echo $this->Html->link('Duyệt bài',
                array('plugin' => 'admin', 'controller' => 'events', 'action' => 'censorship', $event['Event']['id']),
                array('class' => 'censorship', 'target' => '_blank'));
        } ?>
        <!--/nocache-->

        <div class="meta">
            <!--nocache-->
            <?php
            $time = $event['Event']['updated_at'];
            $time = $this->Translate->trans($time);
            ?>
            <!--/nocache-->

            <div class="clearfix show-time" style="position: relative">
                <!--nocache-->
                <div class="time-update">
                    Cập nhật <?= $time; ?>
                </div>
                <!--/nocache-->
                <div class="chose-option">
                    <?= $this->Html->link(
                        '<i class="fa fa-pencil-square-o"></i>',
                        array(
                            'controller' => false,
                            'action' => 'gui-bai',
                            $event['Event']['id']
                        ),
                        array(
                            'class' => 'request-upload',
                            'escape' => false
                        )
                    ) ?>
                    <div class="like-event" style="position: absolute; top: 6px; right: 7px">
                        <?= $this->element('like_button_mobile') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <p class="desc" style="font-size: 17px;">
            <?= htmlspecialchars_decode($event['Event']['description']); ?>
        </p>

        <div class="fb-like-share">

        </div>
        <div class="detail-sort" style="margin-bottom: 15px;">
            <span>Sắp xếp: </span>
            <?= $this->Html->link(
                'Mới nhất',
                array(
                    'controller' => false,
                    'action' => 'su-kien',
                    $event['Event']['slug']
                ),
                array(
                    'class' => !isset($this->params['url']['o']) ? 'active' : ($this->params['url']['o'] != 'tu-dau' ? 'active' : '')
                )
            ); ?>
            <i> | </i>
            <?= $this->Html->link(
                'Cũ nhất',
                array(
                    'controller' => false,
                    'action' => 'su-kien',
                    $event['Event']['slug'],
                    '?' => array('o' => 'tu-dau')
                ),
                array(
                    'class' => !isset($this->params['url']['o']) ? '' : ($this->params['url']['o'] == 'tu-dau' ? 'active' : '')
                )
            ); ?>
        </div>
    </div>
    <div class="share-top">
        <div class="container">
            <div class="facebook_share">
                <i class="fa fa-facebook" style="color: #FFF"></i>
                <span>Share</span>
            </div>
            <div class="title">
                <h2 class="ellipsis"><?= $event['Event']['name'] ?></h2>
                <div class="like-event">
                    <?= $this->element('like_button_mobile') ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="main-event">
        <!--nocache-->
        <?php
        if (!empty($posts)) { ?>
            <div class="only-post">
                <?php
                foreach ($posts as $post) {
                    $time = $post['Post']['updated_at'];
                    $time = $this->Translate->trans($time);
                    ?>
                    <div class="each">
                        <div class="title clearfix">
                            <div class="left-title">
                                <span><i class="fa fa-clock-o"></i> <i><?= $time; ?></i></span>
                            </div>
                        </div>

                        <div class="content">
                            <div class="title">
                                <h3><?= $post['Post']['name'] ?></h3>
                            </div>
                            <p style="font-size: 16px;"><?= htmlspecialchars_decode($post['Post']['content']) ?></p>
                            <?php if (!empty($post['Post']['img'])): ?>
                                <?= $this->Html->image(
                                    'main/posts/' . $post['Post']['img'],
                                    array('alt' => $post['Post']['name'])
                                ); ?>
                            <?php endif ?>
                        </div>
                        <div class="link">
                            <div><i>Đóng góp bởi: </i> <span class="author"><?= $post['Post']['author'] ?></span></div>
                            <ul class="link-group" class="clearfix">
                                <?php
                                if (!empty($post['Link'])) {
                                    foreach ($post['Link'] as $link) { ?>
                                        <li>
                                            <div class="link-group-div">
                                                <span><?= $link['name']; ?>:</span>
                                                <pre>
                                                <a target="_blank"
                                                   href="<?= $link['link']; ?>"><?= $link['link'] ?></a>
                                                </pre>
                                            </div>
                                        </li>
                                    <?php }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <div class="not-found">
                Tạm thời hết chuyện rồi, chờ cập nhật đã nhé
            </div>
        <?php }
        ?>
        <!--/nocache-->
    </div>
    <div class="next-btn">
        <?php
        if (!isset($this->params['url']['o']) || $this->params['url']['o'] != 'tu-dau') {
            $this->Paginator->options(array(
                'url' => array(
                    'controller' => 'events',
                    'action' => 'view',
                    'event' => $event['Event']['slug']
                )));
        } else if (isset($this->params['url']['o']) && $this->params['url']['o'] == 'tu-dau') {
            $this->Paginator->options(array(
                'url' => array(
                    'controller' => 'events',
                    'action' => 'view',
                    'event' => $event['Event']['slug'],
                    '?' => array('o' => 'tu-dau')
                )));
        }

        echo $this->Paginator->next('Xem thêm',
            array('tag' => false, 'escape' => false, 'class' => 'next-link'), null, array('class' => 'disabled'));
        ?>
    </div>
</div>
<div style="padding: 0px 10px; background: #FFF;margin-top: -15px;">
    <div class="suggest-share"><p>Hãy hóng cùng bạn bè</p></div>
    <div class="facebook_share">
        <i class="fa fa-facebook" style="color: #FFF;"></i>
        <span>Share lên Facebook</span>
    </div>
</div>
<?php $listRelate = $this->requestAction(array('controller' => 'Sidebar', 'action' => 'relate_events', 2)); ?>
<div class="suggest-events" style="padding: 0px 10px; background: #FFF;margin-top: -15px;">
    <div class="suggest-share"><p>Xem thêm</p></div>
    <div class="clearfix" style="margin-top: -7px;">
        <?php if (!empty($listRelate)): ?>
            <?php foreach($listRelate as $event): ?>
                <div class="item relate-event-mobile">
                    <?= $this->Html->link(
                        '<div class="img-wrap">'.
                            $this->Html->image(
                                'main/posts/'.$event['Event']['img'],
                                array('style' => 'width: 100%;height: 95px;')
                            ).
                        '</div>'.
                        '<div class="title" style="color: #A92733;padding: 5px;">'.$event['Event']['name'].'</div>',
                        array(
                            'controller' => false,
                            'action' => 'su-kien',
                            $event['Event']['slug']
                        ),
                        array(
                            'escape' => false,
                        )
                    ) ?>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>
<div>
    <div class="title-h2">
        <h2 class="list-header" style="margin-bottom: 5px;">Bình luận</h2>
        <?= $this->element('comment'); ?>
    </div>
</div>
<div>
    <?= $this->element('mobile_footer') ?>
</div>

<script>
    $(document).ready(function () {
        $('.facebook_share').on('click', function () {
            window.open(
                'https://www.facebook.com/sharer/sharer.php?u=' + '<?php echo('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>',
                'facebook-share-dialog',
                'width=1626,height=436');
        })
    });
</script>
<script>
    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;

    $(window).scroll(function(event){
        didScroll = true;
    });

    setInterval(function() {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
            if ($(this).scrollTop() < 100) {
                $('.share-top').removeClass('slidedown').addClass('slideup');
            }
        }
    }, 250);

    function hasScrolled() {
        var st = $(this).scrollTop();

        if(Math.abs(lastScrollTop - st) <= delta)
            return;

        if (st > lastScrollTop){
            // Scroll Down
            $('.share-top').removeClass('slideup').addClass('slidedown');
        } else {
            // Scroll Up
            if(st + $(window).height() < $(document).height()) {
                $('.share-top').removeClass('slideup').addClass('slidedown');
            }
        }


        lastScrollTop = st;
    }
</script>