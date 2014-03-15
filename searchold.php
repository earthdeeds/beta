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
<title>Search Page : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
    	<div class="logo"></div>
        <div class="login">
		<?php
		if ($username){
					echo '
        	       	<span class="style1">Logged in as </span><span class="style2"><a href="mystaff.php">'.$username.'</a>  | <a href="logout.php">Log Out</a></span> ';  
				
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
        
        <div>
<?php				
$username = $_SESSION['myusername'];
$teamid = $_GET['teamid'];
$projid = $_GET['projid'];
$loginerror = $_GET['loginerror'];
?>

	<div class="left3">
                <div class="box">
                   <div><span class="style10">Search Options</span></div>
                   <br />
				   <form action="search.php" method="post">
                   <div><span class="style27">Keyword</span></div>
                   <div><input name="keyword" type="text" class="input-search"/></div>
                   <div><span class="style27">Type</span></div>
                   <div><select id="drop" name="vartype" class="input-search2">
				   <option value="project">Projects</option>
                     <option value="team">Teams</option>
                     <option value="org">Organizations</option>
                   </select></div>
                   <br />
                   <div>
                		<div class="button4x"><!--<a href="#">SEARCH</a>--><input type="submit" /></div>
                   </div>
				   </form> 
				   </br>
				   <a href="search-wiser.php">Advance Search via Wiser.org </a>
                	<br />
                </div>
        </div><!-- end of right ---------------------------------------------------- -->
		 <div class="right3"> 

								<?php
											$vartype = $_POST['vartype'];
											$keyword = $_POST['keyword'];
											$location = $_post['location'];
											include('connect-db.php');
											
											if ($vartype =="project" ){
											$tblsearch = $tblproject; 
											$keysearch = 'project_title';
											$stat = 'project_status';
											} else if($vartype =="team" ){
											$tblsearch = $tblteam;
											$keysearch = 'team_title';
											$stat = 'team_status';
											} else if($vartype =="org" ){
											$tblsearch = $tblorg;
											$keysearch = 'Organization_title';
											$stat = 'Organization_status';
											} 
											
											


								if ($vartype) {
								$querymap = mysql_query("SELECT * FROM $tblsearch WHERE $keysearch LIKE '%$keyword%' AND $stat > 2"); 

								$rowCheckmap = mysql_num_rows($querymap);	}
								if($rowCheckmap > 0){
								while ($row = mysql_fetch_array($querymap)) 
								{ 
								if ($row["project_title"]){
														$projectid = $row['project_account_idnum'];
														$address = $row['project_address1'];
														$projectname = $row['project_title'];
														$projectdesc = '<a class=\"usertext\" href=\"project.php?projid='.$projectid.'\">'.$projectname.'</a>';
														
												$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
												$response = json_decode($response);
												$lat = $response->results[0]->geometry->location->lat;
												$long = $response->results[0]->geometry->location->lng;
													
													$variable .= '[\''.$projectdesc.'\', '.$lat.', '.$long.'],';
													$center = 'new google.maps.LatLng( '.$lat.', '.$long.')';




								} else if ($row["team_title"]){

														$teamid = $row['Team_account_idnum'];
														$address = $row['team_location'];
														$teamname = $row['team_title'];
														$teamdesc = '<a class=\"usertext\" href=\"team.php?teamid='.$teamid.'\">'.$teamname.'</a>';
														
												$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
												$response = json_decode($response);
												$lat = $response->results[0]->geometry->location->lat;
												$long = $response->results[0]->geometry->location->lng;
													
													$variable .= '[\''.$teamdesc.'\', '.$lat.', '.$long.'],';
													$center = 'new google.maps.LatLng( '.$lat.', '.$long.')';

								} else if ($row["Organization_title"]){
														$orgid = $row['Organization_account_idnum'];
														$address = $row['Organization_address1'];
														$orgname = $row['Organization_title'];
														$orgdesc = '<a href="org.php?orgid='.$roworg['Organization_account_idnum'].'">'.$roworg['Organization_title'].'</a>';
														//$orgdesc = '<a class=\"usertext\" href=\"project.php?orgid='.$orgid.'\">'.$orgname.'</a>';
														
												$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
												$response = json_decode($response);
												$lat = $response->results[0]->geometry->location->lat;
												$long = $response->results[0]->geometry->location->lng;
													
													$variable .= '[\''.$teamdesc.'\', '.$lat.', '.$long.'],';
													$center = 'new google.maps.LatLng( '.$lat.', '.$long.')';
								}
								}  
								}
								?>

								<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
								<!--<div id="map" style="border: 1px solid black; width: 600px; height: 400px;"></div>-->

								<div id="map" style="border: 10px solid #f5f5f5; width: 600px; height: 400px;"></div>

								  <script type="text/javascript">
									var locationsp = [      
									<?php echo $variable; ?>  
									];
									var locationst = [      
									<?php echo $variablet; ?>  
									];

									var map = new google.maps.Map(document.getElementById('map'), {
									  zoom: 2,
									  /*center: new google.maps.LatLng( <?php echo $lat; ?>, <?php echo $long; ?>),*/
									  center: <?php if ($center) {
									  echo $center; }
									  else
									  {
									echo 'new google.maps.LatLng( 43.6387, -116.2413)';
									  }
									  ?>,
									  mapTypeId: google.maps.MapTypeId.ROADMAP
									});

									var infowindow = new google.maps.InfoWindow();

									var markerp, markert, i;

									for (i = 0; i < locationsp.length; i++) {  
										markerp = new google.maps.Marker({
										position: new google.maps.LatLng(locationsp[i][1], locationsp[i][2]),
										map: map
									  });

									  google.maps.event.addListener(markerp, 'mouseover', (function(markerp, i) {
										return function() {
										  infowindow.setContent(locationsp[i][0]);
										  infowindow.open(map, markerp);
										}
									  })(markerp, i));
									}
									
									for (i = 0; i < locationst.length; i++) { 	
										markert = new google.maps.Marker({
										position: new google.maps.LatLng(locationst[i][1], locationst[i][2]),
										map: map
									  });

									  google.maps.event.addListener(markert, 'mouseover', (function(markert, i) {
										return function() {
										  infowindow.setContent(locationst[i][0]);
										  infowindow.open(map, markert);
										}
									  })(markert, i));
									}
								  </script>


								<?php			
											
											
								/*-----------searching keyword ---------------------------*/			
											
								echo '<font style="font-weight: bold; font-size: 14px;">Search Keyword = </font>'.$vartype.'  --  '.$keyword.'</br></br>'; 
								//error message (not found message) 
								if ($vartype) {
								$query = mysql_query("SELECT * FROM $tblsearch WHERE $keysearch LIKE '%$keyword%' AND $stat > 2"); 

								$rowCheck = mysql_num_rows($query);	}
								if($rowCheck > 0){
								while ($row = mysql_fetch_array($query)) 
								{ 
								if ($row["project_title"]){
								$projectid = $row['project_account_idnum'];
								$variable1=$row["project_title"]; 
								$variable2=$row["project_description"]; 
						if ($row['project_profile_photo'] == "projimages/"){
						echo "<div><div class=\"left-search\"><img width=\"58px\" height=\"63px\" src=\"projimages/project.jpg\"> </div>";						
						}
						else
						{
						echo "<div><div class=\"left-search\"><img width=\"58px\" height=\"63px\" src=\"".$row['project_profile_photo']."\"></div>";
						}
								echo '

													<div class="right-search">
														<div><span class="style9"><a class="usertext" href="project.php?projid='.$projectid.'">'.$variable1.'</a></span></div>
														<div><span class="style8">'. $variable2.'<a href="project.php?projid='.$projectid.'">  more</a></span></div>
													</div>
													<div class="clear"></div>
												</div><br />

								';

								//<a href=\"project.php?projid='.$projectid.'\">'.$variable1.'</a> <p>'. $variable2.'</p><hr></hr>';



														$address = $row['project_address1'];
														$projectname = $row['project_title'];
														$projectdesc = '<a class="usertext" href="project.php?projid='.$projectid.'">'.$projectname.'</a>';
														
												$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
												$response = json_decode($response);
												$lat = $response->results[0]->geometry->location->lat;
												$long = $response->results[0]->geometry->location->lng;
													
													$variable .= '[\''.$projectdesc.'\', '.$lat.', '.$long.'],';




								} else if ($row["team_title"]){
								$variable1=$row["team_title"]; 
								$variable2=$row["team_description"]; 
								if ($row['team_image'] == "teamimages/"){
						echo "<div><div class=\"left-search\"><img width=\"58px\" height=\"63px\" src=\"teamimages/team.jpg\"> </div>";						
						}
						else
						{
						echo "<div><div class=\"left-search\"><img width=\"58px\" height=\"63px\" src=\"".$row['team_image']."\"></div>";
						}
								echo '
												
											
													<div class="right-search">
														<div><span class="style9"><a class="usertext" href="team.php?teamid='.$teamid.'">'.$variable1.'</a></span></div>
														<div><span class="style8">'. $variable2.'<a href="team.php?teamid='.$teamid.'">  more</a></span></div>
													</div>
													<div class="clear"></div>
												</div><br />
								';
								//<a href="team.php?teamid='.$teamid.'">'.$variable1.'</a> <p>'. $variable2.'</p><hr></hr>




														$teamid = $row['Team_account_idnum'];
														$address = $row['team_location'];
														$teamname = $row['team_title'];
														$teamdesc = '<a class="usertext" href="team.php?teamid='.$teamid.'">'.$teamname.'</a>';
														
												$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
												$response = json_decode($response);
												$lat = $response->results[0]->geometry->location->lat;
												$long = $response->results[0]->geometry->location->lng;
													
													$variable .= '[\''.$teamdesc.'\', '.$lat.', '.$long.'],';


								} else if ($row["Organization_title"]){
								$orgid = $row['Organization_account_idnum'];
								$variable1=$row["Organization_title"]; 
								$variable2=$row["Organization_description"]; 
						if ($row['Organization_profile_photo'] == "orgimages/"){
						echo "<div><div class=\"left-search\"><img width=\"58px\" height=\"63px\" src=\"orgimages/avatar.jpg\"> </div>";						
						}
						else
						{
						echo "<div><div class=\"left-search\"><img width=\"58px\" height=\"63px\" src=\"".$row['Organization_profile_photo']."\"></div>";
						}
								echo '

													<div class="right-search">
														<div><span class="style9"><a class="usertext" href="org.php?orgid='.$orgid.'">'.$variable1.'</a></span></div>
														<div><span class="style8">'. $variable2.'<a href="org.php?orgid='.$orgid.'">  more</a></span></div>
													</div>
													<div class="clear"></div>
												</div><br />
								';

								//<a href="org.php?orgid='.$orgid.'">'.$variable1.'</a> <p>'. $variable2.'</p><hr></hr>';

														
														$address = $row['Organization_address1'];
														$orgname = $row['Organization_title'];
														//$orgdesc = '<a class=\"usertext\" href=\"project.php?orgid='.$orgid.'\">'.$orgname.'</a>';
														$orgdesc = '<a class="usertext" href="org.php?orgid='.$orgid.'">'.$orgname.'</a>';
														
												$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
												$response = json_decode($response);
												$lat = $response->results[0]->geometry->location->lat;
												$long = $response->results[0]->geometry->location->lng;
													
													$variable .= '[\''.$teamdesc.'\', '.$lat.', '.$long.'],';
								}  
								}
								}
								else

								{
								echo 'No Record Found';

								}

									
								?>

		     </div> <!-- End of left ---------------------------------------------------- -->
         <!-- start of right ---------------------------------------------------- -->
        <div class="clear"></div>
        </div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
