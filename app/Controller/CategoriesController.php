<?php

App::uses('AppController', 'Controller');
App::uses('Category', 'Model');

class CategoriesController extends AppController
{
    public $uses = array('Category');
    
    var $helpers = array('Html', 'Form');
    
    var $components = array("RequestHandler");

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->set('categoryTypeOptions', $this->Category->getCategoryTypeOptions());
    }
    
    public function index()
    {
        $categories = $this->Category->find('all');
        $this->set('categories', $categories);
    }

    // user add new category
    public function add() 
    {  
        if ($this->request->is('post')) {
            $this->Category->create();
            $category = $this->request->data;
            if(!$this->Category->exist($category['Category']['name'])) {
                if (!empty($this->data['Category']['photo']['name'])) {
                    $file = $this->data['Category']['photo'];
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($ext, $arr_ext)) {
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . Configure::read('img_folder.category') . $file['name']);
                        $category['Category']['photo'] = $file['name'];
                    }
                } else {
                    $category['Category']['photo'] = '';
                }
                if ($this->Category->save($category)) {
                    $this->Session->setFlash(__('Category has been saved'));
                    $this->redirect('/');
                } else {
                    $this->Session->setFlash(__('Category has not been saved'));
                    $this->redirect('add');
                }
            } else {
                $this->Session->setFlash(__('You have got this category before'));
                $this->redirect('add');
            }
        }
    }

    // user edit existed category
    public function edit($id = null)
    {  
        if (empty($this->request->data)) {
            $this->request->data = $this->Category->findById($id);
        }
        if ($this->request->is(array('post', 'put'))) {
            $category = $this->request->data;
            if(!$this->Category->existWithOther($id, $category['Category']['name'])) {
                if (!empty($this->data['Category']['photo']['name'])) {
                    $file = $this->data['Category']['photo'];
                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($ext, $arr_ext)) {
                        move_uploaded_file($file['tmp_name'], WWW_ROOT . Configure::read('img_folder.category') . $file['name']);
                        $category['Category']['photo'] = $file['name'];
                    }
                } else {
                    $category['Category']['photo'] = '';
                }
                if ($this->Category->save($category)) {
                    $this->Session->setFlash(__('Category has been saved'));
                    $this->redirect('/');
                } else {
                    $this->Session->setFlash(__('Category has not been saved'));
                    $this->redirect('add');
                }
            } else {
                $this->Session->setFlash(__('You have got this category before'));
                $this->redirect('add');
            }
        }
    }
    
    // Delete category using ajax
    public function deleteCategory($id)
    {
        $this->Category->delete($id);
        $this->autoRender = false;
    }
    
    // Get category options by type for selection 
    public function getCategoryOptions($type)
    {
        $categoryOptions = $this->Category->getCategoryOptions($type);
        var_dump($categoryOptions);
        $this->autoRender = false;
    }
}
