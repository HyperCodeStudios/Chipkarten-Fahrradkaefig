<?php
// Setze den Content-Type Header, um sicherzustellen, dass der Browser die Seite richtig interpretiert
header('Content-Type: text/html; charset=utf-8');
include("db.php");

// ueberpruefe, ob die 'id' als GET-Parameter Ã¼bergeben wurde
if (isset($_GET['id'])) {
    // Hole die 'id' aus dem GET-Parameter
    $id = $_GET['id'];

    //ÃœberpÃ¼fe ob Id in der Datenbank ist
    $UserIdExists = CheckIfUserIdExists($id);
    $ChipEnabled = CheckIfChipEnabled($id);
    $Expire = getexpirefromid($id);
 	
  	//echo $UserIdExists.":".$ChipEnabled.":".$ChipVerfallen;

    // ueberpruefe, ob die der Chip Zugriff hat
    if ($UserIdExists and $ChipEnabled and !$Expire) {
        // Setze den HTTP-Statuscode auf 200 (OK)
        http_response_code(200);
        echo "HTTP 200: Anfrage erfolgreich.";
		writeInLog($id);
    } else {
        // Setze den HTTP-Statuscode auf 400 (Bad Request)
        http_response_code(400);
        echo "HTTP 400: UngÃ¼ltige Anfrage.";
    }
} else {
    // Wenn keine 'id' Ã¼bergeben wurde, setze den HTTP-Statuscode auf 400 (Bad Request)
    http_response_code(400);
    echo "HTTP 400: Keine ID Ã¼bergeben.";
}
?>