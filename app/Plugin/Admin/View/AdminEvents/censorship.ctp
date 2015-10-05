<?php
$this->Paginator->options(array(
    'url' => array(
        'plugin' => 'admin',
        'controller' => 'events',
        'action' => 'censorship',
        $event['Event']['id'],
    )));
?>
<div class="main">
    <?php echo $this->Session->flash(); ?>
    <div class="pagination pagination-large">
        <ul class="pagination">
            <?php
            echo $this->Paginator->first('<<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            echo $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li', 'modulus' => 4));
            echo $this->Paginator->next('>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            echo $this->Paginator->last('>>', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>
    </div>
    <?php if ($postsList): ?>
        <?php foreach($postsList as $post): ?>
            <div class="each">
                <?php
                // get time ago
                $time = $post['Waiting']['updated_at'];
                $time = $this->Translate->trans($time);
                ?>
                <div class="col-lg-10">
                    <div class="date">
                        <p><i class="fa fa-clock-o"></i> <?= $time ?></p>
                    </div>
                    <div class="name">
                        <p><i class="fa fa-user"></i>
                        <div class="form-group">
                            <input class="form-control" type="text" value="<?= strip_tags($post['Waiting']['sender_name']) ?>">
                        </div>
                        </p>
                    </div>
                    <div class="content">
                        <div><i class="fa fa-file-text"></i>
                            <div class="form-group">
                                <textarea class="form-control" rows="3"><?= strip_tags($post['Waiting']['content']) ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="actions">
                        <?= $this->Html->link(
                            '<i class="fa fa-check-circle"></i>',
                            array('plugin' => 'admin', 'controller' => 'waitings', 'action' => 'publish', $post['Waiting']['id']),
                            array('escape' => false, 'class' => 'complete')
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fa fa-times-circle"></i>',
                            array('plugin' => 'admin', 'controller' => 'waitings', 'action' => 'delete', $post['Waiting']['id']),
                            array('escape' => false, 'class' => 'delete delete-btn')
                        ) ?>

                        <?= $this->Html->link(
                            '<i class="fa fa-pencil-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'add', $event['Event']['id']),
                            array('escape' => false, 'target' => '_blank')
                        ); ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    <?php endif ?>
    <div class="pagination pagination-large">
        <ul class="pagination">
            <?php
            echo $this->Paginator->first('<<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            echo $this->Paginator->prev('<', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li', 'modulus' => 4));
            echo $this->Paginator->next('>', array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            echo $this->Paginator->last('>>', array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
            ?>
        </ul>
    </div>
</div>