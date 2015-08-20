<?php

class MoneyType extends AppModel {
    
    public $useTable = 'money_types';
    
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Wallet\'s name is required',
            ),
        ),
    );
    
    // Get all types of money for selection
    public function getMoneyTypeOptions() {
        $moneyTypeOptions = $this->find('list', array(
            'fields' => array('MoneyType.id', 'MoneyType.name'),
            'recursive' => 0
        ));
        return $moneyTypeOptions;
    }
}
