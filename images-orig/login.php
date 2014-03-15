<?php

session_start();

if(session_is_registered(myusername)){
header("location:http://sandbox.earthdeeds.com/mystuff.php");
}
require 'facebook.php';
include_once "fbmain.php";
$facebook = new Facebook(array(
  'appId'  => '241738939291376',
  'secret' => '52b2d7acd4729b1d0eb3cf3a17fb5694',
));

$autologin = $_GET['autologin'];
$uname = $_GET['uname'];

if ($autologin=="true"){
$myusername = $uname;
session_register("myusername");
}
$teamid = $_GET['teamid'];
$teamreg = $_GET['teamreg'];
include('connect-db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login : Earth Deeds</title>
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


<div id="fb-root"></div>
    <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
     <script type="text/javascript">
       FB.init({
         appId  : '<?=$fbconfig['appid']?>',
         status : true, // check login status
         cookie : true, // enable cookies to allow the server to access the session
         xfbml  : true  // parse XFBML
       });
       
     </script>
	
	<center>
				<form name="form1" method="post" action="includes/checklogin.php">
				<strong style="font-size: 40px; font-weight: bold;">Member Login </strong><br />
				<?php 
				if ($loginerror== "logerror"){	
				echo "<p class=\"errorpassmain\">Error Login Details</p>";
				}
				?>
				<input type="hidden" name="teamreg" value="<?php echo $teamreg; ?>" class="userform" size="40" />
				<input type="hidden" name="teamid" value="<?php echo $teamid; ?>" class="userform" size="40" />
				<strong>Username: </strong><input name="myusername" type="text" id="myusername"><br /><br />
				<strong>Password: </strong><input name="mypassword" type="password" id="mypassword"><br /><br />
				<input type="submit" name="Submit" value="Login">
				</form>

				<strong style="font-size: 40px; font-weight: bold;">not a member? 
				<?php	if ($teamreg == "member"){	
				echo "<a href=\"User-Registration.php?teamid=".$teamid."&teamreg=member\">register here </a></strong><br />";
				}
				else
				{
				echo '<a href="User-Registration.php">register here </a></strong><br /><br />';
				}
				
				?>
				
				
				
				
		
				
	</center>

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