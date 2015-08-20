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
//        $transactions = $this->Transaction->find('all');
//        $this->set('transactions', $transactions);
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
        $this->Transaction->delete($id);
        $this->autoRender = false;
    }
}
