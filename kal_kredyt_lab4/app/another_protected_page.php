<?php 
require_once dirname(__FILE__).'/../config.php';
include _ROOT_PATH.'../app/auth/auth_guard.php';
require_once _ROOT_PATH.'/lib/smarty/libs/Smarty.class.php';

$smarty = new Smarty();
$smarty->assign('app_url', _APP_URL);
$smarty->assign('page_title', 'Blokowana podstrona');
$smarty->display(_ROOT_PATH.'/app/another_protected_page.tpl');
?>