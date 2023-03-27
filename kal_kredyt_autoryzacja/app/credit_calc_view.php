<?php
    include dirname(__FILE__).'/../utility.php';
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
</head>

<body>
    <div style="height: 100vh; width: 100vw; justify-content: center; align-items: center;" class="pure-g">
        <div style="padding: 10px;" class="pure-u-1-3">
            <form class="pure-form" action="<?php print(_APP_ROOT) ?>/app/credit_calc.php" method="post">
                <fieldset class="pure-group">
                    <input placeholder="Kwota pożyczki: "  class="pure-input-1-2" type="text" name="kwota" id="kwota" value="<?php output($calcForm['kwota']) ?>">
                    <input placeholder="Lata: "  class="pure-input-1-2" type="text" name="lata" id="lata" value="<?php output($calcForm['lata']) ?>">
                    <input placeholder="Oprocentowanie: " class="pure-input-1-2" type="text" name="procent" id="procent" value="<?php output($calcForm['procent']) ?>">
                    <button class="pure-button pure-button-primary" type="submit">Wyślij</button>
                </fieldset>
            </form>
            <div class="pure-menu">
            <?php
            if (count($errors) > 0) {
                print("<ul class=\"pure-menu-list\" style='list-style: none; background-color: red;'>");
                foreach ($errors as $err) {
                    print("<li style=\"padding: 5px;\" class=\"pure-menu-item\">$err</li>");
                }
                print("</ul>");
            }
            ?>
            </div>
            <?php if (isset($result)) { ?>
                <h3>Miesięczna rata: <?php print($result) ?></h3>
            <?php } ?>
    
        </div>
        <div class="pure-menu pure-u-1-3">
            <ul class="pure-menu-list">
                <li class="pure-list-item"><a class="pure-menu-link" href="<?php print(_APP_ROOT)?>/app/another_protected_page.php">Blokowana strona</a></li>
                <li class="pure-list-item"><a class="pure-menu-link" href="<?php print(_APP_ROOT)?>/app/auth/logout.php">Wyloguj</a></li>
            </ul>
        </div >
    </div>
</body>

</html>