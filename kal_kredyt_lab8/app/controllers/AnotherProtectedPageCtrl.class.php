<?php

namespace app\controllers;

class AnotherProtectedPageCtrl
{
    public function action_protectedPageShow()
    {
        getSmarty()->assign('page_title', 'Blokowana podstrona');
        getSmarty()->assign('user', unserialize(getFromSession('user')));
        getSmarty()->display('another_protected_page_view.tpl');
    }
}
