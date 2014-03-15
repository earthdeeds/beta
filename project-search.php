<?php
session_start();
if(!session_is_registered(myusername)){
/*header("location:http://beta.earthdeeds.com/login.php");*/
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

        <br />
        <div class="line"></div>
        <br />
		<div style="float: left;"><a href="search.php" class="style8" > <input type = "submit" name="submit" value="BACK TO SEARCH"> </a></div>
		<div class="clear"></div>
        <div style="width: 920px;">
		
        <!-- start of left ---------------------------------------------------- -->
        <div class="left"> 
					
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
            
                        
            <div class="box">
                <span class="style8"><?php echo $descriptionlong; ?></span>
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


		   </div>
        </div><!-- end of right ---------------------------------------------------- -->
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
