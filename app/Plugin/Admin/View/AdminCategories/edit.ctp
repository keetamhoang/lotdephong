<?php
echo $this->Html->link(
    'Quay lại',
    $this->request->referer(),
    array('style' => 'margin-right: 20px;')
);
echo $this->Html->link(
    'Xem danh mục',
    array('plugin' => false, 'controller' => false, 'action' => 'danh-muc', $this->request->data['Category']['slug']),
    array('style' => 'margin-right: 20px;')
);
echo $this->Html->link(
    'Sự kiện cùng danh mục',
    array('plugin' => 'admin', 'controller' => 'categories', 'action' => 'view', $this->request->data['Category']['id'])
);
echo $this->Session->flash();
//pr($this->request->data['Category']);die;
echo $this->Form->create(false, array(
//    'action' => 'edit',
    'role' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'input', 'error'),
        'div' => array('class' => 'form-group'),
        'label' => array('class' => 'control-label'),
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    ),
    'enctype' => 'multipart/form-data',
    'id' => 'editCategoryForm'
)); ?>

    <input name="data[id]" type="hidden" value="<?= $this->request->data['Category']['id']; ?>">
    <div class="form-group">
        <label for="name">Tên danh mục:</label>
        <div class="row">
            <div class="col-sm-10">
                <input name="data[name]" class="form-control title-event-input" required="required"
                       value="<?= $this->request->data['Category']['name'] ?>" id="name" type="text">
            </div>
            <div class="col-sm-1"><button type="button" class="btn btn-success create-slug-btn">Tạo tên miền</button></div>
        </div>
    </div>

<?php
echo $this->Form->input('slug', array(
    'label' => 'Tên miền:', 'class' => 'form-control slug-event-input',
    'required',
    'value' => $this->request->data['Category']['slug']
));
echo $this->Form->input('image', array('label' => 'Ảnh đại diện', 'type' => 'file'));
?>
    <div class="image-event">
        <?= $this->Html->image(
            'main/posts/'.$this->request->data['Category']['img'],
            array('class' => '')
        ); ?>
    </div>
<?php
echo $this->Form->input(
    'description', array('label' => 'Mô tả danh mục:', 'type' => 'textarea', 'class' => 'form-control',
    'required',
    'value' => $this->request->data['Category']['description']
));
echo $this->Form->submit('Hoàn thành', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>