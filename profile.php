<!DOCTYPE html>
	<?php
		include "navigation.php";
		include "includes/conn.php";
		include "includes/setup.php";
	?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="icon" href="assets/images/logo.png" type="image/png">
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	
</body>

<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-6 col-lg-12 no-padding">
				</div>
				</div>	

         <div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Top 5 (Most Viewed Ideas)</h3>
			</div>
		</div><!--/.row-->

         <table class="table table-bordered">

                    <tbody>
                    <thead>
                      <tr>  
                        <th>
                           <center>Idea Title</center>
                        </th> 
                        <th>
                          <center>Percentage Bar</center>
                        </th>
                        <th>
                           <center>Number of Views</center>
                        </th>
                        <th>
                           <center>Date of Upload</center>
                        </th>
                      </tr>
                    </thead>

<?php

//Php Code to get the catergory information

$query = "SELECT * FROM idea ORDER BY views DESC LIMIT 5";
$select_user_query = queryMysql($query);	
$count = mysqli_num_rows($select_user_query);

			while($row = mysqli_fetch_array($select_user_query)){

				//Inserting the information from DB into variables
				$db_ideaTitle = $row['ideaTitle'];
				$db_ideaViews = $row['views'];
				$db_datePosted = $row['datePosted'];
              	?>

                      <tr>
                        <td>
                           <?php echo "$db_ideaTitle";?>
                        </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $db_ideaViews.'%';?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td>
                          <center><?php echo "$db_ideaViews"; ?></center>
                        </td>
                        <td>
                          <center><?php echo "$db_datePosted";};?></center>
                        </td>
                      </tr>
                    </tbody>
                  </table>
         


       <div class="row">
			<div class="col-lg-12">
				<h3 class="page-header">Top 5 (Most Rated Ideas)</h3>
			</div>
		</div><!--/.row-->

 <table class="table table-bordered">

                    <tbody>
                    <thead>
                      <tr>  
                        <th>
                           <center>Idea Title</center>
                        </th> 
                        <th>
                          <center>Percentage Bar</center>
                        </th>
                        <th>
                           <center>Number of Ratings</center>
                        </th>
                        <th>
                           <center>Date of Upload</center>
                        </th>
                      </tr>
                    </thead>

<?php
//Php Code to get the catergory information

$rating_query = "SELECT * FROM idea ORDER BY ratings DESC LIMIT 5";
$select_rating_query = queryMysql($rating_query);	
$count_rows = mysqli_num_rows($select_rating_query);

			while($row = mysqli_fetch_array($select_rating_query)){


				//Inserting the information from DB into variables
				$db_ideaTitle = $row['ideaTitle'];
				$db_ratings = $row['ratings'];
				$db_datePosted = $row['datePosted'];
              	?>

                      <tr>
                        <td>
                           <?php echo "$db_ideaTitle";?>
                        </td>
                        <td>
                          <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $db_ratings.'%';?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </td>
                        <td>
                          <center><?php echo "$db_ratings";?></center>
                        </td>
                        <td>
                          <center><?php echo "$db_datePosted";}?></center>
                        </td>
                      </tr>
                    </tbody>
                  </table>
   </div>


<?php
include "footer.php";
?>
</html>
