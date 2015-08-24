<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

    public $uses = array();

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('display');
        if (!$this->Auth->login()) {
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
    }
    
    // Display home page
    public function display() {
        $monthOptions = array();
        for ($i = 1; $i <= 12; $i++) {
            $monthOptions[$i] = $i;
        }
        $yearOptions = array(date('Y')-1 => date('Y')-1, date('Y') => date('Y'), date('Y')+1 => date('Y')+1);
        $this->set('monthOptions', $monthOptions);
        $this->set('yearOptions', $yearOptions);
        if (!$this->Session->read('Wallet') && !$this->Wallet->getAllWallets($this->Auth->user('id'))) {
            $this->redirect(array('controller' => 'wallets', 'action' => 'add'));
        }
        if (!empty($this->request->query)) {
            $month = $this->request->query['month']['month'];
            $year = $this->request->query['year']['year'];
            if (strlen($month) < 2) {
                $month = '0' . $month;
            }
            $yearMonth = $year . '-' . $month;
            $allTransactions = $this->Transaction->getAllTransactions($this->Session->read('Wallet')['id'], $yearMonth);
            $this->set('allTransactions', $allTransactions);
            $this->set('monthValue', $month);
            $this->set('yearValue', $year);
        }
        $path = func_get_args();
        try {
            $this->render(implode('/', $path));
        } catch (MissingViewException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
    
}
