<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://earthdeeds.aws.af.cm/login.php?url=".$_SERVER['REQUEST_URI']);
}
$username = $_SESSION['myusername'];
$teamwelcome = $_GET['teamwelcome'];
$teamtitle = $_GET['teamtitle'];
$fblogin = $_GET['fb-login'];
$derror = $_GET['derror'];
$sort = $_GET['sort'];
include('connect-db.php');


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Stuff : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->

<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->
<link type="text/css" href="http://beta.earthdeeds.com/zen/p2/z/widget/css.php" rel="stylesheet"></link>
<script type="text/javascript" src="http://beta.earthdeeds.com/zen/p2/z/widget/jquery.js"></script>
<script type="text/javascript" src="http://beta.earthdeeds.com/zen/p2/z/widget/js.php"></script>
        <style>
            .hide {
                display: none;
            }    
            .current{
                color: red;
            }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
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
            <li  class="active-menu"><a href="mystuff.php">My Stuff</a></li>
            <li><a href="project-view.php">Projects</a></li>
            <li><a href="team-view.php">Teams</a></li>
            <li><a href="org-view.php">Orgs</a></li>
            <li><a href="measure.php">Measure</a></li>	
            <li><a href="reduce.php">Reduce</a></li>	
            <div class="list2"><a href="search.php">Search</a></div>
        </ul>
    </div>
    
    <div class="content"> <!-- start of Content ---------------------------------------------------- -->
  <div id="tab-container-1" class  style="width: 260px;">
		 <ul>
                <li><a href="#sub1" <?php if(!$sort){ echo 'class="current"';} ?> >Summary</a></li>
                <li><a href="#sub2" <?php if($sort){ echo 'class="current"';} ?> >Emissions</a></li>
                <li><a href="#sub3">Admin</a></li>          
            </ul> 	
</div>			
		<div class="line"></div>
 <script>
            function switchContent(obj) {
                obj = (!obj) ? 'sub1' : obj;

                var contentDivs = document.getElementsByTagName('div');
                for (i=0; i<contentDivs.length; i++) {
                    if (contentDivs[i].id && contentDivs[i].id.indexOf('sub') !== -1) {
                        contentDivs[i].className = 'hide';
                    }
                }
				jQuery('html,body').animate({scrollTop:0}, 500)
                document.getElementById(obj).className = '';
            }

            function checkTab() {
                $('a').each(function() {
                    $(this).click(function() {
                        tab = $(this).attr('href').split('#');
                        switchContent(tab[1]);
                        $('.current').attr('class','');
                        $(this).attr('class','current');
                    });
                });
            }

            window.onload = function() {
                checkTab();
            };
      
        </script> 					
<div  id="sub1" <?php if($sort){ echo 'class="hide"';}?> style="width: 960px;">	
        <!-- start of left ---------------------------------------------------- -->
        <div class="left2"> 

		<?php 
					$result = mysql_query("SELECT * FROM $tbl where user_username = '$username' OR user_facebook_id =  '$username'") 
					or die(mysql_error());  

					while($row = mysql_fetch_array( $result )) {

					if ($row['user_username']) {
					$userid = $row['ID'];	

					}
					else 

					{

					$userid = $row['ID'];
					?>

					<div style="background: #E5EECC; padding: 10px 30px;">			
					<p>connect to existing account?  please input your username below</p>
					<form name="userform" method="post" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">
					existing user: <input type="text" name="usercurr" />
					password: <input type="password" name="passwordcurr" /></br>
						<?php
						if ($derror== "error"){	
						echo "<p class=\"style8\" style=\"color: red;\">Error Login Details</p>";
						}
						?>
					<input type="hidden" name="fbusername" value="<?php echo $username; ?>"/>
					<input type="hidden" name="fbuserid" value="<?php echo $userid; ?>"/>
					<input type="hidden" name="identify" value="userfbconnect"/>
					<div style="text-align:right;">
					<input type="submit" name="fbuserupdate" value="Connect"/>
					<input type="submit" name="fbuserupdate" value="Cancel"/>
					</div>
					</form>
					</div>
					</br></br>
					<?php
					}

					}

					?>	
		
		
		
		
		
		<br />
        	<div><span class="style10">My Stuff</span></div>
            
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

				echo '<div><span class="style14"><a href="http://beta.earthdeeds.com/team.php?teamid='.$rowteam['Team_account_idnum'].'">'.substr($rowteam['team_title'], 0, 40).'</a></span></div>';

			
				}
				}
				
		/*-----------------------------------------------------team joined ENDS --------------------------------------------*/		

				$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultteam);	
				if ($rowCheck > 0){
				while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamid = $rowteam['Team_account_idnum'];
					$team_emissions = $rowteam['team_emissions'];	
				$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid' AND user_id = '$userid'") or die(mysql_error());  					
				$rowCheck = mysql_num_rows($resultemission);			
				echo '<div><span class="style14"><a href="http://beta.earthdeeds.com/team.php?teamid='.$rowteam['Team_account_idnum'].'">'.substr($rowteam['team_title'],0 ,40).'</a></span></div>';
					}	
					}
					else
					{
					echo '<div><span class="style14">N/A</span></div>';
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
		$rowCheck = mysql_num_rows($resultteammem);	
		if ($rowCheck > 0){
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
						$emmyr1 += $totalmyemm;
				}
				
				}
				}
				else
				{
					echo '<div><span class="style14">N/A</span></div>';
				}
				
				
				
		/*----------------------------------------------------------------------------------------------------------------*/
				$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultteam);
			
$emmyr2 = 0;				
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
						$emmyr2 += $totalmyemm;
					}
					$totalemmyear = $emmyr2 + $emmyr1;

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
		$rowCheck = mysql_num_rows($resultteammem);
		if ($rowCheck > 0){
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
				}
				else
				{

					echo '<div><span class="style14">N/A</span></div>';

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
						$rowCheck = mysql_num_rows($resultteammem);			
				if($rowCheck > 0){
		while($rowteammem = mysql_fetch_array( $resultteammem )) {
			$teamidmem = $rowteammem['team_id'];					
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamidmem'") or die(mysql_error());  
		

				while($rowproj = mysql_fetch_array( $resultproj )) {
				$projectid = $rowproj['project_account_idnum'];
				$useridproj = $rowproj['user_account_id'];			

				echo '<div><span class="style14"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$projectid.'&teamid='.$teamidmem.'">'.substr($rowproj['project_title'], 0, 40).'</a></span></div>';

			

				}
				
				
				
				/*--------------------------------------------------------------------------------------------------------------------------------*/
				
				$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamidmem'") or die(mysql_error());  
			
			
			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
							echo '<div><span class="style14"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$projectaddid.'&teamid='.$teamidmem.'">'.substr($rowprojteamadd['project_title'], 0, 40).'</a></span></div>';
				
				}
		
			}
		}
}		
		else
		{
			echo '<div><span class="style14">N/A</span></div>';
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

									echo '<div><span class="style14"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$projectaddid.'&teamid='.$teamid.'">'.substr($rowprojteamadd['project_title'], 0, 40).'</a></span></div>';

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
					$rowCheck = mysql_num_rows($resultteammem);			
			if($rowCheck > 0){
		$mysupportyr1 = 0;
		$mysupportyr2 = 0;
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
					$mysupportyr1 +=$total;
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
								$mysupportyr2 +=$total;
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
		}		
		else
		{
			echo '<div><span class="style14">N/A</span></div>';
		}
				
			/*--------------------*/
			
			$resultteam = mysql_query("SELECT * FROM $tblteam where user_account_id = '$userid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultteam);	
			$mysupportyr3 = 0;				
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
							$total1 = 0;	
								while($rowsupport = mysql_fetch_array( $resultsupport )) {									
								$price= $rowsupport['project_support'];
								$total1 += $price;
								$support = 1;
								
								}
								echo '<div><span class="style14">$'.$total1.'</span></div>';
								$mysupportyr3 += $total1; 
								}
								else
								{
								$support = 0;
								echo '<div><span class="style14">N/A</span></div>';
								}

				}
		
			}
			}
				$mysupportyr = $mysupportyr1+$mysupportyr2+$mysupportyr3;
			/*----------------------------------------------------------*/
			
				
				
				
				
				?>
					
					
                    
                </div>
                
                <div style="float: left; width: 140px; height: auto;">
                	<div><span class="style16">Team Support</span></div>
                    <br />
					
						<?php 
		$resultteammem = mysql_query("SELECT * FROM  wp_cc_team_member where user_id = '$userid'") or die(mysql_error()); 
		$rowCheck = mysql_num_rows($resultteammem);			
			if($rowCheck > 0){
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
			}		
		else
		{
			echo '<div><span class="style14">N/A</span></div>';
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
				if ( $profilephoto == 'imagesprofiles/' || $profilephoto == ''){
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
				if ( $profilephoto == 'imagesprofiles/' || $profilephoto == ''){
				echo "<img border=\"0\" src=\"imagesprofiles/avatar.jpg\" width=\"100\" alt=\"".$row['user_first_name']."\" height=\"90\"><br />";
				}
				else
				{
								$userthumb = $row['user_profile_photo'];
				include("resize-class.php");
				$resizeObj = new resize($userthumb);
				$resizeObj -> resizeImage(100, 90, 'auto');
				$resizeObj -> saveImage('imageresize/'.$userthumb, 100);
				echo "<img border=\"0\" src=\"imageresize/".$row['user_profile_photo']."\"  alt=\"".$row['user_first_name']."\"><br />";
				
				
				}
			}
			echo '<div  style="height: 40px;">';
                echo '<span>Welcome '.$row['user_first_name'].'</span>';
 
echo '</div>';
        }

		?>
						
				<!-- <a href="User-update.php">Edit User</a>-->
				 </div>
                 

                <div class="clear"></div>    
            </div>

			</br>
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
	
				echo $totalemmyear.'mT';
				?>
					
					</span></div>  
                    <div><span class="style18">
					
					
							<!-----------------------------------------support calculatedyeaar---------------------------------------------------->
				<?php 
				echo $mysupportyr;
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
				
              </div>              

			  
			  <!----------------------------------------->
			  
			  
			  			<!---------------------------------------------------------admin------------------------------------------------------------------>
			<div id="sub2"  <?php if($sort){ echo 'class=""';}else{echo 'class="hide"';}?>>
			<div class="left2"  style="width: 900px;"> 
					<div class="box">
						<h1 class="entry-title" style = "font-size: 24px;">List of My Emissions</h1><br/>
			<script Language="JavaScript">
					function copy() {
					/*document.getElementById("label").innerHTML = document.getElementById("topcat").value*/

					var topcat;
					var teamid;
					topcat= document.getElementById("topcat").value		
					teamid= document.getElementById("teamid").value		
					
					window.location.href = "?sort=" + topcat ; 
					}
					
					</script>
					<div>
					Sort by:
					<input type="hidden" id="teamid" value="<?php echo $teamid;?>" />
					<select name="sort" class="input-search2" onchange="copy();" id="topcat">
					<?php
					if ($sort == "date_added"){
					echo '
					<option value="date_added">date</option>
					<option value="team_name">team</option>
					<option value="tag">tags</option>
					';
					
					}
					else if ($sort == "team_name"){
						echo '
					<option value="team_name">team</option>
					<option value="date_added">date</option>
					<option value="tag">tags</option>
					';
					}
					else if ($sort == "tag"){
						echo '
					<option value="tag">tags</option>
					<option value="date_added">date</option>
					<option value="team_name">team</option>
					';
					}
					else{
											echo '
					<option value="date_added">date</option>
					<option value="team_name">team</option>
					<option value="tag">tags</option>
					';
					
					}
					?>

					</select></div>
	<table border="1" width="800px" align="center">
			<tr>
				<td width="100px"><div style="text-align:center;font-weight:bold"><font size="4">Teamname</font></div></td>
				<td width="100px"><div style="text-align:center;font-weight:bold"><font size="4">Tags</font></div></td>
				<td width="100px"><div style="text-align:center;font-weight:bold"><font size="4">Date</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Car</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Train</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Bus</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Plane</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Other</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Total</font></div></td>
				<td width="200px"><div style="text-align:center;font-weight:bold"><font size="4">Notes</font></div></td>
			</tr>
					
		<?php
if ($sort){
$orderlist = $sort;
}
else
{
$orderlist = "date_added";
}
			$result = mysql_query("SELECT * FROM wp_cc_team_emmision where user_id = '$userid'ORDER BY $orderlist ASC")or die(mysql_error()); 
			while($rowEmm = mysql_fetch_array( $result )) {
				$userid = $rowEmm['user_id'];
				$teamids = $rowEmm['team_id'];
					echo '<tr><td>'.$rowEmm['team_name'].'</td>';			
					echo '<td>'.$rowEmm['tag'].'</td>';

					//echo '<td>'.$rowEmm['date_added'].'</td>';
$date = date_format(new DateTime($rowEmm['date_added']), "Y-m-d");
if ($date == '-0001-11-30'){
echo '<td>N/A</td>';
}
else{
					echo '<td>'.$date.'</td>';
					}
					echo '<td>'.$rowEmm['car_emm'].'</td>';
					echo '<td>'.$rowEmm['train_emm'].'</td>';
					echo '<td>'.$rowEmm['bus_emm'].'</td>';
					echo '<td>'.$rowEmm['plane_emm'].'</td>';
					echo '<td>N/A</td>';
					echo '<td>'.$rowEmm['member_emmision'].'</td>';
					echo '<td>'.$rowEmm['notes'].'</td></tr>';
		
				

			}
			

		?>
	</table>

					
				
        </div>	
        </div>	
		  <div class="clear"></div>
        </div>	
		
			  <!----------------------------------------->
			  
			  
			  
			  
			  
			  
			  
			  			  
			  			<!---------------------------------------------------------user edit------------------------------------------------------------------>
			<div id="sub3" class="hide">
					<div class="left" style="width: 900px;"> 
        	<div><span class="style10">User Update Form</span></div>
            <br />
        	<div class="box">
                <div style="float: left; width: 200px; height: auto;">
                	
                <br />
                    
                    <!--<div><span class="style20">User Name:</span></div>-->
                    <div><span class="style20">First Name:</span></div>
                    <div><span class="style20">Last Name:</span></div>
                    <div><span class="style20">Your Email (required):</span></div>
                    <div><span class="style20">Password:</span></div>
                    <div><span class="style20">Verify Password:</span></div>
                    <div><br /></div>
                    <div><span class="style20">Profile Photo:</span></div>
					<div><br /></div>
					<div><br /></div>
					<div><br /></div><div><br /></div><div><br /></div><div><br /></div>
                    <div><span class="style20">Address 1:</span></div>
                    <div><span class="style20">Address 2:</span></div>
                    <div><span class="style20">City:</span></div>
                    <div><span class="style20">State:</span></div>
                    <div><span class="style20">Zip:</span></div>
                    <div><span class="style20">Phone:</span></div>
       
                </div>
                
                <div style="float: left;">
				 			</style>			
	<script type="text/javascript">
		function validateForm()
		{
		var uname=document.forms["userform"]["User-Name"].value;
		var fname=document.forms["userform"]["First-Name"].value;
		var lname=document.forms["userform"]["Last-Name"].value;
		if (uname==null || uname=="")
		  {
		  alert("User name must be filled out");
		  return false;
		  }
		  else if (fname==null || fname=="")
		  {
		  alert("First name must be filled out");
		  return false;
		  }
		  else if (lname==null || lname=="")
		  {
		  alert("Last name must be filled out");
		  return false;
		  }
		var x=document.forms["userform"]["your-email"].value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		  {
		  alert("Not a valid e-mail address must have @ character");
		  return false;
		  }
	}
	function verifynotify(field1, field2, result_id, match_html, nomatch_html) {
		this.field1 = field1;
		this.field2 = field2;
		this.result_id = result_id;
		this.match_html = match_html;
		this.nomatch_html = nomatch_html;
		this.check = function() {
		if (!this.result_id) { return false; }
		if (!document.getElementById){ return false; }
		r = document.getElementById(this.result_id);
		if (!r){ return false; }
		if (this.field1.value != "" && this.field1.value == this.field2.value) {
		r.innerHTML = this.match_html;
		} 
		else if ((this.field1.value != "" && this.field1.value != this.field2.value) || (this.field2.value != "" && this.field1.value != this.field2.value)) {
			r.innerHTML = this.nomatch_html;
		}
		}
	}
	</script>
	
	<script type="text/javascript">
	<!-- Begin
	function validate(field) {
	var valid = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-._"
	var ok = "yes";
	var temp;
	for (var i=0; i<field.value.length; i++) {
	temp = "" + field.value.substring(i, i+1);
	if (valid.indexOf(temp) == "-1") ok = "no";
	}
	if (ok == "no") {
	alert("Invalid entry. Only letters and numbers are accepted. No spaces are allowed.");
	
	   setTimeout(function() {
      document.getElementById('User-Name').focus();
	  document.getElementById('User-Name').select();
    }, 0);
	/*window.document.userform.User-Name.focus();  
	window.document.userform.User-Name.select();
	var mytext = document.getElementById("User-Name");
mytext.focus(); 

	field.focus();
	field.select();*/
	   }
	}
	//  End -->
	</script>
<?php 
					$result = mysql_query("SELECT * FROM $tbl where user_username = '$username' OR user_facebook_id =  '$username'") 
					or die(mysql_error());  

					while($row = mysql_fetch_array( $result )) {
					$fname = $row['user_first_name'];
					$lname = $row['user_last_name'];
					$email = $row['user_email'];
					$password = $row['user_password'];
					$add1 = $row['user_address1'];
					$add2 = $row['user_address2'];
					$city = $row['user_city'];
					$state = $row['user_state'];
					$zip = $row['user_zip'];
					$phone = $row['user_phone'];
					$propic = $row['user_profile_photo'];

					if ($row['user_username']) {
					$userid = $row['ID'];	

					}
					else 

					{

					$userid = $row['ID'];
					}
					}
				
					?>
	
	
						<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="create-manage-funct.php">

                <br />
						<input type="hidden" name="identify" value="useredit" class="userform" size="40" />

		<input type="hidden" name="userid" value="<?php echo $userid; ?>" />
                   <!-- <div><input name="User-Name" type="text" class="input"/></div> -->
                    <div><input name="First-Name" type="text" class="input" value = "<?php echo $fname; ?>"/></div>
                    <div><input name="Last-Name" type="text" class="input" value = "<?php echo $lname; ?>"/></div>
                    <div><input name="your-email" type="text" class="input" value = "<?php echo $email; ?>"/></div>

                    <div><input name="password" type="password" onkeyup="verify.check()" class="input" value = "<?php echo $password; ?>" style="width: 300px;"/></div>
                    <div><input name="password2" type="password" onkeyup="verify.check()" class="input" value = "<?php echo $password; ?>" style="width: 300px;"/>&nbsp; <span id="password_result" style="color:red"></span></div>	
                 <!--  <div ><img src="" class="user-profile"/></div>-->
                    <div style="margin-top: 12px;">
						<div class="mystuff-profile">
				
				
			<?php		
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username' OR user_facebook_id =  '$username'") 
			or die(mysql_error());  
			while($row = mysql_fetch_array( $result )) {
			
			
			if ($row['user_facebook_id']){
			
							$userid = $row['ID'];
				$profilephoto = $row['user_profile_photo'];
				if ( $profilephoto == 'imagesprofiles/' || $profilephoto == ''){
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
				if ( $profilephoto == 'imagesprofiles/' || $profilephoto == ''){
				echo "<img border=\"0\" src=\"imagesprofiles/avatar.jpg\" width=\"100\" alt=\"".$row['user_first_name']."\" height=\"90\"><br />";
				}
				else
				{
				echo "<img border=\"0\" src=\"imageresize/".$row['user_profile_photo']."\"  alt=\"".$row['user_first_name']."\"><br />";
				
				}
			}
 



        }

		?>
                 </div>
                    	<div style="float: left;"><input accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" name="Photo" type="file" class="input" style="width: 300px;"/></div>
                      <!--<div style="float: left; margin-top: 8px; margin-left: 10px;"><div class="button2"><a href="#">Browse...</a></div>
                        </div>-->
                        <div class="clear"></div>
                  </div>
					<div><input name="Address-1" type="text" class="input" value = "<?php echo $add1; ?>"/></div>
                    <div><input name="Address-2" type="text" class="input" value = "<?php echo $add2; ?>"/></div>
                    <div><input name="City" type="city" class="input" value = "<?php echo $city; ?>"/></div>
                    <div><input name="State" type="state" class="input" value = "<?php echo $state; ?>"/></div>
                    <div><input name="Zip" type="zip" class="input" value = "<?php echo $zip; ?>"/></div>
                    <div><input name="Phone" type="phone" class="input" value = "<?php echo $phone; ?>"/></div>
              </div>
   
                <div class="clear"></div>
                
                <div><span class="style20">Check here to agree to our  <a href="#">Terms and Conditions</a></span></div>
                <div>
                	<span class="style20">Yes </span><input name="Yes" type="checkbox" value="Yes" style="vertical-align: middle;" />
                </div>
                <div style="width: 610px; text-align: right;">
				<input type="submit" id="maininp" value="Update Now" class="userform" />
                	<!--<div class="button"><a href="#">REGISTER HERE</a></div>-->
                </div>
						</form>
                <br /><br />
                
            </div>
            		<script type="text/javascript">
			verify = new verifynotify();
			verify.field1 = document.userform.password;
			verify.field2 = document.userform.password2;
			verify.result_id = "password_result";
			verify.match_html = "<SPAN STYLE=\"color:green\">Match<\/SPAN>";
			verify.nomatch_html = "<SPAN STYLE=\"color:red\">MisMatch<\/SPAN>";
			verify.check();
		</script>		
            

       
 
				
			</div>	
 	</div>                    
     
<div class="clear"></div>	   
</div> <!-- End of Content ---------------------------------------------------- -->	
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
