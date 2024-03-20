<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona</title>
</head>

<body>
    <?php
    include 'menu.php';
    ?>

    <?php
    $_SESSION['zalogowany'] = false;
    $_SESSION['user'] = "";
    $_SESSION['upr'] = "";
    echo "wylogowano";
    echo $_SESSION["kolorek"];
    header('location: ./index.php');
    sleep(1);
    ?>


</body>

</html>