<?php $this->assign('title', $title); ?>

<div id="main">
    <div id="left">
        <h2 style="margin-bottom: 15px;">Tất cả thông báo</h2>
        <!--nocache-->
        <?php $notications = $this->requestAction(array('controller' => 'follows', 'action' => 'showAll', $userId)) ?>
        <?php if ($notications): ?>
            <?php foreach ($notications as $eachNoti): ?>
                <?php
                // get time ago
                $time = $eachNoti['Follow']['updated_at'];
                $time = $this->Translate->trans($time);
                ?>
                <?php $slug = $this->Slug->addSlug($eachNoti['Event']['name'], $eachNoti['Event']['id']); ?>
                <div class="noti clearfix">
                    <div class="div-image col-xs-2">
                        <?= $this->Html->link(
                            $this->Html->image(
                                'main/posts/' . $eachNoti['Event']['img']
                            ),
                            array(
                                'controller' => false,
                                'action' => 'su-kien',
                                $slug
                            ),
                            array('escape' => false)
                        ); ?>
                    </div>
                    <div class="body-noti col-xs-10">
                        <p>Sự kiện <i><?= $this->Html->link($eachNoti['Event']['name'],
                                    array(
                                        'controller' => false,
                                        'action' => 'su-kien',
                                        $slug
                                    )
                                ) ?> </i> đã được cập nhật tin tức mới.</p>

                        <div><i class="fa fa-clock-o"></i> <?= $time; ?></div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
        <!--/nocache-->
        <?= $this->element('footer'); ?>

    </div>
    <div id="right">
        <div class="fixed-holder" data-fixedtop="45"></div>
        <div class="fixed-right">
            <div class="right-box">
                <div class="sm-post">
                    <div class="fb-page"
                         data-href="https://www.facebook.com/pages/N&#xf3;ng-l&#xe0;-h&#xf3;ng/116476155369167"
                         data-width="336" data-height="130" data-small-header="false" data-adapt-container-width="true"
                         data-hide-cover="false" data-show-facepile="true" data-show-posts="false">
                        <div class="fb-xfbml-parse-ignore">
                            <blockquote
                                cite="https://www.facebook.com/pages/N&#xf3;ng-l&#xe0;-h&#xf3;ng/116476155369167"><a
                                    href="https://www.facebook.com/pages/N&#xf3;ng-l&#xe0;-h&#xf3;ng/116476155369167">Nóng
                                    là hóng</a>
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
                    <i class="fa fa fa-pencil-square-o"></i> <span>Gửi bài để bạn biết, tôi cũng biết <i
                            class="fa fa-smile-o"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>