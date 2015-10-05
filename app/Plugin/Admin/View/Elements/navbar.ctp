<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?= $this->Html->link(
            '   Bleble Admin',
            array('plugin' => false, 'controller' => 'admin', 'action' => 'dashboard'),
            array('class' => 'navbar-brand')
        ); ?>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li>
            <?= $this->Html->link(
                '<i class="fa fa-home"></i> Home',
                array('plugin' => false, 'controller' => false, 'action' => 'index'),
                array('escape' => false)
            ); ?>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                            <div class="media-body">
                                <h5 class="media-heading"><strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-footer">
                    <a href="#">Read All New Messages</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu alert-dropdown">
                <li>
                    <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">View All</a>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i> <?= !empty($user)?$user['username']:'Ẩn danh'; ?> <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <?= $this->Html->link(
                        '<i class="fa fa-fw fa-power-off"></i> Log Out',
                        array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'logout'),
                        array('escape' => false)
                    ); ?>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li class="active">
                <?= $this->Html->link(
                    '<i class="fa fa-fw fa-dashboard"></i> Dashboard',
                    array('plugin' => false, 'controller' => 'admin', 'action' => 'dashboard'),
                    array('escape' => false)
                ); ?>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#events"><i class="fa fa-fw fa-calendar"></i> Sự kiện <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="events" class="collapse">
                    <li>
                        <?= $this->Html->link(
                            'Tất cả',
                            array('plugin' => 'Admin', 'controller' => 'AdminEvents', 'action' => 'index')
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Thêm mới',
                            array('plugin' => 'Admin', 'controller' => 'AdminEvents', 'action' => 'add')
                        ); ?>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#posts"><i class="fa fa-fw fa-newspaper-o"></i> Posts <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="posts" class="collapse">
                    <li>
                        <?= $this->Html->link(
                            'Tất cả',
                            array('plugin' => 'Admin', 'controller' => 'AdminPosts', 'action' => 'index')
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Thêm mới',
                            array('plugin' => 'Admin', 'controller' => 'AdminPosts', 'action' => 'add')
                        ); ?>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#categories"><i class="fa fa-fw fa-tags"></i> Danh mục <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="categories" class="collapse">
                    <li>
                        <?= $this->Html->link(
                            'Tất cả',
                            array('plugin' => 'Admin', 'controller' => 'AdminCategories', 'action' => 'index')
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Thêm mới',
                            array('plugin' => 'Admin', 'controller' => 'AdminCategories', 'action' => 'add')
                        ); ?>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#members"><i class="fa fa-fw fa-users"></i> Người dùng <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="members" class="collapse">
                    <li>
                        <?= $this->Html->link(
                            'Thành viên',
                            array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'member')
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Quản trị viên',
                            array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'manager')
                        ); ?>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#follows"><i class="fa fa-fw fa-bookmark"></i> Theo dõi <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="follows" class="collapse">
                    <li>
                        <?= $this->Html->link(
                            'Đang theo dõi',
                            array('plugin' => 'Admin', 'controller' => 'AdminFollows', 'action' => 'following')
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Hết theo dõi',
                            array('plugin' => 'Admin', 'controller' => 'AdminFollows', 'action' => 'unfollow')
                        ); ?>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#check-post"><i class="fa fa-fw fa-check-circle"></i> Duyệt bài <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="check-post" class="collapse">
                    <li>
                        <?= $this->Html->link(
                            'Chờ duyệt',
                            array('plugin' => 'Admin', 'controller' => 'AdminWaitings', 'action' => 'wait')
                        ); ?>
                    </li>
                    <li>
                        <?= $this->Html->link(
                            'Đã duyệt',
                            array('plugin' => 'Admin', 'controller' => 'AdminWaitings', 'action' => 'done')
                        ); ?>
                    </li>
                </ul>
            </li>
            <li>
                <?= $this->Html->link(
                    '<i class="fa fa-fw fa-flag"></i> Báo cáo',
                    array('plugin' => 'Admin', 'controller' => 'AdminReports', 'action' => 'index'),
                    array('escape' => false)
                ); ?>
            </li>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>