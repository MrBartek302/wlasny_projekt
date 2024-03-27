<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja wydarzenia</title>
</head>

<body>
    <div id="trescogolgoraprawo">
        <h1>
            <?php
            if (isset($_POST['submit'])) {
                if (isset($_POST['edyt'])) {
                    echo "Edycja wydarzenia: " . $_POST['edyt'];
                } else {
                    echo "Nie wybrano wydarzenia do edycji.";
                }
            }
            ?>
        </h1>
    </div>
</body>

</html>