<?php
session_start();
if(!session_is_registered(myusername)){
header("location:login.php");
}
$username = $_SESSION['myusername'];
include('connect-db.php');
$teamid = $_GET['teamid'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Invite Members : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
    	<div class="logo"></div>
        <div class="login">
        	        <div class="login">
        	<span class="style1">Logged in as </span><span class="style2"><a href="mystuff.php"><?php echo $username; ?></a>  | <a href="logout.php">Log Out</a></span>       
        </div>	      
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
				include('connect-db.php');
				$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  

					$rowCheck = mysql_num_rows($resultteam);			
					while($rowteam = mysql_fetch_array( $resultteam )) {
					
			echo '<div><span class="style10">Invite Members to join '. $rowteam['team_title'].'</span> </div>
            <br />
        	<div class="box" style="margin: 0 0 -20px 0;">
                <div style="float: left; width: 200px; height: auto;">
                	
                <br />';

					$message2 = "Please click this link http://beta.earthdeeds.com/confirm.php?teamid=".$teamid;
					$message3 = "to join this team: ".$rowteam['team_title'];
					$message4 = "Thank you for your participation.";
					
					$foot = "Powered by Earth Deeds.";
					}
					
					$email = $_REQUEST['email'];
					$message = $_REQUEST['message'];
					$youremail = $_REQUEST['youremail'];
					if(!isset($email) && empty($message) && empty($youremail)){

					
					
?>
				
                    <div><span class="style20">Send To:</span></div>
                    <div><span class="style20">From:</span></div>
                    <div><span class="style20">Message:</span></div>
			
				</div>
                
                <div style="float: left;">
				<form action="" method="post">
                <br />
                    <div><input name="email" type="text" class="input"/></div>
                    <div><input name="youremail" type="text" class="input"/></div>
                    <div><textarea name="message" cols="" rows="" class="input" style="height: 100px;"></textarea></div>
				
				</div>
   
                <div class="clear"></div>
                
                <div style="width: 610px; text-align: right;">
                	<!--<a href="#">INVITE</a>-->
					<div class="button"><input type='submit' value='Invite'></div>
					</form>

				</div>
				</div>

				


			<?php

						}

							elseif(empty($youremail)){
							die("Please enter your email!");
							}

							elseif(empty($message)){
							die("Please enter your message!");

							}
							else{
							$send = mail($email, "Invitation", $message." 					
$message2 
$message3	
		
$message4			
$foot", "From: $youremail");

							if(!$send){
							echo '<div style="width: 920px;"><div class="left"><div class="box">';
							echo '<div style="width: 920px;"><div class="left"><div class="box">';

							echo "<h1>Can not send your invitation!</h1>";
							echo "<a href=http://beta.earthdeeds.com/team.php?teamid=".$teamid."> View Team</a>";
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							}

							else{
							
							echo '<div style="width: 920px;"><div class="left1"><div class="box" style="margin: -30px 0 0 0;">';
							echo "<h2>Invitation Sent! <img src='images/CheckMark.jpg' length='50'; width='50';></h2>";
							echo '</br>  Check your Inbox for the Invitation.<br>';
							echo "<a href=http://beta.earthdeeds.com/team.php?teamid=".$teamid."> View Team  </a>";
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
							echo '</div>';

						
							}
							}
												
					?>


<div class="clear"></div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>

					
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
