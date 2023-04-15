<?php
require_once $config->root_path . '/lib/smarty/libs/Smarty.class.php';
include $config->root_path . '/app/auth/auth_guard.php';
require_once 'CreditCalcForm.class.php';
require_once $config->root_path . '/lib/Errors.class.php';

class CreditCalcCtrl
{
    private $calc_form;
    private $errors;
    private $result;
    function __construct()
    {
        $this->calc_form = new CreditCalcForm();
        $this->errors = new Errors();
        $this->result = null;
    }
    private function getCalcParams()
    {
        $this->calc_form->kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
        $this->calc_form->lata = isset($_REQUEST['lata']) ? $_REQUEST['lata'] : null;
        $this->calc_form->procent = isset($_REQUEST['procent']) ? $_REQUEST['procent'] : null;
    }
    private function validateCalcForm()
    {
        if (!(isset($this->calc_form->kwota) && isset($this->calc_form->lata) && isset($this->calc_form->procent))) {
            return false;
        }
        if ($this->calc_form->kwota == "") {
            $this->errors->addError("Nie podano kwoty!");
        }
        if ($this->calc_form->lata == "") {
            $this->errors->addError("Nie podano lat!");
        }
        if ($this->calc_form->procent == "") {
            $this->errors->addError("Nie podano oprocentowania!");
        }
        if (!$this->errors->isEmpty()) return false;

        if (!is_numeric($this->calc_form->kwota)) {
            $this->errors->addError("Kwota nie jest liczbą!");
        }
        if (!is_numeric(($this->calc_form->lata))) {
            $this->errors->addError("Lata nie są liczbą!");
        }
        if (!is_numeric(($this->calc_form->procent))) {
            $this->errors->addError("Oprocentowanie nie jest liczbą");
        }

        if (!$this->errors->isEmpty()) return false;
        $this->calc_form->kwota = intval($this->calc_form->kwota);
        $this->calc_form->lata = intval($this->calc_form->lata);
        $this->calc_form->procent = floatval($this->calc_form->procent);
        if (!($this->calc_form->kwota > 0)) {
            $this->errors->addError("Kwota musi być większa od 0");
        }
        if (!($this->calc_form->lata > 0)) {
            $this->errors->addError("Lata muszą być większe od 0");
        }
        if (!($this->calc_form->procent >= 0)) {
            $this->errors->addError("Oprocentowanie musi być większe lub równe od 0");
        }
        if (!$this->errors->isEmpty()) return false;
        return true;
    }
    public function displayView()
    {
        global $role;
        global $config;
        $smarty = new Smarty();
        $smarty->assign('config', $config);
        $smarty->assign('page_title', 'Kalkulator kredytowy');
        $smarty->assign('is_logged_in', $role);
        $smarty->assign('app_url', $config->app_url);
        $smarty->assign('calc_form', $this->calc_form);
        $smarty->assign('errors', $this->errors);
        $smarty->assign('result', $this->result);
        $smarty->display($config->root_path . '/app/credit_calculator/credit_calc_view.tpl');
    }
    public function process()
    {
        $this->getCalcParams();
        if ($this->validateCalcForm()) {
            $this->result = $this->calc_form->kwota /  ($this->calc_form->lata * 12);
            $this->result = number_format(($this->result + ($this->calc_form->kwota * ($this->calc_form->procent / 100))), 2, '.', '');
        }
        $this->displayView();
    }
}
