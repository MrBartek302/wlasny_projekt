<?php
session_start();

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
            $row = $result->fetch_assoc();
            $_SESSION['user'] = $row['login'];
            $_SESSION['upr'] = $row['upr'];

            if ($_SESSION['upr'] == 'admin' || $_SESSION['upr'] == 'pracownik') {
                header('location: ./indexadminiuzytkownik.php');
                exit(); // Dodaj exit po header, aby zapobiec dalszemu wykonywaniu kodu
            } elseif ($_SESSION['upr'] == 'user' || $_SESSION['upr'] == 'viewer') {
                header('location: ./index.php');
                exit(); // Dodaj exit po header, aby zapobiec dalszemu wykonywaniu kodu
            }
        } else {
            $_SESSION["zalogowany"] = false;
            $_SESSION['user'] = "";
            $_SESSION['upr'] = "";
            echo "Nie zalogowano!";
        }
    }
}
?>
<!doctype html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Logowanie</title>

    <link rel="stylesheet" href="stylik.css">

</head>

<body> <!-- partial:index.partial.html -->

    <section> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span> <span></span>
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
        <div id="menu">
            <div id="menlewolewo">
                <h1>Logowanie</h1>
            </div>
            <div id="menlewo">
                <?php
                if ($_SESSION['user'] == 'admin' || $_SESSION['user'] == 'pracownik') {
                    include 'menuadmin.php';
                } elseif ($_SESSION['user'] == 'user' || $_SESSION['user'] == 'viewer') {
                    include 'menu.php';
                } else {
                    echo "";
                }
                ?>
            </div>
            <div id="menprawo"></div>
            <div id="menprawoprawo"></div>
        </div>
        <div class="signin">

            <div class="content">

                <h2>Sign In</h2>

                <div class="form">

                    <form method="POST" action="" style="height: 20px;">
                        <input type="text" class="inputBox" name="login" required> <i>Username</i>
                        <input type="text" class="inputBox" name="pass" required> <i>Password</i>
                        <input type="submit" class="inputBox" name="wyss" value="Login" required>
                    </form>



                </div>

            </div>

        </div>

    </section> <!-- partial -->

</body>

</html>