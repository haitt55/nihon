<?php

App::uses('AppController', 'Controller');
App::uses('Transaction', 'Model');
App::uses('Category', 'Model');

class TransactionsController extends AppController
{
    public $uses = array('Transaction', 'Category');
    
    var $helpers = array('Html', 'Form');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->set('categoryTypeOptions', $this->Category->getCategoryTypeOptions());
    }
    
    // Transactions index
    public function index()
    {
        if (!empty($this->request->query)) {
            $month = $this->request->query['month']['month'];
            $year = $this->request->query['year']['year'];
            if (strlen($month) < 2) {
                $month = '0' . $month;
            }
            $yearMonth = $year . '-' . $month;
            $allTransactions = $this->Transaction->getAllTransactions($this->Session->read('Wallet')['id'], $yearMonth);
            $this->set('allTransactions', $allTransactions);
            $this->set('monthValue', $month);
            $this->set('yearValue', $year);
        }
    }

    // User add new transaction
    public function add() 
    {  
        $this->set('categoryOptions', $this->Category->getCategoryOptions());
        if ($this->request->is('post')) {
            $this->Transaction->create();
            $transaction = $this->request->data;
            $transaction['Transaction']['wallet_id'] = $this->Session->read('Wallet')['id'];
            if (!$transaction['Transaction']['add_date']) {
                $transaction['Transaction']['add_date'] = date("Y-m-d");
            }
            if ($this->Transaction->save($transaction)) {
                $this->Session->setFlash(__('Transaction  has been saved'));
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
            } else {
                $this->Session->setFlash(__('Transaction has not been saved'));
                $this->redirect('add');
            }
        }
    }
    
    // User add new transfer transaction
    public function transfer($walletId) 
    {  
        $amountTotalWallet = $this->Wallet->getAmountTotal($walletId, 1) - $this->Wallet->getAmountTotal($walletId, 2);
        $this->Transaction->validator()->add('amount_money', 'maxValue', array(
            'rule' => array('range', 0, $amountTotalWallet),
            'message' => 'Please enter amount money less than ' . $amountTotalWallet
        ));
        $this->set('walletOptions', $this->Wallet->getWalletOptions($walletId, $this->Auth->user('id')));
        if ($this->request->is('post')) {
            $this->Transaction->set($this->request->data);
            if ($this->Transaction->validates()) {
                $this->Transaction->create();
                $transaction = $this->request->data;
                $transaction['Transaction']['category_id'] = 9;
                if (!$transaction['Transaction']['add_date']) {
                    $transaction['Transaction']['add_date'] = date("Y-m-d");
                }
                $transactionOut = $transaction;
                $transactionOut['Transaction']['wallet_id'] = $walletId;
                $transactionOut['Transaction']['category_id'] = 7;
                if ($this->Transaction->saveMany(array($transaction, $transactionOut), array('deep' => true))) {
                    $this->Session->setFlash(__('Transfer  has been saved'));
                    $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
                } else {
                    $this->Session->setFlash(__('Transfer has not been saved'));
                    $this->redirect(array('controller' => 'transactions', 'action' => 'transfer', $walletId));
                }
            } else {
                $errors = $this->Transaction->validationErrors;
            }
        }
    }

    // User edit existed transaction
    public function edit($id = null)
    {
        if (empty($this->request->data)) {
            $this->request->data = $this->Transaction->findById($id);
            $categoryOptions = $this->Category->getCategoryOptions($this->request->data['Category']['type']);
            $this->set('categoryOptions', $categoryOptions);
            $this->set('type', $this->request->data['Category']['type']);
        }
        if ($this->request->is(array('post', 'put'))) {
            $category = $this->request->data;
            if ($this->Transaction->save($category)) {
                $this->Session->setFlash(__('Transaction has been saved'));
                $this->redirect(array('controller' => 'pages', 'action' => 'display', 'home'));
            } else {
                $this->Session->setFlash(__('Transaction has not been saved'));
                $this->redirect('edit');
            }
        }
    }
    
    // Delete transaction using ajax
    public function deleteTransaction($id)
    {
        if($this->request->is('delete')){
            $this->Transaction->delete($id);
        }
        $this->autoRender = false;
    }
}
