<?php

App::uses('Controller', 'Controller');
App::uses('Wallet', 'Model');
App::uses('MoneyType', 'Model');
App::uses('Transaction', 'Model');

class AppController extends Controller {
    
    public $uses = array('Wallet', 'MoneyType', 'Transaction');

    public $components = array(
        'DebugKit.Toolbar',
        'Session',
        'Common',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login',
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType' => 'sha256'
                    ),
                    'scope' => array('activate' => 1)
                )
            )
        )
    );
    
    // before all action, we have got current user and wallet
    public function beforeFilter()
    {
        if ($this->Auth->user()) {
            $this->set('auth', $this->Auth->user());
            if (!$this->Session->read('Wallet') && $this->Wallet->getAllWallets($this->Auth->user('id'))) {
                $wallet = $this->Wallet->getDefaultWallet($this->Auth->user('id'));
                $this->Session->write('Wallet', $wallet['Wallet']);
            }
            if ($this->Session->read('Wallet')) {
                $this->set('curretWallet', $this->Session->read('Wallet'));
                $transactions = $this->Transaction->getAllTransactions($this->Session->read('Wallet')['id']);
                $this->set('allTransactions', $transactions);
            }
            if ($this->Wallet->getAllWallets($this->Auth->user('id'))) {
                $this->set('allWallets', $this->Wallet->getAllWallets($this->Auth->user('id')));
            }
        } else {
            $this->set('auth', null);
        }
        $this->set('moneyTypeOptions', $this->MoneyType->getMoneyTypeOptions());
        $this->Auth->allow('login', 'register', 'verify', 'forgot_password', 'reset_password');
    }
}
