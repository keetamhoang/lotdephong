<div class="row col-lg-12" style="text-align: right">
<?= $this->Html->link(
    'Thêm mới',
    array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'add')
); ?>
</div>
<?php $keyword = !empty($this->params->query['search'])?$this->params->query['search']:'' ?>
<?php echo $this->Form->create('Event', array('type' => 'get')); ?>
<div class="col-lg-3">
    <div class="input-group">
        <input name="search" type="text" class="form-control" placeholder="Tìm kiếm..."
               value="<?= $keyword ?>" >
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
    </div>
</div>
<?php echo $this->Form->end(); ?>
<?php
echo $this->Session->flash();
?>
<div class="pagination-right">
    <div class="pagination pagination-large">
        <ul class="pagination">
            <?php
            if ($keyword) {
                $this->Paginator->options(array(
                    'url' => array(
                        'plugin' => 'admin',
                        'controller' => 'events',
                        'action' => 'view',
                        $event['Event']['id'],
                        '?' => array('search' => $keyword)
                    )));
            } else {
                $this->Paginator->options(array(
                    'url' => array(
                        'plugin' => 'admin',
                        'controller' => 'events',
                        'action' => 'view',
                        $event['Event']['id'],
                    )));
            }
            ?>
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
<div class="table-responsive">
    <table class="table table-hover table-striped posts-table">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('id', '#'); ?> <i><?= $this->Sort->sort('id'); ?></i></th>
            <th><?= $this->Paginator->sort('name', 'Tên'); ?> <i><?= $this->Sort->sort('name'); ?></i></th>
            <th>Nội dung</th>
            <th>Ảnh</th>
            <th><?= $this->Paginator->sort('author', 'Author'); ?> <i><?= $this->Sort->sort('author'); ?></i></th>
            <th><?= $this->Paginator->sort('updated_at', 'Cập nhật'); ?> <i><?= $this->Sort->sort('updated_at'); ?></i></th>
            <th><?= $this->Paginator->sort('created_at', 'Tạo'); ?> <i><?= $this->Sort->sort('created_at'); ?></i></th>
            <th class="action">Hoạt động</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($allPosts)): ?>
            <?php foreach($allPosts as $eachPost): ?>
                <tr>
                    <td><?= $eachPost['Post']['id']; ?></td>
                    <td>
                        <div style="max-height: 100px; overflow: hidden">
                        <?= $this->Html->link(
                            $eachPost['Post']['name'],
                            array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'edit', $eachPost['Post']['id'])
                        ); ?>
                        </div>
                    </td>
                    <td>
                        <div style="max-height: 100px; overflow: hidden">
                        <?= $this->Html->link(
                            $eachPost['Post']['content'],
                            array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'edit', $eachPost['Post']['id'])
                        ); ?>
                        </div>
                    </td>
                    <td class="image">
                        <?= $this->Html->image(
                            'main/posts/'.$eachPost['Post']['img']
                        ); ?>
                    </td>
                    <td>
                        <?= $eachPost['Post']['author']; ?>
                    </td>
                    <td><?= $eachPost['Post']['updated_at']; ?></td>
                    <td><?= $eachPost['Post']['created_at']; ?></td>
                    <td class="action">
                        <?= $this->Html->link(
                            '<i class="fa fa-eye"></i>',
                            array('plugin' => false, 'controller' => false, 'action' => 'su-kien', $event['Event']['slug']),
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-pencil-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'edit', $eachPost['Post']['id']),
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-minus-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'delete', $eachPost['Post']['id']),
                            array('escape' => false, 'class' => 'delete-btn')
                        ); ?>
                    </td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
        </tbody>
    </table>
</div>

<div class="pagination-right">
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