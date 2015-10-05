<div class="suggests">
    <h2>Xem thêm</h2>
    <?php $listRelate = $this->requestAction(array('controller' => 'Sidebar', 'action' => 'relate_events', 3)); ?>
    <?php
    if (!empty($listRelate)) {
        foreach ($listRelate as $relateEvent) { ?>
            <div class="item relate-event">
                <?= $this->Html->link(
                    '<div class="img-wrap">'.
                    $this->Html->image(
                        'main/posts/'.$relateEvent['Event']['img'],
                        array(
                            'alt' => $relateEvent['Event']['name']
                        )
                    ).
                    '<i class="quiz"></i>
                    </div>
                    <div class="title">'.
                    $relateEvent['Event']['name'].
                    '</div>',
                    array(
                        'controller' => false,
                        'action' => 'su-kien',
                        $relateEvent['Event']['slug']
                    ),
                    array(
                        'escape' => false,
                    )
                ) ?>
            </div>
        <?php }
    }
    ?>

    <div class="clearfix"></div>
</div>