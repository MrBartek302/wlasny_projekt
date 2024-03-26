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

if (isset($_POST['zainteres'])) {
    if ($_SESSION['zalogowany'] == false || $_SESSION['upr'] == 'viewer') {
        echo "<script>alert('Nie możesz wybrać tej opcji, nie jesteś zalogowany')</script>";
    } else {
        $uzytkownik = $_SESSION['user'];
        $nazwa_wydarzenia = $_POST['nazwa_wydarzenia'];
        $sql = "SELECT * FROM `zainteresowania` WHERE `uzytkownik`='$uzytkownik' AND `nazwa_wydarzenia` = '$nazwa_wydarzenia'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<script>alert('Zaznaczyłeś już swoje zainteresowanie!')</script>";
        } else {
            $sql1 = "INSERT INTO `zainteresowania`(`uzytkownik`, `nazwa_wydarzenia`) VALUES ('$uzytkownik','$nazwa_wydarzenia')";
            $result1 = $conn->query($sql1);
            if ($result1) {
                header("Location: ./index.php");
                exit();
            } else {
                echo "";
            }
        }
    }
} elseif (isset($_POST['usun_zainteres'])) {
    if ($_SESSION['zalogowany'] == false || $_SESSION['upr'] == 'viewer') {
        echo "<script>alert('Nie możesz wybrać tej opcji, nie jesteś zalogowany!')</script>";
    } else {
        $uzytkownik1 = $_SESSION['user'];
        $nazwa_wydarzenia1 = $_POST['nazwa_wydarzenia'];
        $sql = "SELECT * FROM `zainteresowania` WHERE `uzytkownik`='$uzytkownik1' AND `nazwa_wydarzenia` = '$nazwa_wydarzenia1'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $sql1 = "DELETE FROM `zainteresowania` WHERE `uzytkownik`='$uzytkownik1' AND `nazwa_wydarzenia` = '$nazwa_wydarzenia1'";
            $result1 = $conn->query($sql1);
            if ($result1) {
                header("Location: ./index.php");
                exit();
            } else {
                echo "";
            }
        } else {
            echo "<script>alert('Nie zaznaczyłeś zainteresowania, nie ma czego usunąć!')</script>";
        }
    }
} elseif (isset($_POST['wyslij_ocene'])) {
    if ($_SESSION['zalogowany'] == false || $_SESSION['upr'] == 'viewer') {
        echo "<script>alert('Nie możesz ocenić, nie jesteś zalogowany!')</script>";
    } else {
        $uzytkownik2 = $_SESSION['user'];
        $nazwa_wydarzenia2 = $_POST['name_wyd'];
        $sql2 = "SELECT * FROM `oceny` WHERE `uzytkownik_wystawiajacy`='$uzytkownik2' AND `nazwa_ocenianego_wyd`='$nazwa_wydarzenia2'";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            echo "<script>alert('Wystawiłeś już swoją ocenę!')</script>";
        } else {
            $ocena = $_POST['ocena_wyd'];
            $sql3 = "INSERT INTO `oceny`(`uzytkownik_wystawiajacy`, `nazwa_ocenianego_wyd`, `wystawiona_ocena`) VALUES ('$uzytkownik2','$nazwa_wydarzenia2','$ocena')";
            $result3 = $conn->query($sql3);
            if ($result3) {
                header("Location: ./index.php");
                exit();
            } else {
                echo "";
            }
        }
    }
} elseif (isset($_POST['usun_ocene'])) {
    if ($_SESSION['zalogowany'] == false || $_SESSION['upr'] == 'viewer') {
        echo "<script>alert('Nie możesz usunąć oceny, nie jesteś zalogowany!')</script>";
    } else {
        $uzytkownik3 = $_SESSION['user'];
        $nazwa_wydarzenia4 = $_POST['name_wyd'];
        $sql4 = "SELECT * FROM `oceny` WHERE `uzytkownik_wystawiajacy`='$uzytkownik3' AND `nazwa_ocenianego_wyd`='$nazwa_wydarzenia4'";
        $result4 = $conn->query($sql4);
        if ($result4->num_rows > 0) {
            $sql5 = "DELETE FROM `oceny` WHERE `uzytkownik_wystawiajacy`='$uzytkownik3' AND `nazwa_ocenianego_wyd`='$nazwa_wydarzenia4'";
            $result5 = $conn->query($sql5);
            if ($result5) {
                header("Location: ./index.php");
                exit();
            } else {
                echo "";
            }
        } else {
            echo "<script>alert('Nie wystawiłeś żadnej oceny, nie ma co usunąć!')</script>";
        }
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
    <title>Strona Główna</title>
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
                <h1>Strona Główna</h1>
            </div>
            <div id="menlewo">
                <?php
                include 'menu.php';
                ?>
            </div>
            <div id="menprawo">
                <?php
                if (isset($_SESSION['user'])) {
                    echo $_SESSION['user'];
                } else {
                    echo "";
                }
                ?>
            </div>
            <div id="menprawoprawo">
            </div>
        </div>
        <div id="tresc">
            <div id="trescogol" style="display: flex; align-items: baseline; justify-content: center; flex-direction: row; flex-wrap: wrap; overflow-y: auto; border-top: solid darkmagenta 3px; border-radius: 20px; width: 99%; height: 95%; /* Ustaw maksymalną wysokość */">
                <?php
                $host = "localhost";
                $dbuser = "root";
                $dbpassword = "";
                $dbname = "Aaawlasny_projekt_BS";
                $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                if (!$conn) {
                    die("Nie połaczono z baza danych" . mysqli_connect_error());
                }

                $przeszlo_juz = false;

                $sql = "SELECT `ID`, `nazwa_wyd`, `opis_wyd`, `data_wyd` FROM `wydarzenia` ORDER BY `data_wyd` ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div id = 'wydarzenie'>";

                        echo "<div id = 'divgora' style='display: flex; align-items: baseline; justify-content: center; height: 20%; width: 100%;'>";
                        echo "<h2 id='nazwa_wyd'>" .  $row['nazwa_wyd'] . "</h2>";
                        echo "</div>";

                        echo "<div id = 'divsrodek'>";
                        echo "<h2>" . "Opis: " . $row['opis_wyd'] . "</h2>";
                        echo "</div>";

                        echo "<div id = 'divdol'>";

                        echo "<div id = 'divdollewo'>";

                        echo "<div id = 'divdollewolewo'>";
                        $date = new DateTime($row['data_wyd']);
                        $now = new DateTime();
                        if ($date >= $now) {
                            echo "<h3 id ='dobre'>Upcoming</h3>";
                        } else {
                            echo "<h3 id ='zle'>Done</h3>";
                        }
                        echo "</div>";

                        echo "<div id = 'divdollewoprawo'>";
                        echo "<h4>" . "Data wydarzenia: " . $row['data_wyd'] . "</h4>";
                        echo "</div>";

                        echo "</div>";

                        echo "<div id = 'divdolprawo'>";
                        $date = new DateTime($row['data_wyd']);
                        $now = new DateTime();

                        if ($date < $now) {
                            echo "<div id = 'divdolprawogora'>";
                            echo "<form method='POST' action=''>";
                            echo "<select name='ocena_wyd' required>";
                            echo "<option value =''>-- Wystaw ocenę --</option>";
                            echo "<option value ='1'>1</option>";
                            echo "<option value ='2'>2</option>";
                            echo "<option value ='3'>3</option>";
                            echo "<option value ='4'>4</option>";
                            echo "<option value ='5'>5</option>";
                            echo "</select>";
                            echo "<input type='hidden' name='name_wyd' value='" . $row['nazwa_wyd'] . "'>";
                            echo "<input type='submit' name='wyslij_ocene' id='wys_ocen' value='Wyślij!'>";
                            echo "</form>";
                            echo "</div>";

                            echo "<div id = 'divdolprawodol'>";
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' name='name_wyd' value='" . $row['nazwa_wyd'] . "'>";
                            echo "<input type='submit' name='usun_ocene' id='usun_zainteresbutton' value='Usuń Ocenę!'>";
                            echo "</form>";
                            echo "</div>";
                        } else {
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' name='nazwa_wydarzenia' value='" . $row['nazwa_wyd'] . "'>";
                            echo "<input type='submit' name='zainteres' id='zainteresbutton' value='Zainteresowany!'>";
                            echo "</form>";

                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' name='nazwa_wydarzenia' value='" . $row['nazwa_wyd'] . "'>";
                            echo "<input type='submit' name='usun_zainteres' id='usun_zainteresbutton' value='Usuń Zainteresowanie!'>";
                            echo "</form>";
                        }
                        echo "</div>";

                        echo "</div>";

                        echo "</div>";
                    }
                } else {
                    echo "<h1>Brak wydarzeń</h1>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>

</body>

</html>