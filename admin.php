<?php
// Start the session
session_start();

$host = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "Aaawlasny_projekt_BS";
$conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
if (!$conn) {
    die("Nie połączono z bazą danych" . mysqli_connect_error());
}

if (isset($_POST['zmienupr'])) {
    $id_uzytkownika = $_POST['userID'];
    $upr_zmian = $_POST['uprdozmiany'];

    $sql_sprawdz_upr = "SELECT `nazwa_upr` FROM `uprawnienia` WHERE `nazwa_upr`='$upr_zmian'";
    $result_sprawdz_upr = $conn->query($sql_sprawdz_upr);
    if ($result_sprawdz_upr->num_rows > 0) {
        $sql_zmien_upr = "UPDATE `uzytkownicy` SET `upr`='$upr_zmian' WHERE `ID`='$id_uzytkownika'";
        $result_zmien_upr = $conn->query($sql_zmien_upr);
        if ($result_zmien_upr) {
            header("Location: ./admin.php");
            exit();
        } else {
            echo "";
        }
    } else {
        echo "<script>alert('Podane uprawnienie nie istnieje!')</script>";
    }
} elseif (isset($_POST['usunuzytadm'])) {
    $idusun = $_POST['wartoscIDuzyt'];
    $sql_usun = "DELETE FROM `uzytkownicy` WHERE `ID` = $idusun";
    $result = $conn->query($sql_usun);
    if ($result) {
        header("Location: ./admin.php");
        exit();
    } else {
        echo "";
    }
} elseif (isset($_POST['usunupradm'])) {
    $id_uzytkownika = $_POST['userID2'];

    $sql_zmien_upr = "UPDATE `uzytkownicy` SET `upr` = 'viewer' WHERE `ID`='$id_uzytkownika'";
    $result_zmien_upr = $conn->query($sql_zmien_upr);
    if ($result_zmien_upr) {
        sleep(1);
        header("Location: ./admin.php");
        exit();
    } else {
        echo "";
    }
} elseif (isset($_POST['wyss1'])) {
    $login_wys = $_POST['login'];
    $pass_wys = $_POST['pass'];
    $upr_wys = $_POST['uprWYS'];
    $sql = "SELECT * FROM `uzytkownicy` WHERE `login`='$login_wys'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<script>alert('Użytkownik o podanym loginie już istnieje!')</script>";
    } else {
        $sql_sprawdz_upr = "SELECT `nazwa_upr` FROM `uprawnienia` WHERE `nazwa_upr`='$upr_wys'";
        $result_sprawdz_upr = $conn->query($sql_sprawdz_upr);
        if ($result_sprawdz_upr->num_rows > 0) {
            $sql_dodaj_uzyt = "INSERT INTO `uzytkownicy`(`login`, `pass`, `upr`) VALUES ('$login_wys','$pass_wys','$upr_wys')";
            $result_dodaj_uzyt = $conn->query($sql_dodaj_uzyt);
            if ($result_dodaj_uzyt) {
                header("Location: ./admin.php");
                exit();
            } else {
                echo "";
            }
        } else {
            echo "<script>alert('Podane uprawnienie nie istnieje!')</script>";
        }
    }
} elseif (isset($_POST['wyss2'])) {
    $nazwa_nowego_upr = $_POST['nowe_upr'];
    $sql_sprawdz_upr1 = "SELECT `nazwa_upr` FROM `uprawnienia` WHERE `nazwa_upr`='$nazwa_nowego_upr'";
    $result_sprawdz_upr1 = $conn->query($sql_sprawdz_upr1);
    if ($result_sprawdz_upr1->num_rows > 0) {
        echo "<script>alert('Podane uprawnienie już istnieje!')</script>";
    } else {
        $sql_dodaj_upr = "INSERT INTO `uprawnienia`(`nazwa_upr`) VALUES ('$nazwa_nowego_upr')";
        $result_dodaj_upr = $conn->query($sql_dodaj_upr);
        if ($result_dodaj_upr) {
            header("Location: ./admin.php");
            exit();
        } else {
            echo "";
        }
    }
} elseif (isset($_POST['wyss3'])) {
    $nazwa_usuwanego_upr = $_POST['upr_cancel'];
    $sql_sprawdz_upr2 = "SELECT `nazwa_upr` FROM `uprawnienia` WHERE `nazwa_upr`='$nazwa_usuwanego_upr'";
    $result_sprawdz_upr2 = $conn->query($sql_sprawdz_upr2);
    if ($result_sprawdz_upr2->num_rows > 0) {
        $sql_usun_upr = "DELETE FROM `uprawnienia` WHERE `nazwa_upr`='$nazwa_usuwanego_upr'";
        $result_usun_upr = $conn->query($sql_usun_upr);
        if ($result_usun_upr) {
            header("Location: ./admin.php");
            exit();
        } else {
            echo "";
        }
    } else {
        echo "<script>alert('Nie można usunąć uprawnienia ponieważ ono nie istnieje!')</script>";
    }
} else {
    echo "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Admina</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="ogoladm">
        <div id="lewoadm">
            <div id="lewoadmgora">
                <div id="lewoadmgoralewo">
                    <h1>Strona Admina</h1>
                </div>
                <div id="lewoadmgoraprawo">
                    <?php
                    echo '<script>';
                    echo 'const buttonImg = document.createElement("img");';
                    echo 'buttonImg.setAttribute("src", "arrow-left.png");';
                    echo 'buttonImg.classList.add("button-image");';
                    echo 'buttonImg.style.cursor = "pointer";';
                    echo 'buttonImg.addEventListener("click", function() {';
                    echo '  window.location.href = "indexadminiuzytkownik.php";';
                    echo '});';

                    echo 'document.getElementById("lewoadmgoraprawo").appendChild(buttonImg);';
                    echo '</script>';
                    ?>
                </div>
            </div>
            <div id="lewoadmdol">
                <div id="lewoadmdolgora">
                    <h1>Działania na użytkownikach:</h1>
                </div>
                <div id="lewoadmdoldol">
                    <?php
                    $sql = "SELECT `ID`, `login`, `pass`, `upr` FROM `uzytkownicy` WHERE 1";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div id='uzytadm'>";
                            echo "<div id='divgoraadm'>";
                            echo "<div id='divgoralewoadm'>";
                            echo "<h4>" . "ID: " .  $row['ID'] . "</h4>";
                            echo "</div>";
                            echo "<div id='divgoraprawoadm'>";
                            echo "<h2>" .   $row['login'] . "</h2>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div id='divsrodekadm'>";
                            echo "<h4>" . "Hasło: " . $row['pass'] . "</h4>";
                            echo "</div>";
                            echo "<div id='divdoladm'>";
                            echo "<div id='divdollewoadm'>";
                            echo "<h4>" . "Upr: " . $row['upr'] . "</h4>";
                            echo "</div>";

                            echo "<div id='divdolprawoadm'>";

                            echo "<div id='divdolprawogoraadm'>";
                            echo "<form method='POST' action=''>";
                            echo "<input type='text' class='input' name='uprdozmiany' placeholder='Upr do zmiany: ' required>";
                            echo "<input type='hidden' name='userID' value='" . $row['ID'] . "'>"; // Przekazanie ID użytkownika
                            echo "<input type='submit' class='input' name='zmienupr' value='Zmień!'>";
                            echo "</form>";
                            echo "</div>";

                            echo "<div id='divdolprawodoladm'>";
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' class='input' name='wartoscIDuzyt' value='" . $row['ID'] . "'>";
                            echo "<input type='submit' class='input1' name='usunuzytadm' value='Usuń użytkownika!'>";
                            echo "</form>";
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' class='input' name='userID2' value='" . $row['ID'] . "'>";
                            echo "<input type='submit' class='input1' name='usunupradm' value='Usuń uprawnienie!'>";
                            echo "</form>";

                            echo "</div>";

                            echo "</div>";

                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div id="srodekadm">
            <div id="srodekadmgora">
                <h1 id="napisadmin">Zainteresowania przyszłymi wydarzeniami:</h1>
                <?php
                $host = "localhost";
                $dbuser = "root";
                $dbpassword = "";
                $dbname = "Aaawlasny_projekt_BS";
                $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                if (!$conn) {
                    die("Nie połaczono z baza danych" . mysqli_connect_error());
                }
                $sql = "SELECT DISTINCT nazwa_wyd, ID FROM `wydarzenia` WHERE data_wyd>CURRENT_DATE";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {

                    echo "<table>";
                    echo "<tr id='tr1'>";
                    echo "<th>Wydarzenia</th>";
                    echo "<th>Ilość zainteresowań</th>";
                    echo "</tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr id ='tr2'>";
                        echo "<td>" . $row['nazwa_wyd'] . "</td>";

                        $id_wydarzenia = $row['ID'];
                        $sql1 = "SELECT COUNT(ID_wydarzenia) AS liczba_zainteresowan FROM `zainteresowania` WHERE ID_wydarzenia='$id_wydarzenia'";
                        $result1 = $conn->query($sql1);
                        if ($result1->num_rows > 0) {
                            while ($row = $result1->fetch_assoc()) {
                                echo "<td>" . $row['liczba_zainteresowan'] . "</td>";
                            }
                        } else {
                            echo "";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "";
                }
                $conn->close();
                ?>
            </div>
            <div id="srodekadmdol">
                <h1 id="napisadmin2">Oceny przeszłych wydarzeń:</h1>
                <?php
                $host = "localhost";
                $dbuser = "root";
                $dbpassword = "";
                $dbname = "Aaawlasny_projekt_BS";
                $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                if (!$conn) {
                    die("Nie połączono z bazą danych" . mysqli_connect_error());
                }
                $sql = "SELECT DISTINCT ID_ocenionego_wyd FROM `oceny` WHERE 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {

                    echo "<table id='tabela1'>";
                    echo "<tr id='tr11'>";
                    echo "<th>Wydarzenia</th>";
                    echo "<th>Średnia ocen dla wydarzenia</th>";
                    echo "</tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr id ='tr22'>";
                        $id_wydarzenia = $row['ID_ocenionego_wyd'];

                        $sql_name = "SELECT nazwa_wyd FROM `wydarzenia` WHERE ID='$id_wydarzenia' LIMIT 1";
                        $result_name = $conn->query($sql_name);
                        $row_name = $result_name->fetch_assoc();

                        echo "<td>" . $row_name['nazwa_wyd'] . "</td>";

                        $sql_avg = "SELECT AVG(wystawiona_ocena) AS srednia FROM `oceny` WHERE ID_ocenionego_wyd='$id_wydarzenia';";
                        $result_avg = $conn->query($sql_avg);
                        if ($result_avg->num_rows > 0) {
                            $row_avg = $result_avg->fetch_assoc();
                            echo "<td>" . round($row_avg['srednia'], 2) . "</td>";
                        } else {
                            echo "<td>Brak ocen</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Brak danych do wyświetlenia";
                }
                $conn->close();
                ?>
            </div>


        </div>
        <div id="prawoadm">
            <div id="prawoadmgora">
                <h1 style="color: green;">Dodaj Użytkownika:</h1>
                <form method="POST" action="" id="formik">
                    <input type="text" class="inputBox" name="login" placeholder="Login" required>
                    <input type="text" class="inputBox" name="pass" placeholder="Password" required>
                    <input type="text" class="inputBox" name="uprWYS" placeholder="Uprawnienie" required>
                    <input type="submit" class="inputBoxSub" name="wyss1" value="Dodaj!" required>
                </form>
            </div>
            <div id="prawoadmdol">
                <div id="prawoadmdolgora">
                    <h1 style="color: green;">Dodaj Uprawnienie:</h1>
                    <form method="POST" action="" id="formik">
                        <input type="text" class="inputBox1" name="nowe_upr" placeholder="Nazwa uprawnienia" required>
                        <input type="submit" class="inputBoxSub1" name="wyss2" value="Dodaj!" required>
                    </form>
                </div>
                <div id="prawoadmdoldol">
                    <h1 style="color: red;">Usuń Uprawnienie:</h1>
                    <form method="POST" action="" id="formik">
                        <input type="text" class="inputBox2" name="upr_cancel" placeholder="Nazwa uprawnienia" required>
                        <input type="submit" class="inputBoxSub2" name="wyss3" value="Usuń!" required>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>