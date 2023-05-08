<?php

namespace app\controllers;

class ResultsCtrl
{
    private $results;
    function __construct()
    {
        $this->results = getDatabase()->select('results', ['result', 'username', 'created_at']);
    }
    public function action_showResults()
    {
        getSmarty()->assign('user', unserialize(getFromSession('user')));
        getSmarty()->assign('results', array_filter($this->results, function ($r) {
            return $r['username'] ==  unserialize(getFromSession('user'))->login;
        }));
        getSmarty()->display('results.view.tpl');
    }
}
