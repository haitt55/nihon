<?php

class Wallet extends AppModel {

    public $useTable = 'wallets';
    
    public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Wallet\'s name is required',
            ),
        ),
    );
    
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );
    
    public $hasOne = 'MoneyType';
    
    public $hasMany = array(
        'Transaction' => array(
            'className' => 'Transaction',
            'foreignKey' => 'wallet_id',
        )
    );
    
    // Get all wallets coresponse to users if have userId agrument
    // or get all wallets if haven't userId agrument
    public function getAllWallets($userId = null) {
        if ($userId) {
            return $this->find('all', array('recursive' => -1, 'conditions' => array(
                'Wallet.user_id' => $userId
            )));
        } else {
            return $this->find('all', array('recursive' => -1));
        }
    }
    
    // Check the wallet name has been in a user's wallet list
    public function existedInUser($walletName, $userId = null) {
        $existWallets = $this->getAllWallets($userId);
        $arrayNameWallet = array();
        foreach ($existWallets as $wallet) {
            $arrayNameWallet[] = $wallet['Wallet']['name'];
        }
        if (in_array($walletName, $arrayNameWallet)) {
            return true;
        } else {
            return false;
        }
    }
    
    // find wallet default coressponse to current user
    public function getDefaultWallet($userId = null) {
        return $this->find('first', array('recursive' => -1, 'conditions' => array(
                'Wallet.user_id' => $userId,
                'Wallet.default' => 1
            )));
    }
}
