<?php
session_start();

if (isset($_POST["wyss"])) {
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
            exit();
        } elseif ($_SESSION['upr'] == 'user' || $_SESSION['upr'] == 'viewer') {
            header('location: ./index.php');
            exit();
        }
    } else {
        $_SESSION["zalogowany"] = false;
        $_SESSION['user'] = "";
        $_SESSION['upr'] = "";
        echo "Nie zalogowano!";
    }
}
?>
<!doctype html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Logowanie</title>

    <link rel="stylesheet" href="styleLog.css">

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
            <div id="menprawo">
                <?php
                echo $_SESSION['user'];
                ?>
            </div>
            <div id="menprawoprawo">
                <?php
                echo '<script>';
                echo 'const buttonImg = document.createElement("img");';
                echo 'buttonImg.setAttribute("src", "school.png");';
                echo 'buttonImg.classList.add("button-image");';
                echo 'buttonImg.style.cursor = "pointer";';
                echo 'buttonImg.addEventListener("click", function() {';
                echo '  window.open("http://www.zs1mm.home.pl/strona/", "_blank");';
                echo '});';
                echo 'document.getElementById("menprawoprawo").appendChild(buttonImg);';
                echo '</script>';
                ?>
            </div>
        </div>
        <div class="signin">

            <div class="content">

                <h2>Sign In</h2>

                <div class="form">

                    <form method="POST" action="">
                        <input type="text" class="inputBox" name="login" placeholder="Login" required>
                        <input type="password" class="inputBox" name="pass" placeholder="Password" required>
                        <input type="submit" class="inputBox" name="wyss" value="Login" required>
                    </form>



                </div>

            </div>

        </div>

    </section> <!-- partial -->

</body>

</html>