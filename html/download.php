<?php
include("settings.php");

 function outputCSV($data,$file_name = 'file.csv') 
 {
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");
        $output = fopen("php://output", "w");
        foreach ($data as $row) {
            fputcsv($output, $row);
        }
        fclose($output);
}

if (isset($_GET['k']) && isset($_GET['b']) && isset($_GET['g']))
{

$keyword = $_GET['k'];
$bor = $_GET['b'];
$grd = $_GET['g'];

$sql = '';

if($grd == "1"){
	//print "global search\n";
	$sql = "select `r`.`name` as 'Restaurant_Name', `b`.`name` as 'Borough', `ig`.`grade` as 'Grade', count(`ig`.`grade`) as 'Received'\n"
    . "from `restaurant_inspection` as `ri`, `inspection_grading` as `ig`, `restaurant_borough` as `rb`, `restaurants` as `r`, `borough` as `b`\n"
    . "where `ri`.`inspection_id` = `ig`.`inspection_id` and `ri`.`restaurant_id` = `rb`.`id` and `r`.`id` = `rb`.`id` and `r`.`name` like '%$keyword%' and `ig`.`grade` like '%%' and `rb`.`borough` like '%$bor' and `b`.`id` = `rb`.`borough`\n"
    . "group by `ig`.`grade`, `r`.`name`\n"
    . "order by `r`.`name`, count(`ig`.`grade`) desc";
}
else if($grd != "1"){
	//print "search via grade given";
	$sql = "select `r`.`name` as 'Restaurant_Name', `b`.`name` as 'Borough', `ig`.`grade` as 'Grade', count(`ig`.`grade`) as 'Received'\n"
    . "from `restaurant_inspection` as `ri`, `inspection_grading` as `ig`, `restaurant_borough` as `rb`, `restaurants` as `r`, `borough` as `b`\n"
    . "where `ri`.`inspection_id` = `ig`.`inspection_id` and `ri`.`restaurant_id` = `rb`.`id` and `r`.`id` = `rb`.`id` and `r`.`name` like '%$keyword%' and `ig`.`grade` = '$grd' and `rb`.`borough` like '%$bor' and `b`.`id` = `rb`.`borough`\n"
    . "group by `ig`.`grade`, `r`.`name`\n"
    . "order by count(`ig`.`grade`) desc";
}

$resultss = mysql_query($sql);
$data = array();
$results = array();

$i = 0;
while($i < mysql_num_fields($resultss)){
	array_push($results, mysql_fetch_field($resultss, $i)->name);
	$i++;
}
array_push($data, $results);

while($r = mysql_fetch_array($resultss)){
	$results = array();
	array_push($results,$r['Restaurant_Name']);
	array_push($results,$r['Borough']); 
	array_push($results,$r['Grade']);
	array_push($results,$r['Received']);
	array_push($data, $results);
}

mysql_free_result($resultss);
mysql_close();
outputCSV($data,'download_data_report.csv');
}