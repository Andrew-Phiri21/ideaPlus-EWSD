<?php

if(isset($_SESSION['s_role'])){
    
}else{
Session_start();
    
}
if ( $_SESSION['s_role'] == 'Admin') {
	include "admin/includes/headers/admin_header.php";
	
	echo '<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">';
	
	include "admin/includes/admin_tag.php"; 
    echo '<ul class="nav menu">
    <li class="active"><a href="admin/admin_index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
    
    <li><a href="admin/add_staff.php"><em class="fa fa-user-plus">&nbsp;</em> Add Staff</a></li>
    <li><a href="admin/view_staff.php"><em class="fa fa-users">&nbsp;</em> View Staff</a></li>
    
    
    
    <li class="parent"><a data-toggle="collapse" href="#sub-item-4">
        <em class="fa fa-calendar">&nbsp;</em> Dates <span data-toggle="collapse" href="#sub-item-4"></span>
        </a>
        <ul class="children collapse" id="sub-item-4">
            <li><a class="" href="admin/dates.php">
                <span class="">&nbsp;</span> View closure dates
            </a></li>
        </ul>
    </li>
    
    <li><a href="includes/download_uploads.php"><em class="fa fa-download">&nbsp;</em> Download Uploads</a></li>

	<ul class="nav menu">
			<a href="includes/logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul> </div>';
	}
	else if ($_SESSION['s_role'] == 'QA Manager') {
	include "admin/includes/headers/admin_header.php";
	
	echo '<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">';
	
	include "admin/includes/admin_tag.php"; 
	echo '<ul class="nav menu">
						
				<li class=""><a href="admin/admin_index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			
				<li class="parent"><a data-toggle="collapse" href="#sub-item-1">
						<em class="fa fa-toggle-off <!--fa-toggle-off-->">&nbsp;</em> Category <span data-toggle="collapse" href="#sub-item-1" ></span>
						</a>
						<ul class="children collapse" id="sub-item-1"><em class="fa arrow"></em>
							<li><a class="" href="admin/add_category.php">
								<span class="">&nbsp;</span> Add category
							</a></li>
							<li><a class="" href="admin/category.php">
								<span class="">&nbsp;</span> View category
							</a></li>
						</ul>
				</li>
			
				<li class="active"><a href="ideas.php"><em class="fa fa-book">&nbsp;</em>View Ideas</a></li>
					
					
					
				<li><a href="includes/logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
			
			</ul></div>';
		
	}
	else if($_SESSION['s_role'] == 'Student' OR $_SESSION['s_role'] == 'Regular Staff' OR $_SESSION['s_role'] == 'QA Coordinator') {include "navigation.php";}
	



	include "includes/setup.php";
    include "includes/conn.php";
	extract($_GET);
	
	$cID = $_SESSION['s_userID'];
	
  //For the first time opening the page.  Adds to views
	if (isset($id)){
	$_SESSION['s_iID'] = $id;
	$view = "UPDATE idea SET views = views + 1 WHERE ideaID = '$id'"; 
	$add_view = queryMysql($view);
	 
	
	}else{
	//for page refresh
	$id = $_SESSION['s_iID'];
		
	}
	if($_SESSION['s_role'] == 'Student'){
		$type = 'student';
	}else{
		$type = 'staff';
	}
	if (isset($_POST['btnComment'])){
	$comm = sanitizeString($_POST['txtComment']); 
	
	if($_SESSION['s_role'] == 'Student'){
		//$cid user id
		$sql = "Select email from user where userID = (select userID from idea where ideaID = '$id');";
		$commentor = queryMysql($sql);
		while($row = mysqli_fetch_array($commentor)){
			$cMail = $row['email'];
			
			include("includes/mail/commentMade.php");
		}
		
		
		
		
	}	
	

	if(isset ($_POST['chkAnon'])){
		$anon = 1;
	}else{
		$anon = 0;
	}
	   $query3 = "INSERT INTO comments(commentDetails, commentType, ideaID, isAnon,  userID) values('{$comm}','{$type}','{$id}',{$anon},'{$cID}');";

	  
	  $add_comment = queryMysql($query3);
	 
		$view = "UPDATE idea SET views = views - 1 WHERE ideaID = '$id'"; 
		$remove_view = queryMysql($view);
	
	 $_SESSION["status"] = "<div class='alert alert-success'><strong>Success!</strong> Your comment has been added </div>"; 
	}
	
	if(isset ($_POST['rateup'])){
		
	$rating = queryMysql("Select * from userRatings where ideaID='$id' and userID='$cID'");
	
	$count = mysqli_num_rows($rating);
	
	if($count > 0){
		while($row = mysqli_fetch_array($rating)){
		$curRate = $row['rating'];
			}
			
		if($curRate == 1 ){
		
		$_SESSION["status"] = "<div class='alert alert-success'><strong> EGG!</strong> Your rating is already positive </div>"; 

		}else{
		$undoRating = "UPDATE idea SET ratings = ratings - '$curRate' WHERE ideaID = '$id'"; 
		$undo = queryMysql($undoRating);
		$rate = "UPDATE userRatings set rating = 1 where ideaID='$id' and userID='$cID'";
		$rate1 = queryMysql($rate);
		$_SESSION["status"] = "<div class='alert alert-success'><strong> EGG!</strong> Your rating has been updated to positive</div>"; 
	
		}
	
	 

		
											
	}else{
		//user hasn't rated before
		
		$rate2 = "insert into userRatings(ideaID, userID, rating) values('$id','$cID',1)";
		$rate1 = queryMysql($rate2);
		$doRating1 = "UPDATE idea SET ratings = ratings + 1 WHERE ideaID = '$id'"; 
		$do = queryMysql($doRating1);
		$_SESSION["status"] = "<div class='alert alert-success'><strong> EGG!</strong> Your positive rating has been added </div>"; 
		
	
	}
	$view = "UPDATE idea SET views = views - 1 WHERE ideaID = '$id'"; 
		$remove_view = queryMysql($view);
	
	}
		
		

		
	if(isset ($_POST['ratedown'])){

	$rating7 = queryMysql("Select * from userRatings where ideaID='$id' and userID='$cID'");
	
	$count = mysqli_num_rows($rating7);
	//Changing rating
	if($count > 0){
		while($row = mysqli_fetch_array($rating7)){
		$curRate = $row['rating'];												}
		
		if($curRate == -1 ){
			$_SESSION["status"] = "<div class='alert alert-danger'><strong> EGG!</strong> Your rating is already negative </div>"; 
				}else{
		$undoRating = "UPDATE idea SET ratings = ratings  -'$curRate' WHERE ideaID = '$id'"; 
		$undo = queryMysql($undoRating);
		$rate = "UPDATE userRatings set rating = -1 where ideaID='$id' and userID='$cID'";
		$rate1 = queryMysql($rate);
		$_SESSION["status"] = "<div class='alert alert-danger'><strong> EGG!</strong> Your rating has been updated to negative </div>"; 
		
		}
	 

		
	}else{
		//user hasn't rated before
		
		$rate2 = "insert into userRatings(ideaID, userID, rating) values('$id','$cID',-1)";
		$rate1 = queryMysql($rate2);
		$doRating1 = "UPDATE idea SET ratings = ratings - 1 WHERE ideaID = '$id'"; 
		$do = queryMysql($doRating1);
		$_SESSION["status"] = "<div class='alert alert-danger'><strong> EGG!</strong> Your negative rating has been added </div>"; 
		
	
	}
		$view = "UPDATE idea SET views = views - 1 WHERE ideaID = '$id'"; 
		$remove_view = queryMysql($view);
	
	}

	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    
    <!-- Add Modern Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Modern styling */
		body {
    font-family: 'Inter', sans-serif;
    background-color: #f8fafc;
    color: #334155;
    line-height: 1.6;
    margin: 60px;
    padding: 0;
}

.container-fluid {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 20px;
}
.main {
    padding: 2rem;
    background-color: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin: 20px auto;
    max-width: 1200px;
}

/* Sidebar positioning */
#sidebar-collapse {
    position: fixed;
    left: 0;
    top: ;
    height: 100%;
    z-index: 1000;
}

/* Content positioning */
.col-sm-9.col-sm-offset-3.col-lg-10.col-lg-offset-2 {
    float: none;
    margin: 0 auto;
    padding-left: 250px; /* Adjust based on your sidebar width */
}

/* Center the main content area */
.row {
    display: flex;
    justify-content: center;
}

.col-lg-8 {
    float: none;
    margin: 0 auto;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .col-sm-9.col-sm-offset-3.col-lg-10.col-lg-offset-2 {
        padding-left: 0;
    }

    .main {
        margin: 10px;
        padding: 1rem;
    }

    .container-fluid {
        padding: 0 10px;
    }
}
        .panel {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            margin-bottom: 2rem;
        }

        .panel-heading {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.5rem;
            border-radius: 12px 12px 0 0;
        }

        .panel-heading h3 {
            margin: 0;
            color: #1e293b;
            font-weight: 600;
        }

        .panel-body {
            padding: 1.5rem;
        }

        /* Stats styling */
        .idea-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-item {
            background: #f1f5f9;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }

        /* Rating buttons */
        .fa-thumbs-up, .fa-thumbs-down {
            font-size: 1.5rem;
            transition: transform 0.2s;
        }

        .fa-thumbs-up:hover, .fa-thumbs-down:hover {
            transform: scale(1.1);
        }

        .color-blue { color: #3b82f6; }
        .color-red { color: #ef4444; }

        /* Comments section */
        .well {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .well-sm {
            padding: 1rem;
        }

        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.75rem;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .btn-primary {
            background-color: #3b82f6;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }

        /* Comment display */
        .media {
            background: #ffffff;
            border-radius: 8px;
            margin-bottom: 1rem;
            transition: transform 0.2s;
        }

        .media:hover {
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 6px;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        /* Author info */
        .lead {
            font-size: 1.1rem;
            color: #64748b;
        }

        .lead a {
            color: #3b82f6;
            text-decoration: none;
        }

        .lead a:hover {
            text-decoration: underline;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 2rem 0;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            margin-top: 3rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main {
                padding: 1rem;
                margin: 10px;
            }

            .idea-stats {
                grid-template-columns: 1fr;
            }
        }

        /* Custom checkbox */
        input[type="checkbox"] {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            vertical-align: middle;
        }

        /* Date display */
        .glyphicon-time {
            color: #64748b;
            margin-right: 0.5rem;
        }

        /* File attachment link */
        a[download] {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #f1f5f9;
            border-radius: 6px;
            color: #3b82f6;
            text-decoration: none;
            margin-top: 1rem;
            transition: background 0.2s;
        }

        a[download]:hover {
            background: #e2e8f0;
        }
    </style>
</head>
    
    <!--Custom Font-->
    <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body> 
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

        <div class="row">
	
            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                

                <?php 
				if (isset($_SESSION['status'])) {
	            echo $_SESSION['status'];
	            unset($_SESSION['status']);
			} 

        $query2 = "SELECT * FROM idea WHERE ideaID = '$id'";
		
		
        $queryC = "SELECT catName FROM idea i,ideaCat ic, category c WHERE i.ideaID = '$id' and i.ideaID = ic.ideaID and ic.catID = c.catID";
		$selectCat = queryMysql($queryC);
		$row2 = mysqli_fetch_array($selectCat);
		$cat1 = $row2['catName'];
		$select_user_query = queryMysql($query2);  
		$count = mysqli_num_rows($select_user_query);

      if ($count == 1) {

      while($row = mysqli_fetch_array($select_user_query)){

        //Inserting the data from the table rows into variables
        $db_userId = $row['userID']; 
        $db_ideaId = $row['ideaID'];
        $db_ideaTitle = $row['ideaTitle'];
        $db_ideaDetails = $row['ideaDetails'];
		$db_ideaDate = $row['datePosted'];
		$db_ideaViews = $row['views'];
		$db_ideaRating = $row['ratings'];
		$_SESSION['s_file'] = '';
		if($row['hasAttach'] == 1){
			$query5 = "select * from attached where ideaID = '$id'";
			$getFilePath = queryMysql($query5);
		while($row = mysqli_fetch_array($getFilePath)){
			$fPath = $row['sourceFile'];
		}
			//echo 'attachments' . $fPath;
			$_SESSION['s_file'] = "<a href='$fPath' download> Download Attachment </a>"; 
			
		}else{ 
			
		}
        
		}
		}
		?> 
		<hr>
		<div class="panel panel-default">
		<div class="panel-heading"><h3><?php echo $db_ideaTitle?></h3></div>
			<div class="panel-body">
		        <!-- Author 
				Show the views and ratings-->
				<div id='egg'> </div>
				<h4> Category: <?php echo $cat1?></h4>
				<h4> Views: <?php echo $db_ideaViews?>  </h4>	
				<h4> Rating: <?php echo $db_ideaRating?>  </h4>	
			   <form role='form' method='POST'>
				<button name="rateup" type='submit'  id="<?php echo $db_ideaId?>" style="padding:0px; border:none; background: none;" ><em class="fa fa-xl fa-thumbs-up color-blue"></em></button>
				<button name="ratedown" type='submit' id="<?php echo $db_ideaId?>" style="padding:0px; border:none; margin-left: 10px; background: none;"><em class="fa fa-xl fa-thumbs-down color-red"></em></button>	
				</form>
				<p class="lead">
                    by <a href="#">
					
   <?php

                    $query = "SELECT u.userID, username, isAnon FROM user u, idea i where u.userID = '$db_userId' and u.userID = i.userID and i.ideaID = '$id'"; 
                    $select_user_query = queryMysql($query);
                    $row = mysqli_fetch_array($select_user_query);
					$anon = $row['isAnon'];
					If($anon == 1){
					echo 'Anonymous';	
					}elseif($anon == 0){
					echo $row['username'];
					}	
					?></a>
                
                </p>
			
			<h3><?php echo $db_ideaDetails?></h3>
			<div> <?php if(isset($_SESSION['s_file'])){echo $_SESSION['s_file'];}?> </div>
			</div>
			</div>
         	<hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on: <?php echo $db_ideaDate?></p>

                <hr>

                 <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="POST">
                        <div class="form-group">
                            <textarea name ="txtComment" class="form-control" rows="3" required></textarea>
                        </div>
						<?php 
		
						$queryD = "SELECT finalClosure FROM dates";
						$selectClos = queryMysql($queryD);
//						$row = mysqli_fetch_array($selectClos);
		
					while($row = mysqli_fetch_array($selectClos)){
						
						$clos = $row['finalClosure'];
						//echo $clos;
						$now = date('Y-m-d');
						//echo $now;
						//check closure date vs server date
						if($now < $clos){
							echo '<button type="submit" name="btnComment" class="btn btn-primary">Comment </button>';
							echo ' ';
							echo "<input type='checkbox' name= 'chkAnon'> Post Anonymously? </input>";
							
						}else{
							//echo ' <button type="submit" name="btnComment" class="btn btn-primary" disabled>Submit </button>';
							echo 'Closure date has passed.  No more comments allowed';
							
						}
						
					}
 ?>
                      
						</form>
                </div>

                <hr>

                <!-- Posted Comments -->
		<?php 
		//Set the sql to only pick student comments if the user is a student.
		if($type == 'student'){
		 //echo 'studente egtrig';
		 $query=mysqli_query($conn,"select u.userID, role, username, c.isAnon, c.commentID, c.ideaID, commentDetails, commentDate from comments c, idea i, user u where i.ideaID = '$id' and i.ideaID = c.ideaID and u.userID = c.userID and commentType='student'  order by commentDate DESC");
		
		}else{
		//echo 'staff egtrig';
		//echo '';
		$query=mysqli_query($conn,"select u.userID, role, username, c.isAnon, c.commentID, c.ideaID, commentDetails, commentDate from comments c, idea i, user u where i.ideaID = '$id' and i.ideaID = c.ideaID and u.userID = c.userID  order by commentDate DESC");
		}
		
		while($row = mysqli_fetch_array($query)){
			$commID = $row['commentID'];
			
		?>
                <!-- Comment -->
                <div class="media">
                   <div class='well well-sm'>
					<h3> <?php 
					//Check if the comment was posted anonymously. 
					
					$anon = $row['isAnon'];
					If($anon == True){
					$c = ' <div class="alert alert-success"> ' . 'Anonymous' . ' <br> Role: ' . $row['role'] . '</div>';	
					echo $c	;
					}elseif($anon == False){
					$c = ' <div class="alert alert-success"> ' . $row['username'] . ' <br> Role: ' . $row['role'] . '</div>';
					echo $c;
					}	
					?>
					<?php 
					//Check if the comment was staff made. 
					
						?>

					</h3>
                   
					<div class="media-body">
                        <h4 class="media-heading"> <?php echo $row['commentDetails'];  ?>
                            <p/>
							
							<small><?php echo 'Commented on: '; echo $row['commentDate']; ?> </small>
                        </h4>
                         </div>
						 </div>
                </div>
		<?php } ?>
               
			</div>
            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->

                <!-- Blog Categories Well -->
                

                <!-- Side Widget Well -->

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Group 3 EWSD &copy; 2024</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
