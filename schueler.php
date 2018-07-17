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
        <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEACABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAABfX18AAAAAAPLy8gAvMJQAPT09AOLi4gC3t7cAKCmNAPT09ABqamoAJieKAKenpwB8fHwA5OTkAMLCwgD29vYAKixrAMvLywBgX8MAKCmMAN3d3QCHh4cA5ubmAC4vlADv7+8AYWHFACsrjgDf398A8fHxAC4vkwD6+voAz8/PAHl5eQAsLZAA4eHhAGFhxAAqK40AyMjIAC8xlQBycnIAJiaJAOzs7ADBwcEA9fX1AMrKygB0dHQA09PTACcoiwC6uroAw8PDAPf39wBtbW0AYGDEAHZ2dgApKo0A5+fnAPDw8AAtLpIA+fn5AM7OzgCjo6MAKyyPANfX1wCBgYEAioqKAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAANTU1NTU1NTU1NTU1NTU1ATUrKysrKysCAisrKysrNQE1KykWFUA3AgIJCT8FKzUBNSsYLTwLJwICMQkGDSs1ATUrOBsUJTMCAiIABgIrNQE1KwIcHy07AgIiCSwCKzUBNSsrDg4qJwICFAkRAis1ATUrDwwODgwCAgwMLgIrNQE1Kw8MDCAMAgICDC4CKzUBNSs6Mg8rCAICHDgYAis1ATUrHjoyDysICAIcOBgrNQEQHR05IT0aJCQ2Ey8KKBABEAMDHRkZIzQ0NBI2Ey8QARAmJgMXHTkhIT0aJDYHEAEQEDAEEBAQEBAQEDAEEBABAQE+NQEBAQEBAQE+NQEBAQABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAAABAAAAAQAAAAEAAM/nAAA=" rel="icon" type="image/x-icon" />

        <!-- Scripts and stylesheets -->
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

        <!--<div class="jumbotron" style="background-color:rgba(0,0,0,0)">-->
            <div class="container">
                <div class="row">
                    <div class="col-lg" style="display:inline-block;height:100%;">
                        <img class="img-fluid" src="pwo_banner.png" alt="PWO Banner" style="width:100%;-ms-interpolation-mode: bicubic; image-rendering: optimizeQuality;">
                        <div>
                            <h1>Schüler</h1>
                            <?php
                                error_reporting( E_ALL );
                                require 'error_msgs.php';
                                if (isset($_GET["id"])) {
                                    $GLOBALS["id"]=$_GET["id"];
                                }

                                foreach ($_POST as $post) {
                                    if (is_string($post)) {
                                        if (!mb_detect_encoding($post, 'ASCII', true)) {
                                            error_msg('Bitte füllen sie die Felder nur mit Zeichen des englischen Alphabets aus. So wird beispielsweise "ä" zu "ae". Erlaubte Zeichen siehe Wikipedia : <a href="https://de.wikipedia.org/wiki/American_Standard_Code_for_Information_Interchange">ASCII</a>.');
                                            if (isset($_POST["login"])) {
                                                show_login();
                                            } else {
                                                mng_pro();
                                            }
                                            return;
                                        }
                                    }
                                }

                                if (isset($_POST["login"])) {
                                    if (empty($_POST["pword"])) {
                                        error_msg("Bitte füllen sie alle Felder aus.");
                                        show_login();
                                    }
                                    else {
                                        $table="schueler";

                                        $con = mysqli_connect('localhost', "root", "", "test") or die( "Unable to connect." );

                                        mysqli_select_db($con,"test") or die( "Unable to connect." );
                                        $pword=hash("md5",$_POST["pword"]);
                                        $query='SELECT s_id FROM '.$table.' WHERE s_username="'.$_POST["name"].'" AND s_pword="'.$pword.'";';
                                        $result=$con->query($query);
                                        if ($result != false) {
                                            if ($result->num_rows == 1) {
                                                $GLOBALS["id"]=$result->fetch_array()[0];
                                                success_msg("Anmeldung erfolgreich.");
                                                mng_pro();
                                            }
                                            else {
                                                error_msg("Benutzername/Passwort falsch.");
                                                show_login();
                                            }
                                        }
                                        else {
                                            error_msg("Benutzername/Passwort falsch.");
                                            show_login();
                                        }
                                        mysqli_close($con);
                                    }
                                }
                                elseif (isset($_POST["reshow"])) {
                                    mng_pro();
                                }
                                elseif (isset($_POST["choice"])) {
                                    $unique=[];
                                    for ($x = 1; $x < 6; $x++) {
                                        array_push($unique,$_POST[$x."choice"]);
                                    }
                                    if (count(array_unique($unique)) < 5) {
                                        error_msg("Mehrmals die gleiche Projektgruppe zu wählen ist nicht erlaubt.");
                                        mng_pro();
                                    }
                                    else {
                                        $uni=[];

                                        $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                        mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                        foreach ($unique as $item) {
                                            $query='SELECT id FROM `projektgruppen` WHERE titel="'.$item.'";';
                                            $result=$con->query($query) or die("Fehler : ID konnte nicht ermittelt werden.");
                                            array_push($uni,$result->fetch_array()[0]);
                                        }
                                        $result=$con->query('DELETE FROM `wahl` WHERE s_id='.$GLOBALS["id"].';') or die("Fehler : Wahl konnte nicht gelöscht werden.");

                                        $query='INSERT into `wahl` (s_id, wahl1_id, wahl2_id, wahl3_id, wahl4_id, wahl5_id) values('.$GLOBALS["id"].', '.$uni[0].', '.$uni[1].', '.$uni[2].', '.$uni[3].', '.$uni[4].');';

                                        $result=$con->query($query) or die("Fehler : Wahl konnte nicht eingetragen werden.");

                                        mysqli_close($con);

                                        success_msg("Wahl erfolgreich.");
                                        mng_pro();
                                    }
                                }
                                else {
                                    show_login();
                                }

                                function show_login() {
                                    echo '<h2>Einloggen</h2>
                                    <form id="login" method="post" action="";>
                                    <label for="name">Benutzername : </label>
                                    <input type="form-control" name="name" id="name" placeholder="mustmax" required><br>
                                    <label for="pword">Passwort : </label>
                                    <input type="password" name="pword" id="pword" placeholder="Passwort" required><br>
                                    <button type="submit" class="btn btn-secondary" name="login">Einloggen</button>
                                    </form>';
                                }

                                function show_choice($opts) {
                                    echo '<h2>Projektgruppen wählen</h2><form id="choice" method="post" action="?id='.$GLOBALS["id"].'">';
                                    $val=deadline();
                                    $bonus=" ";
                                    if (!$val) {
                                        echo "<b>Die Deadline ist leider schon abgelaufen.</b><br>";
                                        $bonus=" disabled ";
                                    }
                                    else {
                                        echo "<b>Deadline : ".$val."</b><br>";
                                    }
                                    for ($x=1; $x < 6; $x++) {
                                        echo '<label for="'.$x.'id">'.$x.'. Wahl : </label>
                                        <select'.$bonus.'required class="form-control" name="'.$x.'choice" id="'.$x.'id">'.$opts[$x-1].'</select><br>';
                                    }
                                    echo '<button'.$bonus.'type="submit" class="btn btn-secondary" name="choice">Wählen</button></form>';
                                }

                                function pro() {

                                    $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $query='SELECT * FROM `projektgruppen` WHERE 1;';

                                    $result=$con->query($query) or die("Fehler : Projektgruppen konnten nicht gelesen werden.");

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

                                    mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

                                    $query='SELECT * FROM `wahl` WHERE s_id='.$GLOBALS["id"].';';

                                    $r=$con->query($query) or die("Fehler : Deadline konnte nicht gelesen werden.");

                                    $array=[];

                                    if ($r->num_rows > 0) {
                                        $r->data_seek(0);
                                        $row=$r->fetch_assoc();

                                        for ($x = 1; $x <= 5; $x++) {
                                            $query='SELECT titel FROM `projektgruppen` WHERE id='.$row["wahl".$x."_id"].';';
                                            $temp=$con->query($query) or die("Fehler : Titel konnte nicht gelesen werden.");
                                            array_push($array,$temp->fetch_array()[0]);
                                        }
                                    }
                                    mysqli_close($con);
                                    for ($x = 0; $x < $result->num_rows; $x++) {
                                        echo '<tr>';
                                        $result->data_seek($x);
                                        $row=$result->fetch_assoc();
                                        echo "<td>".$row["titel"]."</td>";
                                        echo "<td>".$row["lim"]."</td>";
                                        echo "<td>".$row["leiter"]."</td>";
                                        echo "<td>".$row["beschreibung"]."</td>";
                                        echo '</tr>';
                                    }
                                    $options=[];
                                    for ($y = 0; $y < 5; $y++) {
                                        $opti="<option></option>";
                                        for ($x = 0; $x < $result->num_rows; $x++) {
                                            $result->data_seek($x);
                                            $row=$result->fetch_assoc();
                                            $opti=$opti."<option".((isset($array[$y]) and $array[$y]==$row["titel"]) ? " selected":"").">".$row["titel"]."</option>";
                                        }
                                        array_push($options,$opti);
                                    }
                                    echo '</table>';
                                    return $options;
                                }

                                function mng_pro() {
                                    echo '<h2>Projektgruppen einsehen</h2>';
                                    show_choice(pro());
                                    show_app();
                                    show_ein();
                                    reshow('?id='.$GLOBALS["id"]);
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