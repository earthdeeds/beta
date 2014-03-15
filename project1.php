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
<title>Project Page : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="js/yetii.js"></script>	</head>

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

<div style="width: 545px;" id="tab-container-1">

					<ul id="tab-container-1-nav">
					<li><a href="#tab1">Summary</a></li>
					<li><a href="#tab2">Updates</a></li>
					<li><a href="#tab3">Awards</a></li>
					<li><a href="#tab4">Teams Who Support Us</a></li>
					<li><a href="#tab5">Support Received</a></li>
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
			$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultproj);			
			while($rowproj = mysql_fetch_array( $resultproj )) {
						$projectteamid = $rowproj['team_idnum'];
						$projectid = $rowproj['project_account_idnum'];
						if ($rowproj['project_profile_photo'] == "projimages/"){
						echo "<div style=\"float: left; width: 115px; height: 112px; margin-right: 10px;\"><img src=\"http://beta.earthdeeds.com/projimages/project.jpg\" width=\"115\" height=\"112\" alt=\"".$rowproj['project_creator_username']."\"></div>";
						}
						else
						{
						echo "<div style=\"float: left; width: 115px; height: 112px; margin-right: 10px;\"><img src=\"".$rowproj['project_profile_photo']."\" width=\"115\" height=\"112\" alt=\"".$rowproj['project_creator_username']."\"></div>";
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
                	<div><span class="style10">Project: <?php echo $titleproj; ?></span></div>
                    <br />
                    <div><span class="style12"><?php echo $description; ?></span></div>
                    <div><span class="style12"><a href="<?php echo $projecturl; ?>"><?php echo $projecturl; ?></a></span></div>
              </div>
                <div class="clear"></div>
            </div>
            
                        
            <div class="box">
            	<div><span class="style13"><?php echo $titleproj; ?></span></div>
                <br />
                <span class="style8"><?php echo $descriptionlong; ?>
			</span>
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
											echo "<div style=\"float: left; width: 115px; height: 112px; margin-right: 10px;\"><img src=\"http://beta.earthdeeds.com/projimages/project.jpg\" width=\"115\" height=\"112\" alt=\"".$rowproj['project_creator_username']."\"></div>";
											}
											else
											{
											echo "<div style=\"float: left; width: 115px; height: 112px; margin-right: 10px;\"><img src=\"".$rowproj['project_profile_photo']."\" width=\"115\" height=\"112\" alt=\"".$rowproj['project_creator_username']."\"></div>";
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
										<div><span class="style10">Project: <?php echo $titleproj; ?></span></div>
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
	
            
        </div> <!-- End of left ---------------------------------------------------- -->
		
         <!-- start of right ---------------------------------------------------- -->
        <div class="right">
        	<div class="box2">
	
            	<div style="float: left; width: 150px;">
				
	
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
                <div style="float: right; width: 110px;">
				<div style="padding: 10px;"><span class="style6">Support</span></div>
				<?php
			$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultproj);			

			while($rowproj = mysql_fetch_array( $resultproj )) {
						$projectteamid = $rowproj['team_idnum'];
				$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
						$rowChecktep = mysql_num_rows($resultteam);			
						if($rowChecktep > 0){
					while($rowteam = mysql_fetch_array( $resultteam )) {

				$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectteamid'") or die(mysql_error());  		
				$rowCheck = mysql_num_rows($resultsupport);			
				$total = 0;	
					while($rowsupport = mysql_fetch_array( $resultsupport )) {
					$price= $rowsupport['project_support'];
					$total += $price;
					$support = 1;
					}

					if ($support) {
					$totalteamsupport = $total + $rowproj['project_support'];
					echo  '<div style=" padding: 10px;border: 1px solid #dadada; background: #eeeeee;"><span class="style8">$'.$totalteamsupport.'</span></div>';
					}
					else
					{
					echo '<div style=" padding: 10px;border: 1px solid #dadada; background: #eeeeee;"><span class="style8">$'.$rowproj['project_support'].'</span></div>';
					}

				}	
				}
				else
				{
				echo "N/A";
				}
			}				
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
					<form method="POST" action="includes/checklogin.php">
					<input type = "hidden" value="<?php echo $projid; ?>" name="projectid">
					<input type = "hidden" value="<?php echo $teamid; ?>" name="teameditid">
					<input type="hidden" name="identify" value="projectedit"/>
					<input type = "password" name="projpassword" placeholder="Project Password" size="15px">
					<input type = "submit"  id="edit"  name="submit" value="Edit Project"><br/>
					</form>
					<?php 
					if ($loginerror== "logerror"){	
					echo "<p class=\"errorpass\">wrong password</p>";
					}
					?>

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
