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
                <h1>Strona Główna Adminaa</h1>
            </div>
            <div id="menlewo">
                <?php
                include 'manuadmin.php';
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
                    <form action="" method="POST">
                        <input type="text" name="tytul" placeholder="Nazwa Wydarzenia" style="text-align: center;">
                        <input type="text" name="opis" placeholder="Opis Wydarzenia" style="text-align: center;">
                        <input type="date" name="data" placeholder="Data Wydarzenia">
                        <input type="submit" name="wyss">

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

                            if (empty($_POST['tytul']) || empty($_POST['opis']) || empty($_POST['data'])) {
                                echo "<script>alert('Nie uzupełniłeś danych o wydarzeniu')</script>";
                            } else {
                                $sql = "INSERT INTO `wydarzenia`(`nazwa_wyd`, `opis_wyd`, `data_wyd`) VALUES ('$tytul','$opis','$data')";
                                $result = $conn->query($sql);
                                if ($result) {
                                    echo "";
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
                <div id="trescogoldol"></div>
            </div>
        </div>
    </div>



</body>

</html>