<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-calendar fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $countEvent ?></div>
                        <div>Sự kiện</div>
                    </div>
                </div>
            </div>
            <?= $this->Html->link(
                '<div class="panel-footer">
                    <span class="pull-left">Chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>',
                array('plugin' => 'admin', 'controller' => 'events', 'action' => 'index'),
                array('escape' => false)
            ); ?>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-newspaper-o fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $countPost ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <?= $this->Html->link(
                '<div class="panel-footer">
                    <span class="pull-left">Chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>',
                array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'index'),
                array('escape' => false)
            ); ?>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-bookmark fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $countFollow ?></div>
                        <div>Theo dõi</div>
                    </div>
                </div>
            </div>
            <?= $this->Html->link(
                '<div class="panel-footer">
                    <span class="pull-left">Chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>',
                array('plugin' => 'admin', 'controller' => 'follows', 'action' => 'following'),
                array('escape' => false)
            ); ?>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-flag fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= $countReport ?></div>
                        <div>Báo cáo!</div>
                    </div>
                </div>
            </div>
            <?= $this->Html->link(
                '<div class="panel-footer">
                    <span class="pull-left">Chi tiết</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>',
                array('plugin' => 'admin', 'controller' => 'reports', 'action' => 'index'),
                array('escape' => false)
            ); ?>
        </div>
    </div>
</div>
<!-- /.row -->