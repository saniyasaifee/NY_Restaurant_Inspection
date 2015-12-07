<?php
include("settings.php");

function getSearch(){

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

$keyword = $_POST['keyword'];
$bor = $_POST['borough'];
$grd = $_POST['grade'];


$sql = '';

if($grd == "1"){
	//print "global search\n";
	$sql = "select `r`.`name` as 'Restaurant_Name', `b`.`name` as 'Borough', `ig`.`grade` as 'Grade', count(`ig`.`grade`) as 'Received'\n"
    . "from `restaurant_inspection` as `ri`, `inspection_grading` as `ig`, `restaurant_borough` as `rb`, `restaurants` as `r`, `borough` as `b`\n"
    . "where `ri`.`inspection_id` = `ig`.`inspection_id` and `ri`.`restaurant_id` = `rb`.`id` and `r`.`id` = `rb`.`id` and `r`.`name` like '%$keyword%' and `ig`.`grade` like '%%' and `rb`.`borough` like '%$bor' and `b`.`id` = `rb`.`borough`\n"
    . "group by `ig`.`grade`, `r`.`name`\n"
    . "order by `r`.`name`, count(`ig`.`grade`) desc";
}else if($grd != "1"){
	//print "search via grade given";
	$sql = "select `r`.`name` as 'Restaurant_Name', `b`.`name` as 'Borough', `ig`.`grade` as 'Grade', count(`ig`.`grade`) as 'Received'\n"
    . "from `restaurant_inspection` as `ri`, `inspection_grading` as `ig`, `restaurant_borough` as `rb`, `restaurants` as `r`, `borough` as `b`\n"
    . "where `ri`.`inspection_id` = `ig`.`inspection_id` and `ri`.`restaurant_id` = `rb`.`id` and `r`.`id` = `rb`.`id` and `r`.`name` like '%$keyword%' and `ig`.`grade` = '$grd' and `rb`.`borough` like '%$bor' and `b`.`id` = `rb`.`borough`\n"
    . "group by `ig`.`grade`, `r`.`name`\n"
    . "order by count(`ig`.`grade`) desc";
}

$resultss = mysql_query($sql);
$data = '';
$data .= '<table class="table table-condensed table-hover table-striped">';
$data .= '<thead>';
$i = 0;
while($i < mysql_num_fields($resultss)){
	$data .= '<th>'.mysql_fetch_field($resultss, $i)->name.'</th>';
	$i++;
}

$data .= '</thead>';
$data .= '<tbody>';
while($r = mysql_fetch_array($resultss)){
	$data .= '<tr>' . '<td>' . $r['Restaurant_Name'] . '</td> <td>&nbsp&nbsp' . $r['Borough'] . 
		 '</td><td>&nbsp&nbsp' . $r['Grade'] .
		'</td><td>&nbsp&nbsp' . $r['Received'] . '</td><td>';
}
$data .= '</tbody>';
$data .= '</table>';
mysql_free_result($resultss);
mysql_close();
return $data;
}
}



//header("Location: http://localhost/Project2_4/NY_Restaurant_Inspection-master/html/index.html");
?>
