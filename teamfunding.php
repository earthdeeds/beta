<?php
session_start();

$username = $_SESSION['myusername'];

//$myusername= $_POST['currusername'];
$myusername= $_SESSION['myusername'];


/*if ($sup1){
session_register("uname");
}
else
{
$username = $_SESSION['myusername'];
}*/
include('connect-db.php');
$teamid = $_GET['teamid'];
$usernamereg = $_POST['User-Name'];

/********************************************************************************************/

$amount= $_POST['amount'];
$amount1= $_POST['amount1'];
$amount2= $_POST['amount2'];
$sup1= $_POST['sup1'];
$sup2= $_POST['sup2'];
$userid= $_POST['userid'];
$projid1= $_POST['projid'];
$teamid1= $_POST['teamid'];




$mypassword=$_POST['mypassword'];
if ($mypassword){
$myusername=$_POST['myusername'];
$myusername = stripslashes($myusername);
$mypassword = $mypassword;
$myusername = mysql_real_escape_string($myusername);
$sql="SELECT * FROM $tbl WHERE user_username='$myusername' and user_password='$mypassword'";
$result= mysql_query($sql);
$count= mysql_num_rows($result);
if($count==1){
session_register("myusername");
session_register("mypassword");
					while($row = mysql_fetch_array( $result )) {
						$useridlog = $row['ID'];
						}

mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_project_support` (`project_support_id`, `team_id`, `project_support`, `project_id`, `user_id`, `date_added`) VALUES (NULL, '$teamid1', '$amount', '$projid1', '$useridlog', now());") or die(mysql_error()); 

mysql_query("INSERT INTO `shantiom_sandbeta`.`checkout_paypal` (`payment_trans_id`, `date`, `team_id`, `user_id`, `project_id`, `strategic_partner_id`, `trans_project_amount`, `trans_project_actual_amount`, `trans_earthdeeds_additional_amount`, `trans_project_admin_amount`, `trans_total_amount`) VALUES (NULL, now(), '$teamid1', '$useridlog', '$projid1', 'stpartid', '$amount1', '$amount2', '$sup1', '$sup2', '$amount');") or die(mysql_error());
?>
<form name="_xclick" action="https://www.paypal.com/ph/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="webincome@earthdeeds.com">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name" value="Earth Deeds">
<input type="hidden" name="amount" id="testsum" value="<?php echo $amount; ?>">

</form>
	

     
     <script language="javascript" type="text/javascript">
    document._xclick.submit();
     </script>
     <noscript><input type="submit" value="verify submit"></noscript>
<?php
}
else {
header("Location: http://beta.earthdeeds.com/teamfunding.php?teamid=$teamid1&loginerror=logerror"); 
}

}

/*----------------------------------------------------------------------*/
else if ($usernamereg){

$_SESSION['myusername'] = $usernamereg;

$uploadDir = 'imagesprofiles/'; //Image Upload Folder
$fileName = $_FILES['Photo']['name'];
$tmpName = $_FILES['Photo']['tmp_name'];
$fileSize = $_FILES['Photo']['size'];
$fileType = $_FILES['Photo']['type'];
$filePath = $uploadDir . $fileName;
$resultimages = move_uploaded_file($tmpName, $filePath);


if(!get_magic_quotes_gpc())
{
$fileName = addslashes($fileName);
$filePath = addslashes($filePath);
}
			$teamid = $_POST['teamid'];
			$teamreg = $_POST['teamreg'];
			
			$firstname =$_POST['First-Name'];
			$lastname =$_POST['Last-Name'];
			$email =$_POST['your-email'];
			$password =$_POST['password'];
			$imagefile =$_POST['images'];
			$add1 =$_POST['Address-1'];
			$add2 =$_POST['Address-2'];
			$city =$_POST['City'];
			$state =$_POST['State'];
			$zip =$_POST['Zip'];
			$phone =$_POST['Phone'];
			$location =$_POST['Location'];
			$fbid =$_POST['Facebook-Id'];
			$fbpassword =$_POST['Facebook-password'];
			$policy =$_POST['user-policy'];
			$teamid =$_POST['teamid'];
include('connect-db.php');			
			
		$firstnamehtml = htmlentities( $firstname, ENT_QUOTES );
		$lastnamehtml = htmlentities( $lastname, ENT_QUOTES );
		$add1html = htmlentities( $add1, ENT_QUOTES );
		$add2html = htmlentities( $add2, ENT_QUOTES );
		$statehtml = htmlentities( $state, ENT_QUOTES );
		$cityhtml = htmlentities( $city, ENT_QUOTES );
		$ziphtml = htmlentities( $zip, ENT_QUOTES );
		$phonehtml = htmlentities( $phone, ENT_QUOTES );
		if( get_magic_quotes_gpc() )
		{
			$data = stripslashes( $firstnamehtml);
			$data1 = stripslashes( $lastnamehtml);
			$data2 = stripslashes( $add1html);
			$data3 = stripslashes( $add2html);
			$data4 = stripslashes( $statehtml);
			$data5 = stripslashes( $cityhtml);
			$data6 = stripslashes( $ziphtml);
			$data7 = stripslashes( $phonehtml);
		}

		 $firstnameinput= mysql_real_escape_string( $firstnamehtml);  
		 $lastnameinput= mysql_real_escape_string( $lastnamehtml);
		 $add1input= mysql_real_escape_string( $add1html);
		 $add2input= mysql_real_escape_string( $add2html);
		 $stateinput= mysql_real_escape_string( $statehtml);
		 $cityinput= mysql_real_escape_string( $cityhtml);
		 $zipinput= mysql_real_escape_string( $ziphtml);
		 $phoneinput= mysql_real_escape_string( $phonehtml);
			
			
			
			
			$resultfilteruser = mysql_query("SELECT * FROM $tbl where user_username = '$usernamereg'")or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultfilteruser);			
			if($rowCheck > 0){
			//header("Location: http://beta.earthdeeds.com/teamfunding.php?teamid=$teamid1&autologin=true&uname=$username"); 
			header("Location: http://beta.earthdeeds.com/teamfunding.php?teamid=$teamid1&uname=$usernamereg"); 
			}
			
			else
			{

			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_user_account_info` (`ID`, `user_username`, `user_first_name`, `user_last_name`, `user_email`, `user_password`, `user_profile_photo`, `user_address1`, `user_address2`, `user_city`, `user_state`, `user_zip`, `user_phone`, `user_location`, `user_facebook_id`, `user_facebook_password`, `user_policy`, `team_id`,`user_date`) VALUES (NULL, '$usernamereg', '$firstnameinput', '$lastnameinput', '$email', '$password', '$filePath', '$add1input', '$add2input', '$cityinput', '$stateinput', '$zipinput', '$phoneinput', '$location', '$fbid', '$fbpassword', '$policy', '$teamid',now());") or die(mysql_error()); 
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$usernamereg'") or die(mysql_error());  
			while($row = mysql_fetch_array( $result )) {
			$useridlog = $row['ID'];
			}

			mysql_query("INSERT INTO `shantiom_sandbeta`.`checkout_paypal` (`payment_trans_id`, `date`, `team_id`, `user_id`, `project_id`, `strategic_partner_id`, `trans_project_amount`, `trans_project_actual_amount`, `trans_earthdeeds_additional_amount`, `trans_project_admin_amount`, `trans_total_amount`) VALUES (NULL, now(), '$teamid1', '$useridlog', '$projid1', 'stpartid', '$amount1', '$amount2', '$sup1', '$sup2', '$amount');") or die(mysql_error());
			
			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_project_support` (`project_support_id`, `team_id`, `project_support`, `project_id`, `user_id`, `date_added`) VALUES (NULL, '$teamid1', '$amount', '$projid1', '$useridlog', now());") or die(mysql_error()); 
			?>
			<form name="_xclick" action="https://www.paypal.com/ph/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="webincome@earthdeeds.com">
			<input type="hidden" name="currency_code" value="USD">
			<input type="hidden" name="item_name" value="Earth Deeds">
			<input type="hidden" name="amount" id="testsum" value="<?php echo $amount; ?>">

			</form>
				

				 
				 <script language="javascript" type="text/javascript">
				document._xclick.submit();
				 </script>
				 <noscript><input type="submit" value="verify submit"></noscript>
			<?php

			 
		 }
	}	
/*----------------------------------------------------------------------*/


else if ($sup1){

session_register("myusername");
mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_project_support` (`project_support_id`, `team_id`, `project_support`, `project_id`, `user_id`, `date_added`) VALUES (NULL, '$teamid1', '$amount', '$projid1', '$userid', now());") or die(mysql_error()); 

mysql_query("INSERT INTO `shantiom_sandbeta`.`checkout_paypal` (`payment_trans_id`, `date`, `team_id`, `user_id`, `project_id`, `strategic_partner_id`, `trans_project_amount`, `trans_project_actual_amount`, `trans_earthdeeds_additional_amount`, `trans_project_admin_amount`, `trans_total_amount`) VALUES (NULL, now(), '$teamid1', '$userid', '$projid1', 'stpartid', '$amount1', '$amount2', '$sup1', '$sup2', '$amount');") or die(mysql_error());
?>

<form name="_xclick" action="https://www.paypal.com/ph/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="webincome@earthdeeds.com">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name" value="Earth Deeds">
<input type="hidden" name="amount" id="testsum" value="<?php echo $amount; ?>">

</form>
	

     
     <script language="javascript" type="text/javascript">
    document._xclick.submit();
     </script>
     <noscript><input type="submit" value="verify submit"></noscript>
<?php
}
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Team Funding: Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  	<script type="text/Javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/Javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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
  	<script type="text/javascript">
	/*	function validateForm()
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
	}*/
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
		if(this.field1.value == "Password" && this.field2.value == "Repeat Password"){
			r.innerHTML = this.nooutput_html;
		}
		}
	}
	</script>  	
        
        <div>
		<br />
      	 <div class="box" style="width: 800px; margin: auto;">
		 <div style="float: left;">
			<div style="text-align:center;"><span class="style3">Please support the following team and project</span></div>
            <br /><br />
            <div>
            	<div style="float: left; width: 100px; height: auto;">
                    <!-- <div><img src="images2/team-profile.jpg" class="user-profile"/></div> -->
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
					$cprice = $rowteam['carbon_price'];
					$teamuserid = $rowteam['user_account_id'];
						if ($rowteam['team_image'] == "teamimages/"){
						echo '<div><img class="user-profile" width="75" src="imagesprofiles/team.jpg"\> </div>';						
						}
						else
						{
						echo '<div><img class="user-profile" width="75" height="75px" src="'.$rowteam['team_image'].'" alt="'.$rowteam['team_initiator'].'"\></div>';
						}
			echo '
                </div>


               <div style="float: left; width: 280px; margin-right: 20px;">


						<div><span class="style10"><a href="http://beta.earthdeeds.com/team.php?teamid='.$rowteam['Team_account_idnum'].'">'.$rowteam['team_title'].'</a></span></div>
						 <div style="margin-top: 10px;">'.$rowteam['team_description'].'</div>

              </div>';
 					}	
					}
			  ?>
                <!-- <div align="center" style="float: left; width: 100px; height: auto;">
                    <div><img src="images2/team-profile2.jpg" class="user-profile"/></div>
                </div> -->
               <div style="float: left; width: 100px; height: auto;">
                    	<!-- <div><span class="style10"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$projectid.'&teamid='.$projectteamid.'">'.$titleproj.'</a></span></div>
                        <div><span class="style14">'.$description.'</span></div> -->
						<!-- <div><span class="style10"><a href="#">Test Project</a></span></div>
						<div><span class="style14">Project short description</span></div> -->
									<?php
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamid'") or die(mysql_error());  
					
					while($rowproj = mysql_fetch_array( $resultproj )) {
					$projectid = $rowproj['project_account_idnum'];
					$projectuserid = $rowproj['user_account_id'];
					$projectuser = $rowproj['project_creator_username'];
					if ($rowproj['project_profile_photo'] == "projimages/"){
						echo '<div><img src="http://beta.earthdeeds.com/projimages/project.jpg"  class="user-profile" height="75" width="75"></div>';
						}
						else
						{
						echo '<div><img src="'.$rowproj['project_profile_photo'].'" class="user-profile" height="75" width="75"></div>';
						}	
                
              						
					echo '</div>
					<div style="float: left; width: 280px;">
					<div><span class="style10"><a href="http://beta.earthdeeds.com/project.php?projid='.$projectid.'&teamid='.$teamid.'">'.$rowproj['project_title'].'</a></span></div>';
					echo '<div  style="margin-top: 10px;">'.$rowproj['project_description'].'<</div></div><br /><br />';

				}
				
				
				
					
			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamid'") or die(mysql_error());  
			$counter =0;
			
			while(($rowprojadded = mysql_fetch_array( $resultprojadded )) and ($counter < 1)) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd ))  {
			
						$projectid2 = $rowprojteamadd['project_account_idnum'];	
					if ($rowprojteamadd['project_profile_photo'] == "projimages/"){
						echo '<div><img src="http://beta.earthdeeds.com/projimages/project.jpg"  class="user-profile" height="75" width="75"></div>';
						}
						else
						{
							echo '<div><img src="'.$rowprojteamadd['project_profile_photo'].'" class="user-profile" height="75" width="75"></div>';
						}																			

					echo '</div><div style="float: left; width: 280px;">
					<div><span class="style10"><a href="http://beta.earthdeeds.com/project.php?projid='.$projectid2.'&teamid='.$teamid.'">'.$rowprojteamadd['project_title'].'</a></span></div>';
					echo '<div  style="margin-top: 10px;">'.$rowprojteamadd['project_description'].'<</div></div><br /><br />';

							
						$projecttitle = $rowprojteamadd['project_title'];						
						$projectidsup = $rowprojteamadd['project_account_idnum'];	




						$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projectid2' AND pp_tx_status = 'Completed'") or die(mysql_error());  		
						$rowCheck = mysql_num_rows($resultsupport);	
						$total = 0;	
						while($rowsupport = mysql_fetch_array( $resultsupport )) {
						$price= $rowsupport['pp_total_amount'];
						$total += $price;
						
						
						}
					$totalteamsupport = $total;




						

					}
					$counter++;	
					}
					
					
					
					
					
							/*-----------------------------------------------------team joined start --------------------------------------------*/		

					$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid'") or die(mysql_error());  
					$totalemm = 0;
					while($rowemission = mysql_fetch_array( $resultemission )) {
				
					$emm = $rowemission['member_emmision'];
					$totalemm +=  $emm;
					}
					

					$alltotal = $totalemm;

$remain = $alltotal * $cprice - $totalteamsupport;
/*---------------------------------------------------------current supportt---------------------------------------------*/
if ($remain<0){
$remains = abs($remain);
$wordremain = 'we have exceeded our goal by $'.$remains ;
}

else
{
$wordremain = 'we have $'. $remain.' left to raise';
}

			?>
              </div>
                <div class="clear"></div>    
			</div>
            
            <br />
            <div style="text-align:center;"><span class="style10">Our goal is to raise at least $<?php $totrem = $alltotal * $cprice; echo number_format($totrem, 2, '.', ''); ?> and <?php echo $wordremain;?>.</span></div>
            <br />

            <div>
            	<div style="float: left; width: 380px; height: auto;">
                    <div><span class="style28">Amount to <?php echo $projecttitle; ?></span></div>
                    <div><span class="style28">Additional support for Earth Deeds</span></div>
                </div>
	<?php

					$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid'") or die(mysql_error());  
					$totalemm = 0;
					while($rowemission = mysql_fetch_array( $resultemission )) {
				
					$emm = $rowemission['member_emmision'];
					$totalemm +=  $emm;
					}
					
					$alltotal = $totalemm;

					
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

		$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum 	 = '$teamid'") or die(mysql_error());  

		while($rowteam = mysql_fetch_array( $resultteam )) {

$teamidmem = $rowteam['team_id'];
				
				$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamidmem'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultemission);			
				
				$totalemm = 0;	
				while(($rowemission = mysql_fetch_array( $resultemission ))  and ($counter < 1)) {
				
						$mytotal = $rowemission['member_emmision'];
				  
				
						}
						
				}
				
				
		/*----------------------------------------------------------------------------------------------------------------*/

						$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultemission);			
				if($rowCheck > 0){
				$totalemm = 0;	
				$counter = 0;
				while(($rowemission = mysql_fetch_array( $resultemission )) and ($counter < 1)) {
						$finalmytotal = $rowemission['member_emmision'] + $mytotal;	

						$noemission = 1;
						$counter++;	
						}
						}
						else
						{
						$noemission = 0;
						$finalmytotal = $rowemission['member_emmision'] + $mytotal;		
						}
						
			$test =	number_format($finalmytotal, 2, '.', '') * $cprice;
			$finalsup = $finalmytotal * $cprice;
									$finaltest = $finalsup*.15; 
						$fresult = $totalsup + $finaltest;
				?>
                <div style="float: left;text-align:right; margin-right: 30px;">
				 <form name="userform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()">
						<input type="hidden" name="userid" value="<?php echo $userid;?>">						
						<input type="hidden" name="currusername" value="<?php echo $username;?>">						
						<input type="hidden" name="projid" value="<?php echo $projectaddid;?>">						
						<input type="hidden" name="teamid" value="<?php echo $teamid;?>">						
						<input type="hidden" name="amount1" value="<?php echo number_format($alltotal, 2, '.', '') * $cprice; ?>">
						<input type="hidden" name="amount2" value="<?php echo number_format($finalmytotal, 2, '.', '') * $cprice; ?>">
                        <!--<div><span class="style14"><input name="sup1" type="text" value="<?php// echo $test; ?>" class="input2" /></span></div>
						<div><span class="style14"><input name="sup2" type="text" value="<?php //echo number_format($fresult, 2, '.', ''); ?>" class="input2"/></span></div>-->                     
						<div><span class="style14"><input name="sup1" type="text" class="input2" /></span></div>
						<div><span class="style14"><input name="sup2" type="text" class="input2"/></span></div>
						
						
						
							<script type="text/javascript" >
    $(document).ready(function(){
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".input2").each(function() {
 
            $(this).focusout(function(){
                calculateSum();
            });
        });
        $(window).keydown(function(event){
    		if(event.keyCode == 13) {
      			event.preventDefault();
      			return false;
    		}
  	});
    });
 
    function calculateSum() {
 
        var sum = 0;
        var xsum;
        //iterate through each textboxes and add the values
        $(".input2").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#sum").html(sum.toFixed(2));
        $("#testsum").html(sum.toFixed(2));
		xsum = sum.toFixed(2);
		$("#testsum").val(xsum);
		
    }
</script>

                        <div><span class="style14">Total <strong>$<span id="sum"> <?php// echo number_format($fresult, 2, '.', '') + $test; ?></span></strong></span></div>

                </div>
                
                <div style="float: left;text-align:right; ">
                       	<br /><br />
						<div><span class="style14"><a href="whysupportearthdeeds.html" target="blank">Why support Earth Deeds?</a></span></div>
                </div>
                
                <div class="clear"></div>    
			</div>
			<?php
			if ($username){
			echo ' <div style=" text-align: center;"><span class="style5">You are registered as '.$username.'</span></div>';
			}
			else
			{
			?>
            <br />
            <div style="text-align:center;"><span class="style5">Only registered users of the Earth Deeds site can complete a transaction</span></div>
            <br />
            <div style=" text-align: center;"><span class="style5">You can register quickly right here:  <strong>OR</strong> Returning Users Log in here:</span></div>
            <div style="margin-top: 12px; width: 700px; margin: auto;">
            			<br />
                    	<div style="float: left; margin-left: 50px;">
                        	<input name="User-Name" type="text" class="input" style="width: 250px;" placeholder="User Name" id="input"/> <br />
                        	<input name="First-Name" type="text" class="input" style="width: 250px;" placeholder="First Name" id="input"/> <br />
                        	<input name="Last-Name" type="text" class="input" style="width: 250px;" placeholder="Last Name" id="input"/> <br />
                            <input name="your-email" type="text" class="input" style="width: 250px;" placeholder="Email Address" id="input"/> <br />
                            <input name="password" placeholder="Password" type="password" class="input" style="width: 250px;" onkeyup="verify.check()" onfocus="if (this.value=='Password') this.value = ''"; onblur="if (this.value=='') this.value ='Password'"; id="input" /> <br />
                            <input name="password2" placeholder="Repeat Password" type="password" class="input" style="width: 250px;" onkeyup="verify.check()" id="input" onfocus="if (this.value=='Repeat Password') this.value = ''"; onblur="if (this.value=='') this.value = 'Repeat Password'"; />&nbsp; <span id="password_result" style="color:red"></span>
							</br>
<?php $uname= $_GET['uname'];
							if ($uname){	
							echo '<p class=\"errorpassmain\">Username '.$uname.' Already in Use</p>';
							}
							?>

						</div>
                        
                      	<div style="position:absolute; float: right; margin-left: 400px;">
                        	<input name="myusername" type="text" class="input" style="width: 250px;" placeholder="Username" id="input"/> <br />
                        	<input name="mypassword" type="password" class="input" style="width: 250px;" placeholder="Password" id="input"/> <br />					
							<?php 
							if ($loginerror== "logerror"){	
							echo "<p class=\"errorpassmain\">Error Login Details</p>";
							}
							?>

                        </div>
                        
             <div class="clear"></div>
             </div>
			 <?php
			 }
			 ?>
             <br />
            <div style="text-align: center;">
			<script type="text/javascript" >
			var $submit = $("input[type=submit]");
			if ( $("input:empty").length > 0 ) {
			$submit.attr("disabled","disabled");
			} else {
			$submit.removeAttr("disabled");
			}
			</script>
			
			<input type="hidden" name="amount" id="testsum">
                	<input type = "submit" name="submit" value="Pay Now" style="width: 150px; margin-bottom: 10px;"> 
   
             </div>
                <br /><br />
            
              
            
          </div><!-- END OF BOX ------------------------------------------------------------------ -->  
            		<script type="text/javascript">
			verify = new verifynotify();
			verify.field1 = document.userform.password;
			verify.field2 = document.userform.password2;
			verify.result_id = "password_result";
			verify.match_html = "<SPAN STYLE=\"color:green\">Match<\/SPAN>";
			verify.nomatch_html = "<SPAN STYLE=\"color:red\">MisMatch<\/SPAN>";
			verify.nooutput_html = "<SPAN STYLE=\"color:red\"><\/SPAN>";
			verify.check();
		</script>			  
		</div>
        <br />
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
