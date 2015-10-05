<?php $this->assign('title', $title); ?>

<div id="main" class="send-post">
    <div class="post">
        <h1 class="title-post title-send">
            <?= $this->Html->link(
                $event['Event']['name'],
                array('controller' => 'su-kien', 'action' => $event['Event']['slug'])
            ) ?>
        </h1>

        <div class="alert-sendbox" style="margin-bottom: 10px;">
            Bạn có <i>link hay, bài viết nóng</i> về chủ đề trên, hãy gửi cho Lót Dép Hóng để chia sẻ cho mọi người những điều mà bạn có! <i class="fa fa-smile-o"></i>
        </div>
        <!--nocache-->
        <?php echo $this->Session->flash(); ?>
        <!--/nocache-->
        <?php
        echo $this->Form->create(false, array(
            'action' => 'send_post_each_event',
            'role' => 'form',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'input', 'error'),
                'div' => array('class' => 'form-group'),
                'label' => array('class' => 'control-label'),
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
            )
        ));
        ?>
        <input type="hidden" name="event_id" value="<?= $event['Event']['id'] ?>">
        <?php
        echo $this->Form->input('name', array(
            'label' => 'Tên bạn (nickname):', 'class' => 'form-control',
            'required'
        ));
        echo $this->Form->input(
            'content', array('label' => 'Nội dung:', 'type' => 'textarea', 'class' => 'form-control',
            'placeholder' => 'Link facebook, bài báo, bài viết, hình ảnh...và đôi lời muốn nói',
            'required'
        ));
        echo $this->Form->submit('Gửi bài', array('class' => 'btn btn-primary'));
        echo $this->Form->end();
        ?>
    </div>
    <?= $this->element('mobile_footer'); ?>
</div>