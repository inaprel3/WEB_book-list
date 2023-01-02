<?php
    $f = fopen(__DIR__ . "/users.txt",  "r");
    $i = 0;
    while(!feof($f)) {
        $rowStr = fgets($f);
        $rowArr = explode(";", $rowStr);
        $data['users'][$i]["name"] = $rowArr[0];
        $data['users'][$i]["pwd"] = $rowArr[1];
        $data['users'][$i]["rights"] = $rowArr[2];
        $i++;
    }
    fclose($f);
?>