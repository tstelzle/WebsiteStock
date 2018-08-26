<html>
    <style>
        #button { padding: 1%; }
    </style>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>

    <body>
    <div class="container-fluid" style="text-align:center;">
    <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="button">
             <h1>BESTAND</h1>
            </div>
            <div class="col-md-3"></div>
        </div>


    <?php
        $db = new SQLite3('/home/pi/database/mydata.db');

        $result = $db->query('SELECT * FROM bestand');

        print_r (buildTable());

        function buildTable() {
            global $result;

            $table = "<div class='row'><div class='col-md-3'></div><div class='col-md-6'><table align='center' width='90%' class='table-bordered'><tr align='center' style='color:#006dcc'><th>NAME</th><th>MENGE</th><th>LAGERORT</th><th>MHD</th></tr>";
            while($row = $result->fetchArray()) {
                if(time() >= strtotime($row['mhd'])) {
                    $table = $table . "<tr bgcolor='red'><td align='center'>" . $row['name'] . "</td><td align='center'>" . $row['menge'] . "</td><td align='center'>" . $row['lagerort'] . "</td><td align='center'>" . $row['mhd'] . "</td></tr>";
                }
                else {
                    $table = $table . "<tr><td align='center'>" . $row['name'] . "</td><td align='center'>" . $row['menge'] . "</td><td align='center'>" . $row['lagerort'] . "</td><td align='center'>" . $row['mhd'] . "</td></tr>";
                }
            }
            $table = $table . "</table></div><div class='col-md-3'></div></div>";

            return $table;
        }
    ?>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="button">
                <button class="btn btn-primary btn-lg" id="3" onclick="window.print()">DRUCKEN</button>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    </body>
</html>
