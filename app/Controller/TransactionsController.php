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
        $this->set('categoryOptions', $this->Category->getCategoryOptions());
    }
    
    public function index()
    {
//        $categories = $this->Transaction->find('all');
//        $this->set('categories', $categories);
    }

    // user add new transaction
    public function add() 
    {  
        if ($this->request->is('post')) {
            $this->Transaction->create();
            $category = $this->request->data;
            if ($this->Category->save($category)) {
                $this->Session->setFlash(__('Category has been saved'));
                $this->redirect('/');
            } else {
                $this->Session->setFlash(__('Category has not been saved'));
                $this->redirect('add');
            }
        }
    }

    // user edit existed transaction
//    public function edit($id = null)
//    {  
//        if (empty($this->request->data)) {
//            $this->request->data = $this->Category->findById($id);
//        }
//        if ($this->request->is(array('post', 'put'))) {
//            $category = $this->request->data;
//            if ($this->Category->save($category)) {
//                $this->Session->setFlash(__('Category has been saved'));
//                $this->redirect('/');
//            } else {
//                $this->Session->setFlash(__('Category has not been saved'));
//                $this->redirect('add');
//            }
//        }
//    }
//    
    // Delete transaction using ajax
//    public function deleteCategory($id)
//    {
//        $this->Transaction->delete($id);
//        $this->autoRender = false;
//    }
}
