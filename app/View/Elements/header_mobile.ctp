<nav role="navigation" class="navbar navbar-inverse">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button aria-expanded="false" type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle collapsed">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
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
        <div class="like-fb">
            <div class="fb-like" data-href="https://m.facebook.com/pages/N%C3%B3ng-l%C3%A0-h%C3%B3ng/116476155369167" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
        </div>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div style="height: 1px;" aria-expanded="false" id="navbarCollapse" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
            <li class="active">
                <?= $this->Html->link(
                    'Trang chủ',
                    array(
                        'controller' => 'pages',
                        'action' => 'index'
                    )
                ); ?>
            </li>
            <li>
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
            <li>
                <?= $this->Html->link(
                    'Chủ đề',
                    array(
                        'controller' => false,
                        'action' => 'danh-muc'
                    )
                ); ?>
            </li>
        </ul>
    </div>
</nav>