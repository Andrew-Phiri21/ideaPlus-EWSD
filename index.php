<?php

    include "navigation.php";
    //session_start();
    include "includes/conn.php";
    include "includes/setup.php";
	//echo $_SESSION['s_userID'];
	
	
?>

<body>
<header>
      <div class="container">
        <div id="branding">
          <h1><span class="highlight">ideaPlus </h1>
        </div>
      </div>
      <style>
            /* General styling */
body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: auto;
    overflow: hidden;
}

h1, h3, h4 {
    color: #333;
}

/* Header styling */
header {
    background: #333;
    color: #fff;
    padding: 20px 0;
    border-bottom: 3px solid #f4b41a;
}

header h1 {
    margin: 0;
    padding: 0;
    font-size: 2.5em;
    text-transform: uppercase;
    text-align: center;
}

.highlight {
    color: #f4b41a;
}

/* Showcase section */
#showcase {
    /* background: #f4b41a; */
    color: #333;
    padding: 10px 0;
    text-align: center;
}

#showcase h1 {
    font-size: 3em;
    margin-bottom: 10px;
}

/* Boxes section */
#boxes {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.box {
    background: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    flex-basis: 30%;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
}

.box img {
    width: 50px;
    margin-bottom: 15px;
}

/* Sidebar and well styling */
.well {
    background: #fff;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.well h4 {
    border-bottom: 2px solid #f4b41a;
    margin-bottom: 15px;
    padding-bottom: 5px;
}

.input-group .btn {
    background: #333;
    color: #fff;
}

/* Profile section */
.profile-usertitle {
    text-align: center;
    margin-bottom: 15px;
}

.profile-usertitle-name {
    font-size: 1.5em;
    font-weight: bold;
}

.indicator {
    display: inline-block;
    width: 10px;
    height: 10px;
    background-color: #5cb85c;
    border-radius: 50%;
    margin-left: 10px;
}

/* Buttons */
.btn {
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-success {
    background-color: #28a745;
    color: #fff;
}

.btn-success:hover {
    background-color: #218838;
}

.btn-danger {
    background-color: #dc3545;
    color: #fff;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Footer */
hr {
    border: 0;
    height: 1px;
    background: #ddd;
    margin: 20px 0;
}

.lead {
    list-style: none;
}
      </style>
    </header>
	<!--/.main-->

<div class="container">
        <div class="row">

            <!--Content Column -->
            <div class="col-lg-8">
               
    <section id="showcase">
      <div class="">
        <h1>Have a say!</h1>
        <p>Submit an idea that you feel can help improve the school </p>
      </div>
    </section>
    </section>
    <section id="boxes">
      <div class="container">
        <div class="box">
        <em class="fa fa-xl fa-eye-slash color-orange" style="font-size:50px;"></em>
          <h3>Submit anonymously</h3>
          <p>You have the power to withhold your identity as you submit your ideas</p>
        </div>
        <div class="box"><em class="fa fa-xl fa-comment color-blue" style="font-size:50px;"></em>
          <!-- <img src="assets/images/comment.png"> -->
          <h3>Comment on ideas</h3>
          <p>You can leave a comment on an idea</p>
        </div>
        <div class="box">
        <em class="fa fa-xl fa-thumbs-up color-teal" style="font-size:50px;"></em>
          <h3>Thumbs up | Thumbs down</h3>
          <p>University students are able to rate the ideas added by other students in the same category.</p>
        </div>
      </div>
    </section>


            </div>

			
			
			
			
			
			
			
			
			
			
            <!--Sidebar Widgets Column -->
            <div class="col-md-4">

                <!--Search Box -->
                <div class="well">
                    <h4>Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <?php 
				
				
                $p_name = $_SESSION['s_username'];
                $p_fName = $_SESSION['s_lastName'];
                $p_lName = $_SESSION['s_firstName'];
                $p_email = $_SESSION['s_email'];
                $p_deptID = $_SESSION['s_deptID'];
                $p_role = $_SESSION['s_role'];

                $query = "SELECT * FROM department WHERE deptID ='{$p_deptID}'";
                $select_user_query = queryMysql($query);    
                $count = mysqli_num_rows($select_user_query);

                if ($count == 1) {
                while($row = mysqli_fetch_array($select_user_query)){

                //Inserting the information from DB into variables
                $p_deptName = $row['deptName'];
            }}
?>  

                <!-- Profile Widget -->
                <div class="well">
                <div class="profile-usertitle">
                <div class="profile-usertitle-name">Hi, <?php echo "$p_lName         "."". "              <class='profile-usertitle-status'>   <span class='indicator label-success'></span>    Online</div>
                </div></br></br>"?></br>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="lead">
                                <table>
                               <tr><li><h4><td>Name: &nbsp;</td> <td><?php echo "$p_lName"." $p_fName";?></td></h4></p></li></tr>

                               <tr> <li><h4><td>Department:&nbsp;</td> <td><?php echo "$p_deptName";?></td></h4></p></li></tr>

                               <tr> <li><h4><td>Role: &nbsp;</td><td><?php echo "$p_role";?></td></h4></p></li></tr>
                                </table>
                            </ul>
                            
                                <div class="panel-body">
                                <div class="col-md-12">

                                <!-- <a href="#"><button type="submit" class="btn btn-md btn-success">View Profile</button></a> -->
                            
                        <a href="includes/logout.php"><button type="submit" class="btn btn-md btn-danger">Logout</button></a>
                        
                        <br/>
                        </div>
                        </div>

                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <!-- <div class="well">
                    <h4>Submitted idea</h4>
                    <p>Your most recent idea.</p>
                </div> -->

            </div>

        </div>
        <!-- /.row -->

        <hr>
<?php
include "footer.php"
?>
      
</div>
    <!-- /.container -->
    <!-- jQuery -->
<script src="js/jquery.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
