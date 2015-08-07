<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController
{
    
    var $helpers = array('Html', 'Form');

//    public function beforeFilter()
//    {
//        parent::beforeFilter();
//        $this->Auth->allow('add', 'logout');
//    }
    
    public function register()
    {
        if (!empty($this->data)) {
            $this->User->data = $this->data;
            $hash = sha1($this->data['User']['username'] . rand(0, 100));
            $this->User->data['User']['tokenhash'] = $hash;
            if ($this->User->validates()) {
                $this->User->save($this->data);
                $this->__sendEmailActive($hash, $this->data['User']);
                $this->Session->setFlash('Please Check your email for validation Link');
                $this->redirect('/users/login');
                exit;
            }
        }
    }
    
    function __sendEmailActive($tokenHash, $user)
    {
        $ms = '<html> <body> '
                . 'Click on the link below to complete registration ';
        $ms.='<a href="' . Configure::read('site_name') . '/users/verify/t:' . $tokenHash . '/n:' . $user['username'] . '">verify</a>'
                . '</body> </html>';
        $ms = wordwrap($ms, 70);
        $email = new CakeEmail('default');
        $email->from('trantrantt26@gmail.com')
            ->to($user['email'])
            ->emailFormat('html')
            ->subject('Confirm Registration for Money Lover.')
            ->send($ms);
    }
    
    function verify() {
        if (!empty($this->passedArgs['n']) && !empty($this->passedArgs['t'])) {
            $name = $this->passedArgs['n'];
            $tokenHash = $this->passedArgs['t'];
            $results = $this->User->find('first', array('conditions' => array('username' => $name)));
            if ($results['User']['activate'] != 1) {
                if ($results['User']['tokenhash'] == $tokenHash) {
                    $results['User']['activate'] = 1;
                    //var_dump($results);die;
                    var_dump($this->User->save($results));die;
                    $this->Session->setFlash('Your registration is complete: ');
                    $this->redirect('login');
                    exit;
                } else {
                    $this->Session->setFlash('The token does not match');
                    $this->redirect('register');
                }
            } else {
                $this->Session->setFlash('Token has alredy been used');
                $this->redirect('register');
            }
        } else {
            $this->Session->setFlash('There was no token provided for confirmation');
            $this->redirect('register');
        }
    }

    public function login()
    {
        if (!empty($this->data)) {
            if ($this->User->validates()) {
                $this->User->data = $this->data;
                $results = $this->User->findByEmail($this->data['User']['email']);
                if ($results['User']['activate'] == 1) {
                    if ($results && $results['User']['password'] == md5($this->data['User']['password'])) {
                        $this->Session->write('User', $results['User']);
                    } else {
                        $this->Session->setFlash('Invalid Username or Password please try again');
                    }
                } else {
                    $this->User->delete($results['User']['id']);
                    $this->Session->setFlash('Your Email is not verified. Please verify and try again.');
                }
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

    public function view($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__("Invalid user"));
        }
        $this->set('user', $this->User->findById($id));
    }

    public function add()
    {        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved'));
        }
    }

    public function edit($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('The user could not be saved'));
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) 
    {
        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
}