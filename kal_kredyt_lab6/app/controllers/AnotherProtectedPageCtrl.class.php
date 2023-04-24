<?php

namespace app\controllers;

class AnotherProtectedPageCtrl
{
    public function displayView()
    {
        getSmarty()->assign('page_title', 'Blokowana podstrona');
        getSmarty()->display('another_protected_page_view.tpl');
    }
}
