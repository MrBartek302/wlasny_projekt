<ul class="button-list">
    <li><a href="./index.php" class="button">Strona Główna</a></li>
    <?php
    if ($_SESSION['zalogowany'] == false) {
        echo "<li> <a href='./logowanie.php' id='button2'>Logowanie</a></li>";
    } else {
        echo "<li> <a href='./wylog.php' id='button1'>Wyloguj</a></li>";
    }
    ?>
    <li><a href="./rejestracja.php" id="button3">Rejestracja</a></li>
</ul>