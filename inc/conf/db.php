<?php

    require_once(WEBROOT.BASEPATH."inc/class/dbclass/Database.singleton.php");
    $db = Database::obtain(DB_HOST, DB_USER,DB_PASS, DB_NAME);
    $db->connect();
    $db->query("SET NAMES utf8");
    $db->query("SET time_zone = '" . date('P') . "'");
   // mysql_query("SET NAMES utf8");
?>