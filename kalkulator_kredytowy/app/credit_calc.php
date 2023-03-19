<?php 
    require_once dirname(__FILE__)."/../config.php";
    $kwota = $_REQUEST['kwota'];
    $lata = $_REQUEST['lata'];
    $procent = $_REQUEST['procent'];
    if(!(isset($kwota) && isset($lata) && isset($procent))){
        $errors [] = "Brak jednego z parametrów!";
    }
    if(empty($errors)){
        if($kwota == ""){
            $errors [] = "Nie podano kwoty!";
        }
        if($lata == ""){
            $errors [] = "Nie podano lat!";
        }
        if($procent == ""){
            $errors [] = "Nie podano oprocentowania!";
        }
    }
    if(empty($errors)){
        if(!is_numeric($kwota)){
            $errors [] = "Kwota nie jest liczbą!";
        }
        if(!is_numeric(($lata))){
            $errors [] = "Lata nie są liczbą!";
        }
        if(!is_numeric(($procent))){
            $errors [] = "Oprocentowanie nie jest liczbą";
        }
    }
    if(empty($errors)){
        $kwota = intval($kwota);
        $lata = intval($lata);
        $procent = floatval($procent);
        if(!($kwota > 0)){
            $errors [] = "Kwota musi być większa od 0";
        }
        if(!($lata > 0)){
            $errors [] = "Lata muszą być większe od 0";
        }
        if(!($procent >= 0)){
            $errors [] = "Oprocentowanie musi być większe lub równe od 0";
        }
    }
    if(empty($errors)){
        $obliczenie = $kwota /  ($lata*12);
        $wynik = number_format(($obliczenie + ($kwota * ($procent/100))), 2, '.', '');
    }

include 'credit_calc_view.php';
?>