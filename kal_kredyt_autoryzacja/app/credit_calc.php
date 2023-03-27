<?php 
    require_once dirname(__FILE__)."/../config.php";

    include _ROOT_PATH.'/app/auth/auth_guard.php';

    function getCalcParams(&$calcForm){
        $calcForm['kwota'] = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
        $calcForm['lata'] = isset($_REQUEST['lata']) ? $_REQUEST['lata'] : null;
        $calcForm['procent'] = isset($_REQUEST['procent']) ? $_REQUEST['procent'] : null;
    }
    function validateCalcForm(&$calcForm, &$errors){
        if(!(isset($calcForm['kwota']) && isset($calcForm['lata']) && isset($calcForm['procent']))){
            return false;
        }
        if(empty($errors)){
            if($calcForm['kwota'] == ""){
                $errors [] = "Nie podano kwoty!";
            }
            if($calcForm['lata'] == ""){
                $errors [] = "Nie podano lat!";
            }
            if($calcForm['procent'] == ""){
                $errors [] = "Nie podano oprocentowania!";
            }
        }
        if(count($errors) > 0) return false;
        if(empty($errors)){
            if(!is_numeric($calcForm['kwota'])){
                $errors [] = "Kwota nie jest liczbą!";
            }
            if(!is_numeric(($calcForm['lata']))){
                $errors [] = "Lata nie są liczbą!";
            }
            if(!is_numeric(($calcForm['procent']))){
                $errors [] = "Oprocentowanie nie jest liczbą";
            }
        }
        if(count($errors) > 0) return false;
        if(empty($errors)){
            $calcForm['kwota'] = intval($calcForm['kwota']);
            $calcForm['lata'] = intval($calcForm['lata']);
            $calcForm['procent'] = floatval($calcForm['procent']);
            if(!($calcForm['kwota'] > 0)){
                $errors [] = "Kwota musi być większa od 0";
            }
            if(!($calcForm['lata'] > 0)){
                $errors [] = "Lata muszą być większe od 0";
            }
            if(!($calcForm['procent'] >= 0)){
                $errors [] = "Oprocentowanie musi być większe lub równe od 0";
            }
        }
        if(count($errors) > 0 ) return false;
        return true;
    }
    function process(&$calcForm, &$result){
        $result = $calcForm['kwota'] /  ($calcForm['lata']*12);
        $result = number_format(($result + ($calcForm['kwota'] * ($calcForm['procent']/100))), 2, '.', '');
    }
    $calcForm = array();
    $errors = array();
    $result = null;
    getCalcParams($calcForm);
    if(validateCalcForm($calcForm, $errors)){
        process($calcForm, $result);
    }

include _ROOT_PATH.'/app/credit_calc_view.php';
?>