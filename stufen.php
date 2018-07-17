<?php
$stufen=[];
$letters=["a","b","c","d"];
for ($s=5; $s <= 9; $s++) {
    foreach ($letters as $letter) {
        array_push($stufen,$s.$letter);
    }
}
array_push($stufen,"9e");
array_push($stufen,"EF");
array_push($stufen,"Q1");
array_push($stufen,"Q2");
$GLOBALS["stufen"]=$stufen;
?>