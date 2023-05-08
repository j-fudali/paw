<?php

namespace app\controllers;

use app\forms\CreditCalcForm;

class CreditCalcCtrl
{
    private $calc_form;
    private $result;
    function __construct()
    {
        $this->calc_form = new CreditCalcForm();
        $this->result = null;
    }
    private function getCalcParams()
    {
        $this->calc_form->kwota = getFromRequest('kwota');
        $this->calc_form->lata = getFromRequest('lata');
        $this->calc_form->procent = getFromRequest('procent');
    }
    private function validateCalcForm()
    {
        if (!(isset($this->calc_form->kwota) && isset($this->calc_form->lata) && isset($this->calc_form->procent))) {
            return false;
        }
        if ($this->calc_form->kwota == "") {
            getErrors()->addError("Nie podano kwoty!");
        }
        if ($this->calc_form->lata == "") {
            getErrors()->addError("Nie podano lat!");
        }
        if ($this->calc_form->procent == "") {
            getErrors()->addError("Nie podano oprocentowania!");
        }
        if (!getErrors()->isEmpty()) return false;

        if (!is_numeric($this->calc_form->kwota)) {
            getErrors()->addError("Kwota nie jest liczbą!");
        }
        if (!is_numeric(($this->calc_form->lata))) {
            getErrors()->addError("Lata nie są liczbą!");
        }
        if (!is_numeric(($this->calc_form->procent))) {
            getErrors()->addError("Oprocentowanie nie jest liczbą");
        }

        if (!getErrors()->isEmpty()) return false;
        $this->calc_form->kwota = floatval($this->calc_form->kwota);
        $this->calc_form->lata = intval($this->calc_form->lata);
        $this->calc_form->procent = floatval($this->calc_form->procent);
        if (!($this->calc_form->kwota > 0)) {
            getErrors()->addError("Kwota musi być większa od 0");
        }
        if (!($this->calc_form->lata > 0)) {
            getErrors()->addError("Lata muszą być większe od 0");
        }
        if (!($this->calc_form->procent >= 0)) {
            getErrors()->addError("Oprocentowanie musi być większe lub równe od 0");
        }
        if (!getErrors()->isEmpty()) return false;
        return true;
    }
    public function action_creditCalcShow()
    {
        getSmarty()->assign('page_title', 'Kalkulator kredytowy');
        getSmarty()->assign('calc_form', $this->calc_form);
        getSmarty()->assign('result', $this->result);
        getSmarty()->assign('user', unserialize(getFromSession('user')));
        getSmarty()->display('credit_calc_view.tpl');
    }
    public function action_calculate()
    {
        $this->getCalcParams();
        if ($this->validateCalcForm()) {
            $this->result = $this->calc_form->kwota /  ($this->calc_form->lata * 12);
            $this->result = number_format(($this->result + ($this->calc_form->kwota * ($this->calc_form->procent / 100))), 2, '.', '');
            try {
                getDatabase()->insert('results', [
                    'result' => $this->result,
                    'username' => unserialize(getFromSession('user'))->login
                ]);
            } catch (\PDOException $ex) {
                getErrors()->addError($ex->getMessage());
            }
        }
        $this->action_creditCalcShow();
    }
}
