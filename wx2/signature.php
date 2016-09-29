<?php
    $card=array();
    array_push($card, "E0o2-at6NcC2OsJiQTlwlB1hmnGdjLjHUIdtx_LjM052M7YpnxeZif6p7IYQW75T5yZR20Zdc4Oc5dwHyLS5vA");
    array_push($card, "1453823443");
    array_push($card, "2Gw4uGgC9Z7dkI8S");
    array_push($card, "pXi3vs6pDrmUa4OElEbK7liGleFI");
    echo '<pre>';
    print_r($card);    
    sort($card,SORT_STRING);
    echo '<pre>';
    print_r($card);
    $sign = sha1(implode($card));
    echo $sign;
?>