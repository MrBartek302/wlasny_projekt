<ul class="button-list">
    <li><a href="./" class="button">Strona Główna</a></li>
    <?php
    if ($_SESSION['zalogowany'] == false) {
        echo "<li> <a href='./logowanie.php'>Logowanie</a></li>";
    } else {
        echo "<li> <a href='./wylog.php'>Wyloguj</a></li>";
    }
    ?>
    <li><a href="./rejestracja.php" class="button">Rejsetracja</a></li>
</ul>