<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

    public $uses = array();

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('display');
        if (!$this->Auth->login()) {
            return $this->redirect('/users/login');
        }
    }
    
    // Display home page
    public function display() {
        if (!$this->Session->read('Wallet') && !$this->Wallet->getAllWallets($this->Auth->user('id'))) {
            $this->redirect('/wallets/add');
        }
        $path = func_get_args();
        try {
            $this->render(implode('/', $path));
        } catch (MissingViewException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
        
    }
    
}
