<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class UsersController extends AppController
{
    
    var $helpers = array('Html', 'Form');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }
      
    // register new user to the system
    public function register()
    {
        if (!empty($this->data)) {
            $this->User->data = $this->data;
            $hash = sha1($this->data['User']['username'] . rand(0, 100));
            $this->User->data['User']['tokenhash'] = $hash;
            if ($this->User->validates()) {
                $this->User->save($this->data);
                $this->__sendEmailActive($hash, $this->data['User']);
                $this->Session->setFlash(__('Please Check your email for validation Link'));
                $this->redirect('/users/login');
                exit;
            }
        }
    }
    
    // send email include token to active new user
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
    
    // verify new user's token from link in mail to active new user
    // complete registration
    function verify() {
        if (!empty($this->passedArgs['n']) && !empty($this->passedArgs['t'])) {
            $name = $this->passedArgs['n'];
            $tokenHash = $this->passedArgs['t'];
            $results = $this->User->find('first', array('conditions' => array('username' => $name)));
            if ($results['User']['activate'] != 1) {
                if ($results['User']['tokenhash'] == $tokenHash) {
                    $results['User']['activate'] = 1;
                    $this->User->save($results['User']);
                    $this->Session->setFlash(__('Your registration is complete: '));
                    $this->autoRender = false;
                    $this->redirect('login');
                } else {
                    $this->Session->setFlash(__('The token does not match'));
                    $this->redirect('register');
                }
            } else {
                $this->Session->setFlash(__('Token has alredy been used'));
                $this->redirect('register');
            }
        } else {
            $this->Session->setFlash(__('There was no token provided for confirmation'));
            $this->redirect('register');
        }
    }

    // user login into system 
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    // user logout from system
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    // view user's profile
    public function view($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__("Invalid user"));
        }
        $this->set('user', $this->User->findById($id));
    }

    // edit user's profile
    public function edit($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $saved = $this->User->save($this->request->data);
            if ($saved) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'view', $id));
            }
            $this->Session->setFlash(__('The user could not be saved'));
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    // delete user from system
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
    
    // user change password
    public function change_password($id = null) {
        $this->User->id = $id;
        if ($this->request->is(array('post', 'put'))) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $oldPassword = $passwordHasher->hash($this->request->data['User']['old_password']);
            $currentUser = $this->User->find('first', array('conditions' => array('password' => $oldPassword)));
            if ($currentUser) {
                $saved = $this->User->save($this->request->data);
                if ($saved) {
                    $this->Session->setFlash(__('The password has been changed'));
                    return $this->redirect(array('controller' => 'pages', 'action' => 'display'));
                }
                $this->Session->setFlash(__('The user could not be saved'));
            } else {
                $this->Session->setFlash(__('Old password is not true'));
            }
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }
    
    // user who has forgot password get new password
    public function forgot_password() {
        if ($this->request->is(array('post', 'put'))) {
            unset($this->User->validate["email"]["unique"]);
            $data = $this->request->data;
            $this->User->email = $data['User']['email'];
            $user = $this->User->find('first', array('conditions' => array(
                    'email' => $data['User']['email'])));
            if ($user) {
                $this->__sendEmailForgotPassword($user['User']['tokenhash'], $user['User']['email']);
                $this->Session->setFlash(__('Please check your email for guide'));
                $this->redirect('/users/login');
                exit;
            } else {
                $this->Session->setFlash(__('Invalid user'));
            }
        }
    }
    
    // user reset new password
    public function reset_password() {
        $user = $this->User->find('first', array('conditions' => array(
                'email' => $this->passedArgs['email'])));
        if ($user && $this->request->is('post')) {
            $user['User']['password'] = $this->request->data['User']['password'];
            $saved = $this->User->save($user);
            if ($saved) {
                $this->Session->setFlash(__('The password has been reset'));
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
            $this->Session->setFlash(__('The password could not be reset'));
        }
    }

    // send email include link to get back new password
    function __sendEmailForgotPassword($tokenHash, $userEmail)
    {
        $ms = '<html> <body> '
                . 'Click on the link below to reset new password ';
        $ms.='<a href="' . Configure::read('site_name') . '/users/reset_password/t:' . $tokenHash . '/email:' . $userEmail . '">reset new password</a>'
                . '</body> </html>';
        $ms = wordwrap($ms, 70);
        $email = new CakeEmail('default');
        $email->from('trantrantt26@gmail.com')
            ->to($userEmail)
            ->emailFormat('html')
            ->subject('Reset password for Money Lover.')
            ->send($ms);
    }
}