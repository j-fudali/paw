<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php print(_APP_URL)?>/app/credit_calc.php" method="post">
        <label for="kwota">Kwota pożyczki: </label>
        <input type="text" name="kwota" id="kwota" value="<?php if(isset($kwota)) print($kwota) ?>">
        <label for="lata">Lata: </label>
        <input type="text" name="lata" id="lata" value="<?php if(isset($lata)) print($lata) ?>">
        <label for="procent">Oprocentowanie: </label>
        <input type="text" name="procent" id="procent" value="<?php if(isset($procent)) print($procent) ?>">
        <input type="submit" value="Wyślij">
    </form>
    <?php 
        if(isset($errors)){
            print("<ul style='list-style: none; background-color: red;'>");
            foreach ($errors as $err){
                print("<li >$err</li>");
            }
            print("</ul>");
        }
    ?>
    <?php if(isset($wynik)){?>
        <h3>Miesięczna rata: <?php print($wynik)?></h3>
    <?php }?>
</body>
</html>