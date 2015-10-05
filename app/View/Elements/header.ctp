<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <?=
            $this->Html->link(
                '<span class="logo">'.$this->Html->image('logo-1.png', array('escape' => false)).'</span>',
                array(
                    'controller' => 'pages',
                    'action' => 'index'
                ),
                array(
                    'class' => 'navbar-brand',
                    'escape' => false
                )
            );
            ?>
        </div>
        <div>
            <ul class="nav navbar-nav main-nav">
                <li class="highlight">
                    <?= $this->Html->link(
                        'Mới',
                        array(
                            'controller' => 'moi',
                            'action' => false
                        )
                    ); ?>
                </li>
                <li>
                    <?= $this->Html->link(
                        'Nóng',
                        array(
                            'controller' => 'hot',
                            'action' => false
                        )
                    ); ?>
                </li>
                <li>
                    <?= $this->Html->link(
                        'Cũ',
                        array(
                            'controller' => 'cu',
                            'action' => false
                        )
                    ); ?>
                </li>
                <li class="dropdown dropdown-hover">
                    <a class="navbar-link dropdown-toggle" href="#">
                        Chủ đề »

                    </a>
                    <ul class="dropdown-menu more-menu dropdown-main-menu" role="menu">
                        <div class="row">
                            <ul class="c-dropdown">
                                <?php
                                $listCategories = $this->requestAction(array('controller' => 'categories', 'action' => 'listCategories'), array('return'));

                                $totalCategories = count($listCategories);

                                $eachCol = ceil($totalCategories/3);
                                $breakLine = 0;

                                if (!empty($listCategories)) {
                                    foreach ($listCategories as $category) {
                                        if ($breakLine == 0) {
                                            echo '<li>';
                                        } else if ($breakLine == 3) {
                                            echo '</li>';
                                        }
                                        ?>
                                <div class="col-xs-4">
                                    <?= $this->Html->link(
                                        $category['Category']['name'],
                                        array(
                                            'controller' => false,
                                            'action' => 'danh-muc',
                                            $category['Category']['slug']
                                        ),
                                        array(
                                            'role' => 'menuitem',
                                            'tabindex' => '-1'
                                        )
                                    ); ?>
                                </div>
                                    <?php } ?>
                                    <li>
                                        <div class="col-xs-12" style="text-align: center;margin-top: 5px">
                                            <?= $this->Html->link(
                                                'Xem tất cả',
                                                array(
                                                    'controller' => false,
                                                    'action' => 'danh-muc'
                                                ),
                                                array(
                                                    'style' => 'padding: 8px 0px;border-top: 1px solid #E1DDDD;'
                                                )
                                            ); ?>
                                        </div>
                                    </li>
                                <?php } else { ?>
                                    <li><div class="col-xs-12" style="text-align: center; color: #009cff">Hiện tại chưa có dữ liệu bạn yêu cầu</div></li>
                                <?php }
                                ?>
                            </ul>
                        </div>

                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right" style="margin-right: 0;">
                <!--nocache-->
                <?php if ($this->Session->read('Auth.User.id')): ?>
                <li class="dropdown" style="margin-right: 20px;">
                    <a href="#" style="margin-right: 5px;" class="dropdown-toggle show-noti-btn"
                       data-toggle="dropdown" id="<?= $this->Session->read('Auth.User.id'); ?>">
                        <input type="hidden" id="baseUrl" name="baseUrl" value="<?= Router::url('/'); ?>">
                        <i class="fa fa-bell"></i>

                        <?php $notications = $this->requestAction(array('controller' => 'follows', 'action' => 'countNoti', $this->Session->read('Auth.User.id'))) ?>
                        <?php if (!empty($notications)) {
                            echo '<span class="haveNotifications">'.$notications.'</span>';
                        } ?>

                    </a>
                    <ul class="noti-main dropdown-menu more-menu dropdown-noti">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="image-load-noti" style="display: none">
                                    <?= $this->Html->image('loading.gif'); ?>
                                </div>
                                <ul class="c-dropdown show-noti-ul"></ul>
                            </div>
                        </div>
                    </ul>
                </li>
                <?php endif ?>
                <!--/nocache-->
                <!--nocache-->
                <li>
                    <?php if (!$this->Session->read('Auth.User')) { ?>
                        <?= $this->Html->link(
                            'Đăng nhập',
                            array(
                                'controller' => false,
                                'action' => 'dang-nhap'
                            ),
                            array(
                                'class' => 'login-btn auth-btn'
                            )
                        ) ?>
                    <?php } else { ?>
                        <?= $this->Html->link(
                            $this->Html->image(
                                $this->Session->read('Auth.User.avatar')
                            ),
                            array(
                                'controller' => false,
                                'action' => 'dang-xuat'
                            ),
                            array(
                                'class' => 'logout-btn',
                                'escape' => false
                            )
                        ) ?>
                    <?php } ?>
                </li>
                <!--/nocache-->
            </ul>
        </div>
    </div>
</div>