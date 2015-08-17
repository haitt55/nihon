<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M
 *
 * @author haitt
 */
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
        $allMoneyType = $this->find('all', array('recursive' => -1));
        $moneyTypeOptions = array();
        foreach ($allMoneyType as $moneyType) {
            $moneyTypeOptions[$moneyType['MoneyType']['id']] = $moneyType['MoneyType']['name'];
        }
        return $moneyTypeOptions;
    }
}
