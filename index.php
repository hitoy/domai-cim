<?php
/*
 * Domai CIM
 * 哆麦客户信息管理系统
 * Copyright @2018 Hito https://www.hitoy.org/
 * 系统启动
 */
require_once('./setting.php');
$dmcim = new DM_CIM();
$dmcim->run();
