<?php
    $db = new SQLite3('/database/mydata.db', SQLITE3_OPEN_READWRITE);

    $responseText = "";
    $responseStatus = "";

    if(isset($_GET["type"])) {
        $type = $_GET["type"];
    }

    if($type == "add") {
        if (isset($_GET["vorrat"]) and isset($_GET["menge"]) and isset($_GET["lagerort"]) and isset($_GET["mhd"])) {
            $vorrat = $_GET["vorrat"];
            $menge = $_GET["menge"];
            $lagerort = $_GET["lagerort"];
            $mhd = $_GET["mhd"];
            $resultNames = $db->query("SELECT name FROM bestand");
            $namegiven = false;
            while($row = $resultNames->fetchArray()) {
                if($row['name'] == $vorrat) {
                    if($row['lagerort'] == $_GET['lagerort']) {
                        $namegiven = true;
                    }
                }
            }
            if($namegiven === true) {
                $responseStatus = "300";
                $responseText = "Vorratsnamen schon vergeben.";
            }
            else {
                $responseStatus = "201";
                $responseText = "Vorrat hinzugefuegt.";
                $db->exec("INSERT INTO bestand (name , menge, lagerort, mhd) VALUES ('$vorrat', '$menge', '$lagerort', '$mhd')");
            }
        } else {
            $responseText = "Parameter nicht gesetzt.";
            $responseStatus = "301";
        }
    }
    elseif ($type == "delete") {
        if(isset($_GET["vorrat"]) and isset($_GET["lagerort"])) {
            $responseText = "Vorrat geloescht.";
            $responseStatus = "202";
            $vorrat = $_GET["vorrat"];
            $lagerort = $_GET["lagerort"];
            $statement = $db->prepare("SELECT * FROM bestand WHERE name=:description AND lagerort=:place");
            $statement->bindValue(':description', $vorrat);
            $statement->bindValue(':place', $lagerort);
            $result = $statement->execute();
            if(empty($result->fetchArray(SQLITE3_ASSOC))) {
                $responseStatus = "303";
                $responseText = "Vorrat im Lagerort nicht vorhanden.";
                header($_SERVER['SERVER_PROTOCOL'].' '.$responseStatus);
                header('Content-type: text/html; charset=utf-8');
                echo $responseText;
                exit();
            }
            $db->exec("DELETE FROM bestand WHERE name='$vorrat' AND lagerort='$lagerort'");
        } else {
            $responseStatus="302";
            $responseText = "Keinen Vorrat uebergeben.";
        }
    }
    elseif ($type == "update") {
        if(isset($_GET["vorrat"]) and isset($_GET["menge"])) {
            $vorrat = $_GET["vorrat"];
            $menge = $_GET["menge"];
            $responseStatus = "203";
            $responseText = "Vorrat auf " + $vorrat + " aktualisiert.";
            $db->exec("UPDATE bestand SET menge='$menge' WHERE name='$vorrat'");
        } else {
            $responseStatus = "303";
            $responseText = "Keine Menge oder Vorrat uebergen.";
        }
    }
    else {
        $responseStatus = "304";
        $responseText = "Funktion nicht vorhanden.";
    }

    header($_SERVER['SERVER_PROTOCOL'].' '.$responseStatus);
    header('Content-type: text/html; charset=utf-8');
    echo $responseText;
?>
