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
<title>Project Page : Earth Deeds</title>
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
        
          <br />
        
        <div>
        <!-- start of left ---------------------------------------------------- -->
        	<div class="box" style="padding: 40px;">

            	<div><span class="style25"><a href="#"><strong>Wiser.org</a> is a global village of people and organizations working toward social justice, indigenous rights, 
and environmental stewardship.  Search their 100,000+ listed organizations and request those you might 
want to support to create a project on Earth Deeds.</strong>  
				<br /><br />
                We'll follow up with them and let you know when they have created a project.
                <br /><br />
                </span>
	            </div>
                
                <div style="border: 1px solid #d0d0d0; padding: 10px; background: #f7f7f7;">
                	<span class="style25">
                    	Please be sure to write a short personal note about why you would like to have the project created before you submit your request.
                    </span>
                </div>
                
                <br />
            	<div>
                	<span class="style25">
                		<strong>Thank you for your involvement!</strong>
                	</span>
	            </div>
  <br />
                
                
          </div>

         <!-- start of right ---------------------------------------------------- -->
        
        <div class="clear"></div>
        </div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
