<?php

App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    var $name = 'User';

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {

            if (isset($this->data[$this->alias]['id'])) {
                $id = $this->data[$this->alias]['id'];
                $user = $this->findById($id);
            } else {
                $id = false;
            }

            if (!$id || $this->data[$this->alias]['password'] != $user['User']['password']) {
                $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
                $this->data[$this->alias]['password'] = $passwordHasher->hash(
                        $this->data[$this->alias]['password']
                );
            }
        }
        return true;
    }

    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Username is required',
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'required' => 'create',
                'message' => 'This username has used by other user',
                'on' => 'create',
            ),
            'alphanumeric' => array(
                'rule' => 'alphanumeric'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Password is required'
            ),
            'passwordLength' => array(
                'rule' => array('minLength', 6),
                'message' => 'Minimum length of 6 characters'
            )
        ),
        'confirmpassword' => array(
            'equaltofield' => array(
                'rule' => array('equaltofield', 'password'),
                'message' => 'Require the same value to password.',
                //'on' => 'create',
            )
        ),
        'email' => array(
            'email',
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Email is required'
            )
        ),
        'phone_number' => array(
            'phone_no_should_be_numeric' => array(
                'rule' => 'numeric',
                'allowEmpty' => true, 
                'message' => 'Phone number should be numeric')
        ),
        'age' => array(
            'age_no_should_be_numeric' => array(
                'rule' => 'numeric',
                'allowEmpty' => true, 
                'message' => 'Age should be numeric')
        ),
        'login' => array(
            'loginRule-1' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Only alphabets and numbers allowed',
            ),
            'loginRule-2' => array(
                'rule' => array('minLength', 6),
                'message' => 'Minimum length of 6 characters'
            )
        )
    );
    
    public function equaltofield($check,$otherfield)
    {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    } 

}
