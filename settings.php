<?php
/*
 * Domai CIM
 * 哆麦客户信息管理系统
 * Copryright @2018 Hito https://www.hitoy.org/
 *
 * 系统初始化
 */

if(file_exists('./config.php')){
    header('Location: /install/');
    die;
}
require_once('config.php');
if(defined('DEBUG') && DEBUG == true){
    error_reporting(E_ERROR|E_WARNING|E_PARSE);
}else{
    error_reporting(0);
}

require_once(ABSPATH.'lib/class.db.php');
$dmdb = new DM_DB(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
