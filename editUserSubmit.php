<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="refresh" content="5;url=all_users.php" />
        <title>Nutzer wurde bearbeitet</title>
        <link rel="stylesheet" href="style_index.css">
    </head>
    <body>
        <?php
            include("db.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Daten aus dem Formular abrufen und sicherstellen, dass sie existieren
                $user = [
                    'username' => isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '',
					'oldusername' => isset($_POST['oldname']) ? htmlspecialchars($_POST['oldname']) : '',
                    'chipid' => isset($_POST['chipid']) ? htmlspecialchars($_POST['chipid']) : '',
                    'expire' => isset($_POST['expire']) ? htmlspecialchars($_POST['expire']) : '',
                ];

                // Hier können Sie die Daten weiterverarbeiten, z.B. in einer Datenbank speichern oder per E-Mail versenden
                echo "<h2 class='echo_big'>Formulardaten:</h2>";
                echo "<span class='echo_befehl'> Name: " . $user['username'] . "</span>" . "<br>";
                echo "<span class='echo_befehl'> ChipId: " . $user['chipid'] . "</span>"."<br>";
                echo "<span class='echo_befehl'> Verfallsdatum: " . $user['expire'] . "</span>" . "<br>";

                // Funktion zum Erstellen eines Benutzers aufrufen
                editUser($user['oldusername'], $user['username'], $user['chipid'], $user['expire']);
                $Result = checkIfChipExists($user['chipid']);
                if (!$Result) {
                    createChip($user['chipid'], 1);
                }
            } else {
                echo "Ungültige Anforderung.";
            }
        ?>
    </body>
</html>