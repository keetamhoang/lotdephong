<?php
echo $this->Html->link(
    'Quay lại',
    $this->request->referer(),
    array('style' => 'margin-right: 20px;')
);
echo $this->Html->link(
    'Xem bài',
    array('plugin' => false, 'controller' => false, 'action' => 'su-kien', $this->request->data['Event']['slug']),
    array('style' => 'margin-right: 20px;')
);
echo $this->Html->link(
    'Post của sự kiện',
    array('plugin' => 'admin', 'controller' => 'events', 'action' => 'view', $this->request->data['Event']['id']),
    array('style' => 'margin-right: 20px;')
);
echo $this->Html->link(
    'Post chờ duyệt',
    array('plugin' => 'admin', 'controller' => 'events', 'action' => 'censorship', $this->request->data['Event']['id']),
    array('style' => 'margin-right: 20px;')
);
echo $this->Session->flash();
//pr($this->request->data['Event']);die;
echo $this->Form->create('Event', array(
//    'action' => 'edit',
    'role' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'input', 'error'),
        'div' => array('class' => 'form-group'),
        'label' => array('class' => 'control-label'),
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    ),
    'enctype' => 'multipart/form-data',
    'id' => 'editEventForm'
)); ?>
    <input name="data[Event][id]" type="hidden" value="<?= $this->request->data['Event']['id']; ?>">
    <div class="form-group">
        <div class="checkbox">
            <label>
                <b><input name="data[Event][updating]" type="checkbox" <?= (!empty($this->request->data['Event']['updating']))?'checked':''; ?> value="1">Updating</b>
            </label>
            <label>
                <b><input name="data[Event][hot]" type="checkbox" <?= (!empty($this->request->data['Event']['hot']))?'checked':''; ?> value="1">Còn Hot</b>
            </label>
            <label>
                <b><input name="data[Event][old]" type="checkbox" <?= (!empty($this->request->data['Event']['old']))?'checked':''; ?> value="1">Đã Cũ</b>
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="name">Tên sự kiện:</label>
        <div class="row">
            <div class="col-sm-10">
                <input name="data[Event][name]" class="form-control title-event-input" required="required" id="name" type="text"
                    value="<?= htmlspecialchars($this->request->data['Event']['name']) ?>">
            </div>
            <div class="col-sm-1"><button type="button" class="btn btn-success create-slug-btn">Tạo tên miền</button></div>
        </div>
    </div>
<?php
echo $this->Form->input('slug', array(
    'label' => 'Tên miền:', 'class' => 'form-control slug-event-input',
    'required',
    'value' => $this->request->data['Event']['slug']
));
echo $this->Form->input('image', array('label' => 'Ảnh đại diện', 'type' => 'file'));
?>
    <div class="image-event">
        <?= $this->Html->image(
            'main/posts/'.$this->request->data['Event']['img'],
            array('class' => '')
        ); ?>
    </div>
<?php

echo $this->Form->input(
    'description', array('label' => 'Mô tả sự kiện:', 'type' => 'textarea', 'class' => 'form-control',
    'required',
    'value' => htmlspecialchars($this->request->data['Event']['description'])
));

?>
    <div class="form-group">
        <?php
        $category_check = !empty($this->request->data['CategoriesEvent'])?$this->request->data['CategoriesEvent']:'';

        if (!empty($this->request->data['Category'])){
            foreach ($this->request->data['Category'] as $category) { ?>
                <label class="checkbox-inline">
                    <input type="checkbox" name="data[Category][]"
                           value="<?= $category['Category']['id'] ?>"
                        <?php
                        if(!empty($category_check)) {
                            foreach ($category_check as $categoryCheck) {
                                if ($categoryCheck['Category']['id'] == $category['Category']['id']) {
                                    echo 'checked';
                                    break;
                                }
                            }
                        }
                        ?>
                        > <?= $category['Category']['name'] ?>
                </label>
            <?php }
        }
        ?>
    </div>
<?php
echo $this->Form->submit('Hoàn thành', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>