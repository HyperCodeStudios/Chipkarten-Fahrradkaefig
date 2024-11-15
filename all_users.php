<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Alle Nutzer</title>
</head>
<body>
    <header>
        <div>
            <img src="logo.jpg" alt="">
            <div id="clock"></div>
        </div>
        <div>
            <a href="index.html">Home</a>
            <a href="all_users.php">Nutzer/innen</a>
            <a href="logs.php">Logs</a>
            <a class="links" href="credits.html">Mitwirkende</a>
        </div>
    </header>

    <div class="content">
        <div class="table">
            <h2>Alle Nutzer</h2>
            <table>
                <tr><td>Chip Id</td><td>Benutzername</td><td>Verfallsdatum</td><td>Aktiv</td></tr>
                <?php
                include("db.php");

                $userdata = getUserData();                

                if ($userdata) {
                    while ($rowUser = mysqli_fetch_assoc($userdata)) {                        
                        $userId = htmlspecialchars($rowUser['id'], ENT_QUOTES, 'UTF-8');
                        echo "
                        <tr>
                            <td>{$userId}</td>
                            <td>{$rowUser['name']}</td>
                            <td>{$rowUser['verfallsdatum']}</td>
                            <td>{$rowUser['enabled']}</td>                            
                            <td class='special_td'>
                                <img class='button3' src='pencil_new.png' onclick='editUser(\"{$userId}\")'>
                                <img class='button3' src='ban_new.png' onclick='lockUser(\"{$userId}\")'>
                                <img class='button3' src='trash_new.png' onclick='deleteUser(\"{$userId}\")'>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Keine Daten gefunden</td></tr>";
                }
                ?>
            </table>
        </div>
        <a class="button2" href="add_user.php">Nutzer Hinzufügen</a>
    </div>
    <script>
        function time() {
            let date = new Date();
            document.getElementById("clock").innerHTML = ("00" + date.getHours()).slice(-2) + ":" + ("00" + date.getMinutes()).slice(-2) + ":" + ("00" + date.getSeconds()).slice(-2);
        }

        window.setInterval(time, 1000);

        function deleteUser(id) {
            if (confirm("Bist du dir sicher, dass der Benutzer gelöscht werden soll?") == true) {
                console.log("Benutzer mit Id", id, "gelöscht");
                let url = "deleteUser.php?id=\"" + encodeURIComponent(id) + "\"";
                window.location.href = url;
            } else {
                console.log("Abgebrochen");
            }
        }

        function lockUser(id) {
            if (confirm("Bist du dir sicher, dass dieser Chip gesperrt/entsperrt werden soll?") == true) {
                console.log("Chip mit Id", id, "gesperrt/entsperrt.");
                let url = "lockUser.php?id=\"" + encodeURIComponent(id) + "\"";
                window.location.href = url;
            } else {
                console.log("Abgebrochen");
            }
        }

        function editUser(id) {
            console.log("User mit Id", id, "wird bearbeitet.");
            let url = "editUser.php?id=\"" + encodeURIComponent(id) + "\"";
            window.location.href = url;
        }
    </script>
</body>
</html>