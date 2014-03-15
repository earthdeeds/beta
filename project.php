<?php
session_start();
if(!session_is_registered(myusername)){
//header("location:http://beta.earthdeeds.com/login.php");
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
<title>Project Page : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link type="text/css" href="http://beta.earthdeeds.com/zen/p2/z/widget/css.php" rel="stylesheet"></link>
<script type="text/javascript" src="http://beta.earthdeeds.com/zen/p2/z/widget/jquery.js"></script>
<script type="text/javascript" src="http://beta.earthdeeds.com/zen/p2/z/widget/js.php"></script>
<script type="text/javascript" src="js/yetii.js"></script>	
<style>
#tab-container-1 .boxcontent ul{clear: both; margin-left: 20px;}
#tab-container-1 .boxcontent ul li { list-style: disc; width: 600px;}
#tab-container-1 .boxcontent ul li a {  background: none; font-size: 12px;}

</style>
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

<div id="tab-container-1" style="width: 245px;">

					<ul id="tab-container-1-nav">
					<li><a href="#tab1">Summary</a></li>
				<!--	<li><a href="#tab2">Details</a></li> -->
					<li><a href="#tab2">Updates</a></li>
				<!--	<li><a href="#tab4">Teams Who Support Us</a></li>-->
					<li><a href="#tab3">Admin</a></li>
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
				$result = mysql_query("SELECT * FROM $tbl where user_username = '$username' OR user_facebook_id =  '$username'") 
				or die(mysql_error());  
				while($row = mysql_fetch_array( $result )) {
				if ($row['user_facebook_id']){
						$userid = $row['ID'];
				}
				else
				{
				$userid = $row['ID'];				
				}
				}
			$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultproj);			
			while($rowproj = mysql_fetch_array( $resultproj )) {
						$projectteamid = $rowproj['team_idnum'];
						$projectid = $rowproj['project_account_idnum'];
						if ($rowproj['project_profile_photo'] == "projimages/"){
							echo '
							<div class="boxprofile" style="float: left; width: 80px; height: 80px;">
							<table width="100%" height="100%" align="center" valign="center">
							<tr><td>
							<center><img style="float: left; margin-top: -3px; width: 80px; height: 80px;" src="projimages/project.jpg"></center>
							</td></tr>
							</table>
							</div>
							';	
						}
						else
						{
							$projthumb = $rowproj['project_profile_photo'];
							include("resize-class.php");
							$resizeObj = new resize($projthumb);
							$resizeObj -> resizeImage(80, 80, 'auto');
							$resizeObj -> saveImage('imageresize/'.$projthumb, 100);
							echo '
							<div class="boxprofile" style="float: left; width: 80px; height: 80px;">
							<table width="100%" height="100%" align="center" valign="center">
							<tr><td>
							<center><img src="imageresize/'.$rowproj['project_profile_photo'].'"></center>
							</td></tr>
							</table>
							</div>
							';				
						}
				
						
				$titleproj = $rowproj['project_title'];		
				$description = $rowproj['project_description'];
				$projecturl = $rowproj['project_URL'];
				$descriptionlong = html_entity_decode($rowproj['project_long_description']);

				
				$address = $rowproj['project_address1'];
				$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
				$response = json_decode($response);
				$lat = $response->results[0]->geometry->location->lat;
				$long = $response->results[0]->geometry->location->lng;
			}
?>
                <div style="float: right; width: 465px; height: auto;">
                	<div><span class="style10"><?php echo $titleproj; ?></span></div>
                    <br />
                    <div><span class="style12"><?php echo $description; ?></span></div>
                    <div><span class="style12"><a href="<?php echo $projecturl; ?>"><?php echo $projecturl; ?></a></span></div>
              </div>
                <div class="clear"></div>
            </div>
            
                        
            <div class="boxcontent box">
                <span class="style8"><?php echo $descriptionlong; ?></span>
			</div>	
			</div>
			
			
			
			<div class="tab" id="tab2">
					<div class="box">
								<?php
								$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projid'") or die(mysql_error());  
								$rowCheck = mysql_num_rows($resultproj);			
								while($rowproj = mysql_fetch_array( $resultproj )) {
											$projectteamid = $rowproj['team_idnum'];
											$projectid = $rowproj['project_account_idnum'];
																if ($rowproj['project_profile_photo'] == "projimages/"){
						echo "<div style=\"float: left; width: 80px; height: 80px; margin-right: 10px;\"><img src=\"http://sandbox.earthdeeds.com/projimages/project.jpg\" width=\"80\" height=\"80\" alt=\"".$rowproj['project_creator_username']."\"></div>";
						}
						else
						{

						echo "<div style=\"float: left; margin-right: 10px;\"><img src=\"imageresize/".$rowproj['project_profile_photo']."\"  alt=\"".$rowproj['project_creator_username']."\"></div>";
						}
				
											
									$titleproj = $rowproj['project_title'];		
									$description = $rowproj['project_description'];
									$projecturl = $rowproj['project_URL'];
									$descriptionlong = html_entity_decode($rowproj['project_long_description']);
										
									
									echo '</br><b>Address:</b>  '.$rowproj['project_address1'];
									
									$address = $rowproj['project_address1'];
									$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
									$response = json_decode($response);
									$lat = $response->results[0]->geometry->location->lat;
									$long = $response->results[0]->geometry->location->lng;
								}
					?>
									<div style="float: right; width: 465px; height: auto;">
										<div><span class="style10"><?php echo $titleproj; ?></span></div>
										<br />
										<div><span class="style12"><?php echo $description; ?></span></div>
										<div><span class="style12"><a href="<?php echo $projecturl; ?>"><?php echo $projecturl; ?></a></span></div>
								  </div>
									<div class="clear"></div>
								</div>
								
			
			
					
						<?PHP
						$resultupdate = mysql_query("SELECT * FROM post_updates_project where project_id = '$projid' AND user_id = '$userid'") or die(mysql_error());  
						$rowCheck = mysql_num_rows($resultupdate);			
						if($rowCheck > 0){
						while($rowupdate = mysql_fetch_array( $resultupdate )) {
						echo '<div class="box"><div>';
						echo '<div><span class="style9">'.$rowupdate['project_post_title'].'</span></div>';
						echo '<div><span class="style8">'.$rowupdate['username'].'</span></div>';
						echo '<div><span class="style8">'.$rowupdate['date'].'</span></div></div> <br />';
						echo '<span class="style8">'.$rowupdate['project_post_content'];
						echo '</span>
						<div class="clear"></div>
						</div>';
						}
						}
						else
						{
						echo '<p>no updates found</p>';
						}
						?>
				         
				
        </div>
		
		<!---------------------------------------------------------admin------------------------------------------------------------------>
			<div class="tab" id="tab3">
					<div class="box">
						<div style="float: left; width: 115px; height: 112px; margin-right: 10px;">
					<?php
					
						$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projid'") or die(mysql_error());  
								$rowCheck = mysql_num_rows($resultproj);			
								while($rowproj = mysql_fetch_array( $resultproj )) {
											$projectteamid = $rowproj['team_idnum'];
											$projectid = $rowproj['project_account_idnum'];
					if ($rowproj['project_profile_photo'] == "projimages/"){
						echo "<div style=\"float: left; width: 80px; height: 80px; margin-right: 10px;\"><img src=\"http://sandbox.earthdeeds.com/projimages/project.jpg\" width=\"80\" height=\"80\" alt=\"".$rowproj['project_creator_username']."\"></div>";
						}
						else
						{
						echo "<div style=\"float: left; margin-right: 10px;\"><img src=\"imageresize/".$rowproj['project_profile_photo']."\"  alt=\"".$rowproj['project_creator_username']."\"></div>";
						}
													$titleproj = $rowproj['project_title'];		
									$description = $rowproj['project_description'];
					
					}
	
					
					?>
					</div>
               <div style="float: right; width: 465px; height: auto;">
                	<div><span class="style10"><?php echo $titleproj; ?></span></div>
                    <br />
                    
              </div>
                <div class="clear"></div>
            </div>
            
                        
            <div class="box">
 
                <span class="style8">This page is for project administrators only. <br /><br />
                If you are a project administrator, please enter the project password below to access the project administration page:</span>
				<div class="clear"></div>
            </div>
  
            <div>

							<form method="POST" action="includes/checklogin.php">
					<input type = "hidden" value="<?php echo $projid; ?>" name="projectid">
					<input type = "hidden" value="<?php echo $teamid; ?>" name="teameditid">
					<input type="hidden" name="identify" value="projectedit"/>
					<div style="float: left;"><input name="projpassword" type="password" class="input2" style="height: 18px; width: 200px; margin-right: 10px;"></div>
            	<div style="float: left;"><input type = "submit" name="submit"  id="edit" value="Edit Project" class="button2" style="font-weight: normal;"></div>	
					</form>
					<?php 
					if ($loginerror== "logerror"){	
					echo "<p class=\"errorpass\">wrong password</p>";
					}
					?>
					
										
								<?php
				$resultteam = mysql_query("SELECT * FROM wp_cc_project_account where project_account_idnum = '$projid' AND user_account_id = '$userid'") 
				or die(mysql_error()); 
				$rowCheckteam = mysql_num_rows($resultteam);		
				if($rowCheckteam > 0){	
				echo '<center><a href="Pass-update.php?type=project&projid='.$projid.'&teamid='.$teamid.'&userid='.$userid.'">Forgot Password?</a></center>	';
				}
				else
				{
				//echo 'Only team manager can change passwords';
				}
							?>
</div>
					
				
        </div>	
            
        </div> <!-- End of left ---------------------------------------------------- -->
         <!-- start of right ---------------------------------------------------- -->
        <div class="right">
        	<div class="box2">
	
            	<div style="float: left; width: 170px;">
				
	
                	<div style="padding: 10px;"><span class="style6">Teams</span></div>
								<?php
				$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
						$rowChecktep1 = mysql_num_rows($resultteam);			
						if($rowChecktep1 > 0){
					while($rowteam = mysql_fetch_array( $resultteam )) {
					
					$position=20; // Define how many character you want to display.

					$message= $rowteam['team_title'];
					$teamtitle = substr($message, 0, $position);

					echo'<div style=" padding: 10px;border: 1px solid #dadada; background: #eeeeee;"><span class="style8"><a href="team.php?teamid='.$rowteam['Team_account_idnum'].'">'.$teamtitle.'...</a></span></div>';
					
							
				}
				}
				else
				{
				echo "No Team";
				
				}
				
										
		
		
		?>	
                 
                </div>
                <div style="float: right; width: 90px;">
				<div style="padding: 10px;"><span class="style6">Support</span></div>
				<?php


				$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projid' AND team_id = '$teamid' AND pp_tx_status = 'admin'") or die(mysql_error());  		
				$rowCheck = mysql_num_rows($resultsupport);			
				$total = 0;	
					while($rowsupport = mysql_fetch_array( $resultsupport )) {
					$price= $rowsupport['project_support'];
					$total += $price;
					}
					$totalteamsupport = $total;
					echo  '<div style=" padding: 10px;border: 1px solid #dadada; background: #eeeeee;"><span class="style8">$'.$totalteamsupport.'</span></div>';
					/*
					if ($support) {
					$totalteamsupport = $total + $rowproj['project_support'];
					echo  '<div style=" padding: 10px;border: 1px solid #dadada; background: #eeeeee;"><span class="style8">$'.$totalteamsupport.'</span></div>';
					}
					else
					{
					echo '<div style=" padding: 10px;border: 1px solid #dadada; background: #eeeeee;"><span class="style8">$0</span></div>';
					}

					*/				
		?>	

                </div>
                <div class="clear"></div>            	
            </div>
				<?php
				$resultproj1 = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projid'") or die(mysql_error());  
							
							while($rowproj1 = mysql_fetch_array( $resultproj1 )) {
							$address = $rowproj1['project_address1'];
								$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
								$response = json_decode($response);
								$lat = $response->results[0]->geometry->location->lat;
								$long = $response->results[0]->geometry->location->lng;
							
							}
				?>
					<script src="http://maps.google.com/maps/api/js?sensor=false" 
							  type="text/javascript"></script>
					<div id="map" style="width: 260px; height: 204px;"></div>

					  <script type="text/javascript">
						var locations = [
						  ['<?php echo $address;?>', <?php echo $lat;?>, <?php echo $long;?>],
						];

						var map = new google.maps.Map(document.getElementById('map'), {
						  zoom: 10,
						  center: new google.maps.LatLng(<?php echo $lat;?>, <?php echo $long;?>),
						  mapTypeId: google.maps.MapTypeId.ROADMAP
						});

						var infowindow = new google.maps.InfoWindow();

						var marker, i;

						for (i = 0; i < locations.length; i++) {  
						  marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations[i][1], locations[i][2]),
							map: map
						  });

						  google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
							  infowindow.setContent(locations[i][0]);
							  infowindow.open(map, marker);
							}
						  })(marker, i));
						}
					  </script>

					<div class="box2">        
					<div id= "editlink">
					

						</div>   
					</div>
           </div> 
        </div><!-- end of right ---------------------------------------------------- -->
		</div>
<div class="clear"></div>
</div> <!-- End of Content ---------------------------------------------------- -->
<div class="shadow"></div>
 <script type="text/javascript">
var tabber1 = new Yetii({
id: 'tab-container-1', 
active: 1
});
</script>   
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
