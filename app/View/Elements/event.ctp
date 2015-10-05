<h1 style="margin-bottom: 18px;"><?= $titleEvent; ?></h1>

<section id="blog-landing">
    <!--nocache-->
    <?php if (!empty($eventsList)): ?>
        <?php foreach($eventsList as $key => $eachEvent): ?>
            <article class="white-panel">
                <?php
                $time = $eachEvent['Event']['updated_at'];
                $time = $this->Translate->trans($time);
                ?>
                <?= $this->Html->link(
                    $this->Html->image('main/posts/'.$eachEvent['Event']['img']).
                    '<h1>'.$eachEvent['Event']['name'].'</h1>'.
                    '<p class="content-event">'.htmlspecialchars_decode($eachEvent['Event']['description']).'</p>'.
                    '<div class="show-info">'.
                    '<div class="col-lg-8 time-update">'.
                    '<p><i class="fa fa-refresh"></i> '.$time.'</p>'.
                    '</div>'.
                    '<div class="col-lg-4 social-count">'.
                    '<p>'.
                    '<span>'.$eachEvent['Event']['count_post'].' <i class="fa fa-file-text"></i></span>'.
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
</section>
<section>
    <div class="next-home">
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
        ?>
        <?php echo $this->Paginator->next('Xem thêm, còn nhiều thứ để hóng lắm',
            array('tag' => false, 'escape' => false, 'class' => 'next-btn'), null, array('class' => 'disabled')); ?>
    </div>
</section>
<section>
    <?= $this->element('footer'); ?>
</section>
