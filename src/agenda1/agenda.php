<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Agenda</title>
</head>

<body>

    <?php

    // Save username in cookie
    if (!isset($_COOKIE['username'])) {
        $username = htmlentities($_POST['username']);
        setcookie('username', json_encode($username), 0);
        echo "<h1>Agenda de " . $username . "</h1>";
    } else {
        echo "<h1>Agenda de " . json_decode($_COOKIE['username'], true) . "</h1>";
    }

    ?>

</body>

</html>
