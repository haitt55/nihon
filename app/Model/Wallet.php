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
        ),
        'MoneyType' => array(
            'className' => 'MoneyType',
            'foreignKey' => 'money_type'
        )
    );
    
    public $hasMany = array(
        'Transaction' => array(
            'className' => 'Transaction',
            'foreignKey' => 'wallet_id',
        )
    );
    
    // Get all wallets coresponse to users if have userId agrument
    // or get all wallets if haven't userId agrument
    public function getAllWallets($userId = null)
    {
        if ($userId) {
            return $this->find('all', array('recursive' => -1, 'conditions' => array(
                'Wallet.user_id' => $userId
            )));
        } else {
            return $this->find('all', array('recursive' => -1));
        }
    }
    
    // Check the wallet name has been in a user's wallet list
    public function existedInUser($walletName, $userId = null)
    {
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
    
    // Check the wallet name has been in a user's wallet list when edit
    public function checkExistedOtherInUser($id, $walletName, $userId = null)
    {
        $existWallets = $this->getAllWallets($userId);
        $arrayNameWallet = array();
        foreach ($existWallets as $wallet) {
            $arrayNameWallet[$wallet['Wallet']['id']] = $wallet['Wallet']['name'];
        }
        unset($arrayNameWallet[$id]);
        if (in_array($walletName, $arrayNameWallet)) {
            return true;
        } else {
            return false;
        }
    }
    
    // Find wallet default coressponse to current user
    public function getDefaultWallet($userId = null)
    {
        return $this->find('first', array('recursive' => -1, 'conditions' => array(
                'Wallet.user_id' => $userId,
                'Wallet.default' => 1
            )));
    }
    
    // Get amount total by category type in a wallet
    public function getAmountTotal($walletId = null, $categoryType = null)
    {
        $amountTotalIncome = 0;
        if ($walletId) {
            $data = $this->find('first', array('recursive' => 2, 'conditions' => array(
                'Wallet.id' => $walletId)));
        }
        $amountTotalIncome = $this->calculateAmountTotal($data, $categoryType);
        return $amountTotalIncome;
    }
    
    // Get amount total all wallet by category type
    public function getAmountTotalAllWallet($userId = null, $categoryType = null)
    {
        $allWallets = $this->getAllWallets($userId);
        $total = 0;
        foreach ($allWallets as $wallet) {
            $total += $this->getAmountTotal($wallet['Wallet']['id'], $categoryType);
        }
        return $total;
    }

    // Calculate total money
    public function calculateAmountTotal($data = array(), $categoryType = null)
    {
        $total = 0;
        if ($data['Transaction']) {
            foreach ($data['Transaction'] as $transaction) {
                if ($transaction['Category']['type'] == $categoryType) {
                    $total += $transaction['amount_money'];
                }
            }
        }
        return $total;
    }
    
    // Get wallet option for transfer selection
    public function getWalletOptions($currentWalletId = null, $userId = null) {
        if ($currentWalletId) {
            $walletOptions = $this->find('list', array(
                'fields' => array('Wallet.id', 'Wallet.name'),
                'recursive' => 0,
                'conditions' => array('Wallet.user_id' => $userId)
            ));
        }
        unset($walletOptions[$currentWalletId]);
        return $walletOptions;
    }
}
