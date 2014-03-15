<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}
include('connect-db.php');
$teamid = $_GET['teamid'];
$username = $_SESSION['myusername'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project Registration : Earth Deeds</title>
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

        	<div><span class="style10">Project Registration Form</span></div>
            <br />
        	<div class="box">
			<?php
			include('connect-db.php');
			$resultmember = mysql_query("SELECT * FROM  wp_cc_team_member where team_id = '$teamid'")or die(mysql_error());
				echo '<table width="600px">';
				echo '<tr><th class="proj">Image</th> <th class="proj">Name</th> <th class="proj">Action</th><th class="proj">Action</th></tr>';
				
				while($rowmem = mysql_fetch_array( $resultmember )){ 
				$firstname = $rowmem['user_first_name'];
				$userid = $rowmem['user_id'];
				$teamid = $rowmem['team_id'];
				$result = mysql_query("SELECT * FROM $tbl where ID = '$userid'")or die(mysql_error()); 


					while($row = mysql_fetch_array( $result )){
						
					echo "<tr><td>";
						$profilephoto = $row['user_profile_photo'];
							if ( $profilephoto == 'imagesprofiles/' || $profilephoto == ''){
								echo '<div style="width: 50px; float:  left; margin: 0 5px;">';
								echo "<img border=\"0\" src=\"imagesprofiles/avatar.jpg\" width=\"50\" height=\"50\" alt=\"".$row['user_first_name']."\" ><br />";
								echo '</div>';
							}
							else
							{
								echo '<div style="width: 50px; float:  left; margin: 0 5px;">';
								echo "<img border=\"0\" src=\"".$row['user_profile_photo']."\" width=\"50\" height=\"50\"  alt=\"".$row['user_first_name']."\" ><br />";
								echo '</div>';
							}
							echo "</td><td>";
							echo $row['user_first_name'].' '.$row['user_last_name'];		
							echo "</td>";
							echo "<td>";
							echo '<form name="userform" method="post" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">';	
							echo '<input type="hidden" name="identify" value="projteamsupport"/>';
							echo '<input type="hidden" value="'.$teamid.'" name="teamid">';
							echo '<input type="hidden" value="'.$userid.'" name="userid">';
							echo '<input type="hidden" value="'.$row['user_first_name'].'" name="userfname">';
							echo '<input type="Submit" name="delete" value="Delete Member" /></td>';	
							echo '<td>';
							$result3 = mysql_query("SELECT * FROM wp_cc_team_manager where team_manager_userid = '$userid'")or die(mysql_error());
							
							$rowCheck3 = mysql_num_rows($result3);			
							if($rowCheck3 > 0){							
							echo '<input type="Submit" name="delete" value="Delete Team Manager" />';
							}
							else
							{
							echo '<input type="Submit" name="update" value="Add Team Manager" />';
							
							}
														
							echo "</td></form></tr>";
							
							
						
						}
					}
					echo "</table>";
					?>
            </div>
		</div>
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
