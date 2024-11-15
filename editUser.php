<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Nutzer Bearbeiten</title>
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

    <?php
        include("db.php");
        $id = $_GET['id'];
        $name = getnamefromid($id);
        $expire = getexpirefromid($id);

        echo "
            <div class='content'>
                <form action='editUserSubmit.php' method='post' enctype='multipart/form-data'>
                    <h2>Nutzer Bearbeiten</h2>
                    <input class='input1' id='chipid' name='chipid' type='text' value=$id required>
                    <input class='input1' id='username' name='username' maxlength=10 value=$name required>
                    <input class='input1' id='expire' name='expire' type='number' value=$expire required>
					<input type='hidden' id='oldname' name='oldname' value=$name>
                    <button class='button1' type='submit'>Speichern</button>
                </form>
            </div>
        ";
    ?>

    <script>
        function time() {
            let date = new Date();
            document.getElementById("clock").innerHTML = ("00" + date.getHours()).slice(-2) + ":" + ("00" + date.getMinutes()).slice(-2) + ":" + ("00" + date.getSeconds()).slice(-2);
        }

        window.setInterval(time, 60);
    </script>
</body>
</html>