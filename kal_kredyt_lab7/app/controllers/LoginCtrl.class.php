<?php

namespace app\controllers;

use app\transfer\User;
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
        $this->loginForm->login = getFromRequest('login');
        $this->loginForm->password = getFromRequest('password');
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
            $user = new User($this->loginForm->login, 'admin');
            $_SESSION['user'] = serialize($user);
            addRole($user->role);
        } else if ($this->loginForm->login == 'user' && $this->loginForm->password == 'user') {
            $user = new User($this->loginForm->login, 'user');
            $_SESSION['user'] = serialize($user);
            addRole($user->role);
        } else {
            getErrors()->addError('Dane logowania są niepoprawne');
        }

        return getErrors()->isEmpty();
    }
    public function displayView()
    {
        getSmarty()->assign('page_title', 'Strona Logowania');
        getSmarty()->assign('loginForm', $this->loginForm);
        getSmarty()->display('login_view.tpl');
    }
    public function action_login()
    {
        $this->getLoginParameters();

        if ($this->validateLoginForm()) {
            header("Location: " . getConfig()->app_url . "/");
        } else {
            $this->displayView();
        }
    }

    public function action_logout()
    {
        session_destroy();
        $this->displayView();
    }
}
