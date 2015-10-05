<div class="sm-post">
    <div class="fb-page" data-href="https://www.facebook.com/pages/N&#xf3;ng-l&#xe0;-h&#xf3;ng/116476155369167"
         data-width="336" data-height="130" data-small-header="false" data-adapt-container-width="true"
         data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
        <div class="fb-xfbml-parse-ignore">
            <blockquote cite="https://www.facebook.com/pages/N&#xf3;ng-l&#xe0;-h&#xf3;ng/116476155369167"><a
                    href="https://www.facebook.com/pages/N&#xf3;ng-l&#xe0;-h&#xf3;ng/116476155369167">Nóng là hóng</a>
            </blockquote>
        </div>
    </div>
</div>
<h2 class="list-header">Mẹo hay</h2>
<div class="tip">
    <i class="fa fa-bell-o"></i> <span>Nhận thông báo để hóng sự kiện nóng</span><br>
    <i class="fa fa-sign-in"></i> <span>
        <?= $this->Html->link(
            'Đăng nhập',
            array(
                'controller' => false,
                'action' => 'dang-nhap'
            )
        ) ?> dễ dàng hơn bao giờ hết</span><br>
    <i class="fa fa fa-pencil-square-o"></i> <span>Gửi bài để bạn biết, tôi cũng biết <i class="fa fa-smile-o"></i>
    </span>
</div>

<h2 class="list-header">Hóng có thể quan tâm</h2>

<?php $listMaybe = $this->requestAction(array('controller' => 'Sidebar', 'action' => 'maybe_events', 5)); ?>

<?php
if (!empty($listMaybe)) {
    foreach ($listMaybe as $maybeEvent) { ?>
        <div class="sm-post clearfix">
            <?= $this->Html->link(
                '<div class="wrap-top clearfix"><div class="img-wrap">'.
                $this->Html->image(
                    'main/posts/'.$maybeEvent['Event']['img'],
                    array(
                        'alt' => $maybeEvent['Event']['name']
                    )
                ).
                '<i class="quiz"></i>
                    </div>
                    <div class="title"><h1>'.
                $maybeEvent['Event']['name'].
                '</h1></div></div>
                <div class="col-lg-4 col-lg-offset-8 social-count">
                <p><span>'. $maybeEvent['Event']['count_post']
                .' <i class="fa fa-file-text"></i></span>'
                .'<span>'.$maybeEvent['Event']['count_cmt'].' <i class="fa fa-comments-o"></i></span></p>
                </div>',
                array(
                    'controller' => false,
                    'action' => 'su-kien',
                    $maybeEvent['Event']['slug']
                ),
                array(
                    'escape' => false,
                )
            ) ?>
        </div>
    <?php }
}
?>

<h2 class="list-header">Hóng đang nóng</h2>

<?php $listHot = $this->requestAction(array('controller' => 'Sidebar', 'action' => 'hot_events')); ?>

<?php
if (!empty($listHot)) {
    foreach ($listHot as $maybeEvent) { ?>
        <div class="sm-post clearfix">
            <?= $this->Html->link(
                '<div class="wrap-top clearfix"><div class="img-wrap">'.
                $this->Html->image(
                    'main/posts/'.$maybeEvent['Event']['img'],
                    array(
                        'alt' => $maybeEvent['Event']['name']
                    )
                ).
                '<i class="quiz"></i>
                    </div>
                    <div class="title"><h1>'.
                $maybeEvent['Event']['name'].
                '</h1></div></div>
                <div class="col-lg-4 col-lg-offset-8 social-count">
                <p><span>'. $maybeEvent['Event']['count_post']
                .' <i class="fa fa-file-text"></i></span>'
                .'<span>'.$maybeEvent['Event']['count_cmt'].' <i class="fa fa-comments-o"></i></span></p>
                </div>',
                array(
                    'controller' => false,
                    'action' => 'su-kien',
                    $maybeEvent['Event']['slug']
                ),
                array(
                    'escape' => false,
                )
            ) ?>
        </div>
    <?php }
}
?>