<?php $this->assign('title', $title); ?>
<?php $this->assign('image', 'img/main/posts/'.$event['Event']['img']); ?>

<div id="main">
    <div id="left">
        <div class="details video">
            <div class="post">
                <!--nocache-->
                <?php echo $this->Session->flash(); ?>
                <!--/nocache-->
                <h1 class="title-post"><?= htmlspecialchars_decode($event['Event']['name']); ?></h1>
                <!--nocache-->
                <?php if($this->Session->check('Auth.Manager')){
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
                    <div class="clearfix">
                        <!--nocache-->
                        <div class="col-sm-6 time-update">
                            <div style="display: inline;">
                            Cập nhật <?= $time; ?>
                            </div>
                                <div class="chose-option">
                                <?php $isFollowing = $this->requestAction(array('controller' => 'follows', 'action' => 'checkFollow',
                                    $event['Event']['id'], (!empty($userId) ? $userId : ''))) ?>

                                <?php if ($isFollowing): ?>
                                    <?= $this->Html->link(
                                        '<i class="fa fa-bell-slash-o"></i>',
                                        array(
                                            'controller' => 'follows',
                                            'action' => 'not_follow',
                                            $event['Event']['id'],
                                            (!empty($userId) ? $userId : '')
                                        ),
                                        array(
                                            'escape' => false,
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => 'Hủy thông báo'
                                        )
                                    ) ?>
                                <?php else: ?>
                                    <?= $this->Html->link(
                                        '<i class="fa fa-bell-o"></i>',
                                        array(
                                            'controller' => 'follows',
                                            'action' => 'follow',
                                            $event['Event']['id'],
                                            (!empty($userId) ? $userId : '')
                                        ),
                                        array(
                                            'escape' => false,
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'top',
                                            'title' => 'Nhận thông báo'
                                        )
                                    ) ?>
                                <?php endif ?>
                                <!--/nocache-->
                                <?= $this->Html->link(
                                    '<i class="fa fa-pencil-square-o"></i>',
                                    array(
                                        'controller' => false,
                                        'action' => 'gui-bai',
                                        $event['Event']['id']
                                    ),
                                    array(
                                        'class' => 'request-upload',
                                        'escape' => false,
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'title' => 'Gửi bài'
                                    )
                                ) ?>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="detail-sort">
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
                    </div>
                </div>

                <div class="clearfix"></div>
                <p class="desc">
                    <?= htmlspecialchars_decode($event['Event']['description']); ?>
                </p>

                <div class="fb-like-share">
                <?= $this->element('like_button'); ?>
                </div>

                <div class="main-event">

                    <!--nocache-->
                    <?php
                    if (!empty($posts)) { ?>
                        <div class="only-post">
                        <?php
                        foreach ($posts as $post) {
                            // get time ago
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
                                    <?= htmlspecialchars_decode($post['Post']['content']) ?>
                                    <?php if (!empty($post['Post']['img'])): ?>
                                    <?= $this->Html->image(
                                        'main/posts/' . $post['Post']['img']
                                    ); ?>
                                    <?php endif ?>
                                </div>
                                <div class="link">
                                    <div><i>Đóng góp bởi: </i> <span class="author"><?= $post['Post']['author'] ?></span></div>
                                    <ul class="clearfix">
                                        <?php
                                        if (!empty($post['Link'])) {
                                            foreach ($post['Link'] as $link) { ?>
                                                <li>
                                                    <div>
                                                        <span><?= $link['name']; ?>:</span>
                                                        <a target="_blank"
                                                           href="<?= $link['link']; ?>"><?= $link['link'] ?></a>
                                                    </div>
                                                    <div class="report-group">
                                                        <a href="#" title="Báo link sai" idlink="<?= $link['id']; ?>"
                                                           data-toggle="modal" data-target="#report-dialog">
                                                            <i class="fa fa-flag-o"></i>
                                                        </a>
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
                        <div class="show-more">
                            <div class="not-found" style="display: none;">
                                Tạm thời hết chuyện rồi, chờ cập nhật đã nhé <i class="fa fa-smile-o"></i>
                                <?= $this->Html->link(
                                    '<i class="fa fa-pencil-square-o"></i>',
                                    array(
                                        'controller' => false,
                                        'action' => 'gui-bai',
                                        $event['Event']['id']
                                    ),
                                    array(
                                        'class' => 'request-upload',
                                        'escape' => false,
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'title' => 'Gửi bài'
                                    )
                                ) ?>
                            </div>
                            <?= $this->Html->image(
                                'loading.gif',
                                array('style' => 'display: none')
                            ) ?>
                            <a href="#"><span>Còn nhiều lắm</span></a>
                        </div>
                    <?php } else { ?>
                        <div class="not-found">
                            Tạm thời hết chuyện rồi, chờ cập nhật đã nhé <i class="fa fa-smile-o"></i>
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
                        </div>
                    <?php }
                    ?>
                    <!--/nocache-->
                </div>
                <div>
                    <?= $this->element('like_fanpage') ?>
                </div>

                <?= $this->element('relate_events'); ?>

            </div>
        </div>
        <div id="comments">
            <h2 class="list-header">Bình luận</h2>
            <?= $this->element('comment'); ?>

        </div>

        <?= $this->element('footer'); ?>
    </div>

    <div id="right">
        <div class="fixed-holder" data-fixedtop="45"></div>
        <div class="fixed-right">
            <div class="right-box">
                <div class="right-box">
                    <h2 class="list-header">Chủ đề</h2>
                    <ul class="list-inline tags">
                        <?php
                        if (!empty($event['Category'])) {
                            foreach ($event['Category'] as $category) {
                                $slug = $this->Slug->addSlug($category['name'], $category['id']);
                                ?>
                                <li>
                                    <?= $this->Html->link(
                                        $category['name'],
                                        array(
                                            'controller' => false,
                                            'action' => 'danh-muc',
                                            $slug
                                        )
                                    ); ?>
                                </li>
                            <?php }
                        }
                        ?>
                    </ul>
                </div>

                <?= $this->element('sidebar'); ?>

            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- Modal -->
    <div class="modal fade" id="report-dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <?php
                echo $this->Form->create(false, array(
                    'url' => array('controller' => 'reports', 'action' => 'send_report'),
                    'role' => 'form',
                    'inputDefaults' => array(
                        'format' => array('before', 'label', 'input', 'error'),
                        'div' => array('class' => 'form-group'),
                        'label' => array('class' => 'control-label'),
                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
                    ),
                    'id' => 'reportForm'
                ));
                ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Báo cáo tới BQT</h4>
                </div>
                <div class="modal-body">
                    <div style="margin-bottom: 3px">Lý do:</div>
                    <div class="reasion-report">
                        <input type="hidden" id="linkid" name="linkid" value="">
                        <?php
                        $options = array('1' => 'Link sai, link hỏng', '2' => 'Khác');
                        $attributes = array('legend' => false, 'value' => '1', 'separator' => '<br>');
                        echo $this->Form->radio('reason', $options, $attributes);

                        echo $this->Form->input(
                            'reasonOther', array('label' => false, 'type' => 'textarea', 'rows' => 3, 'class' => 'form-control',
                            'placeholder' => 'Bất kỳ lý do gì của bạn', 'style' => 'display: none;'
                        ));
                        ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Gửi đi</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('click', '.report-group a', function () {
        $('#linkid').val($(this).attr('idlink'));
    });

    $('#reportForm input').on('change', function () {
        if ($(this).attr('id') == 'reason2') {
            $('#reasonOther').css('display', 'block');
        } else {
            $('#reasonOther').css('display', 'none');
        }
    });
</script>

<script type="text/javascript">
    var page = 1;

    $('.show-more > a').on('click', function (e) {
        e.preventDefault();

        //show loading ajax
        $('.show-more img').css('display', 'block');
        $('.show-more .not-found').css('display', 'none');

        var start = new Date().getTime();

        page++;

        $.ajax({
            type: "get",
            url: '<?= $event['Event']['slug']; ?>' + '/trang/' + page,
            data: {o: '<?= isset($this->params['url']['o'])?$this->params['url']['o']:'moi-nhat'; ?>'},
            success: function (data) {
                var end = new Date().getTime();

                if (end - start < 1000) {
                    setTimeout(function () {
                        $('.show-more img').css('display', 'none');
                        $('.only-post').append(data);
                    }, 1000);
                } else {
                    $('.show-more img').css('display', 'none');
                    $('.only-post').append(data);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                var end = new Date().getTime();

                if (end - start < 1000) {
                    setTimeout(function () {
                        $('.show-more img').css('display', 'none');
                        $('.show-more .not-found').css('display', 'block');
                    }, 1000);
                } else {
                    $('.show-more img').css('display', 'none');
                    $('.show-more .not-found').css('display', 'block');
                }
            }
        });
    });
</script>
<script>
    window.fbAsyncInit = function() {
        FB.Event.subscribe('comment.create',
            function(response) {
//                alert('You commented in URL: ' + response.href + 'CommentID: ' + response.commentID);
                // do an ajax call to server to store user,commentID,href info if you require
                var base_url = window.location.origin;

                $.ajax({
                    type: "post",
                    url: base_url + '/CountComment/updateCache',
                    data: {event_slug: '<?php echo $event['Event']['slug']?>'},
                    success: function (data) {
                        console.log('success');
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {

                    }
                });
            }
        );
    };

    //load the JavaScript SDK
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>