<?php $keyword = !empty($this->params->query['search'])?$this->params->query['search']:'' ?>
<?php echo $this->Form->create('User', array('type' => 'get')); ?>
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
            <th><?= $this->Paginator->sort('username', 'Tên'); ?> <i><?= $this->Sort->sort('username'); ?></i></th>
            <th><?= $this->Paginator->sort('email', 'Email'); ?> <i><?= $this->Sort->sort('email'); ?></i></th>
            <th><?= $this->Paginator->sort('role', 'Role'); ?> <i><?= $this->Sort->sort('role'); ?></i></th>
            <th><?= $this->Paginator->sort('updated_at', 'Cập nhật'); ?> <i><?= $this->Sort->sort('updated_at'); ?></i></th>
            <th><?= $this->Paginator->sort('created_at', 'Tạo'); ?> <i><?= $this->Sort->sort('created_at'); ?></i></th>
            <th class="action">Hoạt động</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($allUsers)): ?>
            <?php foreach($allUsers as $eachUser): ?>
                <tr>
                    <td><?= $eachUser['Manager']['id']; ?></td>
                    <td>
                        <?= $this->Html->link(
                            $eachUser['Manager']['username'],
                            array('plugin' => 'admin', 'controller' => 'users/manager', 'action' => 'edit', $eachUser['Manager']['id'])
                        ); ?>
                    </td>
                    <td>
                        <?= $eachUser['Manager']['email'] ?>
                    </td>
                    <td class="role-manager" style="color: <?= $eachUser['Manager']['role']=='1'?'#3BB13B':'red' ?>">
                        <b><?= ($eachUser['Manager']['role']=='1'?'Admin':'Guest') ?></b>
                    </td>
                    <td><?= $eachUser['Manager']['updated_at']; ?></td>
                    <td><?= $eachUser['Manager']['created_at']; ?></td>
                    <td class="action">
                        <?= $this->Html->link(
                            '<i class="fa fa-eye"></i>',
                            '#',
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-pencil-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'users/manager', 'action' => 'edit', $eachUser['Manager']['id']),
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-minus-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'users/manager', 'action' => 'delete', $eachUser['Manager']['id']),
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