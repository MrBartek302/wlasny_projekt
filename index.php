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
                $sql = "SELECT `ID`, `nazwa_wyd`, `opis_wyd`, `data_wyd` FROM `wydarzenia` ORDER BY `data_wyd` ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div id = 'wydarzenie'>";

                        echo "<div id = 'divgora' style='display: flex; align-items: baseline; justify-content: center; height: 20%; width: 100%;'>";
                        echo "<h1>" .  $row['nazwa_wyd'] . "</h1>";
                        echo "</div>";

                        echo "<div id = 'divsrodek'>";
                        echo "<h2>" . "Opis: " . $row['opis_wyd'] . "</h2>";
                        echo "</div>";

                        echo "<div id = 'divdol'>";

                        echo "<div id = 'divdollewo'>";
                        echo "<h4>" . "Data wydarzenia: " . $row['data_wyd'] . "</h4>";
                        echo "</div>";

                        echo "<div id = 'divdolprawo'>";
                        $date = new DateTime($row['data_wyd']);
                        $now = new DateTime();

                        if ($date < $now) {
                            echo "<form method='POST' action=''>";
                            echo "<select name='ocena'>";
                            echo "<option value=''>--- Oceń wydarzenie ---</option>";
                            echo "<option value='1'>1</option>";
                            echo "<option value='2'>2</option>";
                            echo "<option value='3'>3</option>";
                            echo "<option value='4'>4</option>";
                            echo "<option value='5'>5</option>";
                            echo "</select>";
                            echo "<input type='hidden' name='value_wydarzenia' value='" . $row['ID'] . "'>";
                            echo "<input type='submit' name='wys_ocene' value='Wyślij!'>";
                            echo "</form>";
                            if (isset($_POST['wys_ocene'])) {
                                if ($_SESSION['zalogowany'] == false || $_SESSION['upr'] == 'viewer') {
                                    $id_wydarzenia = $_POST['value_wydarzenia'];
                                    if ($id_wydarzenia == $row['ID']) {
                                        echo "<script>alert('Nie możesz wybrać tej opcji, nie jesteś zalogowany')</script>";
                                    }
                                } else {
                                    $ocena = $_POST['ocena'];
                                    $id_wydarzenia1 = $_POST['value_wydarzenia'];

                                    if (!empty($ocena) && $id_wydarzenia1 == $row['ID']) {
                                        $sql = "INSERT INTO `oceny`(`ID_wydarzenia`, `wystawiona_ocena`) VALUES ('$id_wydarzenia1','$ocena')";

                                        if ($conn->query($sql) === TRUE) {
                                            header("Location: ./index.php");
                                            exit();
                                        } else {
                                            echo $conn->error;
                                        }
                                    } else {
                                        if ($id_wydarzenia1 == $row['ID']) {
                                            echo "<script>alert('Nie wybrano oceny')</script>";
                                        }
                                    }
                                }
                            }
                        } else {
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' name='nazwa_wydarzenia' value='" . $row['nazwa_wyd'] . "'>";
                            echo "<input type='submit' name='zainteres' id='zainteresbutton' value='Zainteresowany!'>";
                            echo "</form>";
                        }
                        echo "</div>";

                        echo "</div>";

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