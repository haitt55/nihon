<?php

App::uses('Controller', 'Controller');
App::uses('Wallet', 'Model');
App::uses('MoneyType', 'Model');
App::uses('Transaction', 'Model');
App::uses('Category', 'Model');

class AppController extends Controller {
    
    public $uses = array('Wallet', 'MoneyType', 'Transaction', 'Category');

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
                $transactions = $this->Transaction->getAllTransactions($this->Session->read('Wallet')['id'], date('Y-m'));
                $this->set('allTransactions', $transactions);
            }
            if ($this->Wallet->getAllWallets($this->Auth->user('id'))) {
                $this->set('allWallets', $this->Wallet->getAllWallets($this->Auth->user('id')));
            }
            $amountTotalIncomeCurrentWallet = $this->Wallet->getAmountTotal($this->Session->read('Wallet')['id'], 1);
            $amountTotalExpenseCurrentWallet = $this->Wallet->getAmountTotal($this->Session->read('Wallet')['id'], 2);
            $this->set('amountTotalIncomeCurrentWallet', $amountTotalIncomeCurrentWallet);
            $this->set('amountTotalExpenseCurrentWallet', $amountTotalExpenseCurrentWallet);
            $amountTotalIncomeAllWallet = $this->Wallet->getAmountTotalAllWallet($this->Auth->user('id'), 1);
            $amountTotalExpenseAllWallet = $this->Wallet->getAmountTotalAllWallet($this->Auth->user('id'), 2);
            $this->set('amountTotalAllWallet', $amountTotalIncomeAllWallet - $amountTotalExpenseAllWallet);
        } else {
            $this->set('auth', null);
        }
        $monthOptions = array();
        for ($i = 1; $i <= 12; $i++) {
            $monthOptions[$i] = $i;
        }
        $yearOptions = array(date('Y')-1 => date('Y')-1, date('Y') => date('Y'), date('Y')+1 => date('Y')+1);
        $this->set('monthOptions', $monthOptions);
        $this->set('yearOptions', $yearOptions);
        $this->set('moneyTypeOptions', $this->MoneyType->getMoneyTypeOptions());
        $this->Auth->allow('login', 'register', 'verify', 'forgot_password', 'reset_password');
    }
}
