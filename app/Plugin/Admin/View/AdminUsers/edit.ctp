<?php
echo $this->Html->link(
    'Quay lại',
    $this->request->referer(),
    array('style' => 'margin-right: 20px;')
);

echo $this->Session->flash();

echo $this->Form->create(false, array(
//    'action' => 'add',
    'role' => 'form',
    'inputDefaults' => array(
        'format' => array('before', 'label', 'input', 'error'),
        'div' => array('class' => 'form-group'),
        'label' => array('class' => 'control-label'),
        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
    ),
    'id' => 'editManagerForm'
)); ?>

    <input name="data[id]" type="hidden" value="<?= $this->request->data['Manager']['id']; ?>">

<?php
echo $this->Form->input('username', array(
    'label' => 'Tên sử dụng:', 'class' => 'form-control name-manager-input',
    'required',
    'value' => htmlspecialchars($this->request->data['Manager']['username'])
));
?>
    <div class="form-group">
        <select name="data[role]" class="form-control">
            <option <?= $this->request->data['Manager']['role']=='1'?'selected':'' ?> value="1">Admin</option>
            <option <?= $this->request->data['Manager']['role']=='0'?'selected':'' ?> value="0">Guest</option>
        </select>
    </div>
<?php
echo $this->Form->input('email', array(
    'label' => 'E-mail:', 'class' => 'form-control email-manager-input',
    'disabled',
    'value' => htmlspecialchars($this->request->data['Manager']['email'])
));

echo $this->Form->submit('Hoàn thành', array('class' => 'btn btn-primary'));
echo $this->Form->end();
?>
<?php
//echo $this->Form->input('old_password', array(
//    'label' => 'Password cũ:', 'class' => 'form-control old-manager-input', 'type' => 'password',
//    'required',
//    'value' => $this->request->data['Manager']['password']
//));
//echo $this->Form->input('password', array(
//    'label' => 'Password mới:', 'class' => 'form-control old-manager-input', 'type' => 'password',
//));
//echo $this->Form->input('password_confirm', array(
//    'label' => 'Password xác nhận:', 'class' => 'form-control old-manager-input', 'type' => 'password',
//));
?>
