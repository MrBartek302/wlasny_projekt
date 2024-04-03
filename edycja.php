<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja wydarzenia</title>
    <link rel="stylesheet" href="style.css">
</head>

<body style="display:flex; flex-direction:column; align-items: center; justify-content:center; background-color: grey;">
    <div id="div_do_zmiany">
        <?php
        $host = "localhost";
        $dbuser = "root";
        $dbpassword = "";
        $dbname = "Aaawlasny_projekt_BS";
        $id_wyd_edyt = $_POST['edyt'];

        $conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
        if (!$conn) {
            die("Nie połączono z bazą danych" . mysqli_connect_error());
        }

        if (isset($_POST['submit'])) {
            $sql = "SELECT `ID`, `nazwa_wyd`, `opis_wyd`, `data_wyd` FROM `wydarzenia` WHERE `ID`='$id_wyd_edyt'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<form method='POST' action='' style='display:flex; flex-direction:column; align-items: center; justify-content:center;'>";
                    echo "<input type='hidden' name='edyt' value='" . $row['ID'] . "'>";
                    echo "<input type='text' class='input' name='change_name' style='width: 500px;' value='" . $row['nazwa_wyd'] . "'>";
                    echo "<input type='text' class='input' name='change_desc' style='width: 700px;' value='" . $row['opis_wyd'] . "'>";
                    echo "<input type='text' class='input' name='change_date' style='width: 110px;' value='" . $row['data_wyd'] . "'>";
                    echo "<input type='submit' id='inputson' name='zmiana' value='Zmień!' style='width: 110px;'>";
                    echo "</form>";
                }
            } else {
                echo "Nie pobrano danych.";
            }
        } elseif (isset($_POST['zmiana'])) {
            $id_wyd_edyt = $_POST['edyt'];
            $change_name = $_POST['change_name'];
            $change_desc = $_POST['change_desc'];
            $change_date = $_POST['change_date'];

            $sql1 = "UPDATE `wydarzenia` SET `nazwa_wyd`='$change_name', `opis_wyd`='$change_desc', `data_wyd`='$change_date' WHERE `ID`='$id_wyd_edyt'";
            $result1 = $conn->query($sql1);
            if ($result1) {
                echo "<script>alert('Poprawnie zmieniono wydarzenie!'); window.location.href = 'indexadminiuzytkownik.php';</script>";
            } else {
                echo "Błąd podczas aktualizacji danych.";
            }
        }
        ?>
    </div>
</body>

</html>