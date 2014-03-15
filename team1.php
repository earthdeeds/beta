<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://beta.earthdeeds.com/login.php");
}
$username = $_SESSION['myusername'];
include('connect-db.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Team Page : Earth Deeds </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="js/yetii.js"></script>	
</head>

<body>
<div class="header">
    	<div class="logo"></div>
        <div class="login">
        	<span class="style1">Logged in as </span><span class="style2"><a href="http://beta.earthdeeds.com/mystuff.php"/><?php echo $username; ?> </a>   | <a href="logout.php">Log Out</a></span>       
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

<div id="tab-container-1">
	
					

					<ul id="tab-container-1-nav">
					<li><a href="#tab1">Summary</a></li>
					<li><a href="#tab2">Updates</a></li>
					<li><a href="#tab3">Awards</a></li>
					<li><a href="#tab4">Projects Supported</a></li>
					<li><a href="#tab4">Support Given</a></li>
					</ul>
					

		<br />
		<div class="line"></div>
		<br />
		
	<div style="width: 920px;">
        <!-- start of left ---------------------------------------------------- -->
        <div class="left"> 
		<div class="tab" id="tab1">
        	<div class="box">
			
			
			
			<?php
			mysql_connect($sHostname, $sUsername, $sPassword) or die(mysql_error());
			mysql_select_db($sDatabase);

			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());
			$rowteam = mysql_fetch_array( $resultteam );
			//echo '<span style="color: #0000FF; font-size: 24px;"> '.$rowteam['team_title'].'</span>'; 
				$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
					while($row = mysql_fetch_array( $result )) {
						$userid = $row['ID'];
						}
					
					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
					if($rowCheck > 0){
					while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamuserid = $rowteam['user_account_id'];
						if ($rowteam['team_image'] == "teamimages/"){
						echo "<div style=\"float: left; width: 83px; height: 107px; margin-right: 10px;\"><img width=\"83px\" height=\"107px\" src=\"imagesprofiles/team.jpg\"> </div>";						
						}
						else
						{
						echo "<div style=\"float: left; width: 83px; height: 107px; margin-right: 10px;\"><img width=\"83px\" height=\"107px\" src=\"".$rowteam['team_image']."\" alt=\"".$rowteam['team_initiator']."\"></div>";
						}
						?>
			<div style="float: right; width: 485px; height: auto;">
                	<div><span class="style3">Team: </span><span class="style4"><?php echo $rowteam['team_title']; ?> </span></div>
                    <div><span class="style5"><?php echo $rowteam['team_description']; ?></span></div>

                
						<?php
						
						
						$longdesc = html_entity_decode( $rowteam['team_long_description'] );
						
					
					$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid'") or die(mysql_error());  
					$totalemm = 0;
					while($rowemission = mysql_fetch_array( $resultemission )) {
				
					$emm = $rowemission['member_emmision'];
					$totalemm +=  $emm;
					}
					
					echo '<div><span class="style6">Team Emissions: </span><span class="style7">';
					if ($emm) {
					$totalteamemm = $totalemm + $rowteam['team_emissions'];
					echo $totalteamemm;
					}
					else
					{
					echo $rowteam['team_emissions'];
					}
					echo 'mT</span></div>';
					
					}
					}
			?>
			
			</div>

                <div class="clear"></div>
            </div>
            			
            <div class="box">
            	<div style="float: left; width: 300px; height: auto;">
                	<div><span class="style9">Team Projects</span></div>
			
			<?php
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamid'") or die(mysql_error());  
					
					while($rowproj = mysql_fetch_array( $resultproj )) {
					$projectid = $rowproj['project_account_idnum'];
					$projectuserid = $rowproj['user_account_id'];
					$projectuser = $rowproj['project_creator_username'];
																								
					echo '<div><span class="style8"><a href="http://beta.earthdeeds.com/project.php?projid='.$projectid.'&teamid='.$teamid.'">'.$rowproj['project_title'].'</a></span></div>';

				}
				
				
				
									
			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamid'") or die(mysql_error());  
			
			
			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
			
						$projectid2 = $rowprojteamadd['project_account_idnum'];																									
						echo '<div><span class="style8"><a href="http://beta.earthdeeds.com/project.php?projid='.$projectid2.'&teamid='.$teamid.'">'.$rowprojteamadd['project_title'].'</a></span></div>';
							
													

					}
					}
					
					
			
			?>
			
			


                </div>
                <div style="float: left; width: 280px; height: auto;">
				
				<div><span class="style9">Team Support</span></div>
				
						<?php
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamid'") or die(mysql_error());  
					
					while($rowproj = mysql_fetch_array( $resultproj )) {
					$projectid = $rowproj['project_account_idnum'];
					$projectuserid = $rowproj['user_account_id'];
					$projectuser = $rowproj['project_creator_username'];
																								
						
							
					$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectid' AND user_id = '$userid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultsupport);	
					if($rowCheck > 0){
					$total = 0;	
					while($rowsupport = mysql_fetch_array( $resultsupport )) {
					$price= $rowsupport['project_support'];
					$total += $price;
					$totalteamsupport = $total + $rowproj['project_support'];
					}
					echo  ' <div><span class="style8">$'.$totalteamsupport.'</span></div>';
					}
					else
					{
					echo ' <div><span class="style8">$'.$rowproj['project_support'].'</span></div>';
					}
				}
				
				
				
									
			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamid'") or die(mysql_error());  
			
			
			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
			
						$projectid2 = $rowprojteamadd['project_account_idnum'];																									
							
							
						$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectid2' AND user_id = '$userid'") or die(mysql_error());  		
						$rowCheck = mysql_num_rows($resultsupport);	
						if($rowCheck > 0){
						$total = 0;	
						while($rowsupport = mysql_fetch_array( $resultsupport )) {
						$price= $rowsupport['project_support'];
						$total += $price;
						$totalteamsupport = $total + $rowprojteamadd['project_support'];
						
						}
						
						echo  ' <div><span class="style8">$'.$totalteamsupport.'</span></div>';
						}
						else
						{
						echo ' <div><span class="style8">$'.$rowprojteamadd['project_support'].'</span></div>';
						}							

					}
					}
					
					
			
			?>

                </div>
            <div class="clear"></div>
            </div>
            
            <div class="box">
            	
                <span class="style8"><?php echo $longdesc; ?></span>
            </div>	
			
			</div>
		<div class="tab" id="tab2">
        	<div class="box">
			
			
			
			<?php
			mysql_connect($sHostname, $sUsername, $sPassword) or die(mysql_error());
			mysql_select_db($sDatabase);

			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());
			$rowteam = mysql_fetch_array( $resultteam );
			//echo '<span style="color: #0000FF; font-size: 24px;"> '.$rowteam['team_title'].'</span>'; 
				$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
					while($row = mysql_fetch_array( $result )) {
						$userid = $row['ID'];
						}
					
					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
					while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamuserid = $rowteam['user_account_id'];
						if ($rowteam['team_image'] == "teamimages/"){
						echo "<div style=\"float: left; width: 83px; height: 107px; margin-right: 10px;\"><img width=\"83px\" height=\"107px\" src=\"imagesprofiles/team.jpg\"> </div>";						
						}
						else
						{
						echo "<div style=\"float: left; width: 83px; height: 107px; margin-right: 10px;\"><img width=\"83px\" height=\"107px\" src=\"".$rowteam['team_image']."\" alt=\"".$rowteam['team_initiator']."\"></div>";
						}
						?>
			<div style="float: right; width: 485px; height: auto;">
                	<div><span class="style3">Team: </span><span class="style4"><?php echo $rowteam['team_title']; ?> </span></div>
                    <div><span class="style5"><?php echo $rowteam['team_description']; ?></span></div>
					
					
			</div>
			<?php } ?>
			<div class="clear"></div>
		</div>

						<?PHP

				$resultupdate = mysql_query("SELECT * FROM post_updates_team where team_id = '$teamid' AND user_id='$userid'") or die(mysql_error());  	$rowCheck = mysql_num_rows($resultupdate);			
				if($rowCheck > 0){
						while($rowupdate = mysql_fetch_array( $resultupdate )) {
						echo '<div class="box"><div>';
						echo '<div><span class="style9">'.$rowupdate['team_post_title'].'</span></div>';
						echo '<div><span class="style8">'.$rowupdate['username'].'</span></div>';
						echo '<div><span class="style8">'.$rowupdate['date'].'</span></div></div> <br/>';
						echo '<span class="style8">'.$rowupdate['team_post_content'];
						echo '</span>
							<div class="clear"></div>
							</div>';
						}
						}
						else
						{
						echo 'no updates found';
						}
						?>
				<div class="clear"></div>
		</div>
		
         
        </div> <!-- End of left ---------------------------------------------------- -->
         <!-- start of right ---------------------------------------------------- -->
        <div class="right">
        	<div class="box">
            	<div><span class="style10">Team Managers</span></div>
              <div>
			  <?php
				$result = mysql_query("SELECT * FROM $tbl where ID = '$teamuserid'")or die(mysql_error()); 
				while($row = mysql_fetch_array( $result )){
				//$userid = $row['ID'];
				$leader= $row['user_profile_photo'];
					 echo "<div class=\"thumb-pic\"><img border=\"0\" src=\"".$row['user_profile_photo']."\" width=\"50px\" height=\"50px\" alt=\"".$row['user_first_name']."\"></div>";
					 
						}
						
						
				$result1 = mysql_query("SELECT * FROM wp_cc_team_manager where team_id = '$teamid'")or die(mysql_error());
				while($row = mysql_fetch_array( $result1 )){
				$userid1 = $row['team_manager_userid'];
				
				$result2 = mysql_query("SELECT * FROM $tbl where ID = '$userid1'")or die(mysql_error()); 
				while($row = mysql_fetch_array( $result2 )){
				$leader1= $row['user_profile_photo'];
							if ( $leader1 == 'imagesprofiles/' || $leader1 == ''){
							
							echo "<div class=\"thumb-pic\"><img src=\"imagesprofiles/avatar.jpg\" width=\"50px\" height=\"50px\" alt=\"".$row['user_first_name']."\"></div>";
							}
							else
							{
								 echo "<div class=\"thumb-pic\"><img border=\"0\" src=\"".$row['user_profile_photo']."\" width=\"50px\" height=\"50px\" alt=\"".$row['user_first_name']."\"></div>";
							}
					 
					 
					 
					 
					 
					 }
					 
				}
				?>		

                    <div class="clear"></div>
              </div>
				
			<div class="clear"></div>
			<div><span class="style10">Team Members</span></div>
				<div>
			  
							  <?php			
								echo "<div class=\"thumb-pic\"><img src=\"".$leader."\" width=\"50px\" height=\"50px\" alt=\"".$row['user_first_name']."\">";
								echo '</div>';
								$resultmember = mysql_query("SELECT * FROM  wp_cc_team_member where team_id = '$teamid'")or die(mysql_error());
								$counter = 0;
								while(($rowmem = mysql_fetch_array( $resultmember ))  and ($counter < 15)){ 
								$firstname = $rowmem['user_first_name'];
								$userid2 = $rowmem['user_id'];
								
								$result = mysql_query("SELECT * FROM $tbl where ID = '$userid2'")or die(mysql_error()); 

										
									while($row = mysql_fetch_array( $result )){
									
										$profilephoto = $row['user_profile_photo'];
											if ( $profilephoto == 'imagesprofiles/' || $profilephoto == ''){

												/*echo "<div class=\"thumb-pic\"><img src=\"imagesprofiles/avatar.jpg\" width=\"50px\" height=\"50px\" alt=\"".$row['user_first_name']."\" >";
												echo '</div>';*/
											}
											else
											{

												echo " <div class=\"thumb-pic\"><img src=\"".$row['user_profile_photo']."\" width=\"50px\" height=\"50px\"  alt=\"".$row['user_first_name']."\" >";
												echo '</div>';
											}
											
										}
										 $counter++;
									}

									?>

				</div>	
				<div class="clear"><span class="style8"><a href="team-members.php?teamid=<?php echo $teamid ?>">see all members</a></span></div>

				</div>
				
							<div class="box">
						<div class="clear"></div>
							<div id= "editlink">
							<form method="POST" action="includes/checklogin.php">
							<input type = "hidden" value="<?php echo $teamid ?>" name="teamid">
							<input type="hidden" name="identify" value="teamedit"/>
							<input type = "password" name="teampassword" placeholder="Team Password"  size="15px">
							<input type = "submit" id="edit" name="submit" value="Edit Team"><br/>
							</form>
							<?php 
							if ($loginerror== "logerror"){	
							echo "<p class=\"errorpass\">wrong password</p>";
							}
							?>
<a href="checkout.php?teamid=<?php echo $teamid; ?>">Click here to proceed to checkout</a></br>
						</div>
					</div>
					</div>
        </div><!-- start of right ---------------------------------------------------- -->
        	 
</div> <!-- End of Content ---------------------------------------------------- -->	
<div class="clear"></div>	
</div>
<script type="text/javascript">
var tabber1 = new Yetii({
id: 'tab-container-1', 
active: 1
});
</script>
        <div class="shadow"></div>
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
