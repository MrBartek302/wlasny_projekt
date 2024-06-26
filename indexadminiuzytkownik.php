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
                if (isset($_SESSION['user'])) {
                    echo $_SESSION['user'];
                } else {
                    echo "";
                }
                ?>
            </div>
            <div id="menprawoprawo">
                <?php
                if ($_SESSION['upr'] === 'admin') {
                    echo '<script>';
                    echo 'const buttonImg = document.createElement("img");';
                    echo 'buttonImg.setAttribute("src", "admin.png");';
                    echo 'buttonImg.classList.add("button-image");';
                    echo 'buttonImg.style.cursor = "pointer";';
                    echo 'buttonImg.addEventListener("click", function() {';
                    echo '  window.location.href = "admin.php";';
                    echo '});';

                    echo 'document.getElementById("menprawoprawo").appendChild(buttonImg);';
                    echo '</script>';
                } elseif ($_SESSION['upr'] === 'pracownik') {
                    echo '<script>';
                    echo 'const buttonImg = document.createElement("img");';
                    echo 'buttonImg.setAttribute("src", "school.png");';
                    echo 'buttonImg.classList.add("button-image");';
                    echo 'buttonImg.style.cursor = "pointer";';
                    echo 'buttonImg.addEventListener("click", function() {';
                    echo '  window.open("http://www.zs1mm.home.pl/strona/", "_blank");';
                    echo '});';
                    echo 'document.getElementById("menprawoprawo").appendChild(buttonImg);';
                    echo '</script>';
                } else {
                    echo "";
                }
                ?>
            </div>
        </div>
        <div id="tresc">
            <div id="trescogol">
                <div id="trescogolgora">
                    <div id="trescogolgoralewo">
                        <h1>Utwórz wydarzenie: </h1>
                        <form action="" method="POST">
                            <input type="text" class="input" name="tytul" placeholder="Nazwa Wydarzenia" style="text-align: center;" required>
                            <input type="text" class="input" name="opis" placeholder="Opis Wydarzenia" style="text-align: center;" required>
                            <input type="date" class="input" name="data" placeholder="Data Wydarzenia" required>
                            <input type="submit" class="input" name="wyss" value="Utwórz!">
                            <?php
                            if (isset($_POST['wyss'])) {
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
                                    echo "<script>alert('Poprawnie dodano wydarzenie!'); window.location.href = 'indexadminiuzytkownik.php';</script>";
                                    exit();
                                } else {
                                    echo "";
                                }
                            } else {
                                echo "";
                            }
                            ?>
                        </form>
                    </div>
                    <div id="trescogolgoraprawo">
                        <h1>Edytuj wydarzenie: </h1>
                        <form action="edycja.php" method="POST">
                            <?php
                            $host = "localhost";
                            $dbuser = "root";
                            $dbpassword = "";
                            $dbname = "Aaawlasny_projekt_BS";
                            $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                            if (!$conn) {
                                die("Nie połaczono z bazą danych" . mysqli_connect_error());
                            }
                            echo "<select name='edyt' class='input'>";
                            $sql = "SELECT * FROM `wydarzenia` WHERE 1";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['ID'] . "'>" . $row['nazwa_wyd'] . "</option>";
                                }
                                echo "</select>";
                                echo '<input type="submit" class="input" name="submit" value="Edytuj!">';
                            } else {
                                echo "<option value=''>Brak kandydatów</option>";
                            }
                            $conn->close();
                            ?>
                        </form>
                    </div>

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
                    $sql = "SELECT `ID`, `nazwa_wyd`, `opis_wyd`, `data_wyd` FROM `wydarzenia`ORDER BY `data_wyd` ASC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div id = 'wydarzenie'>";
                            echo "<div id = 'divgora'>";
                            echo "<div id = 'divgoralewo'>";
                            echo "<h3>" . "ID: " .  $row['ID'] . "</h3>";
                            echo "</div>";
                            echo "<div id = 'divgoraprawo'>";
                            echo "<h2 id='nazwa_wyd'>" .   $row['nazwa_wyd'] . "</h2>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div id = 'divsrodek'>";
                            echo "<h2>" . "Opis: " . $row['opis_wyd'] . "</h2>";
                            echo "</div>";
                            echo "<div id = 'divdol'>";
                            echo "<div id = 'divdollewolewo'>";
                            $date = new DateTime($row['data_wyd']);
                            $now = new DateTime();
                            if ($date >= $now) {
                                echo "<h3 id ='dobre'>Upcoming</h3>";
                            } else {
                                echo "<h3 id ='zle'>Done</h3>";
                            }
                            echo "</div>";

                            echo "<div id = 'divdollewo'>";
                            echo "<h4 style='color: yellow;'>" . "Data wydarzenia: " . $row['data_wyd'] . "</h4>";
                            echo "</div>";
                            echo "<div id = 'divdolprawo'>";
                            echo "<form method='POST' action=''>";
                            echo "<input type='hidden' class='input1' name='wartoscID' value='" . $row['ID'] . "'>";
                            echo "<input type='submit' class='input1' name='usun' value='Usuń!' style='width: 110px;'>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<h1>Brak Wydarzeń</h1>";
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
                    if (isset($_POST['usun'])) {
                        $idusun = $_POST['wartoscID'];
                        $sql_usun = "DELETE FROM `wydarzenia` WHERE `ID` = $idusun";
                        $result = $conn->query($sql_usun);
                        if ($result) {
                            echo "<script>alert('Poprawnie usunięto wydarzenie!'); window.location.href = 'indexadminiuzytkownik.php';</script>";
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