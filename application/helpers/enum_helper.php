<?php 

function typeTrans_enum(){
    $enums['income'] = 1;
    $enums['expense'] = 2;
    $enums['other'] =3;

    return $enums;
}

function playerstatus_enum(){
    $enums['available'] = 1;
    $enums['registered'] = 2;
    $enums['notregistered'] = 3;
    $enums['notlisted'] = 4;
    return $enums;
}

function playerstatusarr_enum($strstatus){
    $status['code'] = playerstatus_enum()[$strstatus];
    $status['status'] = $strstatus;
    return $status;
}