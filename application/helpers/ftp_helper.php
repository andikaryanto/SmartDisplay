<?php 
function fileconfig_ftp(){
    $config['hostname'] = 'ftp://localhost';
    $config['username'] = 'Komputer';
    $config['password'] = 'ratrace182';
    $config['port']     = 21;
    $config['debug']    = TRUE;

    return $config;
}