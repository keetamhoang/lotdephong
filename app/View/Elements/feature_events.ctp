<section id="slider-home">
    <div class="grid">
<!--nocache-->
<?php if (!empty($featuredEvents)): ?>
    <?php foreach($featuredEvents as $key => $event): ?>
        <?php if ($key == 0 || $key == 2 || $key == 3) {
            $col = 2; $row = 2;
            $description = '<p>'.htmlspecialchars_decode($event['Event']['description']).'</p>';
        } else {
            $col = 2; $row = 1;
            $description = '';
        } ?>
        <div class="grid-item" data-colspan="<?= $col ?>" data-rowspan="<?= $row ?>">
            <?php
            $time = $event['Event']['updated_at'];
            $time = $this->Translate->trans($time);
            ?>
            <?=
            $this->Html->link(
                $this->Html->image('main/posts/'.$event['Event']['img'], array('alt' => $event['Event']['name'])).
                '<div class="main-grid">'.
                '<h1>'.$event['Event']['name'].'</h1>'.
                $description.
                '</div>'.
                '<div>'.
                '<div class="show-info-hot">'.
                '<div class="time-update-hot">'.
                '<p><i class="fa fa-refresh"></i> '.$time.'</p>'.
                '</div>'.
                '<div class="social-count-hot">'.
                '<p>'.
                '<span>'.$event['Event']['count_post'].' <i class="fa fa-file-text"></i> </span>'.
                '<span>'.$event['Event']['count_cmt'].' <i class="fa fa-comments-o"></i></span>'.
                '</p>
                        </div>
                    </div>
                </div>',
                array('controller' => 'su-kien', 'action' => $event['Event']['slug']),
                array('escape' => false)
            )
            ?>
        </div>
    <?php endforeach ?>
<?php endif ?>
<!--/nocache-->
    </div>
</section>