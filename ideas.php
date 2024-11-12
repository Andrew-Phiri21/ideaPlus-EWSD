<?php
if(isset($_SESSION['s_role'])){
    
}else{
Session_start();
    
}
if ( $_SESSION['s_role'] == 'Admin') {
	include "admin/includes/headers/admin_header.php";
	
	echo '<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar" style="margin-left: -55px; width: 250px; border-radius: 15px;">';
	
	include "admin/includes/admin_tag.php";

    echo '<ul class="nav menu">
    <li class="active"><a href="admin/admin_index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
    
    <li><a href="admin/add_staff.php"><em class="fa fa-user-plus">&nbsp;</em> Add Staff</a></li>
    <li><a href="admin/view_staff.php"><em class="fa fa-users">&nbsp;</em> View Staff</a></li>
    
    
    
    <li class="parent"><a data-toggle="collapse" href="#sub-item-4">
        <em class="fa fa-calendar">&nbsp;</em> Dates <span data-toggle="collapse" href="#sub-item-4"></span>
        </a>
        <ul class="children collapse" id="sub-item-4">
            <li><a class="" href="dates.php">
                <span class="">&nbsp;</span> View closure dates
            </a></li>
        </ul>
    </li>
    
    <li><a href="includes/download_uploads.php"><em class="fa fa-download">&nbsp;</em> Download Uploads</a></li>
    
    <li><a href="../includes/logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
</ul>';
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
	else if($_SESSION['s_role'] == 'Student' OR $_SESSION['s_role'] == 'Regular Staff' OR $_SESSION['s_role'] == 'QA Coordinator') {include "navigation.php";
	}
//include "includes/setup.php";
include "includes/pagination.php";
		?>
		
</div>

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
    
    <title>ideaPlus</title>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
            margin: 60px;
            padding: 0;
        }

        .main {
            padding: 0;
            margin: 0;
            max-width: 1400px;
        }

        h1 {
            color: #1e293b;
            font-weight: 800;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }

        .well {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Table Styling */
        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            border: none;
            margin-bottom: 1.5rem;
        }

        .table thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 2.0rem;
            letter-spacing: 0.05em;
            padding: 2rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .table tbody tr {
            transition: all 0.2s;
        }

        .table tbody tr:hover {
            background-color: #f1f5f9;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
        }

        /* Links Styling */
        .table a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .table a:hover {
            color: #2563eb;
        }

        /* Pagination Controls */
        #pagination_controls {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
            gap: 1.0rem;
        }

        #pagination_controls a {
            padding: 0.5rem 1rem;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 6px;
            color: #3b82f6;
            text-decoration: none;
            transition: all 0.2s;
        }

        #pagination_controls a:hover {
            background: #f1f5f9;
            border-color: #3b82f6;
        }

        #pagination_controls strong {
            padding: 1.0rem 1rem;
            background: #3b82f6;
            border-radius: 6px;
            color: white;
        }

        /* Stats Styling */
        .views-count, .rating-count {
            font-weight: 600;
        }

        .rating-count {
            color: #3b82f6;
        }

        .date-posted {
            color: #64748b;
            font-size: 0.875rem;
        }

        .glyphicon-time {
            margin-right: 0.25rem;
            color: #94a3b8;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 2rem 0;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            margin-top: 3rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main {
                padding: 1rem;
            }

            .table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .well {
                padding: 1rem;
            }

            h1 {
                font-size: 1.5rem;
            }
        }

        /* Status Badges */
        .badge {
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 2.0rem;
            font-weight: 500;
        }

        /* Anonymous Tag */
        .anonymous-tag {
            color: #64748b;
            font-style: italic;
        }

        /* Table Header Icons */
        .fa {
            margin-right: 0.5rem;
            color: #94a3b8;
        }

        /* Hover Effects */
        .table tbody tr {
            cursor: pointer;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Existing base styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            line-height: 1.6;
            margin: 60px;
            padding: 0;
        }

        /* Enlarged main container */
        .col-sm-9.col-sm-offset-3.col-lg-10.col-lg-offset-2.main {
            float: none;
            margin-left: auto;
            margin-right: auto;
            padding-left: 250px;
            max-width: 1800px; /* Increased from 1400px */
            width: 95%;
        }

        /* Enlarged content column */
        .col-lg-8 {
            float: none;
            width: 100%;
            max-width: 1400px; /* Increased from 1000px */
            margin: 0 auto;
        }

        /* Larger heading */
        h1 {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 2rem;
            font-size: 2.5rem; /* Increased from 2rem */
        }

        /* Enlarged table styles */
        .table {
            margin: 0 auto;
            width: 100%;
            font-size: 2.1rem; /* Increased font size */
        }

        .table thead th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 2.0rem; /* Increased from 0.875rem */
            letter-spacing: 0.05em;
            padding: 1.25rem; /* Increased padding */
            border-bottom: 2px solid #e2e8f0;
        }

        .table td {
            padding: 1.25rem; /* Increased padding */
            vertical-align: middle;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
            font-size: 2.0rem; /* Increased font size */
        }

        /* Larger well padding */
        .well {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 2rem; /* Increased padding */
            margin-bottom: 2rem;
        }

        /* Enlarged links */
        .table a {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            font-size: 2.0rem; /* Increased font size */
        }

        /* Larger pagination */
        #pagination_controls {
            margin-top: 2rem;
            display: flex;
            justify-content: center;
            gap: 0.75rem;
            font-size: 2.0rem; /* Increased font size */
        }

        #pagination_controls a {
            padding: 0.75rem 1.25rem; /* Increased padding */
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #3b82f6;
            text-decoration: none;
            transition: all 0.2s;
        }

        #pagination_controls strong {
            padding: 0.75rem 1.25rem; /* Increased padding */
            background: #3b82f6;
            border-radius: 8px;
            color: white;
        }

        /* Enlarged stats */
        .views-count, .rating-count {
            font-weight: 500;
            font-size: 2.2rem;
        }

        .date-posted {
            color: #64748b;
            font-size: 2.0rem; /* Increased from 0.875rem */
        }

        /* Larger footer */
        footer {
            text-align: center;
            padding: 2rem 0;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            margin-top: 3rem;
            font-size: 1.1rem;
        }

        /* Larger icons */
        .fa {
            margin-right: 0.75rem;
            color: #94a3b8;
            font-size: 1.2rem; /* Increased size */
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .col-sm-9.col-sm-offset-3.col-lg-10.col-lg-offset-2.main {
                width: 90%;
            }
        }

        @media (max-width: 768px) {
            .col-sm-9.col-sm-offset-3.col-lg-10.col-lg-offset-2.main {
                padding-left: 15px;
                padding-right: 15px;
                width: 95%;
            }

            .table {
                font-size: 1rem; /* Slightly smaller on mobile */
            }

            h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">
			  <!-- Blog Post -->

                
                <h1>View Ideas</h1>				
			
			<div class="well well-sm">             
				
				<table width="80%" class="table table-striped table-bordered table-hover">
				<thead>
					<th>Idea Title</th>
					<th>Posted By</th>
					<th>Views</th>
					<th>Rating</th>
					<th>Posted On <span class="glyphicon glyphicon-time">  </span> </th>
				</thead>
				<tbody>
				<?php
					while($crow = mysqli_fetch_array($nquery)){
				?>
						<tr>
							<td><a href="view_idea.php?id=<?php echo $crow['ideaID']; ?>" id='<?php echo $crow['ideaID']; ?>'><?php echo $crow['ideaTitle']; ?></a> </td>
					<td><?php
					$curIdeaID = $crow['ideaID'];
					$query = "SELECT u.userID, username, ideaID, isAnon FROM idea i, user u where u.userID = i.userID and ideaID = '$curIdeaID'";
					$select_user_query = queryMysql($query);
					$row = mysqli_fetch_array($select_user_query);
					
					//Check if the comment was posted anonymously. 
					$anon = $row['isAnon'];
					If($anon == True){
					echo 'Anonymous';	
					}elseif($anon == False){
					echo $row['username'];
					}					
					
					?>
					</td>
					<td><?php echo $crow['views']; ?></td>
					<td><?php echo $crow['ratings']; ?></td>
					<td><?php echo $crow['datePosted']; ?></td>
							</tr>
								<?php
								}		
							?>
							</tbody>
						</table>
						<div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
						</div>
				 
				<hr> 
             
                
            </div>

           

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
				<p>Group 3, EWSD &copy; 2024</p>
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
