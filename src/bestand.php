<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="content">
    <div class="content-container center">
        <h1 class="headline">BESTAND</h1>
    </div>
    <?php
    $db = new SQLite3('/database/mydata.db');

    $lebensmittel = $db->query('SELECT * FROM bestand WHERE NOT mhd="gegenstand" ORDER BY name');
    $gegenstand = $db->query('SELECT * FROM bestand WHERE mhd="gegenstand" ORDER BY name');

    print_r(buildTable($lebensmittel));
    print_r("<div class='row' style='height: 20px'></div>");
    print_r(buildTable($gegenstand));

    function buildTable($result)
    {
        $table = "<div class='content-container'> <table align='center' width='90%'><tr align='center' style='color:#006dcc'><th>NAME</th><th>MENGE</th><th>LAGERORT</th><th>MHD</th></tr>";
        while ($row = $result->fetchArray()) {
            if (time() >= strtotime($row['mhd']) && $row['mhd'] != "gegenstand" && $row['mhd'] != "kein MHD") {
                $table = $table . "<tr bgcolor='red'><td align='center'>" . $row['name'] . "</td><td align='center'>" . $row['menge'] . "</td><td align='center'>" . $row['lagerort'] . "</td><td align='center'>" . $row['mhd'] . "</td></tr>";
            } else {
                $table = $table . "<tr><td align='center'>" . $row['name'] . "</td><td align='center'>" . $row['menge'] . "</td><td align='center'>" . $row['lagerort'] . "</td><td align='center'>" . $row['mhd'] . "</td></tr>";
            }
        }
        $table = $table . "</table></div>";

        return $table;
    }

    ?>
    <div class="content-container">
        <button class="button" id="3" onclick="window.print()">DRUCKEN</button>
    </div>
</div>
</body>
</html>
