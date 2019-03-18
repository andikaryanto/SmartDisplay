<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function submission_upload_config($filename = null){
    $config['upload_path']          = './uploads/submission_files/';
    $config['allowed_types']        = 'jpg|png|pdf|doc|docx';
    $config['max_size']             = 1000;
    $config['max_width']            = 10240;
    $config['max_height']           = 7680;
    $config['file_name']            = $filename;
    return $config;
}

function company_upload_config($filename = null){
    $config['upload_path']          = './assets/resources/logo/';
    $config['allowed_types']        = 'jpg|png';
    $config['max_size']             = 1000;
    $config['max_width']            = 10240;
    $config['max_height']           = 7680;
    $config['file_name']            = $filename;
    return $config;
}



function userprofile_upload_config($filename = null){
    $config['upload_path']          = './assets/user_profile/';
    $config['allowed_types']        = 'jpg|png';
    $config['max_size']             = 1000;
    $config['max_width']            = 10240;
    $config['max_height']           = 7680;
    $config['file_name']            = $filename;
    return $config;
}

function database_config($database){
    $config['hostname'] = 'localhost';
    $config['username'] = 'root';
    $config['password'] = '';
    $config['database'] = $database;
    $config['dbdriver'] = 'mysqli';
    $config['dbprefix'] = '';
    $config['pconnect'] = FALSE;
    $config['db_debug'] = TRUE;
    $config['cache_on'] = FALSE;
    $config['cachedir'] = '';
    $config['char_set'] = 'utf8';
    $config['dbcollat'] = 'utf8_general_ci';
    return $config;
}