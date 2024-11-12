<?php
include "includes/setup.php";
?>

<!doctype html>
<html> 
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  </head>
<body>
      <link rel="icon" href="assets/images/logo.png" type="image/png">
	    <meta charset="utf-8"> 
	    <title>Login</title> 
	    <link  rel="Stylesheet" href="style.css"> 
      
	     <div class="box" id = "box"> 
        <img src = "assets/images/logo.png" alt = "logo" id = "logo" height="300px" justify="center">
        <h2>Login</h2> 
        <form class="form" action="includes/processLogin.php" method="POST" role="form"> 
          <?php
            session_start();
              // if (isset($_SESSION['message'])) {
              //     echo $_SESSION['message'];
              //     // unset($_SESSION['message']);
              // }

              if(isset($_SESSION['message'])){
                echo $_SESSION['message'];
              };
              if(isset($_SESSION['account-error'])){
                echo $_SESSION['account-error'];
              }
          ?>
          <div class="inputBox"> 
            <input type="text" name="txtUname" required=""> 
            <label>username</label> 
          </div> 
          <div class="inputBox"> 
            <input type="password" name="txtPass" required=""> 
            <label>password</label>
          </div> 
          <input type="submit" name="btnLogin" value="Login"> 
        </form> 
		</br>
	</div> 
</body> 
    <script src="assets/lib/jquery/dist/jquery.js"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/lib/wow/dist/wow.js"></script>
    <script src="assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js"></script>
    <script src="assets/lib/isotope/dist/isotope.pkgd.js"></script>
    <script src="assets/lib/imagesloaded/imagesloaded.pkgd.js"></script>
    <script src="assets/lib/flexslider/jquery.flexslider.js"></script>
    <script src="assets/lib/owl.carousel/dist/owl.carousel.min.js"></script>
    <script src="assets/lib/smoothscroll.js"></script>
    <script src="assets/lib/magnific-popup/dist/jquery.magnific-popup.js"></script>
    <script src="assets/lib/simple-text-rotator/jquery.simple-text-rotator.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


</html>