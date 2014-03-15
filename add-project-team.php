<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://earthdeeds.aws.af.cm/login.php?url=".$_SERVER['REQUEST_URI']);
}
$username = $_SESSION['myusername'];
include('connect-db.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Project Team : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->

<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->
<style>
.style19 a {
    color: #2B85DA;
    font-family: MyriadPro-Regular,'Myriad Pro Regular',MyriadPro,'Myriad Pro',Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 39px;
    text-decoration: none;
}
input[type="submit"] {
line-height: 19px;
}
</style>
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

        	<div><span class="style10">Add a Project to the Team</span></div>
            <br />
        	<div class="box">
			                <div style="float: left; width: 400px; height: auto;">
                	<div><span class="style17">Project</span></div>
                    <br />
			<?php		

			include('connect-db.php');
				$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
 
				$rowCheck = mysql_num_rows($result);		
				
						while($row = mysql_fetch_array( $result )) {

							$userid = $row['ID'];
							
							}
			
			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultteam);	

			while($rowteam = mysql_fetch_array( $resultteam )) {
				$teamtitle = $rowteam['team_title'];
			}
			

				$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum != '$teamid' AND project_status > 2") or die(mysql_error());  		
				while($rowproj = mysql_fetch_array( $resultproj )) {					
				echo '<div><span class="style19"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$rowproj['project_account_idnum'].'&teamid='.$teamid.'">'.$rowproj['project_title'].'</a></span></div>';
				
				}

				
				
				?>
                    
                </div>
                
                <div style="float: left;">
                	<div><span class="style15"><?php echo $teamtitle; ?></span></div>
                    <br />
					
					<?php
					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultteam);	

			while($rowteam = mysql_fetch_array( $resultteam )) {
				$teamtitle = $rowteam['team_title'];
			}
			

				$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum != '$teamid' AND project_status > 2") or die(mysql_error());  		

				while($rowproj = mysql_fetch_array( $resultproj )) {				
				echo "<div class=\"button2\">";
				echo '<form name="userform" method="post" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">';	
				echo '<input type="hidden" value="'.$teamid.'" name="teamid">';
				echo '<input type="hidden" value="'.$rowproj['project_account_idnum'].'" name="projid">';
				echo '<input type="hidden" value="'.$userid.'" name="userid">';
				echo '<input type="hidden" name="identify" value="addprojtoteam"/>';
				echo '<input type="Submit" value="Add to team" />';
				echo '</form>';
				echo "</div>";
				}

					?>

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
