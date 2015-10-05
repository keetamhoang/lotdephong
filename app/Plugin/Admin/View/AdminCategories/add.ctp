<?php
echo $this->Session->flash();

echo $this->Form->create(false, array(
    'action' => 'add',
    'role' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'input', 'error'),
        'div' => array('class' => 'form-group'),
        'label' => array('class' => 'control-label'),
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    ),
    'enctype' => 'multipart/form-data',
    'id' => 'addCategoryForm'
)); ?>

    <div class="form-group">
        <label for="name">Tên danh mục:</label>
        <div class="row">
            <div class="col-sm-10">
                <input name="data[name]" class="form-control title-event-input" required="required" id="name" type="text">
            </div>
            <div class="col-sm-1"><button type="button" class="btn btn-success create-slug-btn">Tạo tên miền</button></div>
        </div>
    </div>

<?php
echo $this->Form->input('slug', array(
    'label' => 'Tên miền:', 'class' => 'form-control slug-event-input',
    'required'
));
echo $this->Form->input('image', array('label' => 'Ảnh đại diện', 'type' => 'file', 'required'));

echo $this->Form->input(
    'description', array('label' => 'Mô tả danh mục:', 'type' => 'textarea', 'class' => 'form-control',
    'required'
));

echo $this->Form->submit('Hoàn thành', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>