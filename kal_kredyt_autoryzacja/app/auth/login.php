<?php
require_once dirname(__FILE__).'/../../config.php';


function getLoginParameters(&$loginForm){
    $loginForm['login'] = isset($_REQUEST['login']) ? $_REQUEST['login'] : null;
    $loginForm['password'] = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;
}

function validateLoginForm(&$loginForm, &$messages){
    if(!(isset($loginForm['login']) && isset($loginForm['password']))){
        return false;
    }

    if($loginForm['login'] == ''){
        $messages [] = 'Nie podano loginu';
    }
    if($loginForm['password'] == ''){
        $messages [] = 'Nie podano hasła';
    }

    if(count($messages) > 0) return false;
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

    $messages [] = 'Dane logowania są niepoprawne';
    return false;
}

$loginForm = array();
$messages = array();

getLoginParameters($loginForm);

if(!validateLoginForm($loginForm, $messages)){
    include _ROOT_PATH.'/app/auth/login_view.php';
}
else{
    header('Location: '._APP_URL);
}
