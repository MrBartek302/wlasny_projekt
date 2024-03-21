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
                <h1>Strona Główna dla Admina i pracownika</h1>
            </div>
            <div id="menlewo">
                <?php
                include 'menuadmin.php';
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
            <div id="trescogol">
                <div id="trescogolgora">
                    <h1>Utwórz wydarzenie: </h1>
                    <form action="" method="POST">
                        <input type="text" name="tytul" placeholder="Nazwa Wydarzenia" style="text-align: center;">
                        <input type="text" name="opis" placeholder="Opis Wydarzenia" style="text-align: center;">
                        <input type="date" name="data" placeholder="Data Wydarzenia">
                        <input type="submit" name="wyss">
                        <?php
                        if (isset($_POST['wyss'])) {
                            if (empty($_POST['tytul']) || empty($_POST['opis']) || empty($_POST['data'])) {
                                echo "<script>alert('Nie uzupełniłeś danych o wydarzeniu')</script>";
                            } else {
                                $host = "localhost";
                                $dbuser = "root";
                                $dbpassword = "";
                                $dbname = "Aaawlasny_projekt_BS";
                                $tytul = $_POST['tytul'];
                                $opis = $_POST['opis'];
                                $data = $_POST['data'];
                                $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                                if (!$conn) {
                                    die("Nie połaczono z baza danych" . mysqli_connect_error());
                                }
                                $sql = "INSERT INTO `wydarzenia`(`nazwa_wyd`, `opis_wyd`, `data_wyd`) VALUES ('$tytul','$opis','$data')";
                                $result = $conn->query($sql);
                                if ($result) {
                                    header("Location: ./indexadminiuzytkownik.php");
                                    exit();
                                } else {
                                    echo "";
                                }
                            }
                        } else {
                            echo "";
                        }
                        ?>
                    </form>
                </div>
                <div id="trescogoldol">
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

                            echo "<div id = 'divgora'>";

                            echo "<div id = 'divgoralewo'>";
                            echo "<h3>" . "ID: " .  $row['ID'] . "</h3>";
                            echo "</div>";

                            echo "<div id = 'divgoraprawo'>";
                            echo "<h1>" . "Nazwa: " .  $row['nazwa_wyd'] . "</h1>";
                            echo "</div>";


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
                            echo "<input type='submit' name='usun' id='usunbutton' value='Usuń!'>";
                            echo "</form>";

                            echo "</div>";

                            echo "</div>";

                            echo "</div>";
                        }
                    } else {
                        echo "";
                    }
                    $conn->close();
                    ?>dfs

                    <?php
                    $host = "localhost";
                    $dbuser = "root";
                    $dbpassword = "";
                    $dbname = "Aaawlasny_projekt_BS";
                    $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

                    if (!$conn) {
                        die("Nie połączono z bazą danych" . mysqli_connect_error());
                    }

                    if (isset($_POST['usun'])) {
                        $idusun = $_POST['wartoscID'];
                        $sql_usun = "DELETE FROM `wydarzenia` WHERE `ID` = $idusun";
                        $result = $conn->query($sql_usun);
                        if ($result) {
                            header("Location: ./indexadminiuzytkownik.php");
                        } else {
                            echo "wystąpił błąd!";
                        }
                    }
                    $conn->close();
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>

</html>