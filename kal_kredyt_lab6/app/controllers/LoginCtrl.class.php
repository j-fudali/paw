<?php

namespace app\controllers;

use app\forms\LoginForm;

class LoginCtrl
{
    private $loginForm;
    function __construct()
    {
        $this->loginForm = new LoginForm();
    }
    private function getLoginParameters()
    {
        $this->loginForm->login = getParam('login');
        $this->loginForm->password = getParam('login');
    }
    private function validateLoginForm()
    {
        if (!(isset($this->loginForm->login) && isset($this->loginForm->password))) {
            return false;
        }

        if ($this->loginForm->login == '') {
            getErrors()->addError('Nie podano loginu');
        }
        if ($this->loginForm->password == '') {
            getErrors()->addError('Nie podano hasła');
        }
        if (!getErrors()->isEmpty()) return false;
        if ($this->loginForm->login == 'admin' && $this->loginForm->password == 'admin') {
            session_start();
            $_SESSION['role'] = 'admin';
            return true;
        }
        if ($this->loginForm->login == 'user' && $this->loginForm->password == 'user') {
            session_start();
            $_SESSION['role'] = 'user';
            return true;
        }

        getErrors()->addError('Dane logowania są niepoprawne');
        return false;
    }
    public function displayView()
    {
        if (!$this->validateLoginForm()) {
            getSmarty()->assign('page_title', 'Strona Logowania');
            getSmarty()->assign('loginForm', $this->loginForm);
            getSmarty()->display('login_view.tpl');
        } else {
            header('Location: ' . getConfig()->app_url);
        }
    }
    public function process()
    {
        $this->getLoginParameters();
        $this->displayView();
    }
}
