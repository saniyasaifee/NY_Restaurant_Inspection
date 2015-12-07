<?php
include("settings.php");
if (isset($_POST['keyword'])) {
	$k = $_POST['keyword'];
}
else {
	$k = "";
}
if (isset($_POST['borough'])) {
	$b = $_POST['borough'];
}
else {
$b = "";
}
if (isset($_POST['grade'])) {
	$g = $_POST['grade'];
}
else {
	$g = "1";
}
?>
<html>
<head>
<title>
NYC Restaurants</title>
<link rel="icon" href="images/favicon.ico">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<link rel="javascript" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body style="background-color:skyblue">
<img src="images/nycrestaurantsbanner.png" class="col-md-12 col-sm-12"></img>
	<div class="col-md-12 col-sm-12">
	<form action="index.php" method="POST">
		<br>
		<div class="col-md-4 col-sm-4">
		<label for="keyword">Search</label>
		<input type="text" value="<?php print $k; ?>" placeholder="Enter Restaurant Name" id="keyword" name="keyword" size="30">
		</div>
		<div class="col-md-2 col-sm-2">
		<label for="borough">Borough</label><br>
		<select id="borough" name="borough" style="width:150px;height:25px;">
		<option value="">**All**</option>	
    	<?php $result= mysql_query('SELECT * FROM `borough` order by `name`'); ?>
    	<?php while($row= mysql_fetch_assoc($result)) { ?>
        	<option value="<?php print $row['ID'] ?>" <?php if ($row['ID']==$b) { ?>selected="selected"<?php } ?>>
            <?php echo htmlspecialchars($row['NAME']); ?>
        	</option>
    	<?php } ?>
		</select>
		</div>
		<div class="col-md-2 col-sm-2">
		<label for="grade">Grade</label><br>
		<select id="grade" name="grade" style="width:150px;height:25px;">
			<option value="1">**All**</option>	
    		<?php $result = mysql_query('SELECT distinct `grade` FROM `inspection_grading` order by `grade`'); ?>
    		<?php while($row = mysql_fetch_assoc($result)) { ?>
        	<option value="<?php print $row['grade'] ?>" <?php if ($row['grade']==$g) { ?>selected="selected"<?php } ?>>
            <?php echo htmlspecialchars($row['grade']); ?>
        	</option>
    	<?php } ?>
		</select>
		</div>
		<div class="col-md-4 col-sm-4"><br>
		<button type="submit" class="btn btn-primary">Search</button>
		<a href="//localhost/Project2_4/NY_Restaurant_Inspection-master/html/index.php" class="btn btn-warning">
			Reset		
		</a>
		<?php
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			?>
			<a href="//localhost/Project2_4/NY_Restaurant_Inspection-master/html/download.php?k=<?php print $k ?>&amp;b=<?php print $b ?>&amp;g=<?php print $g ?>"  target="_blank" class="btn btn-warning" >
				Download as CSV		
			</a>
			<?php
		}
		?>
		</div>
	</form>
	</div>
	<div class="container" id="searchResult">
		<?php 
			include("search.php");			
			echo getSearch(); 
		?>
	</div>

</body>
</html>



