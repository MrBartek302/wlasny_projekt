<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="ogol">
        <div id="menu">
            <div id="menlewolewo">
                <h1>Logowanie</h1>
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
                <input type="text" name="login" placeholder="Login">
                <input type="text" name="pass" placeholder="Hasło">
                <input type="submit" name="wyss" value="Zaloguj">
            </form><br><br>

            <?php
            if (isset($_POST["wyss"])) {
                if (empty($_POST['login']) || empty($_POST['pass'])) {
                    echo "<script>alert('Nie uzupełniłeś pozycji przy logowaniu')</script>";
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

                    $sql = "SELECT `ID`, `login`, `pass`, `upr` FROM `uzytkownicy` WHERE login='$login' AND pass='$szyfrowane'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $_SESSION['zalogowany'] = true;
                        //tutaj bez while bo wiemy że jest jeden rekord
                        $row = $result->fetch_assoc();

                        $_SESSION['user'] = $row['login'];

                        $_SESSION['upr'] = $row['upr'];

                        //przenosi do wybranej strony
                        if ($_SESSION['upr'] == 'admin' || $_SESSION['upr'] == 'pracownik') {
                            header('location: ./indexadminiuzytkownik.php');
                        } elseif ($_SESSION['upr'] == 'user') {
                            header('location: ./index.php');
                        }
                    } else {
                        $_SESSION["zalogowany"] = false;

                        $_SESSION['user'] = "";

                        $_SESSION['upr'] = "";

                        echo "Nie zalogowano!";
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