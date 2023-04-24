<?php
require_once 'init.php';

switch ($action) {
    case 'login':
        $ctrl = new app\controllers\LoginCtrl();
        $ctrl->process();
        break;
    case 'calculate':
        include_once $config->root_path . '/app/auth/auth_guard.php';
        $ctrl = new app\controllers\CreditCalcCtrl();
        $ctrl->process();
        break;
    case 'protected_page':
        include_once $config->root_path . '/app/auth/auth_guard.php';
        $ctrl = new app\controllers\AnotherProtectedPageCtrl();
        $ctrl->displayView();
        break;
    case 'logout':
        include $config->root_path . '/app/auth/logout.php';
        break;
    default:
        include_once $config->root_path . '/app/auth/auth_guard.php';
        $ctrl = new app\controllers\CreditCalcCtrl();
        $ctrl->displayView();
}
