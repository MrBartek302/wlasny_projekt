<?php
// Start the session
session_start();
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
                echo $_SESSION['user'];
                ?>
            </div>
            <div id="menprawoprawo">
            </div>
        </div>
        <div id="tresc">
            <div id="trescogol" style=" align-items: baseline; justify-content: center; flex-direction: row; flex-wrap: wrap; overflow-y: auto; border-top: solid darkmagenta 3px; border-radius: 20px; width: 100%; height: 95%;">
                <?php
                $host = "localhost";
                $dbuser = "root";
                $dbpassword = "";
                $dbname = "Aaawlasny_projekt_BS";
                $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                if (!$conn) {
                    die("Nie połaczono z baza danych" . mysqli_connect_error());
                }
                $sql = "SELECT `ID`, `nazwa_wyd`, `opis_wyd`, `data_wyd` FROM `wydarzenia` WHERE 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div id='wydarzenie'>";
                        echo "<p>" . $row['ID'] . "</p>";
                        echo "<h1>" . $row['nazwa_wyd'] . "</h1>";
                        echo "<h2>" . $row['opis_wyd'] . "</h2>";
                        echo "<p>" . $row['data_wyd'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>



</body>

</html>