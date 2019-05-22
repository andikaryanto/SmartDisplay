<?php 
function fileconfig_ftp(){
    $config['hostname'] = 'ftp://192.168.1.122';
    $config['username'] = 'Administrator';
    $config['password'] = 'p@ssw0rd';
    $config['port']     = 21;
    $config['debug']    = TRUE;

    return $config;
}