<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User wurde gesperrt</title>
        <link rel="stylesheet" href="style_index.css">
    </head>
    <body>
        <?php
            include("db.php");
            $userid=$_GET['id'];
            lockUserFromDB($userid);
        ?>
        <meta http-equiv="refresh" content="5;url=all_users.php" />
    </body>
</html>