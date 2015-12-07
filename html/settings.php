<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$db = mysql_connect('localhost','root','root');
if(!$db){
	die('Could not connect to ' .mysql_error());
}
$db_selected = mysql_select_db('NY_Restaurants_Inspection', $db);
if(!$db_selected){
	die('Can\'t use '.'Project2_4'.': ' .mysql_error());
}

