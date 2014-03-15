<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}
$username = $_SESSION['myusername'];
include('connect-db.php');
$projid = $_GET['projid'];
$identity = $_GET['identify'];
$teamid = $_GET['teamid'];
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
			
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
			while($row = mysql_fetch_array( $result )) {
				$userid = $row['ID'];
				}
			
			$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum= '$projid'") or die(mysql_error());  
			echo '<table width="490px">';
			echo '<tr><th class="proj" width="310px">Team</th> <th class="proj" width="130px">Action</th></tr>';
			while($rowproj = mysql_fetch_array( $resultproj )) {
			$teamprojid = $rowproj['team_idnum'];
			
			echo '</br><span>team  connected to this project </span> <a class="usertext" href="project.php/?projid='.$projid.'">'.$rowproj['project_title'].'</a> ';

			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamprojid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultteam);	
				while($rowteam = mysql_fetch_array( $resultteam )) {
				echo '<tr><td>';
				echo '</br><a class="usertext" href="team.php/?teamid='.$rowteam['Team_account_idnum'].'">'.$rowteam['team_title'].'</a>';
				echo '</td><td>Owned</td></tr>';
				
				}
			
			
			
				}

			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where project_id = '$projid'") or die(mysql_error());  		
			$rowCheck = mysql_num_rows($resultprojadded);	

			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {

			$projteamid = $rowprojadded['team_id'];
			$projaddedid = $rowprojadded['project_id'];
			
			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$projteamid'") or die(mysql_error()); 

				while($rowteam = mysql_fetch_array( $resultteam )) {
				$teamprojid = $rowteam['Team_account_idnum'];
				/*echo '//'.$teamprojid.'//';
				echo $projaddedid.'//';
				echo $userid.'//'; */
				
				echo '<tr>';
				echo '<form name="userform" method="post" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">';	
				echo '<td>';
				echo '</br><a class="usertext" href="team.php/?teamid='.$rowteam['Team_account_idnum'].'">'.$rowteam['team_title'].'</a>';
				echo '<input type="hidden" value="'.$teamprojid.'" name="teamid">';
				echo '<input type="hidden" value="'.$projaddedid.'" name="projid">';
				echo '<input type="hidden" value="'.$userid.'" name="userid">';
				echo '<input type="hidden" name="identify" value="projteamsupport"/>';
				echo '</td><td><input type="Submit" name="delete" value="Unlink to Team" /></td>';
				echo '</form></tr>';
				}
			}
			echo '</table>';

		?>	
		</div>
		</div>
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
