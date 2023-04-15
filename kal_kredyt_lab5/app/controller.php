<?php

require_once dirname(__FILE__) . '/../config.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

switch ($action) {
    case 'login':
        include_once $config->root_path . '/app/auth/LoginCtrl.class.php';
        $ctrl = new LoginCtrl();
        $ctrl->process();
        break;
    case 'calculate':
        include_once $config->root_path . '/app/credit_calculator/CreditCalcCtrl.class.php';
        $ctrl = new CreditCalcCtrl();
        $ctrl->process();
        break;
    case 'protected_page':
        include_once $config->root_path . '/app/protected_page/AnotherProtectedPage.class.php';
        $ctrl = new AnotherProtectedPage();
        $ctrl->displayView();
        break;
    case 'logout':
        include $config->root_path . '/app/auth/logout.php';
        break;
    default:
        include_once $config->root_path . '/app/credit_calculator/CreditCalcCtrl.class.php';
        $ctrl = new CreditCalcCtrl();
        $ctrl->displayView();
}
