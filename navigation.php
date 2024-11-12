<?php
//Starting session


if(isset($_SESSION['s_role'])){
    
}else{
Session_start();
    
}
if(!isset($_SESSION['s_username'])){
					header('location: login.php');
				}
include "includes/conn.php";

$toggle = "Login";

//If statement to only execute code if the user is logged in.
if (isset($_SESSION['s_username'])) {
//this nested if statement checks if the role of the one who has logged in is 'Admin' and sets the toggle.

   if ($_SESSION['s_role'] == 'Regular Staff' OR $_SESSION['s_role'] == 'QA Coordinator') {
        $toggle = $_SESSION['s_username'];

//Option for other Students/standards.
        } else if ($_SESSION ['s_role'] == 'Admin'){
        $toggle = $_SESSION['s_username'];
}} else $toggle = "Nothing";
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
    <link href="css/styles.css" rel="stylesheet">
    <link rel="icon" href="assets/images/logo.png" type="image/png">
    <!--Custom Font-->
    <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                
                <a class="navbar-brand" href="index.php"><span>idea</span> Plus</a>
                

                
               <ul class="nav navbar-top-links navbar-right">
                    
               <!-- NAV BAR LINKS -->
               </ul><div class="collapse navbar-collapse" id="custom-collapse"><ul class="nav navbar-nav navbar-right">

               <!--View ideas page-->
               <li><a href="ideas.php">View Ideas</a></li>

               <?php 
               //This if statement ensures that the add idea link only apears when a Student logs in
               //include once()
               
               if ($_SESSION ['s_role'] == 'Regular Staff'){
                echo "<!--Add Idea page-->
               <li><a href='add_Idea.php'>Add Idea</a></li>";

               }?>
               
               <!--Link to Profile Page-->
               <li><a href="#"><?php echo "$toggle";?></a></li>

               <!--Link to About Us Page-->
               <li><a href="about_us.php">About us</a></li>

               <!--Link to About Us Page-->
               <li><a href="contact_us.php">Contact us</a></li>

               <!--Logout link-->
               <li><a href="includes/logout.php">log-out</a></li>

              <!--li.dropdown.navbar-cart-->
              <!--    a.dropdown-toggle(href='#', data-toggle='dropdown')-->
              <!--        span.icon-basket-->
              <!--        |-->
              <!--        span.cart-item-number 2-->
              <!--    ul.dropdown-menu.cart-list(role='menu')-->
              <!--        li-->
              <!--            .navbar-cart-item.clearfix-->
              <!--                .navbar-cart-img-->
              <!--                    a(href='#')-->
              <!--                        img(src='assets/images/shop/product-9.jpg', alt='')-->
              <!--                .navbar-cart-title-->
              <!--                    a(href='#') Short striped sweater-->
              <!--                    |-->
              <!--                    span.cart-amount 2 &times; $119.00-->
              <!--                    br-->
              <!--                    |-->
              <!--                    strong.cart-amount $238.00-->
              <!--        li-->
              <!--            .navbar-cart-item.clearfix-->
              <!--                .navbar-cart-img-->
              <!--                    a(href='#')-->
              <!--                        img(src='assets/images/shop/product-10.jpg', alt='')-->
              <!--                .navbar-cart-title-->
              <!--                    a(href='#') Colored jewel rings-->
              <!--                    |-->
              <!--                    span.cart-amount 2 &times; $119.00-->
              <!--                    br-->
              <!--                    |-->
              <!--                    strong.cart-amount $238.00-->
              <!--        li-->
              <!--            .clearfix-->
              <!--                .cart-sub-totle-->
              <!--                    strong Total: $476.00-->
              <!--        li-->
              <!--            .clearfix-->
              <!--                a.btn.btn-block.btn-round.btn-font-w(type='submit') Checkout-->
              <!--li.dropdown-->
              <!--    a.dropdown-toggle(href='#', data-toggle='dropdown') Search-->
              <!--    ul.dropdown-menu(role='menu')-->
              <!--        li-->
              <!--            .dropdown-search-->
              <!--                form(role='form')-->
              <!--                    input.form-control(type='text', placeholder='Search...')-->
              <!--                    |-->
              <!--                    button.search-btn(type='submit')-->
              <!--                        i.fa.fa-search-->
             

</div>
</div>
</div>  <!-- /.container-fluid -->
</nav>
</div>

<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>

<!--  
    JavaScript Links
    =============================================
    -->

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