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
    'id' => 'addEventForm'
)); ?>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <b><input name="data[updating]" type="checkbox" value="1">Updating</b>
            </label>
            <label>
                <b><input name="data[hot]" type="checkbox" value="1">Còn Hot</b>
            </label>
            <label>
                <b><input name="data[old]" type="checkbox" value="1">Đã Cũ</b>
            </label>
        </div>
    </div>

    <div class="form-group">
        <label for="name">Tên sự kiện:</label>
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
    'description', array('label' => 'Mô tả sự kiện:', 'type' => 'textarea', 'class' => 'form-control',
    'required'
));
?>
    <div class="form-group">
        <?php
        $category_check = !empty($this->request->data['CategoriesEvent'])?$this->request->data['CategoriesEvent']:'';

        if (!empty($this->request->data['Category'])){
            foreach ($this->request->data['Category'] as $category) { ?>
                <label class="checkbox-inline">
                    <input type="checkbox" name="data[Category][]"
                           value="<?= $category['Category']['id'] ?>"> <?= $category['Category']['name'] ?>
                </label>
            <?php }
        }
        ?>
    </div>
<?php
echo $this->Form->submit('Hoàn thành', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>