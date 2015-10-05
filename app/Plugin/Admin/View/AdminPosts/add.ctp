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
    'id' => 'addPostForm'
)); ?>

<div class="form-group">
    <select multiple class="form-control" name="data[Post][event_id]" required="required">
        <?php
        if (!empty($listEvents)) {
            foreach ($listEvents as $eachEvent) { ?>
                <option <?= $eachEvent['Event']['id'] == $this->request->data['id_event'] ? 'selected' : ''; ?>
                    value="<?= $eachEvent['Event']['id'] ?>"><?= $eachEvent['Event']['name']; ?></option>
            <?php }
        }
        ?>
    </select>
</div>

<?php
echo $this->Form->input('Post.name', array(
    'label' => 'Tên Post:', 'class' => 'form-control name-post-input',
    'required'
));
echo $this->Form->input(
    'Post.content', array('label' => 'Mô tả post:', 'type' => 'textarea', 'class' => 'form-control'
));
echo $this->Form->input('Post.image', array('label' => 'Ảnh', 'type' => 'file'));
echo $this->Form->input('Post.author', array(
    'label' => 'Người gửi:', 'class' => 'form-control author-post-input',
    'required'
));
?>
    <div class="form-group">
        <label for="name">Link bài:</label>
        <div class="row">
            <div class="col-sm-2">
                <input name="data[Link][name][]" class="form-control source-link-input"
                       id="source-link" type="text" placeholder="Nguồn">
            </div>
            <div class="col-sm-8">
                <input name="data[Link][link][]" class="form-control name-link-input"
                       id="name-link" type="text" placeholder="Đường link">
            </div>
            <div class="col-sm-1"><button type="button" class="btn btn-success create-link-btn">Thêm link</button></div>
        </div>
    </div>
<?php

echo $this->Form->submit('Hoàn thành', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>