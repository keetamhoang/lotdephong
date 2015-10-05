<?php

App::uses('AppModel', 'Model');
/**
 * Model for orders table
 */
class Manager extends AppModel {

    public $validate = array(
        'username' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Tên không được để trống.'
            )
        ),
        'email' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'E-mail không được để trống.'
            ),
            'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'E-mail này đã được sử dụng'
            ),
            'between' => array(
                'rule' => array('between', 6, 60),
                'message' => 'E-mail phải có từ 6 đến 60 ký tự'
            )
        ),
        'password' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Mật khẩu không được để trống'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Mật khẩu tối thiểu 6 ký tự'
            )
        ),
        'password_confirm' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Xác nhận mật khẩu không được để trống'
            ),
            'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Hãy xác nhận đúng mật khẩu'
            )
        ),
        'old_password' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Mật khẩu cũ không được để trống'
            ),
            'isCurrentPassword' => array(
                'rule' => array('isCurrentPassword'),
                'message' => 'Mật khẩu cũ không đúng'
            )
        ),
    );

//    function isCurrentPassword($data) {
//        pr($data);die;
//        $this->id = $data['id'];
//        $password = $this->field('password');
//
//        return(AuthComponent::password($data['old_password']) == $password);
//    }

    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {
        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'Manager.id'
                ),
                'conditions' => array(
                    'Manager.email' => $check['email']
                )
            )
        );

        if(!empty($email)){
//            if($this->data[$this->alias]['id'] == $email['Manager']['id']){
//                return true;
//            }else{
//                return false;
//            }
            return false;
        }else{
            return true;
        }
    }

    public function equaltofield($check, $otherfield)
    {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }

    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
    public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }

        // fallback to our parent
        return parent::beforeSave($options);
    }

}