<?php $this->assign('title', $title); ?>

<?= $this->element('feature_events'); ?>

<?= $this->element('like_fanpage') ?>

<section id="blog-landing">
    <!--nocache-->
    <?php if (!empty($newEvents)): ?>
        <?php foreach($newEvents as $eachEvent): ?>
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
        $this->Paginator->options(array(
            'url'=> array(
                'controller' => 'pages',
                'action' => 'index',
            )));

        echo $this->Paginator->next('Xem thêm, còn nhiều thứ để hóng lắm',
            array('tag' => false, 'escape' => false, 'class' => 'next-btn'), null, array('class' => 'disabled'));
        ?>
    </div>
</section>
<section>
    <?= $this->element('footer'); ?>
</section>

<?= $this->Html->script(array('responsivegrid')) ?>

<script>
    $(document).ready(function () {
        $('.grid').responsivegrid({
            'breakpoints': {
                'desktop' : {
                    'range' : '1200-',
                    'options' : {
                        'column' : 6
                    }
                },
                'tablet-landscape' : {
                    'range' : '1000-1200',
                    'options' : {
                        'column' : 5
                    }
                },
                'tablet-portrate' : {
                    'range' : '767-1000',
                    'options' : {
                        'column' : 4
                    }
                },
                'mobile' : {
                    'range' : '-767',
                    'options' : {
                        'column' : 3
                    }
                }
            }
        });

        $('#slider-home .grid-item').each(function(index){
            if ($(this).find('img').width() < $(this).width()) {
                $(this).find('img').css('width', '100%');
                $(this).find('img').css('height', 'auto');
            }
        });
    });

</script>
