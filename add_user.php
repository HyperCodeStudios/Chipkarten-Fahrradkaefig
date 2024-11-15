<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Neuer Nutzer</title>
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
        <form action="add_user_submit.php" method="post" enctype="multipart/form-data">
            <h2>Neuer Nutzer</h2>
            <input class="input1" id="chipid" name="chipid" type="text" placeholder="Id..." required>
            <input class="input1" id="username" name="username" maxlength=10 placeholder="Benutzername..." required>
            <input class="input1" id="expire" name="expire" type="number" placeholder="Verfallsdatum..." required>

            <button class="button1" type="button" onclick="scanChip()">Scan Chip</button>

            <div id="error-message" style="color: red; display: none;">Fehler: Kein NFC-Tag erkannt. Bitte versuchen Sie es erneut.</div>

            <button class="button1" type="submit">Hinzufügen</button>
        </form>
    </div>
    <script>
        function time() {
            let date = new Date();
            document.getElementById("clock").innerHTML = ("00" + date.getHours()).slice(-2) + ":" + ("00" + date.getMinutes()).slice(-2) + ":" + ("00" + date.getSeconds()).slice(-2);
        }

        window.setInterval(time, 60);

        async function scanChip() {
            // Überprüfen, ob der Browser Web NFC unterstützt
            if ("NFC" in window) {
                try {
                    // Starten des NFC-Lesevorgangs
                    const nfcReader = new NDEFReader();
                    await nfcReader.scan();

                    // Verarbeite das Ergebnis, wenn ein NFC-Tag gefunden wurde
                    nfcReader.onreading = event => {
                        const tag = event.message.records[0];
                        const chipId = tag.id; // Die UID des NFC-Tags

                        // Setze die UID in das Chip-ID Textfeld
                        document.getElementById("chipid").value = chipId;

                        // Verstecke die Fehlermeldung (falls sie angezeigt wurde)
                        document.getElementById("error-message").style.display = 'none';
                    };

                    // Fehlerfall: Wenn das Tag nicht erkannt wird, zeige eine Fehlermeldung an
                    nfcReader.onerror = () => {
                        document.getElementById("error-message").style.display = 'block';
                    };

                } catch (error) {
                    // Fehler abfangen, falls etwas schiefgeht
                    console.error("Fehler beim Scannen des NFC-Tags:", error);
                    document.getElementById("error-message").style.display = 'block';
                }
            } else {
                // Fehlermeldung anzeigen, wenn Web NFC nicht unterstützt wird
                alert("Ihr Browser unterstützt Web NFC nicht.");
            }
        }
    </script>
</body>
</html>