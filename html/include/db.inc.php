<?php
/**
 * Created by PhpStorm.
 * User: saniyasaifee
 * Date: 11/18/15
 * Time: 7:02 PM
 */
define('MYSQL_HOSTNAME', '');
define('MYSQL_USERNAME', '');
define('MYSQL_PASSWORD', '');
define('MYSQL_DATABASE', '');

require_once('mysql_db.class.php');
$db = new mysql_db();
$db->connect(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD) or die(" Unable to connect to server ");
$db->select_db('MYSQL_DATABASE') or die("Cannot find the database");
$db->set_magic_quotes_off();
