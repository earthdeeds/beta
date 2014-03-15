<?php
session_start();
if(!session_is_registered(myusername)){
//header("location:http://beta.earthdeeds.com/login.php");
}
$username = $_SESSION['myusername'];
include('connect-db.php');
$teamid = $_GET['teamid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Team Page : Earth Deeds </title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="js/yetii.js"></script>	
<link type="text/css" href="http://beta.earthdeeds.com/zen/p3/z/widget/css.php" rel="stylesheet"></link>
<script type="text/javascript" src="http://beta.earthdeeds.com/zen/p3/z/widget/jquery.js"></script>
<script type="text/javascript" src="http://beta.earthdeeds.com/zen/p3/z/widget/js.php"></script>
<style>
.box { background: #ffffff; padding: 10px; margin-bottom: 0px;}
.tab {margin: -39px 0 0 0;}
#tab3 {margin: -55px 0 0 0;}
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

<div id="tab-container-1" style="width: 330px;">
	
					

					<ul id="tab-container-1-nav">
					<li><a href="#tab1">Summary</a></li>
					<li><a href="#tab2">Update</a></li>
					<li><a href="#tab4">Emissions</a></li>
					<li><a href="#tab3">Admin</a></li>
					</ul>
					
      
		<br />
		<div class="line"></div>
		<br />
	<div style="width: 920px;">
        <!-- start of left ---------------------------------------------------- -->

				<div style="float: right; margin: -80px 0 0 0">
				<a style="text-decoration: none; float: left;" href="measure-team.php?teamid=<?php echo $teamid; ?>"><input  style="font-weight: normal;" type="submit" value="Add Emission" name="submit"></a>
				<a style="text-decoration: none;" href="checkout.php?teamid=<?php echo $teamid; ?>"><input style="font-weight: normal;" type="submit" value="Checkout Now" name="submit"></a>
                </div>
        <div class="left"> 
		<div class="tab" style="margin:0;" id="tab1">
        	<div class="box">
			
			
			
			<?php
			mysql_connect($sHostname, $sUsername, $sPassword) or die(mysql_error());
			mysql_select_db($sDatabase);

			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());
			$rowteam = mysql_fetch_array( $resultteam );
			//echo '<span style="color: #0000FF; font-size: 24px;"> '.$rowteam['team_title'].'</span>'; 
				$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'  || user_facebook_id = '$username'") or die(mysql_error());  
					while($row = mysql_fetch_array( $result )) {
						$userid = $row['ID'];
						}
					
					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
					if($rowCheck > 0){
					while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamuserid = $rowteam['user_account_id'];
						if ($rowteam['team_image'] == "teamimages/"){
							echo '
							<div class="boxprofile" style="float: left; width: 80px; height: 80px;">
							<table width="100%" height="100%" align="center" valign="center">
							<tr><td>
							<center><img style="float: left; margin-top: -3px; width: 80px; height: 80px;" src="teamimages/team.jpg"></center>
							</td></tr>
							</table>
							</div>
							';							
						}
						else
						{
						$teampropic = $rowteam['team_image'];
							include("resize-class.php");
							$resizeObj = new resize($teampropic);
							$resizeObj -> resizeImage(80, 80, 'auto');
							$resizeObj -> saveImage('imageresize/'.$teampropic, 100);
							echo '
							<div class="boxprofile" style="float: left; width: 80px; height: 80px;">
							<table width="100%" height="100%" align="center" valign="center">
							<tr><td>
							<center><img src="imageresize/'.$rowteam['team_image'].'"></center>
							</td></tr>
							</table>
							</div>
							';
						}
						?>
			<div style="float: right; width: 485px; height: auto;">
                	<div><span class="style4"><?php echo $rowteam['team_title']; ?> </span></div>
                    <div><span class="style5"><?php echo $rowteam['team_description']; ?></span></div>
                    <div><span class="style12"><a href="<?php echo $rowteam['team_url']; ?>"><?php echo $rowteam['team_url']; ?></a></span></div>
</div>


                <div class="clear"></div>
            </div>
			
			
			
			
            <div class="box" style="text-align:center; padding: 0px; font-size: 10px;">
            	<br />    
                
						<?php
						
						
						$longdesc = html_entity_decode( $rowteam['team_long_description'] );
						
					
					$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid'") or die(mysql_error());  
					$totalemm = 0;
					while($rowemission = mysql_fetch_array( $resultemission )) {
				
					$emm = $rowemission['member_emmision'];
					$totalemm +=  $emm;
					}
					
					echo '<div><span class="style10">Team Emissions: </span><span class="style29">';
					if ($emm) {
					echo $totalemm.'mT';
					}
					else
					{
					echo 'N/A';
					}
					echo '</span></div>';
					
					}
					}
			?>
			
			         <br />
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
																								
						
							
					 
					$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectid' AND team_id = '$teamid' AND pp_tx_status = 'admin'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultsupport);	
					if($rowCheck > 0){
					$total = 0;	
					while($rowsupport = mysql_fetch_array( $resultsupport )) {
					$price= $rowsupport['project_support'];
					$total += $price;
					$totalteamsupport = $total;
					}
					echo  ' <div><span class="style8">$'.$totalteamsupport.'</span></div>';
					}
					else
					{
					echo ' <div><span class="style8">N/A</span></div>';
					}
				}
				
				
				
									
			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamid'") or die(mysql_error());  
			
			
			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
			
						$projectid2 = $rowprojteamadd['project_account_idnum'];																									
							
							
						$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectid2' AND team_id = '$teamid' AND pp_tx_status = 'admin'") or die(mysql_error());  		
						$rowCheck = mysql_num_rows($resultsupport);	
						if($rowCheck > 0){
						$total = 0;	
						while($rowsupport = mysql_fetch_array( $resultsupport )) {
						$price= $rowsupport['project_support'];
						$total += $price;
						$totalteamsupport = $total;
						
						}
						
						echo  ' <div><span class="style8">$'.$totalteamsupport.'</span></div>';
						}
						else
						{
						echo ' <div><span class="style8">N/A</span></div>';
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
			 <div><a style="text-decoration: none;" href="checkout.php?teamid=<?php echo $teamid; ?>"><input  style="font-weight: normal;" type="submit" value="Checkout Now" name="submit"></a></div>
				</div>
				
						   
            <br /><br />
		<div class="tab" id="tab2">
        	<div class="box">
			
			
			
			<?php
			mysql_connect($sHostname, $sUsername, $sPassword) or die(mysql_error());
			mysql_select_db($sDatabase);

			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());
			$rowteam = mysql_fetch_array( $resultteam );
			//echo '<span style="color: #0000FF; font-size: 24px;"> '.$rowteam['team_title'].'</span>'; 
				$result = mysql_query("SELECT * FROM $tbl where user_username = '$username' || user_facebook_id = '$username'") or die(mysql_error());  
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
						echo "<div style=\"float: left;  margin-right: 10px;\"><img  src=\"imageresize/".$rowteam['team_image']."\" alt=\"".$rowteam['team_initiator']."\"></div>";
						}
						?>
			<div style="float: right; width: 485px; height: auto;">
                	<div><span class="style4"><?php echo $rowteam['team_title']; ?> </span></div>
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
		
				<!---------------------------------------------------------admin------------------------------------------------------------------>
			<div class="tab" id="tab3">
					<div class="box">
						<?php	$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
					while($rowteam = mysql_fetch_array( $resultteam )) {
					
					echo '
						<h1 class="entry-title" style = "font-size: 24px;">List of Member Emissions for '.$rowteam['team_title'].'</h1><br/>';
			
					}
					
			?>
			<script Language="JavaScript">
					function copy() {
					/*document.getElementById("label").innerHTML = document.getElementById("topcat").value*/

					var topcat;
					var teamid;
					topcat= document.getElementById("topcat").value		
					teamid= document.getElementById("teamid").value		
					
					window.location.href = "?teamid=" + teamid +"&sort=" + topcat ; 
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
					<option value="user_username">username</option>
					<option value="tag">tags</option>
					';
					
					}
					else if ($sort == "user_username"){
						echo '
					<option value="user_username">username</option>
					<option value="date_added">date</option>
					<option value="tag">tags</option>
					';
					}
					else if ($sort == "tag"){
						echo '
					<option value="tag">tags</option>
					<option value="date_added">date</option>
					<option value="user_username">username</option>
					';
					}
					else{
											echo '
					<option value="date_added">date</option>
					<option value="user_username">username</option>
					<option value="tag">tags</option>
					';
					
					}
					?>

					</select></div>
	<table border="1" width="600px" align="center">
			<tr>
				<td width="100px"><div style="text-align:center;font-weight:bold"><font size="4">Username</font></div></td>
				<td width="100px"><div style="text-align:center;font-weight:bold"><font size="4">Tag</font></div></td>
				<td width="100px"><div style="text-align:center;font-weight:bold"><font size="4">Date</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Car</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Train</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Bus</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Plane</font></div></td>
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
			$result = mysql_query("SELECT * FROM wp_cc_team_emmision where team_id = '$teamid' and user_id = '$userid'ORDER BY $orderlist ASC")or die(mysql_error()); 
			while($rowEmm = mysql_fetch_array( $result )) {
				$userid = $rowEmm['user_id'];

	
			
					echo '<tr><td>'.$rowEmm['user_username'].'</td>';					
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
					echo '<td>'.$rowEmm['member_emmision'].'</td>';
					echo '<td>'.$rowEmm['notes'].'</td></tr>';
		
				

			}
			

		?>
	</table>

					
				
        </div>	
        </div>	
		
		<!---------------------------------------------------------admin------------------------------------------------------------------>
			<div class="tab" id="tab3">
					<div class="box">
						<div style="float: left; width: 115px; height: 112px; margin-right: 10px;">
					<?php
					
					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
		
					while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamuserid = $rowteam['user_account_id'];
						if ($rowteam['team_image'] == "teamimages/"){
						echo "<div style=\"float: left; width: 83px; height: 107px; margin-right: 10px;\"><img width=\"83px\" height=\"107px\" src=\"imagesprofiles/team.jpg\"> </div>";						
						}
						else
						{
						echo "<div style=\"float: left;  margin-right: 10px;\"><img  src=\"imageresize/".$rowteam['team_image']."\" alt=\"".$rowteam['team_initiator']."\"></div>";
						}
					$titleteam = $rowteam['team_title']; 
                    $description = $rowteam['team_description'];
					
					}
	
					
					?>
					</div>
               <div style="float: right; width: 465px; height: auto;">
                	<div><span class="style10"><?php echo $titleteam; ?></span></div>
                    <br />
                    
              </div>
                <div class="clear"></div>
            </div>
            
                        
            <div class="box">
 
                <span class="style8">This page is for team administrators only. <br /><br />
                If you are a team administrator, please enter the team password below to access the team administration page:</span>
				<div class="clear"></div>
            </div>
  
            <div>

							<form method="POST" action="includes/checklogin.php">
							<input type = "hidden" value="<?php echo $teamid ?>" name="teamid">
							<input type="hidden" name="identify" value="teamedit"/>
							<div style="float: left;"><input name="teampassword" type="password" class="input2" style="height: 18px; width: 200px; margin-right: 10px;"></div>
							<div style="float: left;"><input id="edit" type = "submit" name="submit" value="Edit Team" class="button2" style="font-weight: normal;"></div>	
							</form>
							<?php 
							if ($loginerror== "logerror"){	
							echo "<p class=\"errorpass\">wrong password</p>";
							}
							?>
														<?php
				$resultteam = mysql_query("SELECT * FROM wp_cc_team_manager where team_manager_userid = '$userid' AND team_id = '$teamid'") 
				or die(mysql_error()); 
				$rowCheckteam = mysql_num_rows($resultteam);		
				if($rowCheckteam > 0){	
				echo '<center><a href="Pass-update.php?type=team&teamid='.$teamid.'&userid='.$userid.'">Forgot Password?</a></center>';
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
        	<div class="box">
            	<div><span class="style10">Team Managers</span></div>
              <div>
			  <?php
				$result = mysql_query("SELECT * FROM $tbl where ID = '$teamuserid'")or die(mysql_error()); 
				while($row = mysql_fetch_array( $result )){
				//$userid = $row['ID'];
				$leader= $row['user_profile_photo'];
					 //echo "<div class=\"thumb-pic\"><img border=\"0\" src=\"".$row['user_profile_photo']."\" width=\"50px\" height=\"50px\" alt=\"".$row['user_first_name']."\"></div>";
					 
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
								while(($rowmem = mysql_fetch_array( $resultmember ))  and ($counter < 19)){ 
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
											$userthumb = $row['user_profile_photo'];
											//include("resize-class.php");
											$resizeObj = new resize($userthumb);
											$resizeObj -> resizeImage(100, 90, 'crop');
											$resizeObj -> saveImage('imageresize/'.$userthumb, 100);

												echo " <div class=\"thumb-pic\"><img src=\"imageresize/".$row['user_profile_photo']."\" width=\"50px\" height=\"50px\"  alt=\"".$row['user_first_name']."\" >";
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
							<div>

	<?php
				$resultteam1 = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
							
							while($rowteam1 = mysql_fetch_array( $resultteam1 )) {
							$address = $rowteam1['team_location'];
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
					</div>
					</div>
        </div><!-- start of right ---------------------------------------------------- -->	 
					
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
