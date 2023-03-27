<?php require_once dirname(__FILE__).'/../config.php';
    include _ROOT_PATH.'../app/auth/auth_guard.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">

</head>
<body>
    <h2 style="margin: 10px;">Kolejna blokowana strona</h2>
    <di style="margin: 10px;" class="pure-menu pure-u-1-4">
        <ul class="pure-menu-list">
            <li class="pure-list-item"><a class="pure-menu-link" href="<?php print(_APP_ROOT)?>/app/credit_calc.php">Kalkulator kredytowy</a></li>
            <li class="pure-list-item"><a class="pure-menu-link" href="<?php print(_APP_ROOT)?>/app/auth/logout.php">Wyloguj</a></li>
        </ul>
    </di>
</body>
</html>