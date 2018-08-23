<?php
/**
 * Domai CIM
 * 哆麦客户信息管理系统 
 * Copyright @2018 Hito https://www.hitoy.org
 *
 * 系统基础配置文件
 *
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** Domai数据库的名称 */
define('DB_NAME','domai');

/** MySQL数据库用户名 */
define('DB_USER','root');

/** MySQL数据库密码 */
define('DB_PASSWORD','');

/** MySQL主机 */
define('DB_HOST','localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET','utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE','utf8mb4_unicode_ci');

/**
 * Domai数据表前缀。
 *
 * 如果您有在同一数据库内安装多个Domai的需求，请为每个Domai设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix = 'dm_';

/**
 * 开发者专用：Domai调试模式
 *
 * 将这个值设置为true, Domai将显示所有用于开发的提示
 *
 */
define('DEBUG', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

if(!defined('ABSPATH'))
    define('ABSPATH', dirname(__FILE__).'/');
