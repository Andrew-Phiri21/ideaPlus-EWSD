<?php
	include "navigation.php";
    //session_start();
    include "includes/conn.php";
    include "includes/setup.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ideaPlus</title>
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


<?php
  if(isset($_POST['add_idea'])){
       
  $requiredFields = ['idea_title','idea_details','idea_files'];
  $missingFields = [];
  foreach ( $requiredFields as $requiredField ) {
    if ( !isset( $_POST[$requiredField] ) or !$_POST[$requiredField] ) {
    $missingFields[] = $requiredField;
    }
  }
  if ($missingFields) {
          $_SESSION['status'] = '<div class="alert alert-danger" id="myAlert">
              There were some problems with the form you submitted. Please complete all the fields 
            </div>';

  } 
  
if(isset ($_POST['chkAnon'])){
    $anon = 1;
  }else{
    $anon = 0;
  }
          $db_idea_title = sanitizeString($_POST['idea_title']); 
          $db_details = sanitizeString($_POST['idea_details']);
		  $id2 = $_SESSION['s_userID'];
		  
		  
		  if($_FILES['idea_files']['name'] == "") {
			 //echo 'No attach'; 
			 $attach = 0;
		
		  }else{
			//echo 'Attachment';
			 $db_idea_files= $_FILES['idea_files']['name'];
          $db_idea_files_temp =$_FILES['idea_files']['tmp_name'];
          
          move_uploaded_file($db_idea_files_temp, "uploads/$db_idea_files");
			
		$attach = 1;
		
			}
         	 $query = "INSERT INTO `idea`(userID, ideaTitle, ideaDetails, hasAttach,  isAnon)";
          $query .= "VALUES ('$id2','$db_idea_title', '$db_details', '$attach', '$anon')";
         // echo $query;


if (mysqli_query($conn, $query)) {
    $last_id = mysqli_insert_id($conn);
    //echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
 $catID = $_POST['catID']; 
           $query2 = "INSERT INTO ideacat(ideaID,catID)";

           $query2 .= "VALUES('$last_id','$catID') ";
			queryMysql($query2);
	If($attach == 1){
	$filepath =	'uploads/' . $db_idea_files;
	$qAttach = "INSERT into attached(ideaID, sourceFile) values('$last_id','$filepath');";
		queryMysql($qAttach);
		//echo $qAttach;
	
	}
	

	$sql = "select email from user where role='QA Coordinator'and deptID = (select d.deptID from user u, department d where d.deptID = u.deptID and userID = '$id2');";
	//echo $sql;
	
		$commentor = queryMysql($sql);
		while($row = mysqli_fetch_array($commentor)){
			$qacMail = $row['email'];
			
			include("includes/mail/ideaMade.php");
		}		
		

          $_SESSION["status"] = "<div class='alert alert-success'><strong>Success!</strong> Your idea has been added: <a href='ideas.php'>View your idea page</a></div>"; 
		 
      }

  
 ?>

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h1 align="center">Add Idea</h1>

			<?php if (isset($_SESSION['status'])) {
	            echo $_SESSION['status'];
	            unset($_SESSION['status']);
			} ?>

            <form action="" method="POST" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="idea_title">Idea Title</label>
                    <input type="text" class="form-control" id="idea_title" name="idea_title" required placeholder="Give your idea a title">
                </div>
                <div class="form-group">
                    <label for="">Idea Details</label>
                   <p> <textarea name="idea_details" id="idea_details" class="form-control" rows="5"></textarea> </p>
                </div>
      <div class="form-group">
              <select name="catID" id="category" class= "form-control">
            
               <?php 
                        $query = "SELECT * FROM category";
                        $select_category = queryMysql($query);
                        
                        while ($row = mysqli_fetch_assoc($select_category)){
                                $catID = $row['catID'];
                                $catName = $row['catName'];
                                echo "<option value='{$catID}'>{$catName}</option>";

                        }
            
                    ?>  
          </select>
          </div>

                <div class="form-group">
                    <label for="attachement">Attach File</label>

                    <input type="file" name="idea_files" id="idea_files">
					<input type="checkbox" id="tscs" onclick="checkAgree()">
					<label for ="checkbox" required>I agree to the <a href="terms-conditions.html"> Terms & Conditions </a></label>
					
                </div>






						<?php 
		
						$queryD = "SELECT ideaClosure FROM dates";
						$selectClos = queryMysql($queryD);
//						$row = mysqli_fetch_array($selectClos);
		
					while($row = mysqli_fetch_array($selectClos)){
						
						$clos = $row['ideaClosure'];
						//echo $clos;
						$now = date('Y-m-d');
						//echo $now;
						//check closure date vs server date
						if($now < $clos){
						
							echo "<input type='checkbox' name= 'chkAnon'> Post Anonymously? </input>
							</br> </br>
							<button type='submit' name='add_idea' class='btn btn-primary' id='add-idea' disabled=true >Add Idea</button>";
							echo ' ';
								
							}else{
								echo 'Initial closure date has passed.  No more ideas allowed';
								
							}
						
					}
 ?>

            </form>
        </div>
    </div>
</diV>	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/idea.js"></script>
	
</body>
</br>
<div align="center">
<?php
include "footer.php"
?>
</div>
</html>
