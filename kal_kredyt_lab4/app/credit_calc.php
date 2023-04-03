<?php 
require_once dirname(__FILE__)."/../config.php";
include _ROOT_PATH.'/app/auth/auth_guard.php';
require_once _ROOT_PATH.'/lib/smarty/libs/Smarty.class.php';


function getCalcParams(&$calc_form){
    $calc_form['kwota'] = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
    $calc_form['lata'] = isset($_REQUEST['lata']) ? $_REQUEST['lata'] : null;
    $calc_form['procent'] = isset($_REQUEST['procent']) ? $_REQUEST['procent'] : null;
}
function validateCalcForm(&$calc_form, &$errors){
    if(!(isset($calc_form['kwota']) && isset($calc_form['lata']) && isset($calc_form['procent']))){
        return false;
    }
    if(empty($errors)){
        if($calc_form['kwota'] == ""){
            $errors [] = "Nie podano kwoty!";
        }
        if($calc_form['lata'] == ""){
            $errors [] = "Nie podano lat!";
        }
        if($calc_form['procent'] == ""){
            $errors [] = "Nie podano oprocentowania!";
        }
    }
    if(count($errors) > 0) return false;
    if(empty($errors)){
        if(!is_numeric($calc_form['kwota'])){
            $errors [] = "Kwota nie jest liczbą!";
        }
        if(!is_numeric(($calc_form['lata']))){
            $errors [] = "Lata nie są liczbą!";
        }
        if(!is_numeric(($calc_form['procent']))){
            $errors [] = "Oprocentowanie nie jest liczbą";
        }
    }
    if(count($errors) > 0) return false;
    if(empty($errors)){
        $calc_form['kwota'] = intval($calc_form['kwota']);
        $calc_form['lata'] = intval($calc_form['lata']);
        $calc_form['procent'] = floatval($calc_form['procent']);
        if(!($calc_form['kwota'] > 0)){
            $errors [] = "Kwota musi być większa od 0";
        }
        if(!($calc_form['lata'] > 0)){
            $errors [] = "Lata muszą być większe od 0";
        }
        if(!($calc_form['procent'] >= 0)){
            $errors [] = "Oprocentowanie musi być większe lub równe od 0";
        }
    }
    if(count($errors) > 0 ) return false;
    return true;
}
function process(&$calc_form, &$result){
    $result = $calc_form['kwota'] /  ($calc_form['lata']*12);
    $result = number_format(($result + ($calc_form['kwota'] * ($calc_form['procent']/100))), 2, '.', '');
}
$calc_form = array();
$errors = array();
$result = null;
getCalcParams($calc_form);
if(validateCalcForm($calc_form, $errors)){
    process($calc_form, $result);
}
$smarty = new Smarty();
$smarty->assign('page_title', 'Kalkulator kredytowy');
$smarty->assign('is_logged_in', $role);
$smarty->assign('app_url', _APP_URL);
$smarty->assign('calc_form', $calc_form);
$smarty->assign('errors', $errors);
$smarty->assign('result', $result);
$smarty->display(_ROOT_PATH.'/app/credit_calc_view.tpl');
?>
