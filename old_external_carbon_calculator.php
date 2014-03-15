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
<title>Measure Page : Earth Deeds</title>
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
				<style>

			.entry-title {
    				color: #000000;
    				font-size: 40px;
    				font-weight: bold;
    				text-decoration: none;
   				text-shadow: 1px 4px 6px rgba(0, 0, 0, 0.2), 0 -5px 35px rgba(255, 255, 255, 0.3);
   				font-family: 'Helvetica Neue',sans-serif;
    			}

    			.entry-p {
    				color: #000000;
    				font-size: 14px;
    				font-weight: light;
    				text-decoration: none;
   				//text-shadow: 1px 4px 6px rgba(0, 0, 0, 0.2), 0 -5px 35px rgba(255, 255, 255, 0.3);
   				font-family: 'Helvetica';
    			}
    			</style>
	<span class="entry-p"><p>You can use this carbon footprint calculator to calculate carbon emissions for you or your team.
Or you can feel free to just use the carbon emissions calculator below for right now for any other purpose.</p></span>

<iframe src="http://calculator.carbonfootprint.com/calculator.aspx" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" width="900" height="750"></iframe>
        <div class="clear"></div>
        </div>
        </div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
