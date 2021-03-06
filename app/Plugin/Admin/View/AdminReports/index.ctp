<?php $keyword = !empty($this->params->query['search'])?$this->params->query['search']:'' ?>
<?php echo $this->Form->create('Report', array('type' => 'get')); ?>
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
            <th><?= $this->Paginator->sort('content', 'Nội dung'); ?> <i><?= $this->Sort->sort('content'); ?></i></th>
            <th>Link</th>
            <th>Post</th>
            <th><?= $this->Paginator->sort('updated_at', 'Cập nhật'); ?> <i><?= $this->Sort->sort('updated_at'); ?></i></th>
            <th><?= $this->Paginator->sort('created_at', 'Tạo'); ?> <i><?= $this->Sort->sort('created_at'); ?></i></th>
            <th class="action">Hoạt động</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($allReports)): ?>
            <?php foreach($allReports as $eachReport): ?>
                <tr>
                    <td><?= $eachReport['Report']['id']; ?></td>
                    <td>
                        <div style="max-height: 100px; overflow: hidden">
                            <?= $eachReport['Report']['content']; ?>
                        </div>
                    </td>
                    <td>
                        <div style="max-width: 200px; overflow: hidden">
                            <?= $this->Html->link(
                                $eachReport['Link']['name'],
                                $eachReport['Link']['link']
                            ); ?>
                        </div>
                    </td>
                    <td>
                        <div style="max-width: 200px; overflow: hidden">
                            <?= $this->Html->link(
                                $eachReport['Link']['Post']['name'],
                                array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'edit', $eachReport['Link']['Post']['id'])
                            ); ?>
                        </div>
                    </td>
                    <td><?= $eachReport['Report']['updated_at']; ?></td>
                    <td><?= $eachReport['Report']['created_at']; ?></td>
                    <td class="action">
                        <?= $this->Html->link(
                            '<i class="fa fa-eye"></i>',
                            array('plugin'=> false, 'controller' => 'su-kien', 'action' => $eachReport['Link']['Post']['event_id'].'-admin'),
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-pencil-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'edit', $eachReport['Link']['Post']['id']),
                            array('escape' => false)
                        ); ?>
                        <?= $this->Html->link(
                            '<i class="fa fa-minus-square"></i>',
                            array('plugin' => 'admin', 'controller' => 'reports', 'action' => 'delete', $eachReport['Report']['id']),
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