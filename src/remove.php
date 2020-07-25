<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div class="content">
            <div class="content-container center">
                <h1>VORRAT BEARBEITEN</h1>
            </div>
                <?php
                $db = new SQLite3('/database/mydata.db', SQLITE3_OPEN_READWRITE);
                print_r(dropDownName());
                print_r(dropDownLagerort());

                function dropDownName() {
                    global $db;
                    $result = $db->query('SELECT name FROM bestand');
                    $dropdown = "<div class='content-container'> <select id='5'>";
                    while($row = $result->fetchArray(SQLITE3_ASSOC)){
                        $dropdown = $dropdown . "<option style='color: #ffffff' value='$row[name]'>$row[name]</option>";
                    }
                    $dropdown = $dropdown . "</select> </div>";
                    return $dropdown;
                }

                function dropDownLagerort() {
                    global $db;
                    $result = $db->query('SELECT DISTINCT lagerort FROM bestand');
                    $dropdown = "<div class='content-container'> <select id='6'>";
                    while($row = $result->fetchArray(SQLITE3_ASSOC)){
                        $dropdown = $dropdown . "<option style='color: #ffffff' value='$row[lagerort]'>$row[lagerort]</option>";
                    }
                    $dropdown = $dropdown . "</select> </div>";
                    return $dropdown;
                }
                ?>
            <div class="content-container">
                <label>
                    <input  type="checkbox"
                            onchange="showAmount()"
                            id="3">
                    Alles verbraucht
                </label>
            </div>
            <div class="content-container" id="4">
                <label>Neue Menge: <input type="text"></label>
            </div>
            <div class="content-container">
                <button type="button" id="2" onclick="sendDBRequest()">AKTUALISIEREN</button>
            </div>
        </div>
    </body>

    <script>
         function sendDBRequest() {
             var menge = "NOT";
             var vorrat = "NOT";
             var lagerort = "NOT";
             var url = "";

             if(document.getElementById("6").value == "") {
                 window.alert("Keinen Lagerort ausgewaehlt.");
                 return;
             }

             if(document.getElementById("5").value == "") {
                 window.alert("Keinen Vorrat ausgewaehlt.");
                 return;
             }
             else{
                 vorrat = document.getElementById("5").value;
                 lagerort = document.getElementById("6").value;
                 url = "handle.php?vorrat=" + vorrat + "&lagerort=" + lagerort + "&type=delete";
             }

             if(document.getElementById("3").checked != true) {
                 menge = document.getElementById("4").value;
                 if(menge == "") {
                     window.alert("Keine neue Menge eingetragen.");
                     return;
                 }
                 url = "handle.php?vorrat=" + vorrat + "&lagerort=" + lagerort + "&menge=" + menge + "&type=update";
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
                     window.location.href="index.php";
                     window.alert("Vorrat aktualisiert.");
                 } else {
                     window.alert(request.responseText);
                     console.warn(request.statusText, request.responseText);
                 }
             });

             request.send();

         }

        function showAmount() {
                if (document.getElementById("3").checked === true) {
                    document.getElementById("4").style.visibility='hidden';
                    document.getElementById("4").style.textAlign="center";
                }
                else {
                    document.getElementById("4").style.visibility='visible';
                    document.getElementById("4").style.textAlign="center";
                }
        }
    </script>
</html>
