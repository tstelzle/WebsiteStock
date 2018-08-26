<!Doctype html>
<html xmlns="http://www.w3.org/1999/html">
    <style>
        #button { padding: 3%; }
    </style>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    </head>

    <body>
        <div class="container-fluid" style="text-align:center;">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" id="button"><h1>Website Ferienhaus Sauerland</h1></div>
                <div class="col-md-3"></div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" id="button">
                    <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='bestand.php'">AKTUELLER BESTAND</button>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" id="button">
                     <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='remove.php'">ENTNOMMEN</button>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" id="button">
                  <button type="button" class="btn btn-primary btn-lg" onclick="window.location.href='add.php'">HINZUFÜGEN</button>
                </div>
            <div class="col-md-3"></div>
            </div>
        </div>
    </body>
</html>
