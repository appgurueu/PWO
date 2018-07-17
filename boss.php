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
                                    echo '<h2>Einloggen</h2>
                                    <form id="login" method="post" action="">
                                    <label for="pword">Passwort : </label>
                                    <input type="password" name="pword" id="pword" placeholder="Passwort" required><br>
                                    <button type="submit" class="btn btn-secondary" name="login">Einloggen</button>
                                    </form>';
                                }
                                function show_calc() {
                                    echo '<h2>Einteilung berechnen</h2><form id="calc" method="post" action="">
                                    <button type="submit" class="btn btn-secondary" name="calc">Berechnen</button>
                                    </form>';
                                }
                                function show_switch() {
                                    echo '<h2>Schüler tauschen</h2><form id="switch" method="post" action="">
                                    <label for="s1">1. Schüler : </label>
                                    <input type="form-control" name="s1" id="s1" placeholder="Max Mustermann" required><br>
                                    <label for="s2">2. Schüler : </label>
                                    <input type="form-control" name="s2" id="s2" placeholder="Maja Mustermann" required><br>
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
                                    echo '<h2>Deadline festlegen</h2><form id="create" method="post" action="">
                                    <label for="day">Datum : </label>
                                    <input type="number" min="1" max="31" id="day" value="'.$date[0].'"  name="day" required><input type="number" min="1" max="12" id="month" name="month" value="'.$date[1].'" required>
                                    <button type="submit" class="btn btn-secondary" name="line">Setzen</button>
                                    </form>';
                                }
                                function show_pro() {
                                    echo '<h2>Projektgruppe erstellen</h2>
                                            <form id="create" method="post" action="">
                                            <label for="titel">Titel : </label>
                                            <input type="form-control" name="titel" id="titel" placeholder="Mustergruppe" required><br>
                                            <label for="limit">Limit : </label>
                                            <input type="number" min="5" max="200" id="limit" value="30"  name="limit" required><br>
                                            <label for="leader">Leiter : </label>
                                            <input type="form-control" name="leader" id="leader" required placeholder="Herr Mustermann"><br>
                                            <label for="descri">Beschreibung : </label>
                                            <textarea class="form-control" required type="form-control" name="descri" id="descri2" rows="10" placeholder="Musterhafte Muster mustern."></textarea><br>
                                            <button type="submit" class="btn btn-secondary" name="create">Erstellen</button>
                                            </form>';
                                }

                                function pro() {
                                    $table="projektgruppen";

                                    $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $query='SELECT * FROM `projektgruppen` WHERE 1;';

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
                                    echo '<h2>Projektgruppen einsehen</h2>';
                                    $opts=pro();
                                    show_app();
                                    echo '<h2>Projektgruppen entfernen</h2><form id="delete" method="post" action="">
                                    <b>Nach Entfernen einer Projektgruppe müssen Schüler, die diese gewählt haben, neu wählen. Ebenfalls müssen Schüler, die in dieser Projektgruppe eingeteilt waren, neu eingeteilt werden.</b><br>
                                    <label for="dele">Projektgruppe : </label>
                                    <select class="form-control" name="del" id="dele" required><option></option>'.$opts.'</select><br>
                                    <button type="submit" class="btn btn-secondary" name="delete">Entfernen</button><a>   </a><button type="submit" class="btn btn-secondary" name="deleteall">Alle entfernen</button>
                                    </form>';
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
                                    if (empty($_POST["titel"]) or empty($_POST["descri"]) or empty($_POST["leader"])) {
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

                                    /*$query="SELECT id FROM `projektgruppen` WHERE 1;";

                                    $rid=$con->query($query) or die("Fehler : Projektgruppen IDs konnten nicht gelesen werden.");
                                    for ($z=0; $z < $rid->num_rows; $z++) {
                                        $rid->data_seek($z);
                                        $id=$rid->fetch_array()[0];

                                        $query='DELETE FROM `wahl` WHERE wahl1_id='.$id.' OR wahl2_id='.$id.' OR wahl3_id='.$id.' OR wahl4_id='.$id.' OR wahl5_id='.$id.';';

                                        $result=$con->query($query) or die("Fehler : Wahlen konnten nicht gelöscht werden.");

                                        $query='DELETE FROM `einteilung` WHERE pg_id='.$id.';';

                                        $result=$con->query($query) or die("Fehler : Einteilungen konnten nicht gelöscht werden.");
                                    */

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

                                    $query='SELECT s_id from `schueler` WHERE s_name="'.$_POST["s1"].'";';

                                    $result=$con->query($query) or die("Fehler : Schüler konnten nicht gelesen werden.");

                                    if ($result->num_rows == 0) {
                                        error_msg("Es gibt keinen Schüler mit dem Namen ".$_POST["s1"].".");
                                    }
                                    else {
                                        $s1_id=$result->fetch_array()[0];

                                        $query='SELECT s_id from `schueler` WHERE s_name="'.$_POST["s2"].'";';

                                        $result=$con->query($query) or die("Fehler : Schüler konnten nicht gelesen werden.");

                                        if ($result->num_rows == 0) {
                                            error_msg("Es gibt keinen Schüler mit dem Namen ".$_POST["s2"].".");
                                        }
                                        else {
                                            $s2_id=$result->fetch_array()[0];

                                            $query='SELECT pg_id from `einteilung` WHERE s_id='.$s2_id.';';

                                            $result=$con->query($query) or die("Fehler : pg_id konnte nicht gelesen werden.");

                                            if ($result->num_rows == 0) {
                                                error_msg("Der Schüler mit dem Namen ".$_POST["s2"]." ist noch nicht eingeteilt.");
                                            }
                                            else {
                                                $s2_val=$result->fetch_array()[0];

                                                $query='SELECT pg_id from `einteilung` WHERE s_id='.$s1_id.';';

                                                $result=$con->query($query) or die("Fehler : pg_id konnte nicht gelesen werden.");

                                                if ($result->num_rows == 0) {
                                                    error_msg("Der Schüler mit dem Namen ".$_POST["s1"]." ist noch nicht eingeteilt.");
                                                }
                                                else {
                                                    $s1_val=$result->fetch_array()[0];
                                                    $query='UPDATE `einteilung` SET `pg_id`='.$s2_val.' WHERE s_id='.$s1_id.';';
                                                    $con->query($query) or die("Fehler : Update Query 1 gescheitert.");
                                                    $query='UPDATE `einteilung` SET `pg_id`='.$s1_val.' WHERE s_id='.$s2_id.';';
                                                    $con->query($query) or die("Fehler : Update Query 2 gescheitert.");
                                                    success_msg("Die Schüler ".$_POST["s1"]." und ".$_POST["s2"]." wurden erfolgreich vertauscht.");
                                                }
                                            }
                                            //SWAP 'EM
                                        }
                                    }
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
                                                echo $query;
                                                $res=$con->query($query) or die("Fehler : Konnte nicht inserten.");
                                            }
                                            if ($a[1] != 0) {
                                                $frei[$a[0]]=$a[1];
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
                                        }
                                        $i=mt_rand(0,$c-1);
                                        $frei[$i]=$frei[$i]-1;
                                        if ($frei[$i] == 0) {
                                            unset($frei[$i]);
                                        }
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