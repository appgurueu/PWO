<!doctype html>
<!-- Template for lua_api.html -->
<html lang="en">

    <body data-spy="scroll" data-target="#contenttable" data-offset="15" style="background: url('background.png') no-repeat center center fixed;background-size: 100% 100%;background-repeat: no-repeat;image-rendering:optimizeSpeed">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="CSG EF Praktika">
        <meta name="author" content="Lars Müller">
        <link rel="icon" href="icon.png"> 
        <div class="bg"></div>

        <title>PWO - ProjektWochenOrganisator</title>
        <link rel="shortcut icon" href="<!--PLACEBG-->">

        <!-- Scripts and stylesheets -->
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEACABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAABfX18AAAAAAPLy8gAvMJQAPT09AOLi4gC3t7cAKCmNAPT09ABqamoAJieKAKenpwB8fHwA5OTkAMLCwgD29vYAKixrAMvLywBgX8MAKCmMAN3d3QCHh4cA5ubmAC4vlADv7+8AYWHFACsrjgDf398A8fHxAC4vkwD6+voAz8/PAHl5eQAsLZAA4eHhAGFhxAAqK40AyMjIAC8xlQBycnIAJiaJAOzs7ADBwcEA9fX1AMrKygB0dHQA09PTACcoiwC6uroAw8PDAPf39wBtbW0AYGDEAHZ2dgApKo0A5+fnAPDw8AAtLpIA+fn5AM7OzgCjo6MAKyyPANfX1wCBgYEAioqKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANTU1NTU1NTU1NTU1NTU1ATUrKysrKysCAisrKysrNQE1KykWFUA3AgIJCT8FKzUBNSsYLTwLJwICMQkGDSs1ATUrOBsUJTMCAiIABgIrNQE1KwIcHy07AgIiCSwCKzUBNSsrDg4qJwICFAkRAis1ATUrDwwODgwCAgwMLgIrNQE1Kw8MDCAMAgICDC4CKzUBNSs6Mg8rCAICHDgYAis1ATUrHjoyDysICAIcOBgrNQEQHR05IT0aJCQ2Ey8KKBABEAMDHRkZIzQ0NBI2Ey8QARAmJgMXHTkhIT0aJDYHEAEQEDAEEBAQEBAQEDAEEBABAQE+NQEBAQEBAQE+NQEBAQABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAM/nAAA=" rel="icon" type="image/x-icon" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        <!--<div class="jumbotron" style="background-color:rgba(0,0,0,0)">-->
            <div class="container">
                <div class="row">
                    <div class="col-lg" style="display:inline-block;height:100%;">
                        <img class="img-fluid" src="pwo_banner.png" alt="PWO Banner" style="width:100%;-ms-interpolation-mode: bicubic; image-rendering: optimizeQuality;">
                        <div>
                            <h1>Schulleiter</h1>
                            <?php
                                error_reporting( E_ALL );
                                require 'error_msgs.php';
                                function makeDate($n1,$n2) {
                                    return $n1.".".$n2.".".date("Y");
                                }
                                function show_login() {
                                    echo '<h2 class="mt-4">Einloggen</h2>
                                    <form id="login" method="post" action="">
                                    <label for="pword">Passwort : </label>
                                    <input type="password" name="pword" id="pword" placeholder="Passwort" required><br>
                                    <button type="submit" class="btn btn-secondary" name="login">Einloggen</button>
                                    </form>';
                                }

                                function show_calc() {
                                    echo '<h2 class="mt-4">Einteilung berechnen</h2><form id="calc" method="post" action="">
                                    <button type="submit" class="btn btn-primary" name="calc">Berechnen</button>
                                    </form>';
                                }

                                function show_switch() {
                                    echo '<h2 class="mt-4">Schüler tauschen</h2><form id="switch" method="post" action="">
                                    <label for="s1">1. Schüler : </label>
                                    <input type="form-control" name="s1" id="s1" placeholder="Max Mustermann" required><label for="k1" class="mx-1">Klasse : </label><input type="form-control" name="k1" id="k1" placeholder="EF"><br>
                                    <label for="s2">2. Schüler : </label>
                                    <input type="form-control" name="s2" id="s2" placeholder="Maja Mustermann" required><label for="k2" class="mx-1">Klasse : </label><input type="form-control" name="k2" id="k2" placeholder="Q1"><br>
                                    <button type="submit" class="btn btn-secondary" id="switch" name="switch">Tauschen</button>
                                    </form>';
                                }

                                function show_line() {
                                    $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $query='SELECT * FROM `deadline` WHERE 1;';

                                    $result=$con->query($query) or die("Fehler : Deadline konnte nicht gelesen werden.");

                                    $result->data_seek(0);
                                    $row=$result->fetch_assoc()["datum"];
                                    mysqli_close($con);
                                    $date=explode(".",$row);
                                    echo '<h2 class="mt-4">Deadline festlegen</h2><form id="create" method="post" action="">
                                    <label for="day">Datum : </label>
                                    <input type="number" min="1" max="31" id="day" value="'.$date[0].'"  name="day" required><input type="number" min="1" max="12" id="month" name="month" value="'.$date[1].'" required>
                                    <button type="submit" class="btn btn-secondary" name="line">Setzen</button>
                                    </form>';
                                }

                                function show_pro() {
                                    echo '<h2 class="mt-4">Projektgruppe erstellen</h2>
                                            <form id="create" method="post" action="">
                                            <label for="titel">Titel : </label>
                                            <input type="form-control" name="titel" id="titel" placeholder="Mustergruppe" required><br>
                                            <label for="limit">Limit : </label>
                                            <input type="number" min="5" max="200" id="limit" value="30"  name="limit" required><br>
                                            <label for="leader">Leiter : </label>
                                            <input type="form-control" name="leader" id="leader" required placeholder="Herr Mustermann"><br>
                                            <label for="descri">Beschreibung : </label>
                                            <textarea class="form-control mb-2" required type="form-control" name="descri" id="descri2" rows="10" placeholder="Musterhafte Muster mustern."></textarea>
                                            <button type="submit" class="btn btn-success" name="create">Erstellen</button>
                                            </form>';
                                }

                                function show_edit($opts) {
                                    $table="projektgruppen";

                                    $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $query='SELECT * FROM `projektgruppen` WHERE 1 ORDER BY titel;';

                                    $result=$con->query($query) or die("Fehler : Projektgruppen konnten nicht gelesen werden.");

                                    mysqli_close($con);

                                    if ($result == false) {
                                        return;
                                    }

                                    echo '<script>
                                    pgs=';
                                    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
                                    echo ';
                                    function selected() {
                                        let titel=document.getElementById("select_titel_edit").value;
                                        if (titel === "") {
                                            document.getElementById("hide_edit").style="display:none;";
                                            return;
                                        }
                                        for (let pg of pgs) {
                                            if (pg.titel === titel) {
                                                document.getElementById("hide_edit").style="display:block;";
                                                document.getElementById("pg_id").value=pg.id;
                                                document.getElementById("edit_titel").value=titel;
                                                document.getElementById("edit_limit").value=pg.lim;
                                                document.getElementById("edit_leader").value=pg.leiter;
                                                document.getElementById("edit_descri").value=pg.beschreibung;
                                                break;
                                            }
                                        }
                                    }
                                    </script>';
                                    echo '<h2 class="mt-4">Projektgruppe bearbeiten</h2>
                                            <form id="edit" method="post" action="">
                                            <label for="select_titel_edit">Alter Titel : </label>
                                            <select class="form-control mb-2" style="max-width: 17rem;" id="select_titel_edit" onchange="selected();" required><option></option>'.$opts.'</select>
                                            <div id="hide_edit" style="display:none;">
                                            <label for="edit_titel">Neuer Titel : </label>
                                            <input type="form-control" name="titel" id="edit_titel" required placeholder="Mustergruppe"><br>
                                            <label for="limit">Neues Limit : </label>
                                            <input type="number" min="5" max="200" id="edit_limit" value="30" name="limit" required><br>
                                            <label for="leader">Neue Leiter : </label>
                                            <input type="form-control" name="leader" id="edit_leader" required placeholder="Herr Mustermann"><br>
                                            <label for="descri">Neue Beschreibung : </label>
                                            <textarea class="form-control mb-2" required type="form-control" name="descri" id="edit_descri" rows="10" placeholder="Musterhafte Muster mustern."></textarea>
                                            <button type="submit" class="btn btn-primary" name="edit">Bearbeiten</button>
                                            </div>
                                            <input type="hidden" name="pg_id" id="pg_id">
                                            </form>';
                                }

                                function show_delete($opts) {
                                    echo '<h2 class="mt-4">Projektgruppen entfernen</h2><form id="delete" method="post" action="">
                                    <b>Nach Entfernen einer Projektgruppe müssen Schüler, die diese gewählt haben, neu wählen. Ebenfalls müssen Schüler, die in dieser Projektgruppe eingeteilt waren, neu eingeteilt werden.</b><br>
                                    <label for="dele">Projektgruppe : </label>
                                    <select class="form-control mb-2" style="max-width: 17rem" name="del" id="dele" required><option></option>'.$opts.'</select>
                                    <button type="submit" class="btn btn-warning mr-2" name="delete">Entfernen</button><button type="submit" class="btn btn-danger" name="deleteall">Alle entfernen</button>
                                    </form>';
                                }

                                function pro() {
                                    $table="projektgruppen";

                                    $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $query='SELECT * FROM `projektgruppen` WHERE 1 ORDER BY titel;';

                                    $result=$con->query($query) or die("Fehler : Projektgruppen konnten nicht gelesen werden.");

                                    mysqli_close($con);

                                    if ($result == false) {
                                        return;
                                    }

                                    $options="";

                                    echo '<table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Titel</th>
                                        <th scope="col">Limit</th>
                                        <th scope="col">Leiter</th>
                                        <th scope="col">Beschreibung</th>
                                      </tr>
                                    </thead>';
                                    for ($x = 0; $x < $result->num_rows; $x++) {
                                        echo '<tr>';
                                        $result->data_seek($x);
                                        $row=$result->fetch_assoc();
                                        echo "<td>".$row["titel"]."</td>";
                                        $options=$options."<option>".$row["titel"]."</option>";
                                        echo "<td>".$row["lim"]."</td>";
                                        echo "<td>".$row["leiter"]."</td>";
                                        echo "<td>".$row["beschreibung"]."</td>";
                                        echo '</tr>';
                                    } 
                                    echo '</table>';
                                    return $options;
                                }

                                function mng_pro() {
                                    echo '<h2 class="mt-4">Projektgruppen einsehen</h2>';
                                    $opts=pro();
                                    show_edit($opts);
                                    show_delete($opts);
                                    show_app();
                                    show_line();
                                    show_ein(true);
                                    show_calc();
                                    show_switch();
                                    reshow("");
                                }

                                function delete_id($i) {
                                    $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $query="SELECT id FROM `projektgruppen` WHERE titel='".$i."';";

                                    $id=$con->query($query) or die("Fehler : Projektgruppen ID konnte nicht gelesen werden.");
                                    $id=$id->fetch_array()[0];

                                    $query="DELETE FROM `projektgruppen` WHERE titel='".$i."';";

                                    $result=$con->query($query) or die("Fehler : Projektgruppe konnte nicht gelöscht werden.");

                                    $query='DELETE FROM `wahl` WHERE wahl1_id='.$id.' OR wahl2_id='.$id.' OR wahl3_id='.$id.' OR wahl4_id='.$id.' OR wahl5_id='.$id.';';

                                    $result=$con->query($query) or die("Fehler : Wahlen konnten nicht gelöscht werden.");

                                    $query='DELETE FROM `einteilung` WHERE pg_id='.$id.';';

                                    $result=$con->query($query) or die("Fehler : Einteilungen konnten nicht gelöscht werden.");

                                    mysqli_close($con);

                                    success_msg("Die Projektgruppe ".$i." wurde gelöscht. Folglich müssen alle Schüler, die diese gewählt hatten, auch neu wählen und neu eingeteilt werden.");

                                }

                                foreach ($_POST as $post) {
                                    if (is_string($post)) {
                                        if (!mb_detect_encoding($post, 'ASCII', true)) {
                                            error_msg('Bitte füllen sie die Felder nur mit Zeichen des englischen Alphabets aus. So wird beispielsweise "ä" zu "ae". Erlaubte Zeichen siehe Wikipedia : <a href="https://de.wikipedia.org/wiki/American_Standard_Code_for_Information_Interchange">ASCII</a>.');
                                            if (isset($_POST["login"])) {
                                                show_login();
                                            } else {
                                                show_pro();
                                                mng_pro();
                                            }
                                            return;
                                        }
                                    }
                                }

                                if (isset($_POST["login"])) {
                                    if (empty($_POST["pword"])) {
                                        error_msg("Bitte geben sie ein Passwort ein.");
                                        show_login();
                                    }
                                    else {
                                        $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                        mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                        $query='SELECT `hash` FROM `schulleiter_passwort` WHERE 1;';

                                        $result=$con->query($query) or die("Fehler : Passwort konnte nicht gelesen werden.");

                                        mysqli_close($con);
                                        if (hash("md5",$_POST["pword"])==$result->fetch_array()[0]) {
                                            success_msg("Anmeldung erfolgreich.");
                                            show_pro();
                                            mng_pro();
                                        }
                                        else {
                                            error_msg("Falsches Passwort.");
                                            show_login();
                                        }
                                    }
                                }
                                elseif (isset($_POST["create"])) {
                                    if (empty($_POST["titel"]) or empty($_POST["descri"]) or empty($_POST["leader"]) or empty($_POST["limit"])) {
                                        error_msg("Bitte füllen sie alle Felder aus.");
                                        show_pro();
                                        mng_pro();
                                    }
                                    else {

                                        $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                        mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                        $query='INSERT INTO `projektgruppen`(`titel`,`lim`,`leiter`, `beschreibung`) VALUES ("'.$_POST["titel"].'",'.$_POST["limit"].',"'.$_POST["leader"].'","'.$_POST["descri"].'");';

                                        $result=$con->query($query) or die("Fehler : Projektgruppe konnte nicht erstellt werden.");

                                        mysqli_close($con);

                                        success_msg("Die Projektgruppe ".$_POST["titel"]." wurde erfolgreich erstellt.");

                                        show_pro();
                                        mng_pro();
                                    }
                                }
                                elseif (isset($_POST["edit"])) {
                                    if (empty($_POST["titel"]) or empty($_POST["descri"]) or empty($_POST["leader"]) or empty($_POST["limit"]) or empty($_POST["pg_id"])) {
                                        error_msg("Bitte füllen sie alle Felder aus.");
                                        show_pro();
                                        mng_pro();
                                    }
                                    else {

                                        $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                        mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                        $query='UPDATE `projektgruppen` SET titel="'.$_POST["titel"].'", lim='.$_POST["limit"].', leiter="'.$_POST["leader"].'", beschreibung="'.$_POST["descri"].'" WHERE id='.$_POST["pg_id"].';';

                                        $result=$con->query($query) or die("Fehler : Projektgruppe konnte nicht bearbeitet werden.");

                                        mysqli_close($con);

                                        success_msg("Die Projektgruppe ".$_POST["titel"]." wurde erfolgreich bearbeitet.");

                                        show_pro();
                                        mng_pro();
                                    }
                                }
                                elseif (isset($_POST["line"])) {
                                    if (empty($_POST["day"]) or empty($_POST["month"])) {
                                        error_msg("Bitte füllen sie alle Felder aus.");
                                    }
                                    else {
                                        if (checkdate($_POST["month"],$_POST["day"],date("Y"))) {
                                            $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                            mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                            $query='DELETE FROM `deadline` WHERE 1;';

                                            $result=$con->query($query) or die("Fehler : Deadline konnte nicht gelöscht werden.");

                                            $date=makeDate($_POST["day"],$_POST["month"]);

                                            $query='INSERT INTO `deadline`(`datum`) VALUES ("'.$date.'");';

                                            $result=$con->query($query) or die("Fehler : Deadline konnte nicht geschrieben werden.");

                                            mysqli_close($con);

                                            success_msg("Die Deadline wurde jetzt auf den ".$date." gesetzt.");
                                        }
                                        else {
                                            error_msg("Kein gültiges Datum angegeben.");
                                        }
                                    }
                                    show_pro();
                                    mng_pro();
                                }
                                elseif (isset($_POST["delete"])) {
                                    delete_id($_POST["del"]);
                                    show_pro();
                                    mng_pro();
                                }
                                elseif (isset($_POST["deleteall"])) {
                                    $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $query="DELETE FROM `projektgruppen` WHERE 1;";

                                    $result=$con->query($query) or die("Fehler : Projektgruppen konnten nicht gelöscht werden.");

                                    $query="DELETE FROM `wahl` WHERE 1;";

                                    $result=$con->query($query) or die("Fehler : Wahlen konnten nicht gelöscht werden.");

                                    $query="DELETE FROM `einteilung` WHERE 1;";

                                    $result=$con->query($query) or die("Fehler : Einteilung konnte nicht gelöscht werden.");

                                    mysqli_close($con);
                                    success_msg("Alle Projektgruppen wurden gelöscht. Folglich müssen alle Schüler auch neu wählen und neu eingeteilt werden.");
                                    show_pro();
                                    mng_pro();
                                }
                                elseif (isset($_POST["switch"])) {
                                    $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $s_ids=[0,0];
                                    $pg_ids=[0,0];
                                    for ($s=0; $s <=1; $s++) {
                                        $klasse=NULL;
                                        if (array_key_exists("k".($s+1), $_POST)) {
                                            $klasse=$_POST["k".($s+1)];
                                        }

                                        $query='SELECT s_id from `schueler` WHERE s_name="'.$_POST["s".($s+1)].'"';

                                        if (!empty($klasse)) {
                                            $query.=' AND s_klasse="'.$_POST["k".($s+1)].'"';
                                        }
                                        $query.=";";

                                        $result=$con->query($query) or die("Fehler : Schüler konnten nicht gelesen werden.");

                                        if ($result->num_rows == 0) {
                                            error_msg("Es gibt keinen Schüler mit dem Namen ".$_POST["s1"].(!empty($klasse) ? " in der Klasse ".$klasse:"").".");
                                            break;
                                        }
                                        elseif ($result->num_rows > 1) {
                                            error_msg("Es gibt mehrere Schüler mit dem Namen ".$_POST["s1"].". Bitte geben sie zusätzlich noch die Klasse an.");
                                            break;
                                        }

                                        $s_ids[$s]=$result->fetch_array()[0];

                                        $query='SELECT pg_id from `einteilung` WHERE s_id='.$s_ids[$s].';';

                                        $result=$con->query($query) or die("Fehler : pg_id konnte nicht gelesen werden.");

                                        if ($result->num_rows == 0) {
                                            error_msg("Der Schüler mit dem Namen ".$_POST["s".($s+1)]." ist noch nicht eingeteilt.");
                                        }

                                        $pg_ids[$s]=$result->fetch_array()[0];
                                    }

                                    $query='UPDATE `einteilung` SET `pg_id`='.$pg_ids[1].' WHERE s_id='.$s_ids[0].';'; // Erster Schüler bekommt PG vom Zweiten
                                    $con->query($query) or die("Fehler : Update Query 1 gescheitert.");
                                    $query='UPDATE `einteilung` SET `pg_id`='.$pg_ids[0].' WHERE s_id='.$s_ids[1].';'; // Zweiter Schüler bekommt PG vom Ersten
                                    $con->query($query) or die("Fehler : Update Query 2 gescheitert.");
                                    success_msg("Die Schüler ".$_POST["s1"]." und ".$_POST["s2"]." wurden erfolgreich vertauscht.");

                                    mysqli_close($con);
                                    show_pro();
                                    mng_pro();
                                }
                                elseif (isset($_POST["reshow"])) {
                                    show_pro();
                                    mng_pro();
                                }
                                elseif (isset($_POST["calc"])) {
                                    //Do calculation stuff here
                                    $verplant=[];
                                    $frei=[];
                                    $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $query="SELECT id,lim FROM `projektgruppen` WHERE 1;";

                                    $result=$con->query($query) or die("Fehler : IDs und lims konnten nicht gelesen werden.");

                                    for ($n=1; $n <= 5; $n++) {
                                        for ($z=0; $z < $result->num_rows; $z++) {
                                            $result->data_seek($z);
                                            $a=$result->fetch_array();
                                            $query="SELECT s_id FROM `wahl` WHERE wahl".$n."_id=".$a[0].";";
                                            $resa=$con->query($query) or die("Fehler : Konnte s_id nicht lesen.");
                                            $breakme=false;
                                            $array=[];
                                            for ($s=0; $s < $resa->num_rows; $s++) {
                                                $resa->data_seek($s);
                                                array_push($array,$resa->fetch_array()[0]);
                                            }
                                            shuffle($array);
                                            foreach ($array as $arr) {
                                                $a[1]=$a[1]-1;
                                                if ($a[1] == 0) {
                                                    $breakme=true;
                                                    break;
                                                }
                                                if (isset($verplant[$arr])) {
                                                    continue;
                                                }
                                                $verplant[$arr]=true;
                                                $query="DELETE FROM `einteilung` WHERE s_id=".$arr.";";
                                                $res=$con->query($query) or die("Fehler : Konnte nicht löschen.");
                                                $query='INSERT INTO `einteilung`(`s_id`, `pg_id`) VALUES ('.$arr.','.$a[0].');';
                                                $res=$con->query($query) or die("Fehler : Konnte nicht inserten.");
                                            }
                                            if ($a[1] != 0) {
                                                array_push($frei,$a);
                                            }
                                            if ($breakme) {
                                                break;
                                            }
                                        }
                                    }

                                    $query="SELECT s_id FROM `schueler` WHERE 1;";

                                    $result=$con->query($query) or die("Fehler : IDs konnten nicht gelesen werden.");

                                    for ($s=0; $s < $result->num_rows; $s++) {
                                        $result->data_seek($s);
                                        $arr=$result->fetch_array()[0];
                                        if (isset($verplant[$arr])) {
                                            continue;
                                        }
                                        $c=count($frei);
                                        if ($c == 0) {
                                            error_msg("Nicht genügend freie Plätze vorhanden.");
                                            break;
                                        }
                                        $i=mt_rand(0,$c-1);
                                        
                                        $frei[$i][1]=$frei[$i][1]-1;
                                        if ($frei[$i][1] == 0) {
                                            unset($frei[$i]);
                                        }
                                        $query="DELETE FROM `einteilung` WHERE s_id=".$arr.";";
                                        $res=$con->query($query) or die("Fehler : Konnte nicht löschen.");
                                        $query='INSERT INTO `einteilung`(`s_id`, `pg_id`) VALUES ('.$arr.','.$frei[$i][0].');';
                                        $res=$con->query($query) or die("Fehler : Konnte nicht inserten.");
                                        //$verplant[$arr]=true;
                                    }

                                    mysqli_close($con);
                                    success_msg("Berechnung abgeschlossen.");
                                    show_pro();
                                    mng_pro();
                                }
                                else {
                                    show_login();
                                }
                            ?>
                        </div>
                        <hr>
                        <a href="https://www.clara-online.de">Clara-Schumann-Gymnasium</a><a> - </a><a href="/pwo">Projektwochenorganisator</a><a> © </a><a href="https://www.github.com/appgurueu">Lars Müller</a>
                    </div>
                </div>
            </div>
        <!--</div>-->

    </body>

</html>