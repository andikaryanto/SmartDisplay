<?php 
function fileconfig_ftp(){
    $config['hostname'] = 'ftp://SysdevMurni';
    $config['username'] = 'andik';
    $config['password'] = 'ratrace182';
    $config['port']     = 21;
    $config['debug']    = TRUE;

    return $config;
}