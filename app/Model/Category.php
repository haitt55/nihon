<?php

class Category extends AppModel
{
    public $useTable = 'categories';
    
    public $validate = array(
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
}
