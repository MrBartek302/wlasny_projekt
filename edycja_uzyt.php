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
            $host = "localhost";
            $dbuser = "root";
            $dbpassword = "";
            $dbname = "Aaawlasny_projekt_BS";
            $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
            if (!$conn) {
                die("Nie połaczono z bazą danych" . mysqli_connect_error());
            }
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
                    echo "<input type='text' class='input' name='uprdozmiany' placeholder='Upr do zmiany: ' required>";
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
                echo "";
            }
            ?>
        </div>
    </div>
</body>

</html>