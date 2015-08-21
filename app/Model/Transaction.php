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
    
    // Get all transaction in this month
    public function getAllTransactions($walletId = null, $yearMonth = null)
    {
        $transactions = $this->find('all', 
            array('conditions' => array(
                'Transaction.wallet_id' => $walletId,
                'Transaction.add_date LIKE' => $yearMonth.'%'),
            'order' => array("Transaction.add_date DESC")
            ));
        $transactionsByDate = $this->groupTransactionByDate($transactions);
        return $transactionsByDate;
    }
    
    // group transaction by date
    public function groupTransactionByDate($transactions = array())
    {
        $dates = array();
        $results = array();
        foreach ($transactions as $transaction) {
            $date = $transaction['Transaction']['add_date'];
            if (!array_key_exists($date, $results)) {
                $results[$date] = array();
            }
            $results[$date][] = $transaction;
        }
        return $results;
    }
}
