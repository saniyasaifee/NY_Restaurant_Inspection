<?php
/**
 * Created by PhpStorm.
 * User: saniyasaifee
 * Date: 11/18/15
 * Time: 7:02 PM
 */
define('MYSQL_HOSTNAME', 'localhost');
define('MYSQL_USERNAME', 'root');
define('MYSQL_PASSWORD', 'root');
define('MYSQL_DATABASE', 'Project2_4');

/*function searchForKeyword($keyword){	
	$db = mysql_connect('localhost','root','root');
	if(!$db){
		die('Could not connect to ' .mysql_error());
	}
	$db_selected = mysql_select_db('Project2_4', $db);
	if(!$db_selected){
		die('Can\'t use '.'Project2_4'.': ' .mysql_error());
	}

	$sql = "SELECT `name` FROM `restaurants`";
	$result = mysql_query($sql);
	$data = array();
	while($i = mysql_fetch_array($result)){
		$data = $i;
	}
	mysql_close();
	return $data;
}*/

//require('mysql_db.class.php');

/*
$db = new mysql_db();
$db->connect(MYSQL_HOSTNAME, MYSQL_USERNAME, MYSQL_PASSWORD) or die(" Unable to connect to server ");
$db->select_db('MYSQL_DATABASE') or die("Cannot find the database");
$db->set_magic_quotes_off();
*/

?>
