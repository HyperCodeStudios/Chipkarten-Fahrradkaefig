<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User wurde gelöscht</title>
        <link rel="stylesheet" href="style_index.css">
    </head>
    <body>
        <?php
            include("db.php");
            deleteUserFromDB($_GET['id']);

            echo"<div class='message'><h1>User wurde Gelöscht</h1></div>";

        ?>
        <meta http-equiv="refresh" content="2;url=all_users.php" />
    </body>
</html>