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
            <div id="trescogol" style=" align-items: baseline; justify-content: center; flex-direction: row; flex-wrap: wrap; overflow-y: auto; border-top: solid darkmagenta 3px; border-radius: 20px; width: 99%; height: 95%;">
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
                        echo "<div id = 'wydarzenie'>";

                        echo "<div id = 'divgora' style='display: flex; align-items: baseline; justify-content: center;'>";
                        echo "<h1>" . "Nazwa: " .  $row['nazwa_wyd'] . "</h1>";
                        echo "</div>";

                        echo "<div id = 'divsrodek'>";
                        echo "<h2>" . "Opis: " . $row['opis_wyd'] . "</h2>";
                        echo "</div>";

                        echo "<div id = 'divdol'>";

                        echo "<div id = 'divdollewo'>";
                        echo "<h4>" . "Data wydarzenia: " . $row['data_wyd'] . "</h4>";
                        echo "</div>";

                        echo "<div id = 'divdolprawo'>";
                        echo "<form method='POST' action=''>";
                        echo "<input type='hidden' name='wartoscID' value='" . $row['ID'] . "'>";
                        echo "<input type='submit' name='zainteres' id='zainteresbutton' value='Zainteresowany!'>";
                        echo "</form>";

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
                if (isset($_POST['zainteres'])) {
                    $host = "localhost";
                    $dbuser = "root";
                    $dbpassword = "";
                    $dbname = "Aaawlasny_projekt_BS";

                    $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                    if (!$conn) {
                        die("Nie połaczono z baza danych" . mysqli_connect_error());
                    }

                    if ($_SESSION['zalogowany'] == false) {
                        echo "<script>alert('Nie możesz wybrać tej opcji, nie jesteś zalogowany')</script>";
                    } else {
                        $uzytkownik = $_SESSION['user'];
                        $id_wydarz = $_POST['wartoscID'];
                        $sql = "SELECT * FROM `zainteresowania` WHERE `uzytkownik`='$uzytkownik' AND `id_wydarzenia` = '$id_wydarz'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<script>alert('Zaznaczyłeś już swoje zainteresowanie!')</script>";
                        } else {
                            $sql1 = "INSERT INTO `zainteresowania`(`uzytkownik`, `id_wydarzenia`) VALUES ('$uzytkownik','$id_wydarz')";
                            $result1 = $conn->query($sql1);
                            if ($result1) {
                                header("Location: ./index.php");
                            } else {
                                echo "";
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>