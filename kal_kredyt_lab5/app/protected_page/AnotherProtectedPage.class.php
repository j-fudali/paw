<?php
require_once $config->root_path . '/lib/smarty/libs/Smarty.class.php';
include $config->root_path . '/app/auth/auth_guard.php';
class AnotherProtectedPage
{
    public function displayView()
    {
        global $config;
        $smarty = new Smarty();
        $smarty->assign('config', $config);
        $smarty->assign('app_url', $config->app_url);
        $smarty->assign('page_title', 'Blokowana podstrona');
        $smarty->display($config->root_path . '/app/protected_page/another_protected_page_view.tpl');
    }
}
