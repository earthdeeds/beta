<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}
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
<title>Organization Page : Earth Deeds</title>
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
    	<div class="nav3">
        	<ul>
            	<li><a href="#">Summary</a></li>
                <li><a href="#">Updates</a></li>
                <li><a href="#">Awards</a></li>
                <li><a href="#">Teams Who Support Us</a></li>
                <li><a href="#">Support Received</a></li>
            </ul>
        </div>	
        <br />
        <div class="line"></div>
        <br />
        
        <!-- start of left ---------------------------------------------------- -->
        <div> 
        	<div class="box">
			<?php
			$resultorg = mysql_query("SELECT * FROM $tblorg where Organization_account_idnum = '$orgid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultorg);			
			while($roworg = mysql_fetch_array( $resultorg )) {
						if ($roworg['Organization_profile_photo'] == "orgimages/"){
						echo "<div style=\"float: left; width: 115px; height: 112px; margin-right: 10px;\"><img src=\"http://beta.earthdeeds.com/projimages/project.jpg\" width=\"115\" height=\"112\" alt=\"".$roworg['Organization_profile_photo']."\"></div>";
						}
						else
						{
						echo "<div style=\"float: left; width: 115px; height: 112px; margin-right: 10px;\"><img src=\"".$roworg['Organization_profile_photo']."\" width=\"115\" height=\"112\"></div>";
						}
						
				$titleorg = $roworg['Organization_title'];		
				$description = $roworg['Organization_description'];
				$descriptionlong = html_entity_decode($roworg['Organization_long_description']);
					
				

			}
			
?>
              <div style="float: right; width: 465px; height: auto;">
                	<div><span class="style10">Organization: <?php echo $titleorg; ?></span></div>
                    <br />
                    <div><span class="style12"><?php echo $description; ?></span></div>
                    
              </div>
                <div class="clear"></div>
                <div class="clear"></div>
            </div>
            
                        
            <div class="box">
            	<div><span class="style13"><?php echo $titleorg; ?></span></div>
                <br />
                <span class="style8"><?php echo $descriptionlong; ?></span>
            </div>	
            
      
        <div class="clear"></div>
        </div>
			<div id= "editlink">
	<form method="POST" action="includes/checklogin.php">
	<input type = "hidden" value="<?php echo $orgid; ?>" name="orgid">
	<input type="hidden" name="identify" value="orgedit"/>
	<input type = "password" name="orgpassword" placeholder="Organization Password"  size="15px">
	<input type = "submit" name="submit" value="Edit Organization"><br/>
	</form>
	<?php 
	if ($loginerror== "logerror"){	
	echo "<p class=\"errorpass\">wrong password</p>";
	}
	?>
		
		</div>
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
