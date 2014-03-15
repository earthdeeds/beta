<?php
session_start();
$username = $_SESSION['myusername'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Error : Earth Deeds </title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
    	<div class="logo"></div>
        <div class="login">
		<?php
		if ($username){
					echo '
        	       	<span class="style1">Logged in as </span><span class="style2"><a href="http://beta.earthdeeds.com/my_stuff/">'.$username.'</a>  | <a href="logout.php">Log Out</a></span> ';  
				
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
		
        <br />
        
        <div>
        <!-- start of left ---------------------------------------------------- -->
        	<div class="box" style="padding: 40px;">
            	<div><span class="style5"><strong>Sorry,</strong></span></div>
                <br />
            	<div><span class="style5">Looks like the page you're looking for was moved, never existed, or could be an error on our site. <br /><br />Please make sure you typed the correct URL or followed a valid link. If you feel this error was due to an error on the site, please let us know by emailing us the url and any other helpful details to:

                    <strong><a href="#">shanti@earthdeeds.com</a></strong><br />
                    <br /> Thank you.
              <br />
              <br />
                
               </span>
                </div>
  <br />
                
                
          </div>

         <!-- start of right ---------------------------------------------------- -->
        
        <div class="clear"></div>
        </div>
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
    <div class="footer">
    	<div style="float: left; width: 590px; height: auto;"> 
        	<span class="style11"> <a href="#">About Us</a>    |    <a href="#">Contact Us</a>     |   <a href="#"> Support </a>    |    <a href="#"> Terms and Conditions</a></span>        </div>
        <div style="float: right; width: 290px; text-align: right;">
        	<span class="style11">Copyright 2013. EarthDeeds. All Rights Reserved</span>
        </div>
        <div class="clear"></div>
    </div>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
