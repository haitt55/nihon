<?php

App::uses('AppController', 'Controller');

class WalletsController extends AppController
{
    var $helpers = array('Html', 'Form');

    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    // user add new wallet
    public function add() {  
        if ($this->request->is('post')) {
            $this->Wallet->create();
            $wallet = $this->request->data;
            if(!$this->Wallet->existedInUser($wallet['Wallet']['name'], $this->Auth->user('id'))) {
                $wallet['Wallet']['user_id'] = $this->Auth->user('id');
                if (!$this->Session->read('Wallet')) {
                    $this->Session->write('Wallet', $wallet['Wallet']);
                    $wallet['Wallet']['default'] = 1;
                }
                if (!empty($this->data['Wallet']['photo']['name'])) {
                    $file = $this->data['Wallet']['photo'];
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($ext, $arr_ext)) {
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . Configure::read('img_folder.wallet') . $file['name']);
                        $wallet['Wallet']['photo'] = $file['name'];
                    }
                }
                if ($this->Wallet->save($wallet)) {
                    $this->Session->setFlash(__('Wallet has been saved'));
                    $this->redirect('/');
                } else {
                    $this->Session->setFlash(__('Wallet has not been saved'));
                    $this->redirect('add');
                }
            } else {
                $this->Session->setFlash(__('You have got this wallet before'));
                $this->redirect('add');
            }
        }
    }

}
