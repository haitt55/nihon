<?php

class Category extends AppModel
{
    const INCOME = 1;
    const EXPENSE = 2;
    const SAVE = 3;

    public $useTable = 'categories';
    
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank'
            )
        ),
        'parent_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'type' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
    );
    
    public $hasAndBelongsToMany = array(
        'Wallet' =>
        array(
            'className' => 'Wallet',
            'joinTable' => 'wallets_categories',
            'foreignKey' => 'category_id',
            'associationForeignKey' => 'wallet_id',
            'conditions' => '',
        )
    );
    
    // Get all types of Category for selection
    public function getCategoryTypeOptions() 
    {
        $allCategoryType = Configure::read('category_type');
        $allCategoryType[0] = '-- Please choose --';
        return $allCategoryType;
    }
    
    // Get all category by type for selection
    public function getCategoryOptions($type = null) 
    {
        if ($type) {
            $categories = $this->find('all', array('recursive' => -1, 'conditions' => array(
            'Category.type' => $type)));
        } else {
            $categories = $this->find('all', array('recursive' => -1));
        }
        $categoryOptions = array();
        foreach ($categories as $category) {
            $categoryOptions[$category['Category']['id']] = $category['Category']['name'];
        }
        $categoryOptions[0] = '-- Please choose --';
        return $categoryOptions;
    }
    
    // Check if category exist in System
    public function exist($name = null)
    {
        $existCategories = $this->find('all', array('recursive' => -1));
        $arrayNameCategory = array();
        foreach ($existCategories as $category) {
            $arrayNameCategory[] = $category['Category']['name'];
        }
        if (in_array($name, $arrayNameCategory)) {
            return true;
        } else {
            return false;
        }
    }
    
    // Check if category exist in System
    public function existWithOther($id, $name = null)
    {
        $existCategories = $this->find('all', array('recursive' => -1));
        $arrayNameCategory = array();
        foreach ($existCategories as $category) {
            $arrayNameCategory[$category['Category']['id']] = $category['Category']['name'];
        }
        unset($arrayNameCategory[$id]);
        if (in_array($name, $arrayNameCategory)) {
            return true;
        } else {
            return false;
        }
    }
}
