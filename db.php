<?php
$db = new mysqli('10.147.48.56', 'sus', 'X4ToKu', 'testDB');

if ($db->connect_errno) {
    exit("Verbindungsfehler: " . $db->connect_error);
}

function createUser($username, $id, $expire) {
    global $db;
    $sql = "INSERT INTO user VALUES ('$username', '$id', '$expire')";
    $ergebnis = mysqli_query($db, $sql);
    if ($ergebnis) {
        echo "<span class='echo_befehl' class='echo_under'>Benutzer erfolgreich erstellt.</span>";
    } else {
        echo "<span class='echo_befehl' class='echo_under'> Fehler: " . mysqli_error($db) . "</span>";
    }
}

function editUser($oldusername, $newusername, $id, $expire) {
    global $db;
    $sql = "UPDATE user SET id='$id', name='$newusername', verfallsdatum=$expire WHERE name='$oldusername' ";
    //echo $sql;
    $ergebnis = mysqli_query($db, $sql);
    if ($ergebnis) {
        echo "<span class='echo_befehl' class='echo_under'>Benutzer erfolgreich bearbeitet.</span>";
    } else {
        echo "<span class='echo_befehl' class='echo_under'> Fehler: " . mysqli_error($db) . "</span>";
    }
}


function createChip($id, $enabled) {
    global $db;
    $sql = "INSERT INTO chips VALUES ('$id', $enabled) ";
	//echo $sql;
    $ergebnis = mysqli_query($db, $sql);
    if ($ergebnis) {
        echo "<span class='echo_befehl' class='echo_under'>Chip erfolgreich erstellt.</span>";
    } else {
        echo "<span class'echo_befehl' class='echo_under'>Fehler: " .  mysqli_error($db) . "</span>";
    }
}

function deleteUserFromDB($id) {
    global $db;
    $sql = "DELETE FROM user WHERE id = $id";
    $ergebnis = mysqli_query($db, $sql);
    //echo $ergebnis;
}

function getUserData() {
    global $db;
    $sql = "SELECT a.id, a.name, a.verfallsdatum, b.enabled FROM user a, chips b WHERE a.id=b.id";
    $ergebnis = mysqli_query($db, $sql);
    return $ergebnis ;
}

function getChipData() {
    global $db;
    $sql = "SELECT * FROM chips";
    $ergebnis = mysqli_query($db, $sql);
    return $ergebnis ;
}

function checkIfChipExists($id) {
    global $db;
    $sql="SELECT id FROM chips WHERE id = '$id'";
	$ergebnis = mysqli_query($db, $sql);
    return mysqli_num_rows($ergebnis) > 0;
}

function lockUserFromDB($id) {
    global $db;
    $chipEnabled = CheckIfChipEnabled($id);

    if ($chipEnabled == true) {
        $sql = "UPDATE chips SET enabled = 0 WHERE id = $id";
        echo"<div class='message'><h1>Chip wurde erfolgreich Gesperrt!</h1></div>";
    } else {
        $sql = "UPDATE chips SET enabled = 1 WHERE id = $id";
        echo"<div class='message'><h1>Chip wurde erfolgreich freigeschaltet!</h1></div>";
    }

    $result = mysqli_query($db, $sql);

    if (!$result) {
        die('Fehler beim Sperren des Chips: ' . mysqli_error($db));
    }
}

function getnamefromid($id){
	global $db;
	$sql ="select name from user where Id='$id'";
	$ergebnis = mysqli_query($db, $sql);
	if (mysqli_num_rows($ergebnis) > 0) {
        $row = mysqli_fetch_assoc($ergebnis);
        return $row['name'];
    } else {
        return null;
    }
}

function getexpirefromid($id){
	global $db;
	$sql ="select verfallsdatum from user where Id='$id' AND verfallsdatum < YEAR(curdate());";
	//echo $sql;
	$ergebnis = mysqli_query($db, $sql);
	if (mysqli_num_rows($ergebnis) > 0) {
          return true;
    } else {
        return false;
    }
}

function CheckIfUserIdExists($id) {
    global $db;
    $sql = "SELECT id FROM user WHERE id = '$id'";
    $result = mysqli_query($db, $sql);
	if($result){
		if (mysqli_num_rows($result)>0){
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}	
}

function CheckIfChipEnabled($id) {
    global $db;
    $sql = "SELECT enabled FROM chips WHERE id = $id";
    //echo "$sql";
    $result = mysqli_query($db, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $test = $row['enabled']; 
            return $row['enabled'] == 1;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function writeInLog($id){
    global $db;
	$sql = "INSERT INTO zugriff(id, datum) values('$id', CURRENT_TIMESTAMP)";
    //echo "$sql";
    $result = mysqli_query($db, $sql);
}
?>
