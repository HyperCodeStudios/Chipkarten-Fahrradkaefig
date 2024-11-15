<?php
// Setze den Content-Type Header, um sicherzustellen, dass der Browser die Seite richtig interpretiert
header('Content-Type: text/html; charset=utf-8');

// Überprüfe, ob die 'id' als GET-Parameter übergeben wurde
if (isset($_GET['id'])) {
    // Hole die 'id' aus dem GET-Parameter
    $id = $_GET['id'];

    // Überprüfe, ob die 'id' gleich 4811 ist
    if ($id == "73AB8AF5") {
        // Setze den HTTP-Statuscode auf 200 (OK)
        http_response_code(200);
        echo "HTTP 200: Anfrage erfolgreich.";
    } else {
        // Setze den HTTP-Statuscode auf 400 (Bad Request)
        http_response_code(400);
        echo "HTTP 400: Ungültige Anfrage.";
    }
} else {
    // Wenn keine 'id' übergeben wurde, setze den HTTP-Statuscode auf 400 (Bad Request)
    http_response_code(400);
    echo "HTTP 400: Keine ID übergeben.";
}
?>