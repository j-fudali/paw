<?php

require_once 'core/Config.class.php';
$config = new core\Config();
require_once 'config.php';

function &getConfig()
{
    global $config;
    return $config;
}

require_once 'core/Errors.class.php';
$err = new core\Errors();

function &getErrors()
{
    global $err;
    return $err;
}

$smarty = null;
function &getSmarty()
{
    global $smarty;
    if (!isset($smarty)) {
        include_once 'lib/smarty/libs/Smarty.class.php';
        $smarty = new Smarty();
        $smarty->assign('config', getConfig());
        $smarty->assign('errors', getErrors());
        $smarty->setTemplateDir(array(
            'others' => getConfig()->root_path . '/app/views',
            'main' => getConfig()->root_path . '/app/views/templates'
        ));
    }
    return $smarty;
}

require_once 'core/ClassLoader.class.php';
$classLoader = new core\ClassLoader();
function &getLoader()
{
    global $classLoader;
    return $classLoader;
}
require_once 'core/Router.class.php';
$router = new core\Router();
function &getRouter(): core\Router
{
    global $router;
    return $router;
}
require_once 'core/utilities.php';
session_start();
$config->roles = isset($_SESSION['_roles']) ? unserialize($_SESSION['_roles']) : array();


$router->setAction(getFromRequest('action'));
