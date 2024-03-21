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
                    echo 'const buttonAdmin = document.createElement("button");';
                    echo 'buttonAdmin.setAttribute("id", "buttonAdmin");';
                    echo 'buttonAdmin.textContent = "Strona Admina";';
                    echo 'buttonAdmin.addEventListener("click", function() {';
                    echo 'window.location.href = "admin.php";';
                    echo '});';
                    echo 'document.getElementById("menprawoprawo").appendChild(buttonAdmin);';
                    echo '</script>';
                } elseif ($_SESSION['upr'] === 'pracownik') {
                    echo '<script>';
                    echo 'const buttonPracownik = document.createElement("button");';
                    echo 'buttonPracownik.setAttribute("id", "buttonPracownik");';
                    echo 'buttonPracownik.textContent = "Strona pracownika";';
                    echo 'buttonPracownik.addEventListener("click", function() {';
                    echo 'window.location.href = "pracownik.php";';
                    echo '});';
                    echo 'document.getElementById("menprawoprawo").appendChild(buttonPracownik);';
                    echo '</script>';
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
                            <input type="text" name="tytul" placeholder="Nazwa Wydarzenia" style="text-align: center;">
                            <input type="text" name="opis" placeholder="Opis Wydarzenia" style="text-align: center;">
                            <input type="date" name="data" placeholder="Data Wydarzenia">
                            <input type="submit" name="wyss" value="Utwórz!">
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
                    <div id="trescogolgoraprawo">
                        <h1>Edytuj wydarzenie: </h1>
                        <form action="" method="POST">
                            <input type="number" name="idwyd" placeholder="ID Wydarzenia do zmiany" style="text-align: center;">
                            <input type="number" name="idzam" placeholder="Zmienione ID" style="text-align: center;">
                            <input type="text" name="tytul1" placeholder="Nazwa Wydarzenia" style="text-align: center;">
                            <input type="text" name="opis1" placeholder="Opis Wydarzenia" style="text-align: center;">
                            <input type="date" name="data1" placeholder="Data Wydarzenia">
                            <input type="submit" name="wyss1" value="Edytuj!">
                            <?php
                            if (isset($_POST['wyss1'])) {
                                if (empty($_POST['idwyd']) || empty($_POST['idzam']) || empty($_POST['tytul1']) || empty($_POST['opis1']) || empty($_POST['data1'])) {
                                    echo "<script>alert('Nie uzupełniłeś danych do edycji wydarzenia')</script>";
                                } else {
                                    $host = "localhost";
                                    $dbuser = "root";
                                    $dbpassword = "";
                                    $dbname = "Aaawlasny_projekt_BS";
                                    $idwyd = $_POST['idwyd'];
                                    $idzam = $_POST['idzam'];
                                    $tytul = $_POST['tytul1'];
                                    $opis = $_POST['opis1'];
                                    $data = $_POST['data1'];
                                    $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
                                    if (!$conn) {
                                        die("Nie połaczono z baza danych" . mysqli_connect_error());
                                    }
                                    $sql = "UPDATE `wydarzenia` SET `ID`='$idzam',`nazwa_wyd`='$tytul',`opis_wyd`='$opis',`data_wyd`='$data' WHERE ID = $idwyd";
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