<div class="title-h2">
    <h2 class="list-header"><?= $titleEvent; ?></h2>
</div>

<div id="blog-landing">
    <!--nocache-->
    <?php if (!empty($eventsList)): ?>
        <?php foreach($eventsList as $eachEvent): ?>
            <article class="white-panel">
                <?php
                $time = $eachEvent['Event']['updated_at'];
                $time = $this->Translate->trans($time);
                ?>
                <?= $this->Html->link(
                    $this->Html->image('main/posts/'.$eachEvent['Event']['img'], array('alt' => $eachEvent['Event']['name'])).
                    '<h1>'.$eachEvent['Event']['name'].'</h1>'.
                    '<p class="content-event">'.htmlspecialchars_decode($eachEvent['Event']['description']).'</p>'.
                    '<div class="show-info">'.
                    '<div class="time-update">'.
                    '<p><i class="fa fa-refresh"></i> '.$time.'</p>'.
                    '</div>'.
                    '<div class="social-count">'.
                    '<p>'.
                    '<span>'.$eachEvent['Event']['count_post'].' <i class="fa fa-file-text"></i></span> '.
                    '<span>'.$eachEvent['Event']['count_cmt'].' <i class="fa fa-comments-o"></i></span>'.
                    '</p>'.
                    '</div>'.
                    '</div>',
                    array('controller' => 'su-kien', 'action' => $eachEvent['Event']['slug']),
                    array('escape' => false)
                ) ?>

            </article>
        <?php endforeach ?>
    <?php endif ?>
    <!--/nocache-->
</div>
<div class="next-btn">
    <?php
    switch ($whichPage) {
        case 'Event':
            $controllerOption = 'events';
            $actionOption = 'index';
            break;
        case 'EventHot':
            $controllerOption = 'events';
            $actionOption = 'hot';
            break;
        case 'EventOld':
            $controllerOption = 'events';
            $actionOption = 'old';
            break;
        default:
            break;
    }

    $this->Paginator->options(array(
        'url'=> array(
            'controller' => $controllerOption,
            'action' => $actionOption,
        )));

    echo $this->Paginator->next('Xem thêm',
        array('tag' => false, 'escape' => false, 'class' => 'next-link'), null, array('class' => 'disabled'));
    ?>
</div>

<?= $this->element('mobile_footer') ?>
