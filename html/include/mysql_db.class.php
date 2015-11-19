<?php

/**
 * Created by PhpStorm.
 * User: saniyasaifee
 * Date: 11/18/15
 * Time: 8:32 PM
 */
define('MYSQL_ALL_ROWS', -1);

class mysql_db
{
    var $mysql_link_id;
    var $connected;

    /**
     * mysql_db constructor.
     * @param string $host
     * @param string $username
     * @param string $password
     */
    function mysql_db($host = '', $username = '', $password = '')
    {
        if(!empty(host))
            $this->connect($host, $username, $password);
        else
            $this->connected = false;
    }

    function connect($host = 'localhost', $username = '', $password = '')
    {
        if($username)
            $this->mysql_link_id = @mysqli_connect($host, $username, $password);
        else
            $this->mysql_link_id = @mysqli_connect($host);
        if($this->mysql_link_id)
            $this->connected = true;
        else
            this->$this->connected = false;
        return $this->connected;
    }

    function select_db($database)
    {
        return @mysqli_select_db($this->mysql_link_id, $database);
    }

    function fetch_row($query)
    {
        if(!$result = mysqli_query($this->mysql_link_id, $query))
            return FALSE;
        else if(!$row = mysqli_fetch_array($result))
            return FALSE;
        return $row;
    }

    function fetch($query, $limit = MYSQL_ALL_ROWS, $page_offset = 0)
    {
        if($limit>0)
        {
            $query .= 'LIMIT' . ($page_offset * $limit). ','.$limit;
        }
        $result = mysqli_query($this->mysql_link_id, $query) or die($query."<br />". "failed to execute.");
        $arr_results = Array();
        while($row = mysqli_fetch_array($result)){
            $arr_results[] = $row;
        }
        return $arr_results;
    }
}