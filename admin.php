<?php
// Start the session
session_start();


// Połączenie z bazą danych
$host = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "Aaawlasny_projekt_BS";
$conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
if (!$conn) {
    die("Nie połączono z bazą danych" . mysqli_connect_error());
}

// Kod PHP odpowiedzialny za przetwarzanie formularzy
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
                    echo 'const buttonpowrot = document.createElement("button");';
                    echo 'buttonpowrot.setAttribute("id", "buttonpowrot");';
                    echo 'buttonpowrot.textContent = "Powrót";';
                    echo 'buttonpowrot.addEventListener("click", function() {';
                    echo 'window.location.href = "indexadminiuzytkownik.php";';
                    echo '});';
                    echo 'document.getElementById("lewoadmgoraprawo").appendChild(buttonpowrot);';
                    echo '</script>';
                    ?>
                </div>
            </div>
            <div id="lewoadmdol">
                <div id="lewoadmdolgora">
                    <h1>Użytkownicy:</h1>
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
                            echo "<input type='text' class='input' name='uprdozmiany' placeholder='Upr do zmiany: '>";
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
            <?php
            $host = "localhost";
            $dbuser = "root";
            $dbpassword = "";
            $dbname = "Aaawlasny_projekt_BS";
            $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
            if (!$conn) {
                die("Nie połaczono z baza danych" . mysqli_connect_error());
            }
            $sql = "SELECT DISTINCT nazwa_wyd FROM `wydarzenia`";
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

                    $nazwa_wydarzenia = $row['nazwa_wyd'];
                    $sql1 = "SELECT COUNT(nazwa_wydarzenia) AS liczba_zainteresowan FROM `zainteresowania` WHERE nazwa_wydarzenia='$nazwa_wydarzenia'";
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
        <div id="prawoadm"></div>
    </div>
</body>

</html>