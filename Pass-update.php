<?php
if(session_is_registered(myusername)){
header("location:http://beta.earthdeeds.com/mystuff.php");
}

$changetype = $_GET['type'];
$projid = $_GET['projid'];
$teamid = $_GET['teamid'];
$userid = $_GET['userid'];
$projid1 = $_POST['projid'];
$teamid1 = $_POST['teamid'];
$userid1 = $_POST['userid'];
$passtype = $_POST['passtype'];
$emailreset = $_POST['emailreset'];
include('connect-db.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reset Password</title>
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
    
   <div style="width: auto; margin: auto;"> <!-- start of Content ---------------------------------------------------- -->


                <!-- Data retrived from user profile are shown here -->
                <div class="box">
                    <?php// d($userInfo); ?>
					


				 <!--<span class="style8">(note details can not be changed except for the password)</span></br>-->
				<div style="text-align:center;"><span class="style8" style="font-weight: bolder;">
		<?php			

if ($emailreset){


				$result = mysql_query("SELECT * FROM $tbl where user_email = '$emailreset'") 
				or die(mysql_error()); 
				$rowCheck = mysql_num_rows($result);		
				if($rowCheck > 0){				
				$row = mysql_fetch_array( $result );

				$useremail = $row['user_email'];
				$upass = $row['user_password'];

				if($passtype=="user"){
				$message = "You have requested a link to reset your password on your Earth Deeds team account.\r\n\r\nClick on the link below to reset your password\r\n\r\nhttp://beta.earthdeeds.com/Pass-update-function.php?email=".$useremail."&changepasstype=".$passtype."&key=".$upass."\r\n\r\nThank you for using Earth Deeds.\r\n\r\nSincerely,\r\n\r\nThe Earth Deeds team";	
				$message = wordwrap($message, 70, "\r\n");
				$headers = 'From: shanti@earthdeeds.com' . "\r\n" .
				'Reply-To: shanti@earthdeeds.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();	
				mail($useremail, 'Earthdeeds Password Reset', $message, $headers);
				echo '<span style="color: red;">Email Sent to '.$useremail.'</span>';
				}if($passtype=="team"){
				//echo $userid1;			
				$resultteam = mysql_query("SELECT * FROM wp_cc_team_manager where team_manager_userid = '$userid1' AND team_id = '$teamid1'") 
				or die(mysql_error()); 
				$rowCheckteam = mysql_num_rows($resultteam);		
				if($rowCheckteam > 0){				
				$row = mysql_fetch_array( $resultteam );
				$message = "click the link below to reset youre password\r\nhttp://beta.earthdeeds.com/Pass-update-teamproj.php?email=".$useremail."&changepasstype=".$passtype."&teamid=".$teamid1."&userid=".$userid1."\r\nReset ".$passtype." Password Request";
				$message = wordwrap($message, 70, "\r\n");
				$headers = 'From: shanti@earthdeeds.com' . "\r\n" .
				'Reply-To: shanti@earthdeeds.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();	
				mail($useremail, 'Earthdeeds Password Reset', $message, $headers);
				echo '<span style="color: red;">Email Sent to '.$useremail.'</span>';
				}
				else
				{
				echo 'Only team manager can change passwords';
				}
				

				}if($passtype=="project"){
				$message = "click the link below to reset youre password\r\nhttp://beta.earthdeeds.com/Pass-update-teamproj.php?email=".$useremail."&changepasstype=".$passtype."&teamid=".$teamid1."&projid=".$projid1."&userid=".$userid1."\r\nReset ".$passtype." Password Request";
				$message = wordwrap($message, 70, "\r\n");
				$headers = 'From: shanti@earthdeeds.com' . "\r\n" .
				'Reply-To: shanti@earthdeeds.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();	
				mail($useremail, 'Earthdeeds Password Reset', $message, $headers);
				echo '<span style="color: red;">Email Sent to '.$useremail.'</span>';
				}


				}
				else
				{
				echo '<span style="color: red;">Email not registered</span>';
				}
				}
				?>
				 <form name="userform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()">
				<span class="style8">Reset <?php echo $changetype;?><?php echo $passtype;?> Password </span><br></br>
				<input type="hidden" name="passtype" value="<?php echo $changetype;?>"/>
				<input type="hidden" name="userid" value="<?php echo $userid;?>"/>
				<input type="hidden" name="teamid" value="<?php echo $teamid;?>"/>
				<input type="hidden" name="projid" value="<?php echo $projid;?>"/>
				<span class="style8">Email:  </span><input type="text" name="emailreset"  class="userform" size="40" /></br></br>
				<div style="text-align:center;"><input type="submit" name="Submit" value="Send Password to Email"></div>
				</form>
                </div>

        <div class="clear"></div>
		</div>
<!-- End of Content ---------------------------------------------------- -->
   </div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>