<?php
if ($posts) {
    foreach ($posts as $post) {
        // get time ago
        $time = $post['Post']['updated_at'];
        $time = $this->Translate->trans($time);
        ?>
        <div class="each">
            <div class="title clearfix">
                <div class="left-title">
                    <span><i class="fa fa-clock-o"></i> <i><?= $time; ?></i></span>
                </div>
            </div>

            <div class="content">
                <div class="title">
                    <h3><?= $post['Post']['name'] ?></h3>
                </div>
                <?= $post['Post']['content'] ?>
                <?php if (!empty($post['Post']['img'])): ?>
                    <?= $this->Html->image(
                        'main/posts/' . $post['Post']['img']
                    ); ?>
                <?php endif ?>
            </div>
            <div class="link">
                <div><i>Đóng góp bởi: </i> <span class="author"><?= $post['Post']['author'] ?></span></div>
                <ul class="clearfix">
                    <?php
                    if (!empty($post['Link'])) {
                        foreach ($post['Link'] as $link) { ?>
                            <li>
                                <div>
                                    <span><?= $link['name']; ?>:</span>
                                    <a target="_blank" href="<?= $link['link']; ?>"><?= $link['link'] ?></a>
                                </div>
                                <div class="report-group">
                                    <a href="#" title="Báo link sai" idlink="<?= $link['id']; ?>"
                                       data-toggle="modal" data-target="#report-dialog">
                                        <i class="fa fa-flag-o"></i>
                                    </a>
                                </div>
                            </li>
                        <?php }
                    }
                    ?>
                </ul>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="not-found">
        Tạm thời hết chuyện để hóng rồi, chờ cập nhật đã nhé <i class="fa fa-smile-o"></i>
    </div>
<?php }
?>

