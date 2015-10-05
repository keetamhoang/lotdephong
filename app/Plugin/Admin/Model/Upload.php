<?php
App::uses('AdminAppModel', 'Admin.Model');
/**
 * User Model
 *
 * @property Facebook $Facebook
 * @property Follow $Follow
 */
class Upload extends AdminAppModel {
    public $useTable = false;

    public $_schema = array(
        'image' => array(
            'type' => 'string',
            'length' => 200,
            'null' => false,
        ),
        'name' => array(
            'type' => 'string',
            'length' => 150,
            'null' => false,
        )
    );

    public function upload($data) {
        $this->image = $data['name'];
        pr($this->image);die;
        //upload image
        $dir = WWW_ROOT . 'img\main\posts';
        $slas = '\\';
        move_uploaded_file($image['tmp_name'], $dir . $slas . $image['name']);

        return true;
    }

}
