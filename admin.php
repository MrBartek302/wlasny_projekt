<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Admina</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
</body>
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
                echo '
                </script>';
                ?>
            </div>
        </div>
        <div id="lewoadmdol">
            <div id="lewoadmdolgora">
                <h1>Użytkownicy:</h1>
            </div>
            <div id="lewoadmdoldol">
                <?php
                $host = "localhost";
                $dbuser = "root";
                $dbpassword = "";
                $dbname = "Aaawlasny_projekt_BS";
                $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                if (!$conn) {
                    die("Nie połaczono z baza danych" . mysqli_connect_error());
                }
                $sql = "SELECT `ID`, `login`, `pass`, `upr` FROM `uzytkownicy` WHERE 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div id = 'uzytadm'>";
                        echo "<div id = 'divgoraadm'>";
                        echo "<div id = 'divgoralewoadm'>";
                        echo "<h4>" . "ID: " .  $row['ID'] . "</h4>";
                        echo "</div>";
                        echo "<div id = 'divgoraprawoadm'>";
                        echo "<h2>" .   $row['login'] . "</h2>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div id = 'divsrodekadm'>";
                        echo "<h4>" . "Hasło: " . $row['pass'] . "</h4>";
                        echo "</div>";
                        echo "<div id = 'divdoladm'>";
                        echo "<div id = 'divdollewoadm'>";
                        echo "<h4>" . "Upr: " . $row['upr'] . "</h4>";
                        echo "</div>";

                        echo "<div id = 'divdolprawoadm'>";

                        echo "<div id = 'divdolprawogoraadm'>";
                        echo "<form method='POST' action=''>";
                        echo "<input type='text' class='input' name='uprzmien' placeholder='Upr do zmiany: '>";
                        echo "<input type='submit' class='input' name='zmienupr' value='Zmień!'>";
                        echo "</form>";
                        echo "</div>";

                        echo "<div id = 'divdolprawodoladm'>";
                        echo "<form method='POST' action=''>";
                        echo "<input type='hidden' class='input' name='wartoscIDuzyt' value='" . $row['ID'] . "'>";
                        echo "<input type='submit' class='input1' name='usunuzytadm' value='Usuń użytkownika!'>";
                        echo "</form>";
                        echo "<form method='POST' action=''>";
                        echo "<input type='hidden' class='input' name='wartoscIDupr' value='" . $row['ID'] . "'>";
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
                $conn->close();
                ?>

                <?php
                $host = "localhost";
                $dbuser = "root";
                $dbpassword = "";
                $dbname = "Aaawlasny_projekt_BS";
                $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                if (!$conn) {
                    die("Nie połączono z bazą danych" . mysqli_connect_error());
                }
                if (isset($_POST['usunuzytadm'])) {
                    $idusun = $_POST['wartoscID'];
                    $sql_usun = "DELETE FROM `uzytkownicy` WHERE `ID` = $idusun";
                    $result = $conn->query($sql_usun);
                    if ($result) {
                        header("Location: ./admin.php");
                    } else {
                        echo "wystąpił błąd!";
                    }
                } elseif (isset($_POST['zmienupr'])) {
                    $upr_zmian = $_POST['uprdozmiany'];
                    $id_upr = $_POST['uprdozmiany'];
                    $sql_zmien_upr = "UPDATE `uprawnienia` SET `nazwa_upr`='$upr_zmian' WHERE `nazwa_upr`='$id_upr'";
                    $result = $conn->query($sql_zmien_upr);
                    if ($result) {
                        header("Location: ./admin.php");
                    } else {
                        echo "wystąpił błąd!";
                    }
                } elseif (isset($_POST['usunupradm'])) {
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <div id="srodekadm"></div>
    <div id="prawoadm"></div>
</div>

</html>