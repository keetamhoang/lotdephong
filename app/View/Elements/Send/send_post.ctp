<?php $this->assign('title', $title); ?>

<div id="main">
    <div id="left">
        <div class="alert-sendbox">
            Bạn có <i>chủ đề nóng</i>, <i>link bài viết hay</i> hoặc đơn giản là muốn <i>đóng góp</i> cho Lót Dép Hóng, vui
            lòng gửi email đến: <a href="#">contact@lotdephong.com</a>, chúng tôi sẽ đăng giúp bạn. Hãy chia sẻ cho người
            khác những điều thú vị của bạn! <i class="fa fa-smile-o" style="color: #009B01"></i>
        </div>
        <div class="clearfix"></div>
        <!--nocache-->
        <?php echo $this->Session->flash(); ?>
        <!--/nocache-->
        <?php
        echo $this->Form->create(false, array(
            'action' => 'send_post_user',
            'role' => 'form',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'input', 'error'),
                'div' => array('class' => 'form-group'),
                'label' => array('class' => 'control-label'),
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            )
        ));
        echo $this->Form->input('email', array(
            'label' => 'E-mail của bạn:', 'class' => 'form-control',
            'required'
        ));
        echo $this->Form->input('name', array(
            'label' => 'Tên bạn:', 'class' => 'form-control',
            'required'
        ));
        echo $this->Form->input(
            'subject', array('label' => 'Chủ đề bài viết:', 'class' => 'form-control',
            'placeholder' => 'Về 1 vụ đang hot cực kỳ',
            'required'
        ));
        echo $this->Form->input(
            'content', array('label' => 'Lời muốn nói:', 'type' => 'textarea', 'class' => 'form-control',
            'placeholder' => 'Link facebook, bài báo, bài viết, hình ảnh...và đôi lời muốn nói',
            'required'
        ));
        echo $this->Form->submit('Gửi bài', array('class' => 'btn btn-primary'));
        echo $this->Form->end();
        ?>

        <?= $this->element('footer'); ?>

    </div>
    <div id="right">
        <div class="fixed-holder" data-fixedtop="45"></div>
        <div class="fixed-right">
            <div class="right-box">
                <?= $this->element('sidebar'); ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>