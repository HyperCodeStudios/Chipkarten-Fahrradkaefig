<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs</title>
    <link rel="stylesheet" href="style.css">
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
        <input type="text" id="searchInput" class="input1" placeholder="Suche...">
        <input type="date" id="dateInput" class="input1">
        <div class="table">
            <h2>Logs</h2>
            <table id="logTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">ID</th>
                        <th onclick="sortTable(1)">Datum</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include 'db.php';

                $sql = "SELECT * FROM zugriff ORDER BY datum DESC";
                $result = mysqli_query($db, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars(date("d.m.Y H:i:s", strtotime($row['datum']))) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Keine Ergebnisse</td></tr>";
                }

                mysqli_close($db);
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Suchfunktion
        document.getElementById('searchInput').addEventListener('keyup', function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll('#logTable tbody tr');
            rows.forEach(function(row) {
                var cells = row.querySelectorAll('td');
                var match = false;
                cells.forEach(function(cell) {
                    if (cell.innerHTML.toLowerCase().indexOf(searchValue) > -1) {
                        match = true;
                    }
                });
                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Kalenderfunktion
        document.getElementById('dateInput').addEventListener('change', function() {
            var selectedDate = this.value;
            var rows = document.querySelectorAll('#logTable tbody tr');
            rows.forEach(function(row) {
                var dateCell = row.querySelectorAll('td')[1];
                var rowDate = new Date(dateCell.innerHTML.split(' ')[0].split('.').reverse().join('-'));
                var selectedDateObj = new Date(selectedDate);
                if (rowDate.toDateString() === selectedDateObj.toDateString()) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function time() {
            let date = new Date();
            document.getElementById("clock").innerHTML = ("00" + date.getHours()).slice(-2) + ":" + ("00" + date.getMinutes()).slice(-2) + ":" + ("00" + date.getSeconds()).slice(-2);
        }

        window.setInterval(time, 1000);
    </script>
</body>
</html>