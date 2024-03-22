<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    if (!isset($_SESSION["zalogowany"])) {
        $_SESSION["zalogowany"] = false;
    }

    if (!isset($_SESSION['user'])) {
        $_SESSION['user'] = 'viewer';
    } elseif ($_SESSION['user'] == "") {
        $_SESSION['user'] = 'viewer';
    }
    ?>
    <div id="ogol">
        <div id="menu">
            <div id="menlewolewo">
                <h1>Rejestracja</h1>
            </div>
            <div id="menlewo">
                <?php
                if ($_SESSION['user'] == 'admin' || $_SESSION['user'] == 'pracownik') {
                    include 'menuadmin.php';
                } else {
                    include 'menu.php';
                }
                ?>
            </div>
            <div id="menprawo"></div>
        </div>
        <div id="tresclog" style="display: flex; align-items:center; justify-content:center; flex-direction: row; width: 100%; height: 90vh;">
            <form method="POST" action="" style="height: 20px;">
                <input type="text" class="input" name="login" placeholder="Login">
                <input type="text" class="input" name="pass" placeholder="Hasło">
                <input type="submit" class="input" id="wyss" name="wyss" value="Zarejestruj">
            </form>
            <?php
            if (isset($_POST["wyss"])) {
                if (empty($_POST['login']) || empty($_POST['pass'])) {
                    echo "<script>alert('Nie uzupełniłeś wszystkich pozycji przy rejestracji')</script>";
                } else {
                    $login = $_POST["login"];
                    $pass = $_POST["pass"];

                    function szyfruj_haslo($pass)
                    {
                        return md5($pass);
                    }

                    $szyfrowane = szyfruj_haslo($pass);

                    $host = "localhost";
                    $dbuser = "root";
                    $dbpassword = "";
                    $dbname = "Aaawlasny_projekt_BS";

                    $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

                    if (!$conn) {
                        die("Nie połaczono z baza danych" . mysqli_connect_error());
                    }

                    $sql = "INSERT INTO `uzytkownicy`(`login`, `pass`, `upr`) VALUES ('$login','$szyfrowane', 'user')";
                    $result = $conn->query($sql);
                    if ($result) {
                        echo "<script>document.getElementById('wyss').style.backgroundColor='green'; setTimeout(function() {window.location.href='./rejestracja.php';}, 3000);</script>";
                        exit();
                    } else {
                        echo "Nie dodano!!!!";
                    }
                }
            } else {
                echo "";
            }
            ?>
        </div>
    </div>
</body>

</html>