<?php
session_start();
$username = $_SESSION['myusername'];
include('connect-db.php');
$username = $_SESSION['myusername'];
$teamid = $_GET['teamid'];
$projid = $_GET['projid'];
$loginerror = $_GET['loginerror'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Support</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
    	<div class="logo"></div>
        <div class="login">
		<?php
		if ($username){
					echo '
        	       	<span class="style1">Logged in as </span><span class="style2"><a href="mystaff.php">'.$username.'</a>  | <a href="logout.php">Log Out</a></span> ';  
				
					}
					else
					{
					echo '<span style="margin: 0 50px 0 0;" class="style2"><a href="login.php">Login</a></span>';
}
					?>
        </div>	
    <div class="clear"></div>
</div>

<div class="container">
	
    <div class="nav">
    	<ul>
            <div class="list"><a href="index.php">Home</a></div>
            <li><a href="mystuff.php">My Stuff</a></li>
            <li><a href="project-view.php">Projects</a></li>
            <li><a href="team-view.php">Teams</a></li>
            <li><a href="org-view.php">Orgs</a></li>
            <li><a href="measure.php">Measure</a></li>	
            <li><a href="reduce.php">Reduce</a></li>	
            <div class="list2"><a href="search.php">Search</a></div>
        </ul>
    </div>
    
    <div class="content"> <!-- start of Content ---------------------------------------------------- -->
        
        <div>
        	<div class="box">
				<div><span class="style3">Support </span></div>
                <br />
            	<div><span class="style8">
									<p>Earth Deeds is in beta phase and no technical support is officially being offered at this time.</p>
<p>Any technical questions or technical support requests should be addressed to Shanti Gaia at&nbsp;<a href="mailto:shanti@earthdeeds.com" target="_blank">shanti@earthdeeds.com</a></p>
				</span>
                </div>

			
        <div class="clear"></div>
        </div>
        </div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
    <div class="footer">
    	<div style="float: left; width: 590px; height: auto;"> 
        	<span class="style11"> <a href="page-aboutus.php">About Us</a>    |    <a href="page-contactus.php">Contact Us</a>     |   <a href="page-support.php"> Support </a>    |    <a href="page-TOC.php"> Terms and Conditions</a></span>        </div>
        	<span class="style11">Copyright 2013. EarthDeeds. All Rights Reserved</span>
        </div>
        <div class="clear"></div>
    </div>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
