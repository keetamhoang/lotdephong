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
            <th>Ảnh</th>
            <th><?= $this->Paginator->sort('facebook_id', 'FB id'); ?> <i><?= $this->Sort->sort('facebook_id'); ?></i></th>
            <th><?= $this->Paginator->sort('updated_at', 'Cập nhật'); ?> <i><?= $this->Sort->sort('updated_at'); ?></i></th>
            <th><?= $this->Paginator->sort('created_at', 'Tạo'); ?> <i><?= $this->Sort->sort('created_at'); ?></i></th>
            <th class="action">Hoạt động</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($allUsers)): ?>
            <?php foreach($allUsers as $eachUser): ?>
                <tr>
                    <td><?= $eachUser['User']['id']; ?></td>
                    <td>
                        <div style="max-height: 100px; overflow: hidden">
                            <?= $this->Html->link(
                                $eachUser['User']['username'],
                                'https://facebook.com/'.$eachUser['User']['facebook_id']
                            ); ?>
                        </div>
                    </td>
                    <td>
                        <div style="max-height: 100px; overflow: hidden">
                            <?= $eachUser['User']['email'] ?>
                        </div>
                    </td>
                    <td class="image">
                        <?= $this->Html->image(
                            $eachUser['User']['image_profile'],
                            array('style' => 'width: 43px;')
                        ); ?>
                    </td>
                    <td>
                        <?= $this->Html->link(
                            $eachUser['User']['facebook_id'],
                            'https://facebook.com/'.$eachUser['User']['facebook_id']
                        ); ?>
                    </td>
                    <td><?= $eachUser['User']['updated_at']; ?></td>
                    <td><?= $eachUser['User']['created_at']; ?></td>
                    <td class="action">
                        <?= $this->Html->link(
                            '<i class="fa fa-eye"></i>',
                            'https://facebook.com/'.$eachUser['User']['facebook_id'],
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-pencil-square"></i>',
                            '#',
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-minus-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'users/member', 'action' => 'delete', $eachUser['User']['id']),
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