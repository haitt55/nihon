<?php

class Transaction extends AppModel
{
    public $useTable = 'transactions';
    
    public $validate = array(
        'amount_money' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'category_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'wallet_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
    );
    
    public $belongsTo = array(
        'Wallet' =>
        array(
            'className' => 'Wallet',
            'foreignKey' => 'wallet_id',
        ),
        'Category' =>
        array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
        )
    );
}
