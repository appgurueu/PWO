<?php
    require "stufen.php";

    //echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>';
    
    function error_msg($error) {
        echo '<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="Fehler" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="error">Fehler</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden=hg"true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="alert alert-danger">
            <strong>Fehler !</strong> '.$error.'
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
            </div>
        </div>
        </div>
        <script type="text/javascript">
    $(window).on("load",function(){
        $("#errorModal").modal("show");
    });
    </script>';
        //echo "<div class=\"modal\" id=\"modalfillin\" style=\"display:block;\"><div class=\"modal-content\"><input type=\"button\" class=\"close\" onclick=\"disable_popup('modalfillin');\" value=\"&times;\"/><a>".$error."</a><br><br></div></div>";
    }

    function success_msg($error) {
        echo '<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="Fehler" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="error">Erfolg</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden=hg"true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="alert alert-success">
            <strong>Erfolg !</strong> '.$error.'
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok</button>
            </div>
            </div>
        </div>
        </div>
        <script type="text/javascript">
    $(window).on("load",function(){
        $("#errorModal").modal("show");
    });
    </script>';
    }

    function deadline() {
        $d=date("Y.m.d");
        $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

        mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

        $query='SELECT * FROM `deadline` WHERE 1;';

        $result=$con->query($query) or die("Fehler : Deadline konnte nicht gelesen werden.");

        $result->data_seek(0);
        $row=$result->fetch_assoc()["datum"];
        mysqli_close($con);
        $c=date_format(DateTime::createFromFormat("d.m.Y",$row),"Y.m.d");
        if ($c < $d) {
            return false;
        }
        return $row;
    }

    function show_app() {
        echo '<h2 class="mt-4">Wahl einsehen</h2>';
        echo 'Chance bezeichnet die Wahrscheinlichkeit, mit der jeweiligen Wahl in eine Projektgruppe zu kommen. Es ist zu beachten, dass sich diese Chancen noch ändern können.';
        echo '<table class="table">
        <thead>
          <tr>
            <th scope="col">Titel</th>
            <th scope="col">1. Wahl</th>
            <th scope="col">Chance</th>
            <th scope="col">2. Wahl</th>
            <th scope="col">Chance</th>
            <th scope="col">3. Wahl</th>
            <th scope="col">Chance</th>
            <th scope="col">4. Wahl</th>
            <th scope="col">Chance</th>
            <th scope="col">5. Wahl</th>
            <th scope="col">Chance</th>
          </tr>
        </thead>';

        $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

        mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

        $query='SELECT titel, id, lim FROM `projektgruppen` WHERE 1 ORDER BY titel;';

        $result=$con->query($query) or die("Fehler : Projektgruppen konnten nicht gelesen werden.");

        for ($x = 0; $x < $result->num_rows; $x++) {
            $result->data_seek($x);
            $row=$result->fetch_array();
            echo "<tr>";
            echo "<td>".$row[0]."</td>";

            $free=0;
            for ($y = 1; $y <= 5; $y++) {
                $query='SELECT s_id FROM `wahl` WHERE wahl'.$y.'_id='.$row[1].';';
                $res=$con->query($query) or die("Fehler : Wähler konnten nicht gelesen werden.");
                if ($y==1) {
                    $free=$row[2];
                }
                $free=$free-$res->num_rows;
                echo "<td>".$res->num_rows."</td>";
                echo "<td>".(min(100,max(0,$free)/($res->num_rows+1)*100))." %</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        mysqli_close($con);
    }

    function show_ein($nope=false) {
        echo '<h2 class="mt-4">Einteilung einsehen</h2>';
        $val=deadline();

        if ($val and !$nope) {
            echo '<b>Die Einteilung steht noch nicht fest.</b>';
            return;
        }

        $con = mysqli_connect('localhost', "root", "", "test") or die( "Fehler : Keine Verbindung." );

        if (!$nope) {

            mysqli_select_db($con,"test") or die( "Fehler : Keine Verbindung." );

            $query='SELECT pg_id FROM `einteilung` WHERE s_id='.$GLOBALS["id"].';';

            $result=$con->query($query) or die("Fehler : Einteilung konnte nicht gelesen werden.");

            if ($result->num_rows == 0) {
                echo '<b>Deine Einteilung steht noch nicht fest.</b>';
            }
            else {
                $query='SELECT titel FROM `projektgruppen` WHERE id='.$result->fetch_array()[0].';';
                $result=$con->query($query) or die("Fehler : Titel konnte nicht gelesen werden.");
                echo 'Deine Projektgruppe : <b>'.$result->fetch_array()[0].'</b>';
            }
        }
        echo '<div class="accordion" id="accordionExample">
        <div class="card">
          <div class="card-header" id="headingOne">
            <h3 class="mb-0">
              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Stufen
              </button>
            </h3>
          </div>
      
          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body"><div class="accordion" id="klassen">';
        foreach ($GLOBALS["stufen"] as $stufe) {
            echo '<div class="card">
            <div class="card-header" id="'.$stufe.'heading">
              <h3 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#'.$stufe.'" aria-expanded="false" aria-controls="'.$stufe.'">
                '.$stufe.'
                </button>
              </h3>
            </div>
            <div id="'.$stufe.'" class="collapse" aria-labelledby="'.$stufe.'heading" data-parent="#klassen">
              <div class="card-body">';
              $query='SELECT s_id,s_name FROM `schueler` WHERE s_klasse="'.$stufe.'";';
              $result=$con->query($query) or die("Fehler : s_id konnte nicht gelesen werden.");
              echo '<table class="table">
              <thead>
              <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Projektgruppe</th>
              </tr>
              </thead>';
              for ($i=0; $i < $result->num_rows; $i++) {
                  $result->data_seek($i);
                  $a=$result->fetch_array();
                  echo "<tr><td>".$a[1]."</td>";
                  $query='SELECT pg_id FROM `einteilung` WHERE s_id='.$a[0].';';
                  $res=$con->query($query) or die("Fehler : pg_id konnte nicht gelesen werden.");
                  if ($res->num_rows > 0) {
                      $query='SELECT titel FROM `projektgruppen` WHERE id='.$res->fetch_array()[0].';';
                      $res=$con->query($query) or die("Fehler : titel konnte nicht gelesen werden.");
                      if ($res->num_rows > 0) {
                          echo "<td>".$res->fetch_array()[0]."</td>";
                      }
                  }
                  echo "</tr>";
              }
              echo "</table>";
           echo   '</div>
            </div>
          </div>';
        }
        echo '</div></div>
          </div>
        </div>
        <div class="card">
          <div class="card-header" id="headingTwo">
            <h3 class="mb-0">
              <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Gruppen
              </button>
            </h3>
          </div>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body" id="klassen2">';
        $query='SELECT titel, id FROM `projektgruppen` WHERE 1 ORDER BY titel;';
        $result=$con->query($query) or die("Fehler : Titel konnte nicht gelesen werden.");
        $arr=[];
        for ($i=0; $i < $result->num_rows; $i++) {
            $result->data_seek($i);
            array_push($arr,$result->fetch_array());
        }
        foreach ($arr as $st) {
            $stufe=$st[0];
            $query='SELECT s_id FROM `einteilung` WHERE pg_id='.$st[1].';';
            $result=$con->query($query) or die("Fehler : s_id konnte nicht gelesen werden.");
            if ($result->num_rows > 0) {
                $query='SELECT s_name,s_klasse FROM `schueler` WHERE s_id='.$result->fetch_array()[0].';';
                $result=$con->query($query) or die("Fehler : s_name und s_klasse konnten nicht gelesen werden.");
            }
            echo '<div class="card">
            <div class="card-header" id="'.$stufe.'heading">
              <h3 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#'.$stufe.'" aria-expanded="false" aria-controls="'.$stufe.'">
                '.$stufe.'
                </button>
              </h3>
            </div>
            <div id="'.$stufe.'" class="collapse" aria-labelledby="'.$stufe.'heading" data-parent="#klassen2">
              <div class="card-body">';
              echo '<table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Klasse</th>
            </tr>
            </thead>';
            for ($i=0; $i < $result->num_rows; $i++) {
                $result->data_seek($i);
                $a=$result->fetch_array();
                echo "</tr><td>".$a[0]."</td>";
                echo "<td>".$a[1]."</td></tr>";
            }
            echo "</table>";
                echo '</div>
            </div>
          </div>';
        }
        //PROJEKTGRUPPEN !
        echo    '</div>
          </div>
        </div>
         </div>';
        mysqli_close($con);
    }
    function reshow($param) {
        echo '<h2 class="mt-4">Seite aktualisieren</h2>
        <form id="reshow" method="post" action="'.$param.'">
        <button type="submit" class="btn btn-secondary" name="reshow">Aktualisieren</button>
        </form>';
    }
    echo '<script>
    function enable_popup(popup) {
    document.getElementById(popup).style.display="block";
    }
    function disable_popup(popup) {
    //document.getElementById(popup).innerHTML=document.getElementById("saved").innerHTML;
    document.getElementById(popup).style.display="none";
    }
    </script>';
?>