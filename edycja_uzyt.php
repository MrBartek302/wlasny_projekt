<?php
$host = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "Aaawlasny_projekt_BS";
$conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
if (!$conn) {
    die("Nie połaczono z bazą danych" . mysqli_connect_error());
}
if (isset($_POST['zmienupr'])) {
    $id_uzytkownika = $_POST['userID'];
    $upr_zmian = $_POST['change_upr'];

    $sql_sprawdz_upr = "SELECT `nazwa_upr` FROM `uprawnienia` WHERE `nazwa_upr`='$upr_zmian'";
    $result_sprawdz_upr = $conn->query($sql_sprawdz_upr);
    if ($result_sprawdz_upr->num_rows > 0) {
        $sql_zmien_upr = "UPDATE `uzytkownicy` SET `upr`='$upr_zmian' WHERE `ID`='$id_uzytkownika'";
        $result_zmien_upr = $conn->query($sql_zmien_upr);
        if ($result_zmien_upr) {
            echo "<script>alert('Poprawnie zmieniono uprawnienie użytkownika!'); window.location.href = 'admin.php';</script>";
        } else {
            echo "";
        }
    } else {
        echo "<script>alert('Podane uprawnienie nie istnieje!'); window.location.href = 'admin.php';</script>";
    }
} elseif (isset($_POST['usunuzytadm'])) {
    $idusun = $_POST['wartoscIDuzyt'];
    $sql_usun = "DELETE FROM `uzytkownicy` WHERE `ID` = $idusun";
    $result = $conn->query($sql_usun);
    if ($result) {
        echo "<script>alert('Poprawnie usunięto użytkownika!'); window.location.href = 'admin.php';</script>";
        exit();
    } else {
        echo "";
    }
} elseif (isset($_POST['usunupradm'])) {
    $id_uzytkownika = $_POST['userID2'];

    $sql_zmien_upr = "UPDATE `uzytkownicy` SET `upr` = 'viewer' WHERE `ID`='$id_uzytkownika'";
    $result_zmien_upr = $conn->query($sql_zmien_upr);
    if ($result_zmien_upr) {
        echo "<script>alert('Poprawnie usunięto uprawnienie użytkownikowi!'); window.location.href = 'admin.php';</script>";
        exit();
    } else {
        echo "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="ogol">
        <div id="menu">
            <ul class="button-list">
                <li><a href="./admin.php" class="button">Strona Główna</a></li>
            </ul>
        </div>
        <div id="tresc">
            <?php
            $nazwa_uzyt = $_POST['uuzyt'];
            $sql_wyswietl_uzyt = "SELECT * FROM `uzytkownicy` WHERE `login`='$nazwa_uzyt'";
            $result_wyswietl_uzyt = $conn->query($sql_wyswietl_uzyt);
            if ($result_wyswietl_uzyt->num_rows > 0) {
                while ($row = $result_wyswietl_uzyt->fetch_assoc()) {
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
                    echo "<select name='change_upr' class='input'>";
                    $sql1 = "SELECT * FROM `uprawnienia` WHERE 1";
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        while ($row1 = $result1->fetch_assoc()) {
                            echo "<option value='" . $row1['nazwa_upr'] . "'>" . $row1['nazwa_upr'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "<option value=''>Brak kandydatów</option>";
                    }
                    echo "<input type='hidden' name='userID' value='" . $row['ID'] . "'>";
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
                echo "Wyszukany user nie istnieje!";
            }

            ?>
        </div>
    </div>
</body>

</html>