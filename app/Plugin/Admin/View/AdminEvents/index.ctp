<?php
echo $this->Session->flash();
?>
<?php echo $this->Form->create('Event', array('type' => 'get')); ?>
    <div class="col-lg-3">
        <div class="input-group">
            <input name="search" type="text" class="form-control" placeholder="Tìm kiếm..."
                value="<?= !empty($this->params->query['search'])?$this->params->query['search']:'' ?>" >
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
        </div>
    </div>
<?php echo $this->Form->end(); ?>
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
<div class="table-responsive">
    <table class="table table-hover table-striped events-table">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('id', '#'); ?> <i><?= $this->Sort->sort('id'); ?></i></th>
            <th><?= $this->Paginator->sort('name', 'Tên'); ?> <i><?= $this->Sort->sort('name'); ?></i></th>
            <th><?= $this->Paginator->sort('slug', 'Tên miền'); ?> <i><?= $this->Sort->sort('slug'); ?></i></th>
            <th class="center"><?= $this->Paginator->sort('updating', 'Updating'); ?> <i><?= $this->Sort->sort('updating'); ?></i></th>
            <th>Ảnh</th>
            <th class="center"><?= $this->Paginator->sort('hot', 'Hot'); ?> <i><?= $this->Sort->sort('hot'); ?></i></th>
            <th class="center"><?= $this->Paginator->sort('old', 'Cũ'); ?> <i><?= $this->Sort->sort('old'); ?></i></th>
            <th><?= $this->Paginator->sort('updated_at', 'Cập nhật'); ?> <i><?= $this->Sort->sort('updated_at'); ?></i></th>
            <th><?= $this->Paginator->sort('created_at', 'Tạo'); ?> <i><?= $this->Sort->sort('created_at'); ?></i></th>
            <th class="action">Hoạt động</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($eventsList)): ?>
            <?php foreach($eventsList as $eachEvent): ?>
                <tr>
                    <td><?= $eachEvent['Event']['id']; ?></td>
                    <td>
                        <?= $this->Html->link(
                            $eachEvent['Event']['name'],
                            array('plugin' => 'admin', 'controller' => 'events', 'action' => 'edit', $eachEvent['Event']['id'])
                        ); ?>
                    </td>
                    <td>
                        <?= $this->Html->link(
                            $eachEvent['Event']['slug'],
                            array('plugin' => 'admin', 'controller' => 'events', 'action' => 'edit', $eachEvent['Event']['id'])
                        ); ?>
                    </td>
                    <td class="updating-check <?= $eachEvent['Event']['updating']=='1'?'ok':'not-ok'; ?>">
                        <?= $this->Html->link(
                            '<i class="fa fa-'.($eachEvent['Event']['updating']=='1'?'check':'times').'-circle"></i>',
                            '#',
                            array('escape' => false)
                        ); ?>
                    </td>
                    <td class="image">
                        <?= $this->Html->image(
                            'main/posts/'.$eachEvent['Event']['img']
                        ); ?>
                    </td>
                    <td class="hot-check <?= $eachEvent['Event']['hot']=='1'?'ok':'not-ok'; ?>">
                        <?= $this->Html->link(
                            '<i class="fa fa-'.($eachEvent['Event']['hot']=='1'?'check':'times').'-circle"></i>',
                            '#',
                            array('escape' => false)
                        ); ?>
                    </td>
                    <td class="old-check <?= $eachEvent['Event']['old']=='1'?'ok':'not-ok'; ?>">
                        <?= $this->Html->link(
                            '<i class="fa fa-'.($eachEvent['Event']['old']=='1'?'check':'times').'-circle"></i>',
                            '#',
                            array('escape' => false)
                        ); ?>
                    </td>
                    <td><?= $eachEvent['Event']['updated_at']; ?></td>
                    <td><?= $eachEvent['Event']['created_at']; ?></td>
                    <td class="action">
                        <?= $this->Html->link(
                            '<i class="fa fa-eye"></i>',
                            array('plugin' => false, 'controller' => false, 'action' => 'su-kien', $eachEvent['Event']['slug']),
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-pencil-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'events', 'action' => 'edit', $eachEvent['Event']['id']),
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-minus-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'events', 'action' => 'delete', $eachEvent['Event']['id']),
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