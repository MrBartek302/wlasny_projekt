<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Główna</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="ogol">
        <div id="menu">
            <div id="menlewolewo">
                <h1>Strona Główna</h1>
            </div>
            <div id="menlewo">
                <?php
                include 'menu.php';
                ?>
            </div>
            <div id="menprawo">
                <?php
                echo $_SESSION['user'];
                ?>
            </div>
            <div id="menprawoprawo">
            </div>
        </div>
        <div id="tresc">
            <div id="trescogol"></div>
        </div>
    </div>



</body>

</html>