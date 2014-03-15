<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}
$username = $_SESSION['myusername'];
include('connect-db.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>List Items : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
    	<div class="logo"></div>
        <div class="login">
        	<span class="style1">Logged in as </span><span class="style2"><a href="mystuff.php"><?php echo $username; ?></a>  | <a href="logout.php">Log Out</a></span>           
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

        	<div><span class="style10">List of Team</span></div>
            <div><span class="style5">Team connected to <<a href="#">Test Project 20</a>></span></div>
        <br />
        	<div class="box">
                <div style="float: left; width: 100px; height: auto;">
                	<div><span class="style17">Team</span></div>
                    <br />
                    
                    <div class="list-pic"><img src="images/list-image1.jpg" /></div>
                    <div class="list-pic"><img src="images/list-image2.jpg" /></div>

                </div>
                
                <div style="float: left; width: 300px; height: auto;">
                	<div><span class="style17">Name</span></div>
                    <br />
                    
                    <div><span class="style21">Test User11</span></div>
                    <div><span class="style21">Shanti</span></div>
                </div>
                
                <div style="float: left; width: 200px;">
                	<div><span class="style15">Action</span></div>
                    <br /><br />
                    <div class="button3"><a href="#">Unlink to Team</a></div>
                    <div class="button3"><a href="#">Unlink to Team</a></div>
                </div>
                
                <div class="clear"></div>

            </div>

       
        </div>
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
