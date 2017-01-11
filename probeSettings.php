<?php
    require_once "uq/auth.php";
    auth_require();
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" type="text/css"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

		<script src="scripts/js/settings.js"></script>
		<script src="scripts/js/moment.js"></script>
		<script src="scripts/js/bootstrap-datetimepicker.js"></script>
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css" type="text/css"/>

		<!-- Bootstrap: Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Bootstrap: Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<!-- Bootstrap: Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="styles/css/style.css" type="text/css" />


		<script src="scripts/js/settings.js"></script>
		<title>UQ GH Monitoring</title>
	</head>
	<body>
		<div class="container-fluid">
			<nav class="navbar navbar-inverse uq-color">
				<div class="container">
					<div class="row">
	    				<div class="navbar-text pull-right">
							<ul class="list-unstyled list-inline" style="font-size:10px">
								<li><a href="http://www.uq.edu.au/">UQ Home</a></li>
								<li><a href="http://www.uq.edu.au/contacts/">Contacts</a></li>
								<li><a href="http://www.uq.edu.au/study/">Study</a></li>
								<li><a href="http://www.uq.edu.au/maps/">Maps</a></li>
								<li><a href="http://www.uq.edu.au/news/">News</a></li>
								<li><a href="http://www.uq.edu.au/events/">Events</a></li>
								<li><a href="http://www.library.uq.edu.au/">Library</a></li>
								<li><a href="http://my.uq.edu.au/">my.UQ</a></li>
							</ul>
						</div>
					</div>
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a href="index.html" title="UQ Monitors Homepage"><img src="images/uq-logo-white.png" alt="UQ Logo"></a>
				    </div>
					<!-- Collect the nav links, forms, and other content for toggling -->
    				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
				        	<li><h6 style="color:white">Welcome, <?php echo auth_get_payload()['name']; ?></h6></li>
				          </ul>
				        </li>
				      </ul>
					</div>
	  			</div>
			</nav>
		</div>
		<div class="header_menu_wrapper">
			<ul class="header_menu">
			  	<li class="expanded">
					<a href="overview.php" title="">Overview</a>
			  	</li>
				<li class="expanded">
					<a href="search.php" title="">Explore</a>
			  	</li>
			  	<li class="active expanded">
					<a href="probeSettings.php" title="">Probe Settings</a>
			  	</li>
			</ul>
		</div>

		<div class="main_content">
            <div class="container">
            <div class="row">
                <h2>Probe Settings</h2>
            </div>
            <div class="row filter">

                <h3>Add Probe</h3>

                <div class="col-md-4">
                        <label>Probe ID:</label>
                        <input class="form-control" type="search" placeholder="probexxxx" id="add-probeID" name="probeLocation">
                </div>
                <div class="col-md-4">
                    	<label>Dev ID</label>
                        <input class="form-control" type="search" placeholder="" id="add-devID" name="probeLocation">
                </div>

                <div class="col-md-4">
                    	<label>Access Token</label>
                        <input class="form-control" type="search" placeholder="" id="add-accToken" name="probeLocation">
                </div>
                
                 <div class="col-md-4">
                    	<label>Description:</label>
                        <input class="form-control" type="search" placeholder="Add Description" id="add-desc" name="probeLocation">
                </div>
               
                <div class="col-md-12" style="padding-top: 20px">
                    <button type="button" class="btn btn-default" onclick="addProbe()">Add Probe</button>
                </div>
            </div>
             <div class="row">

                <h3>Update Probe</h3>

                <form method="post">
                <div class="col-md-4">
                        <label>Probe ID:</label>
						<select class="form-control" id="up-probeID" name=""></select>
                </div>

                <div class="col-md-4">
                    	<label>Dev ID</label>
                        <input class="form-control" type="search" placeholder="" id="up-devID" name="probeLocation">
                </div>

                <div class="col-md-4">
                    	<label>Access Token</label>
                        <input class="form-control" type="search" placeholder="" id="up-accToken" name="probeLocation">
                </div>
                
                 <div class="col-md-4">
                    	<label>Description:</label>
                        <input class="form-control" type="search" placeholder="" id="up-desc" name="probeLocation">
                </div>
               
                <div class="col-md-12" style="padding-top: 20px">
                    <button type="submit" class="btn btn-default" onclick="updateProbe()">Update Probe</button>
                </div>
				</form>
            </div>

            <div class="row filter">
            <form method="post">
                <h3>Update Probe Location</h3>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Probe ID:</label>
						    <select class="form-control" id="upl-probeID" name=""></select>
                        </div>
                    </div>
            </div>
                    
            <div class="row filter">
                <h4> Existing Location:</h4>
                <div class="row">
                    <div class="col-md-4">
                    	<label> Location ID:</label>
                        <input class="form-control" type="search" placeholder="loc0001" id="el-locID" name="probeLocation">
                    </div>
                
                    <div class="col-md-4">
                    	<label> Room:</label>
                        <input class="form-control" type="search" placeholder="room 1" id="el-room" name="probeLocation">
                    </div> 
                </div>
            </div>
                
            <div class="row filter">
                <h4> OR </h4>
            </div>

            <div class="row filter">
                <h4> New Location:</h4>
                <div class="row">
                    <div class="col-md-3">
                    	<label> Location ID:</label>
                        <input class="form-control" type="search" placeholder="" id="nl-locID" name="probeLocation">
                    </div>
                    
                    <div class="col-md-3">
                    	<label> Location Name:</label>
                        <input class="form-control" type="search" placeholder="" id="nl-name" name="probeLocation">
                    </div>
               
                    <div class="col-md-3">
                    	<label> Room:</label>
                        <input class="form-control" type="search" placeholder="" id="nl-room" name="probeLocation">
                    </div> 
                    <div class="col-md-2">
                    	<label> Type:</label>
                        <input class="form-control" type="search" placeholder="" id="nl-type" name="probeLocation">
                    </div> 
                    <div class="col-md-2">
                    	<label> lat:</label>
                        <input class="form-control" type="search" placeholder="" id="nl-lat" name="probeLocation">
                    </div> 
                    <div class="col-md-2">
                    	<label> Long:</label>
                        <input class="form-control" type="search" placeholder="" id="nl-lng" name="probeLocation">
                    </div> 
                    <div class="col-md-4">
                    	<label> Description:</label>
                        <input class="form-control" type="search" placeholder="" id="nl-desc" name="probeLocation">
                    </div> 

                </div>
            </div>

            <div class="row filter">
                <div class="col-md-12" style="padding-top: 20px">
                    <button type="submit" class="btn btn-default" onclick="updateProbeLoc()"> Update Probe Location</button>
                </div>
            </form>
            </div> 
        </div>
	</div>


		<!-- fdsfds -->
		<footer>
			<div class="footer_content">
				<a href="http://www.uq.edu.au/terms-of-use/" rel="external" class="footer__link footer__terms-link">Privacy &amp; Terms of use</a> &nbsp; | &nbsp;
				<a href="http://www.uq.edu.au/rti/" rel="external" class="footer__link footer__rti-link">Right to Information</a> &nbsp; | &nbsp;
				<a href="http://www.uq.edu.au/feedback" rel="external" class="footer__link footer__feedback-link">Feedback</a> &nbsp; | &nbsp;
				<span class="footer__last-updated">Updated: 7 August 2016</span>
			</div>
		</footer>
	</body>
</html>
