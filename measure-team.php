<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://earthdeeds.aws.af.cm/login.php?url=".$_SERVER['REQUEST_URI']);
}
include('connect-db.php');
$username = $_SESSION['myusername'];
$teamid = $_GET['teamid'];
error_reporting(0);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Carbon Emissions Calculator : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->

<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->
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
      		<?php
			
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

		
if($car_miles){
				$car_emissions = ($car_miles*0.00892)/$car_mpg;
			}


			$train_emission =  (($train_miles*0.38)*0.4536)/2204.6226218;

			$bus_emission = (($bus_miles*0.66)*0.4536)/2204.6226218;

	if ($start){
			
			$result = mysql_query("SELECT * FROM wp_airportdata where IATA_Code = '$start'") or die(mysql_error());  
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
			//	$emm = $miles * 0.23;
				if($miles < 280){
				$emm = ($miles * 0.64) / 2204.6226218;
				}
				else if($miles >= 280 && $miles <= 1000){
				$emm = ($miles * 0.44) / 2204.6226218;
				}
				else {
				$emm = ($miles * 0.39) / 2204.6226218;
				}

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
		//	$emm = $miles * 0.23;
				if($miles < 280){
				$emm = ($miles * 0.64) / 2204.6226218;
				}
				else if($miles >= 280 && $miles <= 1000){
				$emm = ($miles * 0.44) / 2204.6226218;
				}
				else {
				$emm = ($miles * 0.39) / 2204.6226218;
				}

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
		//		$emm2 = $miles * 0.23;
				if($miles < 280){
				$emm2 = ($miles * 0.64) / 2204.6226218;
				}
				else if($miles >= 280 && $miles <= 1000){
				$emm2 = ($miles * 0.44) / 2204.6226218;
				}
				else {
				$emm2 = ($miles * 0.39) / 2204.6226218;
				}


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
		//	$emm2 = $miles * 0.23;
		if($miles < 280){
				$emm2 = ($miles * 0.64) / 2204.6226218;
				}
				else if($miles >= 280 && $miles <= 1000){
				$emm2 = ($miles * 0.44) / 2204.6226218;
				}
				else {
				$emm2 = ($miles * 0.39) / 2204.6226218;
				}

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
		//		$emm3 = $miles * 0.23;
				if($miles < 280){
				$emm3 = ($miles * 0.64) / 2204.6226218;
				}
				else if($miles >= 280 && $miles <= 1000){
				$emm3 = ($miles * 0.44) / 2204.6226218;
				}
				else{
				$emm3 = ($miles * 0.39) / 2204.6226218;
				}

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
		//	$emm3 = $miles * 0.23;
				if($miles < 280){
				$emm3 = ($miles * 0.64) / 2204.6226218;
				}
				else if($miles >= 280 && $miles <= 1000){
				$emm3 = ($miles * 0.44) / 2204.6226218;
				}
				else {
				$emm3 = ($miles * 0.39) / 2204.6226218;
				}
			
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
		//		$emm4 = $miles * 0.23;
				if($miles < 280){
				$emm4 = ($miles * 0.64) / 2204.6226218;
				}
				else if($miles >= 280 && $miles <= 1000){
				$emm4 = ($miles * 0.44) / 2204.6226218;
				}
				else{
				$emm4 = ($miles * 0.39) / 2204.6226218;
				}

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
		//	$emm4 = $miles * 0.23;
				if($miles < 280){
				$emm4 = ($miles * 0.64) / 2204.6226218;
				}
				else if($miles >= 280 && $miles <= 1000){
				$emm4 = ($miles * 0.44) / 2204.6226218;
				}
				else{
				$emm4 = ($miles * 0.39) / 2204.6226218;
				}
			
		}	
			}	

		?>
<div class="container">
	
    <div class="nav">
    	<ul>
           <div class="list"><a href="index.php">Home</a></div>
            <li><a href="mystuff.php">My Stuff</a></li>
            <li><a href="project-view.php">Projects</a></li>
            <li><a href="team-view.php">Teams</a></li>
            <li><a href="org-view.php">Orgs</a></li>
            <li  class="active-menu"><a href="measure.php">Measure</a></li>	
            <li><a href="reduce.php">Reduce</a></li>	
            <div class="list2"><a href="search.php">Search</a></div>
        </ul>
    </div>
    
    <div class="content"> <!-- start of Content ---------------------------------------------------- -->
    	
        
        <div>

        	<div><span class="style10">Carbon Emissions Calculator - Travel</span></div>
        	<div class="box">
<p class="style28">For metric version of this calculator click <a href="measure-metric.php">here</a>.</p>
		<form id="float" action="http://beta.earthdeeds.com/measure-team.php?teamid=<?php echo $teamid; ?>" method="post">
              <div>
              	<div style="float: left; width: 150px; height: auto;">  	
                    <div><span class="style28">Car Miles:</span></div>
                    <div><span class="style28">Car MPG:</span></div>
                    <div><span class="style28">Train Miles:</span></div>
                    <div><span class="style28">Bus Miles:</span></div>
                </div>
                <div style="float: left;">
                    <div><input name="car_miles" value="<?php echo $car_miles; ?>" type="text" class="input2" style="width: 200px;" tabindex=1/></div>
                    <div><input name="car_mpg" value="<?php echo $car_mpg; ?>" type="text" class="input2" style="width: 200px;" tabindex=2/></div>
                    <div><input name="train_miles" value="<?php echo $train_miles; ?>" type="text" class="input2" style="width: 200px;" tabindex=3/></div>
                    <div><input name="bus_miles" value="<?php echo $bus_miles; ?>" type="text" class="input2" style="width: 200px;" tabindex=4/></div>
              	</div>
              <div class="clear"></div>
              </div>
                
              <div>
              	<div style="float: left; width: 150px; height: auto; margin-top: 35px;">  	
                    <div><span class="style28">Plane leg 1</span></div>
                    <div><span class="style28">Plane leg 2</span></div>
                    <div><span class="style28">Plane leg 3</span></div>
                    <div><span class="style28">Plane leg 4</span></div>
                </div>
                <div style="float: left; width: 200px; margin-right: 50px;">
                    <div>
                      <div align="center"><span class="style28">Takeoff airport code:</span></div>
                    </div>
                    
                    <div><input name="start" value="<?php echo $start; ?>" type="text" class="input2" style="width: 200px;" tabindex=5/></div>
                    <div><input name="start2" value="<?php echo $start2; ?>" type="text" class="input2" style="width: 200px;" tabindex=7/></div>
                    <div><input name="start3" value="<?php echo $start3; ?>" type="text" class="input2" style="width: 200px;" tabindex=9/></div>
                    <div><input name="start4" value="<?php echo $start4; ?>" type="text" class="input2" style="width: 200px;" tabindex=11/></div>
              	</div>
                <div style="float: left; width: 200px; margin-right: 50px;">
                    <div>
                      <div align="center"><span class="style28">Landing airport code:</span></div>
                    </div>
                    <div><input name="end" value="<?php echo $end; ?>" type="text" class="input2" style="width: 200px;" tabindex=6/></div>
                    <div><input name="end2" value="<?php echo $end2; ?>" type="text" class="input2" style="width: 200px;" tabindex=8/></div>
                    <div><input name="end3" value="<?php echo $end3; ?>" type="text" class="input2" style="width: 200px;" tabindex=10/></div>
                    <div><input name="end4" value="<?php echo $end4; ?>" type="text" class="input2" style="width: 200px;" tabindex=12/></div>
              	</div>
				<div style="float: left; width: 220px; margin-right: 10px;font-size:17px;font-weight:bold;margin-top:72px">
					<div>

					 <div align="center"><p style="font-size: 14px;"><a target="_blank" href="http://www.airportcodes.org/">Click here for list of airport codes</a> </br><span style="font-size: 14px;"> (opens in a new browser tab)</span></p>
					
					 </div>
					 
                    </div>
				</div>
              <div class="clear"></div>
              </div> 
              <div style="width: 610px;">
                	<input type = "submit" name="submit" value="Calculate Emissions">
              </div>
			  <br />			  
        </form>
              <p class="style28">All emissions are calculated in mT or Carbon Dioxide</p>
<?php
$plainemm = $emm+$emm2+$emm3+$emm4;

	echo '<form method="POST" action="verify.php">
		<input type="hidden" name="car_miles" value="'.$car_miles.'" />
		<input type="hidden" name="car_mpg" value="'.$car_mpg.'" />
		<input type="hidden" name="train_miles" value="'.$train_miles.'" />
		<input type="hidden" name="bus_miles" value="'.$bus_miles.'" />
		
		<input type="hidden" name="startplain" value="'.$start.'" />
		<input type="hidden" name="endplain" value="'.$end.'" />		
		<input type="hidden" name="startplain2" value="'.$start2.'" />
		<input type="hidden" name="endplain2" value="'.$end2.'" />
		<input type="hidden" name="startplain3" value="'.$start3.'" />
		<input type="hidden" name="endplain3" value="'.$end3.'" />		
		<input type="hidden" name="startplain4" value="'.$start4.'" />
		<input type="hidden" name="endplain4" value="'.$end4.'" />
		
	              <div>
              	<div style="float: left; width: 150px; height: auto;">  	
                    <div><span class="style28">Plane Emissions:</span></div>
                    <div><span class="style28">Car Emissions:</span></div>
                    <div><span class="style28">Train Emissions:</span></div>
                    <div><span class="style28">Bus Emissions:</span></div>
					<div><span class="style28">Total Emissions:</span></div>
                </div>
				
                <div style="float: left;">
                    <div><input value="'.number_format($plainemm, 2, '.', '').'" name="plane_emm" type="text" class="input2" style="width: 200px;" readonly /></div>
                    <div><input value="'.number_format($car_emissions, 2, '.', '').'" name="car_emm" type="text" class="input2" style="width: 200px;" readonly /></div>
                    <div><input value="'.number_format($train_emission, 2, '.', '').'" name="train_emm" type="text" class="input2" style="width: 200px;" readonly /></div>
                    <div><input value="'.number_format($bus_emission, 2, '.', '').'" name="bus_emm" type="text" class="input2" style="width: 200px;" readonly /></div>
					<div><input value="'.number_format($emm+$emm2+$emm3+$emm4+$car_emissions+$train_emission+$bus_emission, 2, '.', '').'" type="text" name="total_emm" class="input2" style="width: 200px;" readonly /></div>
              	</div>
              <div class="clear"></div>
              </div>
              
              <div style=" background: #e7e8d2; padding: 10px;">
			  <table>
			  <tr><td>            
                  <div>
                    <div style="float: left; width: 250px; height: auto;">  	
                        <div><span class="style28">Connect these emissions with team:</span></div>
  	
                        <div><span class="style28">You can add a tag text here (optional):
						</span></div>
                    </div>
                    <div style="float: left;">
					<div>';
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
					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());
					while($rowteam = mysql_fetch_array( $resultteam )) {
					
					$teamtitle = $rowteam['team_title'];
					}
					echo '<div style="width: 162px; height: 30px; text-align: left; margin-top: 7px;">'.$teamtitle.'</div>';
				echo '

				<input type="hidden" name="Reffered_team" value="'.$teamid.'">
          </div>	
		  <div><input name="tag" type="text" class="input2" style="width: 150px;"/></div>
		  <input type="hidden" value="'.$username.'" name="username" />
		  <input type="hidden" value="'.$userid.'" name="userid" />
                        <!-- <div>
                            <select name="Reffered team" class="input2" style="width: 162px; height: 30px; text-align: left;">
                            <option>Reffered team</option>
                            <option>Reffered team</option>
                            </select>
                        </div> -->
                    </div>
                  	<div class="clear"></div>
                  </div>
				  </td>
				  <td>&nbsp;&nbsp;</td>
				  <td>
				  <div><span class="style28">Notes to be connected to these emissions (optional):<br /><textarea style="margin-top:-5px" width= "250px" cols="45" rows="5" name="notes"></textarea></span></div>
				  </td></tr>
				  </table>
            	</div>    
                <br/>
                <div>
                    <div style="float: left; width: 300px; height: auto;">  
                    	<input type = "submit" name="submit" value="Save Emissions">	
                    </div>
                    <div style="float: left;">
						<input type="submit" name="submit" value="Check Out Now">
                    </div>
              	<div class="clear"></div>
              	</div></form>';
            ?>    
             <br />   
            </div>
      </div>
	   <div align="center"><p class="style28">Currently the methodology used for these calculations is taken from <a target="_blank" href="CustomO16C45F39728.pdf">this document from the World Resources Institute</a>.</p>
					
					 </div>
	  
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
