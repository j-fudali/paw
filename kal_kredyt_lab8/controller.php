<?php
require_once 'init.php';
getRouter()->setDefaultRoute('creditCalcShow');
getRouter()->setLoginRoute('login');

getRouter()->addRoute('login', 'LoginCtrl');
getRouter()->addRoute('logout', 'LoginCtrl', ['user', 'admin']);
getRouter()->addRoute('creditCalcShow', 'CreditCalcCtrl', ['user', 'admin']);
getRouter()->addRoute('calculate', 'CreditCalcCtrl', ['user', 'admin']);
getRouter()->addRoute('protectedPageShow', 'AnotherProtectedPageCtrl', ['user', 'admin']);
getRouter()->addRoute('showResults', 'ResultsCtrl', ['user', 'admin']);

getRouter()->go();
