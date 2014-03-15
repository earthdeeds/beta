<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}
$username = $_SESSION['myusername'];
include('connect-db.php');
$identity = $_GET['identity'];
$teamtitle = $_GET['teamtitle'];
$username = $_SESSION['myusername'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Team Registration : Earth Deeds</title>
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
	<?php

			$resultedit = mysql_query("SELECT * FROM $tbl where user_username = '$username'") 
			or die(mysql_error());  

			while($row = mysql_fetch_array( $resultedit )) {
			$useridedit = $row['ID'];
			}
?>
			<style>
			.singular
			.entry-title {
    				color: #000000;
    				font-size: 36px;
    				font-weight: bold;
    				margin: -40px 0;
    				text-decoration: none;
   				text-shadow: 1px 4px 6px rgba(0, 0, 0, 0.2), 0 -5px 35px rgba(255, 255, 255, 0.3);
   				font-family: 'Helvetica Neue',sans-serif;
    			}
    			</style>

<?php   
if ($identity == "support"){

?>
		<h1 class="entry-title">Edit Support</h1><br><br><br>
		<div style="float: left;">
			
			<?php		
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") 
			or die(mysql_error());  

			while($row = mysql_fetch_array( $result )) {

				$userid = $row['ID'];
				$profilephoto = $row['user_profile_photo'];
				if ( $profilephoto == 'imagesprofiles/' || $profilephoto == ''){
				echo "&nbsp; <img border=\"0\" src=\"http://beta.earthdeeds.com/imagesprofiles/avatar.jpg\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				}
				else
				{
				echo "&nbsp;  <img border=\"0\" src=\"".$row['user_profile_photo']."\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				
				}
				
                echo '<b>Welcome</b> '.$row['user_first_name'].'</br>';
 



        }
		?>
</div>
		<div style="float: left; clear: right; padding: 0 20px;">
		<?php
		
		$resultteammem = mysql_query("SELECT * FROM  wp_cc_team_member where user_id = '$userid'") or die(mysql_error()); 
		while($rowteammem = mysql_fetch_array( $resultteammem )) {
		$teamidmem = $rowteammem['team_id'];
		
		$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum 	 = '$teamidmem'") or die(mysql_error());  
		$rowCheck = mysql_num_rows($resultteam);	
		while($rowteam = mysql_fetch_array( $resultteam )) {
			
				
				echo 'Team: <a class="usertext" href="http://beta.earthdeeds.com/related-team/?teamid='.$rowteam['Team_account_idnum'].'">'.$rowteam['team_title'].'</a></br>';
						
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamidmem'") or die(mysql_error());  
		
					while($rowproj = mysql_fetch_array( $resultproj )) {
				$projectid = $rowproj['project_account_idnum'];
				$useridproj = $rowproj['user_account_id'];			
				echo 'Project: <a class="usertext" href="http://beta.earthdeeds.com/related-project/?projid='.$projectid.'">'.$rowproj['project_title'].'</a>';
				echo '<form name="userform" method="post" onsubmit="return validateForm()" action="http://beta.earthdeeds.com/submituser.php" class="userform">';	
				
					$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectid' AND user_id = '$userid'") or die(mysql_error());

				$rowCheck = mysql_num_rows($resultsupport);			
				if($rowCheck > 0){					

				while($rowsupport = mysql_fetch_array( $resultsupport )) {

				echo '<input type="hidden" value="'.$teamidmem.'" name="teamid">';
				echo '<input type="hidden" value="'.$projectid.'" name="projid">';
				echo '<input type="hidden" name="identify" value="projsupport"/>';
				echo '<input type="hidden" name="username" value="'.$username.'"/>';
				echo '<input name="projsupport" id="support" type = "text" value="'.$rowsupport['project_support'].'"/>';
					}
					}
					else
					{
					echo '<input type="hidden" value="'.$teamidmem.'" name="teamid">';
				echo '<input type="hidden" value="'.$projectid.'" name="projid">';
				echo '<input type="hidden" name="identify" value="projsupport"/>';
				echo '<input type="hidden" name="username" value="'.$username.'"/>';
				echo '<input name="projsupport" id="support" type = "text" value="0"/>';
				
					}
					
				echo '<input type="Submit" value="Update" />';
				echo '</form>';

				}


		
		
		
		}
			echo '<hr></hr>';
		}
		
		/*-----------------------------------------------------team joined end --------------------------------------------*/
		

				$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultteam);	
				while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamid = $rowteam['Team_account_idnum'];
					echo 'Team: <a class="usertext" href="http://beta.earthdeeds.com/related-team/?teamid='.$rowteam['Team_account_idnum'].'">'.$rowteam['team_title'].'</a></br>';

				echo '<tr>';						
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamid'") or die(mysql_error());  
		
					while($rowproj = mysql_fetch_array( $resultproj )) {
				$projectid = $rowproj['project_account_idnum'];
				$useridproj = $rowproj['user_account_id'];			

				echo 'Project: <a class="usertext" href="http://beta.earthdeeds.com/related-project/?projid='.$projectid.'">'.$rowproj['project_title'].'</a>';
					echo '<form name="userform" method="post" onsubmit="return validateForm()" action="http://beta.earthdeeds.com/submituser.php" class="userform">';	
				
					$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectid' AND user_id = '$userid'") or die(mysql_error());

				$rowCheck = mysql_num_rows($resultsupport);			
				if($rowCheck > 0){					

				while($rowsupport = mysql_fetch_array( $resultsupport )) {

				echo '<input type="hidden" value="'.$teamidmem.'" name="teamid">';
				echo '<input type="hidden" value="'.$projectid.'" name="projid">';
				echo '<input type="hidden" name="identify" value="projsupport"/>';
				echo '<input type="hidden" name="username" value="'.$username.'"/>';
				echo '<input name="projsupport" id="support" type = "text" value="'.$rowsupport['project_support'].'"/>';
					}
					}
					else
					{
					echo '<input type="hidden" value="'.$teamidmem.'" name="teamid">';
				echo '<input type="hidden" value="'.$projectid.'" name="projid">';
				echo '<input type="hidden" name="identify" value="projsupport"/>';
				echo '<input type="hidden" name="username" value="'.$username.'"/>';
				echo '<input name="projsupport" id="support" type = "text" value="0"/>';
				
					}
				echo '<input type="Submit" value="Update" />';
				echo '</form>';	
			
				
		}
		echo '<hr></hr>';
		
}		
}	
else

{
$teamid = $_GET['teamidemm'];

					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());
					$rowteam = mysql_fetch_array( $resultteam );
					
					
?>    		
	<h1 class="entry-title"><?php echo $rowteam['team_title']; ?></h1>

		<div style="float: left;">
			
			<?php		
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") 
			or die(mysql_error());  

			while($row = mysql_fetch_array( $result )) {

				$userid = $row['ID'];
				$profilephoto = $row['user_profile_photo'];
				if ( $profilephoto == 'images/' || $profilephoto == ''){
				echo "&nbsp; <img border=\"0\" src=\"http://beta.earthdeeds.com/images/avatar.jpg\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				}
				else
				{
				echo "&nbsp;  <img border=\"0\" src=\"http://beta.earthdeeds.com/".$row['user_profile_photo']."\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				
				}
				
                echo '<b>Welcome</b> '.$row['user_first_name'].'</br>';
 



        }
		?>
</div>
	<h1>Emission Calculator</h1>
	
	<div>
		<?php
		$codetype = $_POST['codetype'];
		$car_miles = $_POST['car_miles'];
		$car_mpg = $_POST['car_mpg'];
		$train_miles = $_POST['train_miles'];
		$bus_miles = $_POST['bus_miles'];
		
		
		$start = $_POST['start'];
		$end = $_POST['end'];
		$start2 = $_POST['start2'];
		$end2 = $_POST['end2'];
		$start3 = $_POST['start3'];
		$end3 = $_POST['end3'];
		$start4 = $_POST['start4'];
		$end4 = $_POST['end4'];
		?>
		<form id="float" action="emission-support.php?teamidemm=<?php echo $teamid;?>" method="post">
		

</br>
</br></br></br></br>

			<p>Car miles:</br> <input type="text" name="car_miles" value="<?php echo $car_miles;?>"/></p>
			<p>Car MPG:</br> <input type="text" name="car_mpg" value="<?php echo $car_mpg;?>"/></p>
			<p>Train miles:</br> <input type="text" name="train_miles" value="<?php echo $train_miles;?>"/></p>
			<p>Bus miles:</br> <input type="text" name="bus_miles" value="<?php echo $bus_miles;?>"/></p>
			<p>Plane leg 1 takeoff airport code:    <input type="text" name="start" value="<?php echo $start;?>"/>    Landing airport code:<input type="text" name="end" value="<?php echo $end;?>"/></p>
			<p>Plane leg 2 takeoff airport code:   <input type="text" name="start2" value="<?php echo $start2;?>"/>     Landing airport code:<input type="text" name="end2" value="<?php echo $end2;?>"/></p>
			<p>Plane leg 3 takeoff airport code:    <input type="text" name="start3" value="<?php echo $start3;?>"/>         Landing airport code:<input type="text" name="end3" value="<?php echo $end3;?>"/></p>
			<p>Plane leg 4 takeoff airport code:     <input type="text" name="start4" value="<?php echo $start4;?>"/>        Landing airport code:<input type="text" name="end4" value="<?php echo $end4;?>"/></p>
			<!--<p>Starting Airport Code:</br> <input type="text" name="start" /></p>
			<p>Ending Airport Code:</br> <input type="text" name="end" /></p>-->
			<input type="submit" value="Calculate Emission" />
		</form>
		


		

		<?php
			echo '</br>Car Miles: '.$car_miles .'miles';
			echo '</br>Car MPG: '.$car_mpg .'mpg';
			$car_emissions = ($car_mpg/$car_miles)*19.6*0.4536;
			echo '</br><b>Car Emission:</b>'.$car_emissions.' Em';
			
			
			echo '</br></br>Train Miles: '.$train_miles.'miles';			
			$train_emission =  ($train_miles*0.38)*0.4536;
			echo '</br><b>Train Emission:</b>'.$train_emission.' Em';
			
			
			echo '</br></br>Bus Miles: '.$bus_miles.'miles';
			$bus_emission = ($bus_miles*0.66)*0.4536;
			echo '</br><b>Bus Emission:</b>'.$bus_emission.' Em';

			
if ($start){
			
			$result = mysql_query("SELECT * FROM wp_airportdata where IATA_Code = '$start'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($result);			
			//if($rowCheck > 0){
		
			
			echo "</br></br><b>Plane Emission</b>";
			
			while($row = mysql_fetch_array( $result )) {
					//	echo $row['IATA_Code'];
						$deglat1 = $row['Latitude_Degrees'];
						$minlat1 = $row['Latitude_Minutes'];
						$seclat1 = $row['Latitude_Seconds'];
						
						$deglon1 = $row['Longitude_Degrees'];
						$minlon1 = $row['Longitude_Minutes'];
						$seclon1 = $row['Longitude_Seconds'];
						
						$latDirS = $row['Latitude_Direction:'];
						$longDirS = $row['Longitude_Direction'];
						}
			
			$lat1 = $deglat1+((($minlat1*60)+($seclat1))/3600); 
			$lon1 = $deglon1+((($minlon1*60)+($seclon1))/3600);
			
			 
			if($latDirS == "S"){
				$lat1 = -1 * $lat1;
			}
			else{
				$lat1 = $lat1;
			}	
			
		//	echo '</br>'.$lat1.'</br>';
			
			if($longDirS == "U"){
				$lon1 = -1 * $lon1;
			}
			else{
				$lon1 = $lon1;
			}
			
			//echo $lon1.'</br>';

			$result = mysql_query("SELECT * FROM wp_airportdata where IATA_Code = '$end'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($result);			
			//if($rowCheck > 0){
			while($row = mysql_fetch_array( $result )) {
					//	echo '</br>'.$row['IATA_Code'];
						$deglat2 = $row['Latitude_Degrees'];
						$minlat2 = $row['Latitude_Minutes'];
						$seclat2 = $row['Latitude_Seconds'];
						
						$deglon2 = $row['Longitude_Degrees'];
						$minlon2 = $row['Longitude_Minutes'];
						$seclon2 = $row['Longitude_Seconds'];
						
						$latDirE = $row['Latitude_Direction:'];
						$longDirE = $row['Longitude_Direction'];
						}
							
			$lat2 = $deglat2+((($minlat2*60)+($seclat2))/3600);
			$lon2 = $deglon2+((($minlon2*60)+($seclon2))/3600);

			if($latDirE == "S"){
				$lat2 = -1 * $lat2;
			}
			else{
				$lat2 = $lat2;
			}	
			
			//echo '</br>'.$lat2.'</br>';
			
			if($longDirE == "U"){
				$lon2 = -1 * $lon2;
			}
			else{
				$lon2 = $lon2;
			}
			
			//echo $lon2.'</br>';
			
			$a = 6378137; 
			$b = 6356752.314245;  
			$f = 1/298.257223563;  
			$L = deg2rad($lon2)- deg2rad($lon1);
  			$U1 = atan((1-$f) * tan(deg2rad($lat1)));
  			$U2 = atan((1-$f) * tan(deg2rad($lat2)));
		  	$sinU1 = sin($U1); 
		  	$cosU1 = cos($U1);
  			$sinU2 = sin($U2); 
  			$cosU2 = cos($U2);
  			
  			$lambda = $L;
  			$pow = pow(10,-24);
  			
  			   do{
    				$sinLambda = sin($lambda); 
    				$cosLambda = cos($lambda);
    				$sinSigma = sqrt(($cosU2*$sinLambda*$cosU2*$sinLambda) + ((($cosU1*$sinU2)-($sinU1*$cosU2*$cosLambda))*(($cosU1*$sinU2)-($sinU1*$cosU2*$cosLambda))));
    				if($sinSigma==0){
    					break;
    				}
    				$cosSigma = ($sinU1*$sinU2) + ($cosU1*$cosU2*$cosLambda);
    				$sigma = atan2($sinSigma, $cosSigma);
    				$sinAlpha = $cosU1 * $cosU2 * $sinLambda / $sinSigma;
    				$cosSqAlpha = 1 - ($sinAlpha*$sinAlpha);
    				$cos2SigmaM = $cosSigma - 2*$sinU1*$sinU2/$cosSqAlpha;
    				if(is_nan($cos2SigmaM)){
    					$cos2SigmaM = 0;
    					break;
    				}
    				$C = $f/16*$cosSqAlpha*(4+$f*(4-3*$cosSqAlpha));
    				$lambdaN = $lambda;
     				$lambda = $L + (1-$C) * $f * $sinAlpha * ($sigma + $C*$sinSigma*($cos2SigmaM+$C*$cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)));
  			}while (abs($lambda-$lambdaN) > $pow);
			
			if($sinSigma==0 || $cos2SigmaM==0){
				$miles = 0;
			//	echo '</br>Plane Leg 1 Distance: '.$miles.' miles';
				$emm = $miles * 0.23;
				echo '</br>Plane Leg 1 Emission: '.$emm.' Em';
			}
			else{ 
			$uSq = $cosSqAlpha * ($a*$a - $b*$b) / ($b*$b); 
			$A = 1 + ($uSq/16384)*(4096+$uSq*(-768+$uSq*(320-175*$uSq))); 
			$B = ($uSq/1024) * (256+$uSq*(-128+$uSq*(74-47*$uSq)));
			$deltaSigma = $B*$sinSigma*($cos2SigmaM+$B/4*($cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)- $B/6*$cos2SigmaM*(-3+4*$sinSigma*$sinSigma)*(-3+4*$cos2SigmaM*$cos2SigmaM))); 
			$miles = ($b*$A*($sigma-$deltaSigma)) / 1609.34;
			
			// $sigma1 = atan2($cosU2*sin$lambda, cosU1*sinU2 - $sinU1*$cosU2*$cosLambda);
			// $sigma2 = atan2($cosU1*sin$lambda, -sinU1*cosU2 + $cosU1*$sinU2*$cosLambda);
			
			
		//	echo '</br>Plane Leg 1 Distance: '.$miles.' miles';
			$emm = $miles * 0.23;
			echo '</br>Plane Leg 1 Emission: '.$emm.' Em';
			}
			
	}		
/* Leg 2 --------------------------------------------------------------------------------------------------------------------------------- */
	if ($start2){		
			$result = mysql_query("SELECT * FROM wp_airportdata where IATA_Code = '$start2'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($result);			
			//if($rowCheck > 0){
			while($row = mysql_fetch_array( $result )) {
					//	echo $row['IATA_Code'];
						$deglat1 = $row['Latitude_Degrees'];
						$minlat1 = $row['Latitude_Minutes'];
						$seclat1 = $row['Latitude_Seconds'];
						
						$deglon1 = $row['Longitude_Degrees'];
						$minlon1 = $row['Longitude_Minutes'];
						$seclon1 = $row['Longitude_Seconds'];
						
						$latDirS = $row['Latitude_Direction:'];
						$longDirS = $row['Longitude_Direction'];
						}
			
			$lat1 = $deglat1+((($minlat1*60)+($seclat1))/3600); 
			$lon1 = $deglon1+((($minlon1*60)+($seclon1))/3600);
			
			 
			if($latDirS == "S"){
				$lat1 = -1 * $lat1;
			}
			else{
				$lat1 = $lat1;
			}	
			
		//	echo '</br>'.$lat1.'</br>';
			
			if($longDirS == "U"){
				$lon1 = -1 * $lon1;
			}
			else{
				$lon1 = $lon1;
			}
			
			//echo $lon1.'</br>';

			$result = mysql_query("SELECT * FROM wp_airportdata where IATA_Code = '$end2'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($result);			
			//if($rowCheck > 0){
			while($row = mysql_fetch_array( $result )) {
					//	echo '</br>'.$row['IATA_Code'];
						$deglat2 = $row['Latitude_Degrees'];
						$minlat2 = $row['Latitude_Minutes'];
						$seclat2 = $row['Latitude_Seconds'];
						
						$deglon2 = $row['Longitude_Degrees'];
						$minlon2 = $row['Longitude_Minutes'];
						$seclon2 = $row['Longitude_Seconds'];
						
						$latDirE = $row['Latitude_Direction:'];
						$longDirE = $row['Longitude_Direction'];
						}
							
			$lat2 = $deglat2+((($minlat2*60)+($seclat2))/3600);
			$lon2 = $deglon2+((($minlon2*60)+($seclon2))/3600);

			if($latDirE == "S"){
				$lat2 = -1 * $lat2;
			}
			else{
				$lat2 = $lat2;
			}	
			
			//echo '</br>'.$lat2.'</br>';
			
			if($longDirE == "U"){
				$lon2 = -1 * $lon2;
			}
			else{
				$lon2 = $lon2;
			}
			
			//echo $lon2.'</br>';
			
			$a = 6378137; 
			$b = 6356752.314245;  
			$f = 1/298.257223563;  
			$L = deg2rad($lon2)- deg2rad($lon1);
  			$U1 = atan((1-$f) * tan(deg2rad($lat1)));
  			$U2 = atan((1-$f) * tan(deg2rad($lat2)));
		  	$sinU1 = sin($U1); 
		  	$cosU1 = cos($U1);
  			$sinU2 = sin($U2); 
  			$cosU2 = cos($U2);
  			
  			$lambda = $L;
  			$pow = pow(10,-24);
  			
  			   do{
    				$sinLambda = sin($lambda); 
    				$cosLambda = cos($lambda);
    				$sinSigma = sqrt(($cosU2*$sinLambda*$cosU2*$sinLambda) + ((($cosU1*$sinU2)-($sinU1*$cosU2*$cosLambda))*(($cosU1*$sinU2)-($sinU1*$cosU2*$cosLambda))));
    				if($sinSigma==0){
    					break;
    				}
    				$cosSigma = ($sinU1*$sinU2) + ($cosU1*$cosU2*$cosLambda);
    				$sigma = atan2($sinSigma, $cosSigma);
    				$sinAlpha = $cosU1 * $cosU2 * $sinLambda / $sinSigma;
    				$cosSqAlpha = 1 - ($sinAlpha*$sinAlpha);
    				$cos2SigmaM = $cosSigma - 2*$sinU1*$sinU2/$cosSqAlpha;
    				if(is_nan($cos2SigmaM)){
    					$cos2SigmaM = 0;
    					break;
    				}
    				$C = $f/16*$cosSqAlpha*(4+$f*(4-3*$cosSqAlpha));
    				$lambdaN = $lambda;
     				$lambda = $L + (1-$C) * $f * $sinAlpha * ($sigma + $C*$sinSigma*($cos2SigmaM+$C*$cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)));
  			}while (abs($lambda-$lambdaN) > $pow);
			
			if($sinSigma==0 || $cos2SigmaM==0){
				$miles = 0;
		//		echo '</br>Plane Leg 2 Distance: '.$miles.' miles';
				$emm2 = $miles * 0.23;
				echo '</br>Plane Leg 2 Emission: '.$emm2.' Em';
			}
			else{ 
			$uSq = $cosSqAlpha * ($a*$a - $b*$b) / ($b*$b); 
			$A = 1 + ($uSq/16384)*(4096+$uSq*(-768+$uSq*(320-175*$uSq))); 
			$B = ($uSq/1024) * (256+$uSq*(-128+$uSq*(74-47*$uSq)));
			$deltaSigma = $B*$sinSigma*($cos2SigmaM+$B/4*($cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)- $B/6*$cos2SigmaM*(-3+4*$sinSigma*$sinSigma)*(-3+4*$cos2SigmaM*$cos2SigmaM))); 
			$miles = ($b*$A*($sigma-$deltaSigma)) / 1609.34;
			
			// $sigma1 = atan2($cosU2*sin$lambda, cosU1*sinU2 - $sinU1*$cosU2*$cosLambda);
			// $sigma2 = atan2($cosU1*sin$lambda, -sinU1*cosU2 + $cosU1*$sinU2*$cosLambda);
			
			
		//	echo '</br>Plane Leg 2 Distance: '.$miles.' miles';
			$emm2 = $miles * 0.23;
			echo '</br>Plane Leg 2 Emission: '.$emm2.' Em';
			}
	}		
/* Leg 2 end */

/* Leg 3 ---------------------------------------------------------------------------------------------------------------------------------------- */
 if ($start3){			
			$result = mysql_query("SELECT * FROM wp_airportdata where IATA_Code = '$start3'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($result);			
			//if($rowCheck > 0){
			while($row = mysql_fetch_array( $result )) {
					//	echo $row['IATA_Code'];
						$deglat1 = $row['Latitude_Degrees'];
						$minlat1 = $row['Latitude_Minutes'];
						$seclat1 = $row['Latitude_Seconds'];
						
						$deglon1 = $row['Longitude_Degrees'];
						$minlon1 = $row['Longitude_Minutes'];
						$seclon1 = $row['Longitude_Seconds'];
						
						$latDirS = $row['Latitude_Direction:'];
						$longDirS = $row['Longitude_Direction'];
						}
			
			$lat1 = $deglat1+((($minlat1*60)+($seclat1))/3600); 
			$lon1 = $deglon1+((($minlon1*60)+($seclon1))/3600);
			
			 
			if($latDirS == "S"){
				$lat1 = -1 * $lat1;
			}
			else{
				$lat1 = $lat1;
			}	
			
		//	echo '</br>'.$lat1.'</br>';
			
			if($longDirS == "U"){
				$lon1 = -1 * $lon1;
			}
			else{
				$lon1 = $lon1;
			}
			
			//echo $lon1.'</br>';

			$result = mysql_query("SELECT * FROM wp_airportdata where IATA_Code = '$end3'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($result);			
			//if($rowCheck > 0){
			while($row = mysql_fetch_array( $result )) {
					//	echo '</br>'.$row['IATA_Code'];
						$deglat2 = $row['Latitude_Degrees'];
						$minlat2 = $row['Latitude_Minutes'];
						$seclat2 = $row['Latitude_Seconds'];
						
						$deglon2 = $row['Longitude_Degrees'];
						$minlon2 = $row['Longitude_Minutes'];
						$seclon2 = $row['Longitude_Seconds'];
						
						$latDirE = $row['Latitude_Direction:'];
						$longDirE = $row['Longitude_Direction'];
						}
							
			$lat2 = $deglat2+((($minlat2*60)+($seclat2))/3600);
			$lon2 = $deglon2+((($minlon2*60)+($seclon2))/3600);

			if($latDirE == "S"){
				$lat2 = -1 * $lat2;
			}
			else{
				$lat2 = $lat2;
			}	
			
			//echo '</br>'.$lat2.'</br>';
			
			if($longDirE == "U"){
				$lon2 = -1 * $lon2;
			}
			else{
				$lon2 = $lon2;
			}
			
			//echo $lon2.'</br>';
			
			$a = 6378137; 
			$b = 6356752.314245;  
			$f = 1/298.257223563;  
			$L = deg2rad($lon2)- deg2rad($lon1);
  			$U1 = atan((1-$f) * tan(deg2rad($lat1)));
  			$U2 = atan((1-$f) * tan(deg2rad($lat2)));
		  	$sinU1 = sin($U1); 
		  	$cosU1 = cos($U1);
  			$sinU2 = sin($U2); 
  			$cosU2 = cos($U2);
  			
  			$lambda = $L;
  			$pow = pow(10,-24);
  			
  			   do{
    				$sinLambda = sin($lambda); 
    				$cosLambda = cos($lambda);
    				$sinSigma = sqrt(($cosU2*$sinLambda*$cosU2*$sinLambda) + ((($cosU1*$sinU2)-($sinU1*$cosU2*$cosLambda))*(($cosU1*$sinU2)-($sinU1*$cosU2*$cosLambda))));
    				if($sinSigma==0){
    					break;
    				}
    				$cosSigma = ($sinU1*$sinU2) + ($cosU1*$cosU2*$cosLambda);
    				$sigma = atan2($sinSigma, $cosSigma);
    				$sinAlpha = $cosU1 * $cosU2 * $sinLambda / $sinSigma;
    				$cosSqAlpha = 1 - ($sinAlpha*$sinAlpha);
    				$cos2SigmaM = $cosSigma - 2*$sinU1*$sinU2/$cosSqAlpha;
    				if(is_nan($cos2SigmaM)){
    					$cos2SigmaM = 0;
    					break;
    				}
    				$C = $f/16*$cosSqAlpha*(4+$f*(4-3*$cosSqAlpha));
    				$lambdaN = $lambda;
     				$lambda = $L + (1-$C) * $f * $sinAlpha * ($sigma + $C*$sinSigma*($cos2SigmaM+$C*$cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)));
  			}while (abs($lambda-$lambdaN) > $pow);
			
			if($sinSigma==0 || $cos2SigmaM==0){
				$miles = 0;
		//		echo '</br>Plane Leg 3 Distance: '.$miles.' miles';
				$emm3 = $miles * 0.23;
				echo '</br>Plane Leg 3 Emission: '.$emm3.' Em';
			}
			else{ 
			$uSq = $cosSqAlpha * ($a*$a - $b*$b) / ($b*$b); 
			$A = 1 + ($uSq/16384)*(4096+$uSq*(-768+$uSq*(320-175*$uSq))); 
			$B = ($uSq/1024) * (256+$uSq*(-128+$uSq*(74-47*$uSq)));
			$deltaSigma = $B*$sinSigma*($cos2SigmaM+$B/4*($cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)- $B/6*$cos2SigmaM*(-3+4*$sinSigma*$sinSigma)*(-3+4*$cos2SigmaM*$cos2SigmaM))); 
			$miles = ($b*$A*($sigma-$deltaSigma)) / 1609.34;
			
			// $sigma1 = atan2($cosU2*sin$lambda, cosU1*sinU2 - $sinU1*$cosU2*$cosLambda);
			// $sigma2 = atan2($cosU1*sin$lambda, -sinU1*cosU2 + $cosU1*$sinU2*$cosLambda);
			
			
		//	echo '</br>Plane Leg 3 Distance: '.$miles.' miles';
			$emm3 = $miles * 0.23;
			echo '</br>Plane Leg 4 Emission: '.$emm3.' Em';
			
			}
	}		
/* Leg 2 end */
			
/* Leg 3---------------------------------------------------------------------------------------------------------------------------------------- */
			
	 if ($start4){
			$result = mysql_query("SELECT * FROM wp_airportdata where IATA_Code = '$start4'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($result);			
			//if($rowCheck > 0){
			while($row = mysql_fetch_array( $result )) {
					//	echo $row['IATA_Code'];
						$deglat1 = $row['Latitude_Degrees'];
						$minlat1 = $row['Latitude_Minutes'];
						$seclat1 = $row['Latitude_Seconds'];
						
						$deglon1 = $row['Longitude_Degrees'];
						$minlon1 = $row['Longitude_Minutes'];
						$seclon1 = $row['Longitude_Seconds'];
						
						$latDirS = $row['Latitude_Direction:'];
						$longDirS = $row['Longitude_Direction'];
						}
			
			$lat1 = $deglat1+((($minlat1*60)+($seclat1))/3600); 
			$lon1 = $deglon1+((($minlon1*60)+($seclon1))/3600);
			
			 
			if($latDirS == "S"){
				$lat1 = -1 * $lat1;
			}
			else{
				$lat1 = $lat1;
			}	
			
		//	echo '</br>'.$lat1.'</br>';
			
			if($longDirS == "U"){
				$lon1 = -1 * $lon1;
			}
			else{
				$lon1 = $lon1;
			}
			
			//echo $lon1.'</br>';

			$result = mysql_query("SELECT * FROM wp_airportdata where IATA_Code = '$end4'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($result);			
			//if($rowCheck > 0){
			while($row = mysql_fetch_array( $result )) {
					//	echo '</br>'.$row['IATA_Code'];
						$deglat2 = $row['Latitude_Degrees'];
						$minlat2 = $row['Latitude_Minutes'];
						$seclat2 = $row['Latitude_Seconds'];
						
						$deglon2 = $row['Longitude_Degrees'];
						$minlon2 = $row['Longitude_Minutes'];
						$seclon2 = $row['Longitude_Seconds'];
						
						$latDirE = $row['Latitude_Direction:'];
						$longDirE = $row['Longitude_Direction'];
						}
							
			$lat2 = $deglat2+((($minlat2*60)+($seclat2))/3600);
			$lon2 = $deglon2+((($minlon2*60)+($seclon2))/3600);

			if($latDirE == "S"){
				$lat2 = -1 * $lat2;
			}
			else{
				$lat2 = $lat2;
			}	
			
			//echo '</br>'.$lat2.'</br>';
			
			if($longDirE == "U"){
				$lon2 = -1 * $lon2;
			}
			else{
				$lon2 = $lon2;
			}
			
			//echo $lon2.'</br>';
			
			$a = 6378137; 
			$b = 6356752.314245;  
			$f = 1/298.257223563;  
			$L = deg2rad($lon2)- deg2rad($lon1);
  			$U1 = atan((1-$f) * tan(deg2rad($lat1)));
  			$U2 = atan((1-$f) * tan(deg2rad($lat2)));
		  	$sinU1 = sin($U1); 
		  	$cosU1 = cos($U1);
  			$sinU2 = sin($U2); 
  			$cosU2 = cos($U2);
  			
  			$lambda = $L;
  			$pow = pow(10,-24);
  			
  			   do{
    				$sinLambda = sin($lambda); 
    				$cosLambda = cos($lambda);
    				$sinSigma = sqrt(($cosU2*$sinLambda*$cosU2*$sinLambda) + ((($cosU1*$sinU2)-($sinU1*$cosU2*$cosLambda))*(($cosU1*$sinU2)-($sinU1*$cosU2*$cosLambda))));
    				if($sinSigma==0){
    					break;
    				}
    				$cosSigma = ($sinU1*$sinU2) + ($cosU1*$cosU2*$cosLambda);
    				$sigma = atan2($sinSigma, $cosSigma);
    				$sinAlpha = $cosU1 * $cosU2 * $sinLambda / $sinSigma;
    				$cosSqAlpha = 1 - ($sinAlpha*$sinAlpha);
    				$cos2SigmaM = $cosSigma - 2*$sinU1*$sinU2/$cosSqAlpha;
    				if(is_nan($cos2SigmaM)){
    					$cos2SigmaM = 0;
    					break;
    				}
    				$C = $f/16*$cosSqAlpha*(4+$f*(4-3*$cosSqAlpha));
    				$lambdaN = $lambda;
     				$lambda = $L + (1-$C) * $f * $sinAlpha * ($sigma + $C*$sinSigma*($cos2SigmaM+$C*$cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)));
  			}while (abs($lambda-$lambdaN) > $pow);
			
			if($sinSigma==0 || $cos2SigmaM==0){
				$miles = 0;
		//		echo '</br>Plane Leg 4 Distance: '.$miles.' miles';
				$emm4 = $miles * 0.23;
				echo '</br>Plane Leg 4 Emission: '.$emm4.' Em';
			}
			else{ 
			$uSq = $cosSqAlpha * ($a*$a - $b*$b) / ($b*$b); 
			$A = 1 + ($uSq/16384)*(4096+$uSq*(-768+$uSq*(320-175*$uSq))); 
			$B = ($uSq/1024) * (256+$uSq*(-128+$uSq*(74-47*$uSq)));
			$deltaSigma = $B*$sinSigma*($cos2SigmaM+$B/4*($cosSigma*(-1+2*$cos2SigmaM*$cos2SigmaM)- $B/6*$cos2SigmaM*(-3+4*$sinSigma*$sinSigma)*(-3+4*$cos2SigmaM*$cos2SigmaM))); 
			$miles = ($b*$A*($sigma-$deltaSigma)) / 1609.34;
			
			// $sigma1 = atan2($cosU2*sin$lambda, cosU1*sinU2 - $sinU1*$cosU2*$cosLambda);
			// $sigma2 = atan2($cosU1*sin$lambda, -sinU1*cosU2 + $cosU1*$sinU2*$cosLambda);
			
			
		//	echo '</br>Plane Leg 4 Distance: '.$miles.' miles';
			$emm4 = $miles * 0.23;
			echo '</br>Plane Leg 4 Emission: '.$emm4.' Em';
			
		}	
			}
			
			/* Leg 3 end */
			$plainemm = $emm + $emm2 + $emm3 + $emm4;
			?>
			<div style = "border: 1px dashed #000;">
			<form style="padding: 20px;" name="userform" method="post" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">
			Plane Emission: <input type="text" name="plain_emm" value="<?php echo $plainemm ;?>" /></br>
			Car Emission: <input type="text" name="car_emm" value="<?php echo $car_emissions;?>" /></br>
			Bus Emission: <input type="text" name="bus_emm" value="<?php echo $bus_emission;?>" /></br>
			Train Emission: <input type="text" name="train_emm" value="<?php echo $train_emission;?>" /></br>
			

			<input type="hidden" name="identify" value="calculate-emission"/>
			<input type="hidden" value="<?php echo $userid;?>" name="userid" />
			<input type="hidden" value="<?php echo $teamid; ?>" name="teamid" />
			
						<?php
			$totalemm = $car_emissions + $train_emission + $bus_emission + $plainemm;
			echo '</br> Total Emission:'.$totalemm;?></br>
			<input type="hidden" value="<?php echo $totalemm;?>" name="totalemm" />
			<input type="submit" value="Save Emission" />
			</form>
			</div>
			
<?php			
}			  		
?>
	

	
	</div>
	

    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
