<ul class="button-list">
    <li><a href="./indexadminiuzytkownik.php" class="button">Strona Główna</a></li>
    <?php
    if ($_SESSION['zalogowany'] == false) {
        echo "<li> <a href='./logowanie.php' class='button'>Logowanie</a></li>";
    } else {
        echo "<li> <a href='./wylog.php' id='button1'>Wyloguj</a></li>";
    }
    ?>
    <li><a href="./rejestracja.php" class="button">Rejestracja</a></li>
</ul>