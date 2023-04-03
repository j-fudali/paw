<?php
require_once dirname(__FILE__).'/../../config.php';
require_once _ROOT_PATH.'/lib/smarty/libs/Smarty.class.php';

function getLoginParameters(&$loginForm){
    $loginForm['login'] = isset($_REQUEST['login']) ? $_REQUEST['login'] : null;
    $loginForm['password'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
}

function validateLoginForm(&$loginForm, &$errors){
    if(!(isset($loginForm['login']) && isset($loginForm['password']))){
        return false;
    }

    if($loginForm['login'] == ''){
        $errors [] = 'Nie podano loginu';
    }
    if($loginForm['password'] == ''){
        $errors [] = 'Nie podano hasła';
    }

    if(count($errors) > 0) return false;
    if($loginForm['login'] == 'admin' && $loginForm['password'] == 'admin'){
        session_start();
        $_SESSION['role'] = 'admin';
        return true;
    }
    if($loginForm['login'] == 'user' && $loginForm['password'] == 'user'){
        session_start();
        $_SESSION['role'] = 'user';
        return true;
    }

    $errors [] = 'Dane logowania są niepoprawne';
    return false;
}

$loginForm = array();
$errors = array();

getLoginParameters($loginForm);

$smarty = new Smarty();
if(!validateLoginForm($loginForm, $errors)){
    $smarty = new Smarty();
    $smarty->assign('page_title', 'Strona Logowania');
    $smarty->assign('app_url', _APP_URL);
    $smarty->assign('loginForm', $loginForm);
    $smarty->assign('errors', $errors);
    $smarty->display(_ROOT_PATH.'/app/auth/login_view.tpl');
}
else{
    header('Location: '._APP_URL);
}
