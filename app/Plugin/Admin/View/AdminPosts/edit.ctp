<?php
echo $this->Html->link(
    'Quay lại',
    $this->request->referer(),
    array('style' => 'margin-right: 20px;')
);

echo $this->Session->flash();

echo $this->Form->create('Post', array(
//    'action' => 'add',
    'role' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'input', 'error'),
        'div' => array('class' => 'form-group'),
        'label' => array('class' => 'control-label'),
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    ),
    'enctype' => 'multipart/form-data',
    'id' => 'editPostForm'
)); ?>
    <input name="data[Post][id]" type="hidden" value="<?= $this->request->data['Post']['id']; ?>">
    <div class="form-group">
        <select multiple class="form-control" name="data[Post][event_id]" required="required">
            <?php
            if (!empty($listEvents)) {
                foreach ($listEvents as $eachEvent) { ?>
                    <option <?= $eachEvent['Event']['id'] == $this->request->data['Post']['event_id'] ? 'selected' : ''; ?>
                        value="<?= $eachEvent['Event']['id'] ?>"><?= $eachEvent['Event']['name']; ?></option>
                <?php }
            }
            ?>
        </select>
    </div>

<?php
echo $this->Form->input('Post.name', array(
    'label' => 'Tên Post:', 'class' => 'form-control name-post-input',
    'required',
    'value' => htmlspecialchars($this->request->data['Post']['name'])
));
echo $this->Form->input(
    'Post.content', array('label' => 'Mô tả post:', 'type' => 'textarea', 'class' => 'form-control',
    'value' => $this->request->data['Post']['content']
));
echo $this->Form->input('Post.image', array('label' => 'Ảnh', 'type' => 'file'));
?>
    <div class="image-event">
        <?= $this->Html->image(
            'main/posts/' . $this->request->data['Post']['img'],
            array('class' => '')
        ); ?>
    </div>
<?php
echo $this->Form->input('Post.author', array(
    'label' => 'Người gửi:', 'class' => 'form-control author-post-input',
    'required',
    'value' => $this->request->data['Post']['author']
));
?>
    <div class="form-group">
        <label for="name">Link bài:</label>
        <?php if (!empty($this->request->data['Link'])) {
            foreach ($this->request->data['Link'] as $link) { ?>
                <div class="row">
                    <div class="col-sm-2">
                        <input name="data[Link][name][]"
                               class="form-control source-link-input"
                               id="source-link" placeholder="Nguồn" type="text"
                               value="<?= $link['Link']['name']; ?>">
                    </div>
                    <div class="col-sm-8">
                        <input name="data[Link][link][]" class="form-control name-link-input"
                               id="name-link" placeholder="Đường link" type="text"
                               value="<?= $link['Link']['link']; ?>">
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn remove-link-btn btn-danger">Xóa link</button>
                    </div>
                </div>
            <?php }
        } ?>
        <div class="row">
            <div class="col-sm-2">
                <input name="data[Link][name][]" class="form-control source-link-input"
                       id="source-link" type="text" placeholder="Nguồn">
            </div>
            <div class="col-sm-8">
                <input name="data[Link][link][]" class="form-control name-link-input"
                       id="name-link" type="text" placeholder="Đường link">
            </div>
            <div class="col-sm-1">
                <button type="button" class="btn btn-success create-link-btn">Thêm link</button>
            </div>
        </div>
    </div>
<?php

echo $this->Form->submit('Hoàn thành', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>