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
    
    <?php

    // Class specification
    class Agenda {
        private $agenda;

        function __construct() {
            $this->agenda = array();
        }

        // Adds new name and email to dictionary
        function addEntry($new_name, $new_email) {
            // No difference between uppercase and lowercase values
            $new_name = strtolower($new_name);
            $new_email = strtolower($new_email);

            // Valid entries
            if (!array_key_exists($new_name, $this->agenda) && $new_name != "" && filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
                $this->agenda[$new_name] = $new_email;
            } else if ($new_name == "") {  // Empty name
                echo "<b style='color:red'>EL NOMBRE ESTÁ VACÍO</b><br>";
            } else if (array_key_exists($new_name, $this->agenda) && $new_email == "") {  // Empty email
                echo "<b style='color:red'>REGISTRO CON EL NOMBRE '" . $new_name . "' ELIMINADO</b><br>";
                unset($this->agenda[$new_name]);
            } else if (array_key_exists($new_name, $this->agenda) && filter_var($new_email, FILTER_VALIDATE_EMAIL) && $this->agenda[$new_name] != $new_email) {  // Different email
                echo "<b style='color:red'>EMAIL ACTUALIZADO</b><br>";
                $this->agenda[$new_name] = $new_email;
            } else if (array_key_exists($new_name, $this->agenda) && $this->agenda[$new_name] == $new_email) {  // Same entries
                echo "<b style='color:red'>REGISTRO REPETIDO</b><br>";
            } else {
                echo "<b style='color:red'>EMAIL NO VÁLIDO</b><br>";
            }
        }

        // Return internal array
        function getAgenda() {
            return $this->agenda;
        }

        // Show internal data
        function toString() {
            echo "<h4>Agenda</h4>";
            foreach ($this->agenda as $i => $v) {
                echo "{$i} => {$v}<br>";
            }
        }
    }

    ?>

</body>

</html>
