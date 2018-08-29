<html>
    <style>
        #button { padding: 2%; }
    </style>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>

    <body>
    <div class="container-fluid" style="text-align:center;">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="button"> <h1>VORRAT HINZUFÜGEN</h1> </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="button"><label>Name: </label>
            <input type="text" id="1"> </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="button">
                <label>Menge: </label>
                <input type="text" id="2">
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="button">
                <label>Lagerort:
                <?php
                    $places=["LO1", "LO2", "LU1", "LU2", "LU3", "LU4", "LU5", "LU6", "LU7", "LU8", "LU9", "RO1", "RO2", "RO3", "RU1", "RU2", "RU3", "RU4", "RU5", "RU6", "WEINKELLER"];
                    $dropdown = "<select id='5' style='background-color: #006dcc'> ";
                    for ($i=0; $i<sizeof($places); $i++) {
                        $dropdown = $dropdown . "<option style='color: #ffffff'>$places[$i]</option>";
                    }
                    $dropdown = $dropdown . "</select>";
                    print_r($dropdown);
                ?>
                </label>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3" id="button">
                <label><input type="checkbox" id="8" onchange="isStock()" checked="true">Lebensmittel</label>
            </div>
            <div class="col-md-3" id="button">
                <label id="10"><input type="checkbox" id="9" onchange="isMHD()">kein Ablaufdatum</label>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="button">
                <label id="7">Mindeshaltbarkeitsdatum: </label>
                <input type="date" id="3">
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-6" id="button">
                <button type="button" class="btn btn-primary btn-lg" id="4" onclick="submit()">HINZUFÜGEN</button>
                </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    </body>

    <script>
        function isStock() {
            if(document.getElementById("8").checked != true) {
               document.getElementById("7").style.visibility='hidden';
               document.getElementById("3").style.visibility='hidden';
               document.getElementById("9").style.visibility='hidden';
               document.getElementById("10").style.visibility='hidden';
            } else {
                document.getElementById("7").style.visibility='visible';
                document.getElementById("3").style.visibility='visible';
                document.getElementById("9").style.visibility='visible';
                document.getElementById("10").style.visibility='visible';
            }
        }

        function isMHD() {
            if(document.getElementById("9").checked != true) {
                document.getElementById("7").style.visibility='visible';
                document.getElementById("3").style.visibility='visible';
            } else {
                document.getElementById("7").style.visibility='hidden';
                document.getElementById("3").style.visibility='hidden';
            }
        }

        function submit() {
            var vorrat = "NOT";
            var menge = "NOT";
            var lagerort = "NOT"
            var mhd = "NOT";
            var error = false;

            document.getElementById("1").value == "" ? error=true : vorrat = document.getElementById("1").value;
            document.getElementById("2").value == "" ? error=true : menge = document.getElementById("2").value;
            document.getElementById("5").value == "" ? error=true : lagerort = document.getElementById("5").value;

            if(document.getElementById("8").checked === true) {
                if(document.getElementById("9").checked === true) {
                    mhd = "kein MHD";
                } else {
                    document.getElementById("3").value == "" ? error=true : mhd = document.getElementById("3").value;
                }
            } else {
                mhd = "gegenstand";
            }

            if(error === true) {
                window.alert("Eingaben fehlend.");
                return;
            }

            var request = new XMLHttpRequest();
            var url = "handle.php?vorrat=" + vorrat + "&menge=" + menge + "&lagerort=" + lagerort +"&mhd=" + mhd + "&type=add";
            request.open("GET", url, true);
            request.addEventListener('load', function (event) {
                if (request.status >= 200 && request.status < 300) {
                    //window.alert(request.responseText);
                    console.log(request.responseText);
                    window.alert("Vorrat hinzugefuegt.");
                    window.location.href="index.php";
                } else {
                    if(request.status === "300") {
                        window.alert(request.responseText);
                        return;
                    }
                    window.alert(request.responseText);
                    console.warn(request.statusText, request.responseText);
                }
            });
            request.send();
        }
    </script>
</html>