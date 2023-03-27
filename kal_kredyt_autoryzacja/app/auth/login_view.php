<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
</head>
<body>
    <form style="padding: 10px;" class="pure-form pure-g" action="<?php print(_APP_ROOT)?>/app/auth/login.php">
    <fieldset class="pure-group">
        <label for="password">Login</label>
        <input type="text" id="login" name="login">
        <label for="password">Password</label> 
        <input type="password" id="password" name="password">
        <button type="submit" class="pure-button pure-button-primary">Zaloguj się!</button>
    </fieldset>
    </form>
    <div class="pure-menu">
            <?php
            if (count($messages) > 0) {
                print("<ul class=\"pure-menu-list pure-u-1-4\" style='list-style: none; background-color: red; padding: 10px;'>");
                foreach ($messages as $mess) {
                    print("<li style=\"padding: 5px;\" class=\"pure-menu-item\">$mess</li>");
                }
                print("</ul>");
            }
            ?>
    </div>
</body>
</html>