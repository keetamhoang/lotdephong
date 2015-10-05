<div class="row col-lg-12" style="text-align: right">
    <?= $this->Html->link(
        'Thêm mới',
        array('plugin' => 'admin', 'controller' => 'categories', 'action' => 'add')
    ); ?>
</div>
<?php $keyword = !empty($this->params->query['search'])?$this->params->query['search']:'' ?>
<?php echo $this->Form->create('Category', array('type' => 'get')); ?>
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
            <th><?= $this->Paginator->sort('slug', 'Tên miền'); ?> <i><?= $this->Sort->sort('slug'); ?></i></th>
            <th>Ảnh</th>
            <th><?= $this->Paginator->sort('description', 'Mô tả'); ?> <i><?= $this->Sort->sort('description'); ?></i></th>
            <th><?= $this->Paginator->sort('updated_at', 'Cập nhật'); ?> <i><?= $this->Sort->sort('updated_at'); ?></i></th>
            <th><?= $this->Paginator->sort('created_at', 'Tạo'); ?> <i><?= $this->Sort->sort('created_at'); ?></i></th>
            <th class="action">Hoạt động</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($allCategories)): ?>
            <?php foreach($allCategories as $eachCategory): ?>
                <tr>
                    <td><?= $eachCategory['Category']['id']; ?></td>
                    <td>
                        <div style="max-height: 100px; overflow: hidden">
                            <?= $this->Html->link(
                                $eachCategory['Category']['name'],
                                array('plugin' => 'admin', 'controller' => 'categories', 'action' => 'edit', $eachCategory['Category']['id'])
                            ); ?>
                        </div>
                    </td>
                    <td>
                        <div style="max-height: 100px; overflow: hidden">
                            <?= $this->Html->link(
                                $eachCategory['Category']['slug'],
                                array('plugin' => 'admin', 'controller' => 'categories', 'action' => 'edit', $eachCategory['Category']['id'])
                            ); ?>
                        </div>
                    </td>
                    <td class="image">
                        <?= $this->Html->image(
                            'main/posts/'.$eachCategory['Category']['img']
                        ); ?>
                    </td>
                    <td>
                        <?= $this->Html->link(
                            $eachCategory['Category']['description'],
                            array('plugin' => 'admin', 'controller' => 'categories', 'action' => 'edit', $eachCategory['Category']['id'])
                        ); ?>
                    </td>
                    <td><?= $eachCategory['Category']['updated_at']; ?></td>
                    <td><?= $eachCategory['Category']['created_at']; ?></td>
                    <td class="action">
                        <?= $this->Html->link(
                            '<i class="fa fa-eye"></i>',
                            array('plugin'=> false, 'controller' => 'danh-muc', 'action' => $eachCategory['Category']['slug']),
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-pencil-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'categories', 'action' => 'edit', $eachCategory['Category']['id']),
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-minus-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'categories', 'action' => 'delete', $eachCategory['Category']['id']),
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