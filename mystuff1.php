<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}
$username = $_SESSION['myusername'];
include('connect-db.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Stuff : Earth Deeds</title>
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
    	
        
        <!-- start of left ---------------------------------------------------- -->
        <div class="left2"> 
        	<div><span class="style10">My Stuff</span></div>
            <br />
        	<div class="box">
                <div style="float: left; width: 290px; height: auto;">
                	<div><span class="style17">Teams</span></div>
                    <br />
					
					
					
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

		/*-----------------------------------------------------team joined start --------------------------------------------*/		
		$resultteammem = mysql_query("SELECT * FROM  wp_cc_team_member where user_id = '$userid'") or die(mysql_error()); 
	
		while($rowteammem = mysql_fetch_array( $resultteammem )) {
		$teamidmem = $rowteammem['team_id'];
		$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum 	 = '$teamidmem'") or die(mysql_error());  

		while($rowteam = mysql_fetch_array( $resultteam )) {

				echo '<div><span class="style14"><a href="http://beta.earthdeeds.com/team.php?teamid='.$rowteam['Team_account_idnum'].'">'.substr($rowteam['team_title'], 0, 45).'</a></span></div>';

			
				}
				}

		/*-----------------------------------------------------team joined ENDS --------------------------------------------*/		

				$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultteam);	
				while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamid = $rowteam['Team_account_idnum'];
					$team_emissions = $rowteam['team_emissions'];	
				$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid' AND user_id = '$userid'") or die(mysql_error());  					
				$rowCheck = mysql_num_rows($resultemission);			
				echo '<div><span class="style14"><a href="http://beta.earthdeeds.com/team.php?teamid='.$rowteam['Team_account_idnum'].'">'.substr($rowteam['team_title'], 0, 45).'</a></span></div>';
					}	
				?>
                </div>
				
                
                <div style="float: left; width: 140px; height: auto;">
                	<div><span class="style15">My Emissions</span></div>
                    <br />
					
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
		
		/*-----------------------------------------------------team joined start --------------------------------------------*/		
		$resultteammem = mysql_query("SELECT * FROM  wp_cc_team_member where user_id = '$userid'") or die(mysql_error()); 
	$myemm1 = 0;
		while($rowteammem = mysql_fetch_array( $resultteammem )) {
		$teamidmem = $rowteammem['team_id'];
		$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum 	 = '$teamidmem'") or die(mysql_error());  
		
		while($rowteam = mysql_fetch_array( $resultteam )) {


				
				$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamidmem' AND user_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultemission);			
				
				$totalmyemm = 0;	
				while($rowemission = mysql_fetch_array( $resultemission )) {
						$myemm = $rowemission['member_emmision'];
						$totalmyemm +=  $myemm ;
					$noemission = 1;
						}
						if($noemission){
						echo ' <div><span class="style14">'.$totalmyemm.'mT <a href="http://beta.earthdeeds.com/emission-support.php?teamidemm='.$teamidmem.'">add/edit</a></span></div>';
						}
							
						else
						{
						echo '<div><span class="style14">N/A <a href="http://beta.earthdeeds.com/emission-support.php?teamidemm='.$teamidmem.'">add/edit</a></span></div>';
						}
						
				}
				$myemm1 += $totalmyemm;
				}
				
		/*----------------------------------------------------------------------------------------------------------------*/
				$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultteam);	
				while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamid = $rowteam['Team_account_idnum'];
					$team_emissions = $rowteam['team_emissions'];	
						$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid' AND user_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultemission);			
				
				$totalmyemm = 0;	
				while($rowemission = mysql_fetch_array( $resultemission )) {
						$myemm = $rowemission['member_emmision'];
						$totalmyemm +=  $myemm ;
						//echo '<div><span class="style14">'.$rowemission['member_emmision'].'mT <a href="http://beta.earthdeeds.com/emission-support.php?teamidemm='.$teamid.'">add/edit</a></span></div>';	

						$noemission = 1;
						}
						if($noemission){
						echo ' <div><span class="style14">'.$totalmyemm.'mT <a href="http://beta.earthdeeds.com/emission-support.php?teamidemm='.$teamid.'">add/edit</a></span></div>';
						}
						else
						{
						$noemission = 0;
						echo '<div><span class="style14">N/A <a href="http://beta.earthdeeds.com/emission-support.php?teamidemm='.$teamid.'">add/edit</a></span></div>';
						}
					}
				?>

                </div>
                
                <div style="float: left; width: 140px; height: auto;">
                	<div><span class="style15">Team Emissions</span></div>
                    <br />
					
					
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
		
		/*-----------------------------------------------------team joined start --------------------------------------------*/		
		$resultteammem = mysql_query("SELECT * FROM  wp_cc_team_member where user_id = '$userid'") or die(mysql_error()); 
	
		while($rowteammem = mysql_fetch_array( $resultteammem )) {
		$teamidmem = $rowteammem['team_id'];
		$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum 	 = '$teamidmem'") or die(mysql_error());  

		while($rowteam = mysql_fetch_array( $resultteam )) {
				$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamidmem'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultemission);			
				if($rowCheck > 0){
				$totalemm = 0;	

				while($rowemission = mysql_fetch_array( $resultemission )) {
						$emm = $rowemission['member_emmision'];
						$totalemm +=  $emm;
				  
					$noemission = 1;
						}
						}
						else
						{
					$noemission = 0;
					
						}
						/*$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamidmem'") or die(mysql_error());
						while($rowemission = mysql_fetch_array( $resultemission )) {
						$emm = $rowemission['member_emmision'];
						$totalemm +=  $emm;
						}*/


				echo '<div><span class="style14">';
				if ($noemission) {
					$totalteamemm = $totalemm;
					echo $totalteamemm.'mT';
					}
					else
					{
					echo 'N/A';
					}

				echo '</span></div>';
			
				}
				}
/*------------------------------------------------------------end team joiend ---------------------------------*/					
					
				$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultteam);	
				while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamid = $rowteam['Team_account_idnum'];
					$team_emissions = $rowteam['team_emissions'];			
				
				$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultemission);			
				if($rowCheck > 0){
				$totalemm = 0;	
				while($rowemission = mysql_fetch_array( $resultemission )) {
						$emm = $rowemission['member_emmision'];
						$totalemm +=  $emm;
						$noemission = 1;
						}
						}
						else
						{
						$noemission = 0;
						}
					/*	$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid'") or die(mysql_error());
						while($rowemission = mysql_fetch_array( $resultemission )) {
						$emm = $rowemission['member_emmision'];
						$totalemm +=  $emm;
						}*/
				echo '<div><span class="style14">';
					if ($noemission) {
					$totalteamemm = $totalemm;
					echo $totalteamemm.'mT';
					}
					else
					{
					echo 'N/A';
					}
				
				echo '</span></div>';
				}
				?>
                    
                </div>
                    
                <div class="clear"></div>
            </div>
            
                        
            <div class="box">
                <div style="float: left; width: 290px; height: auto;">
                	<div><span class="style17">Projects</span></div>
					<br />
					
					
					
					<?php 
		$resultteammem = mysql_query("SELECT * FROM  wp_cc_team_member where user_id = '$userid'") or die(mysql_error()); 
		while($rowteammem = mysql_fetch_array( $resultteammem )) {
			$teamidmem = $rowteammem['team_id'];					
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamidmem'") or die(mysql_error());  
		

				while($rowproj = mysql_fetch_array( $resultproj )) {
				$projectid = $rowproj['project_account_idnum'];
				$useridproj = $rowproj['user_account_id'];			

				echo '<div><span class="style14"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$projectid.'&teamid='.$teamidmem.'">'.substr($rowproj['project_title'], 0, 45).'</a></span></div>';

			

				}
				
				
				
				/*--------------------------------------------------------------------------------------------------------------------------------*/
				
				$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamidmem'") or die(mysql_error());  
			
			
			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
							echo '<div><span class="style14"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$projectaddid.'&teamid='.$teamidmem.'">'.substr($rowprojteamadd['project_title'], 0, 45).'</a></span></div>';
				
				}
		
			}
		}		
			/*--------------------*/
			
			$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
				
			while($rowteam = mysql_fetch_array( $resultteam )) {

			$teamid = $rowteam['Team_account_idnum'];
			

			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultprojadded);
					while($rowprojadded = mysql_fetch_array( $resultprojadded )) {		
					$projectaddid = $rowprojadded['project_id'];
					//echo'ssdsdsdsd'.$projectaddid;			
					$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
					
						while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {

						echo '<div><span class="style14"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$projectaddid.'&teamid='.$teamid.'">'.substr($rowprojteamadd['project_title'], 0, 45).'</a></span></div>';

						}
				
					}
					

			}
			
			/*----------------------------------------------------------*/
			
			
				?>
                    
                </div>
                
                <div style="float: left; width: 140px; height: auto;">
                	<div><span class="style16">My Support</span></div>
                    <br />
					
						<?php 
		$resultteammem = mysql_query("SELECT * FROM  wp_cc_team_member where user_id = '$userid'") or die(mysql_error()); 
		while($rowteammem = mysql_fetch_array( $resultteammem )) {
		$teamidmem = $rowteammem['team_id'];					
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamidmem'") or die(mysql_error());  
		

					while($rowproj = mysql_fetch_array( $resultproj )) {
				$projectid = $rowproj['project_account_idnum'];
				$useridproj = $rowproj['user_account_id'];			


				$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectid' AND user_id = '$userid' AND pp_tx_status = 'Completed'") or die(mysql_error());  		
				$rowCheck = mysql_num_rows($resultsupport);			
				if($rowCheck > 0){
				$total = 0;	
					while($rowsupport = mysql_fetch_array( $resultsupport )) {
					$price= $rowsupport['project_support'];
					$total += $price;
					$support = 1;
					}
					echo '<div><span class="style14">$'.$total.'</span></div>';
					}
					else
					{
					$support = 0;
					echo '<div><span class="style14">N/A</span></div>';
					}
				

				}
				
							
				/*--------------------------------------------------------------------------------------------------------------------------------*/
				
				$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamidmem'") or die(mysql_error());  
			
			
			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
							
							$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectaddid' AND user_id = '$userid' AND pp_tx_status = 'Completed'") or die(mysql_error());  		
									$rowCheck = mysql_num_rows($resultsupport);			
							if($rowCheck > 0){
							$total = 0;	
								while($rowsupport = mysql_fetch_array( $resultsupport )) {
								//echo '$'.$rowsupport['project_support'];	
								$price= $rowsupport['project_support'];
								$total += $price;
								$support = 1;
								}
								echo '<div><span class="style14">$'.$total.'</span></div>';
								}
								else
								{
								$support = 0;
								echo '<div><span class="style14">N/A</span></div>';
								}

				
				}
		
			}
	}		
			/*--------------------*/
			
							$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultteam);	
				while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamid = $rowteam['Team_account_idnum'];
			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamid'") or die(mysql_error());  

			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
							
							$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectaddid' AND user_id = '$userid' AND pp_tx_status = 'Completed'") or die(mysql_error());  		
							$rowCheck = mysql_num_rows($resultsupport);			
							if($rowCheck > 0){
							$total = 0;	
								while($rowsupport = mysql_fetch_array( $resultsupport )) {									
								$price= $rowsupport['project_support'];
								$total += $price;
								$support = 1;
								}
								echo '<div><span class="style14">$'.$total.'</span></div>';
								}
								else
								{
								$support = 0;
								echo '<div><span class="style14">N/A</span></div>';
								}
							

				}
		
			}
			}
			
			/*----------------------------------------------------------*/
			
				
				
				
				
				?>
					
					
                    
                </div>
                
                <div style="float: left; width: 140px; height: auto;">
                	<div><span class="style16">Team Support</span></div>
                    <br />
					
						<?php 
		$resultteammem = mysql_query("SELECT * FROM  wp_cc_team_member where user_id = '$userid'") or die(mysql_error()); 
		while($rowteammem = mysql_fetch_array( $resultteammem )) {
		$teamidmem = $rowteammem['team_id'];					
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamidmem'") or die(mysql_error());  
		

					while($rowproj = mysql_fetch_array( $resultproj )) {
				$projectid = $rowproj['project_account_idnum'];
				$useridproj = $rowproj['user_account_id'];			


				$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectid' AND pp_tx_status = 'Completed'") or die(mysql_error());  		
				$rowCheck = mysql_num_rows($resultsupport);			
				if($rowCheck > 0){
				$total = 0;	
					while($rowsupport = mysql_fetch_array( $resultsupport )) {	
					$price= $rowsupport['project_support'];
					$total += $price;
					$support = 1;
					}
					}
					else
					{
					$support = 0;
					}

				
				if ($support) {
					$totalteamsupport = $total;
					echo  '<div><span class="style14">$'.$totalteamsupport.'</span></div>';
					}
					else
					{
					echo '<div><span class="style14">N/A</span></div>';
					}
				

			
				}
		
						/*--------------------------------------------------------------------------------------------------------------------------------*/
				
				$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamidmem'") or die(mysql_error());  
			
			
			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
							
							$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectaddid' AND pp_tx_status = 'Completed'") or die(mysql_error());  		
							$rowCheck = mysql_num_rows($resultsupport);			
							if($rowCheck > 0){
							$total = 0;	
								while($rowsupport = mysql_fetch_array( $resultsupport )) {
								$price= $rowsupport['project_support'];
								$total += $price;
								$support = 1;
								}
								}
								else
								{
								$support = 0;
								}
							
							
							if ($support) {
								$totalteamsupport = $total;
								echo  '<div><span class="style14">$'.$totalteamsupport.'</span></div>';
								}
								else
								{
								echo '<div><span class="style14">N/A</span></div>';
								}
				
				}
		
			}
	}		
			/*--------------------*/
			
			$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultteam);	
				while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamid = $rowteam['Team_account_idnum'];
			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamid'") or die(mysql_error());  

			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
							
							$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectaddid' AND pp_tx_status = 'Completed'") or die(mysql_error());  		
							$rowCheck = mysql_num_rows($resultsupport);			
							if($rowCheck > 0){
							$total = 0;	
								while($rowsupport = mysql_fetch_array( $resultsupport )) {									
								$price= $rowsupport['project_support'];
								$total += $price;
								$support = 1;
								}
								}
								else
								{
								$support = 0;
								}

							if ($support) {
								$totalteamsupport = $total;
								echo  '<div><span class="style14">$'.$totalteamsupport.'</span></div>';
								}
								else
								{
								echo '<div><span class="style14">N/A</span></div>';
								}

				}
		
			}
			}
			
				?>
					
                </div>
                    
                <div class="clear"></div>
            </div>
            
        </div> <!-- End of left ---------------------------------------------------- -->
         <!-- start of right ---------------------------------------------------- -->
        <div class="right2">
		
	
		
		
		
        	<div>
            	<div class="mystuff-profile">
				
				
			<?php		
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username' OR user_facebook_id =  '$username'") 
			or die(mysql_error());  
			while($row = mysql_fetch_array( $result )) {
			
			
			if ($row['user_facebook_id']){
			
							$userid = $row['ID'];
				$profilephoto = $row['user_profile_photo'];
				if ( $profilephoto == 'images/' || $profilephoto == ''){
				echo "&nbsp; <img border=\"0\" src=\"imagesprofiles/avatar.jpg\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				}
				else
				{
				echo "&nbsp;  <img border=\"0\" src=\"".$row['user_profile_photo']."\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				
				}
				
			
			}
			else
			{

				$userid = $row['ID'];
				$profilephoto = $row['user_profile_photo'];
				if ( $profilephoto == 'images/' || $profilephoto == ''){
				echo "&nbsp; <img border=\"0\" src=\"imagesprofiles/avatar.jpg\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				}
				else
				{
				echo "&nbsp;  <img border=\"0\" src=\"".$row['user_profile_photo']."\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				
				}
			}
                echo '<span>Welcome '.$row['user_first_name'].'</span>';
 



        }

		?>
                 </div>
                <div class="clear"></div>    
            </div>
                 <div class="box">
            	<div style="float: left; width: 230px;">
                    <div><span class="style18">My <a href="#">total emissions</a> this year: </span></div>      
                    <div><span class="style18">My <a href="#">total support</a> given this year:</span></div>   
                    <div><span class="style18">My <a href="#">pledged reductions</a> this year:</span></div>  
                </div>   
                <div style="float: right; width: 65px;">   
                	<div><span class="style18">
					
					<!-----------------------------------------emission calculatedyeaar---------------------------------------------------->
							<?php		
	


				
				$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where user_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultemission);			
			
				$totalemm = 0;	
				while($rowemission = mysql_fetch_array( $resultemission )) {
				
						$totalemm += $rowemission['member_emmision'];

						}
					
				echo $totalemm.'mT'; 
				?>
					
					</span></div>  
                    <div><span class="style18">
					
					
							<!-----------------------------------------support calculatedyeaar---------------------------------------------------->
											<?php 
	


				$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where user_id = '$userid' AND pp_tx_status = 'Completed'") or die(mysql_error());  		
				$rowCheck = mysql_num_rows($resultsupport);			
				
				$total = 0;	
					while($rowsupport = mysql_fetch_array( $resultsupport )) {
					$price= $rowsupport['project_support'];
					$total += $price;
					}

			echo '$ '.$total;
				
			
			
			/*----------------------------------------------------------*/
			
		
				?>	
					
					
					
					</span></div>  
                    <div><span class="style18">
					
					<?php
					$reductotal  = 0;
					
					$resultteammem = mysql_query("SELECT * FROM  user_reduc_calc1 where username = '$username'") or die(mysql_error()); 
					while($rowreduc = mysql_fetch_array( $resultteammem )) {
					
					$reductotal += $rowreduc['reduct1_total'];
					}
					echo $reductotal.'mT';
					?>
					</span></div> 
                </div>	
                
                <div class="clear"></div>
            </div>
            
            
            
        </div><!-- end of right ---------------------------------------------------- -->
        <div class="clear"></div>
       
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
