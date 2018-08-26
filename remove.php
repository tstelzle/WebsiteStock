<html>
    <style>
        #button { padding: 1%; }
    </style>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>
    <body>
        <div class="container-fluid" style="text-align: center">

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h1>VORRAT BEARBEITEN</h1>
                </div>
                <div class="col-md-3"></div>
            </div>
                    <?php
                    $db = new SQLite3('/home/pi/database/mydata.db', SQLITE3_OPEN_READWRITE);
                    print_r (dropdownListe());

                    function dropDownListe() {
                        global $db;
                        $result = $db->query('SELECT name FROM bestand');
                        $dropdown = "<div class=\"row\"> <div class='col-md-3'></div> <div class=\"col-md-6\" id='button'> <select style='background-color: #006dcc' name='vorrat' id='5'>";
                        while($row = $result->fetchArray(SQLITE3_ASSOC)){
                            $dropdown = $dropdown . "<option style='color: #ffffff' value='$row[name]'>$row[name]</option>";
                        }
                        $dropdown = $dropdown . "</select> </div> <div class=\"col-md-3\"></div> </div>";
                        return $dropdown;
                    }
                    ?>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" id="button">
                    <label><input type="checkbox" id="3" onchange="showAmount()" checked="true">Alles verbraucht</label>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" id="button">
                    <label id="6" style="visibility: hidden">Neue Menge: <input align="center" type="text" id="4" name="amount" style="visibility: hidden"></label>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" id="button">
                    <button id="2" class='btn btn-primary btn-lg' name="update" onclick="sendDBRequest()">AKTUALISIEREN</button>
                </div>
                <div class="col-md-3"></div>
            </div>

        </div>
    </body>

    <script>
         function sendDBRequest() {
             var menge = "NOT";
             var vorrat = "NOT";
             var url = "";

             if(document.getElementById("5").value == "") {
                 window.alert("Keinen Vorrat ausgewaehlt.");
                 return;
             }
             else{
                 vorrat = document.getElementById("5").value;
                 url = "handle.php?vorrat=" + vorrat + "&type=delete";
             }

             if(document.getElementById("3").checked != true) {
                 menge = document.getElementById("4").value;
                 if(menge == "") {
                     window.alert("Keine neue Menge eingetragen.");
                     return;
                 }
                 url = "handle.php?vorrat=" + vorrat + "&menge=" + menge + "&type=update";
             }

             //XMLHTTPREQUEST
             var request = new XMLHttpRequest();
             request.open("GET", url, true);
             request.setRequestHeader("DB", "update");
             console.log(request);
             console.log(url);

             request.addEventListener('load', function (event) {
                 if (request.status >= 200 && request.status < 300) {
                     //window.alert(request.responseText);
                     console.log(request.responseText);
                 } else {
                     window.alert(request.responseText);
                     console.warn(request.statusText, request.responseText);
                 }
             });

             request.send();
             window.location.href="index.php";
             window.alert("Vorrat aktualisiert.");
         }

        function showAmount() {
                if (document.getElementById("3").checked === true) {
                    document.getElementById("4").style.visibility='hidden';
                    document.getElementById("6").style.visibility='hidden';
                    document.getElementById("4").style.textAlign="center";
                }
                else {
                    document.getElementById("4").style.visibility='visible';
                    document.getElementById("6").style.visibility='visible';
                    document.getElementById("4").style.textAlign="center";
                }
        }
    </script>
</html>
