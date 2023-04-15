<?php
require_once $config->root_path . '/lib/smarty/libs/Smarty.class.php';
require_once 'LoginForm.class.php';
require_once $config->root_path . '/lib/Errors.class.php';
class LoginCtrl
{
    private $loginForm;
    private $errors;
    function __construct()
    {
        $this->loginForm = new LoginForm();
        $this->errors = new Errors();
    }
    private function getLoginParameters()
    {
        $this->loginForm->login = isset($_REQUEST['login']) ? $_REQUEST['login'] : null;
        $this->loginForm->password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
    }
    private function validateLoginForm()
    {
        if (!(isset($this->loginForm->login) && isset($this->loginForm->password))) {
            return false;
        }

        if ($this->loginForm->login == '') {
            $this->errors->addError('Nie podano loginu');
        }
        if ($this->loginForm->password == '') {
            $this->errors->addError('Nie podano hasła');
        }
        if (!$this->errors->isEmpty()) return false;
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

        $this->errors->addError('Dane logowania są niepoprawne');
        return false;
    }
    public function displayView()
    {
        global $config;
        $smarty = new Smarty();
        if (!$this->validateLoginForm()) {
            $smarty = new Smarty();
            $smarty->assign('config', $config);
            $smarty->assign('page_title', 'Strona Logowania');
            $smarty->assign('app_url', $config->app_url);
            $smarty->assign('loginForm', $this->loginForm);
            $smarty->assign('errors', $this->errors);
            $smarty->display($config->root_path . '/app/auth/login_view.tpl');
        } else {
            header('Location: ' . $config->app_url);
        }
    }
    public function process()
    {
        $this->getLoginParameters();
        $this->displayView();
    }
}
