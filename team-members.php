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
<title>Team Members : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
    	<div class="logo"></div>
        <div class="login">
		<?php
		if ($username){
					echo '
        	       	<span class="style1">Logged in as </span><span class="style2"><a href="http://beta.earthdeeds.com/mystuff.php">'.$username.'</a>  | <a href="logout.php">Log Out</a></span> ';  
				
					}
					else
					{
					echo '<span style="margin: 0 100px 0 0;" class="style2"><a href="login.php">Login</a></span>';
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
							  <?php		

$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			

					while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamuserid = $rowteam['user_account_id'];
						if ($rowteam['team_image'] == "teamimages/"){
						echo "<div style=\"float: left; width: 83px; height: 107px; margin-right: 10px;\"><img width=\"83px\" height=\"107px\" src=\"http://beta.earthdeeds.com/teamimages/team.jpg\"> </div>";						
						}
						else
						{
						echo "<div style=\"float: left; width: 83px; height: 107px; margin-right: 10px;\"><img width=\"83px\" height=\"107px\" src=\"".$rowteam['team_image']."\" alt=\"".$rowteam['team_initiator']."\"></div>";
						}
						
						?>
			<div style="float: right; width: 900px; height: auto;">
                	<div><span class="style3">Team: </span><span class="style4"><?php echo $rowteam['team_title']; ?> </span></div>
                    <div><span class="style5"><?php echo $rowteam['team_description']; ?></span></div>
			</div>
                <?php		
}				
				$result = mysql_query("SELECT * FROM $tbl where ID = '$teamuserid'")or die(mysql_error()); 
				while($row = mysql_fetch_array( $result )){
				$userid = $row['ID'];
				$fname = $row['user_first_name'];
				$leader= $row['user_profile_photo'];
				}
								echo "<div class=\"thumb-pic\"><img src=\"".$leader."\" width=\"100px\" height=\"100px\" alt=\"".$fname."\"></br>".$fname."";
								echo '</div>';
								$resultmember = mysql_query("SELECT * FROM  wp_cc_team_member where team_id = '$teamid'")or die(mysql_error());
								while($rowmem = mysql_fetch_array( $resultmember )){ 
								$firstname = $rowmem['user_first_name'];
								$userid = $rowmem['user_id'];
								
								$result = mysql_query("SELECT * FROM $tbl where ID = '$userid'")or die(mysql_error()); 

										
									while($row = mysql_fetch_array( $result )){
									
										$profilephoto = $row['user_profile_photo'];
											if ( $profilephoto == 'imagesprofiles/' || $profilephoto == ''){

												echo "<div class=\"thumb-pic\"><img src=\"imagesprofiles/avatar.jpg\" width=\"100px\" height=\"100px\" alt=\"".$row['user_first_name']."\" ></br>".$row['user_first_name']."";
												echo '</div>';
											}
											else
											{


												echo " <div class=\"thumb-pic\"><img src=\"imageresize/".$row['user_profile_photo']."\" width=\"100px\" height=\"100px\"  alt=\"".$row['user_first_name']."\" ></br>".$row['user_first_name']."";
												echo '</div>';
											}
											
										}
									
									}

									?>
        <div class="clear"></div>
        </div>
        </div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
