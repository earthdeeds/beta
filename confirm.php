<?php
session_start();
error_reporting(0);
$teamid = $_GET['teamid'];
$teamwelcome = $_GET['teamwelcome'];
$teamtitle = $_GET['teamtitle'];

$autologin = $_GET['autologin'];
$uname = $_GET['uname'];
$userreg = $_GET['user'];

if ($autologin=="true"){
$_SESSION['myusername'] = $uname;
session_register("myusername");
$_SESSION['myusername'] = $uname;
//session_register("myusername");
}
if(!session_is_registered(myusername)){
header("location:http://beta.earthdeeds.com/login.php?teamid=$teamid&teamreg=member&url=".$_SERVER['REQUEST_URI']);
}
$username = $_SESSION['myusername'];
include('connect-db.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Confirm : Earth Deeds </title>
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

        
        <div>
        <!-- start of left ---------------------------------------------------- -->
        	<div class="box">
			<?php
	if ($teamwelcome== "teamwelcome"){	
	//echo "<h1>Team Welcome Page</h1>";
	echo "<h1>Welcome you are now part of the team ".$teamtitle."</h1>";
	echo "<h2><a href=\"http://beta.earthdeeds.com/team.php?teamid=$teamid\">Click Here to View Team $teamtitle </a></h2>";
	}
	else
	{


if($teamid){

$username = $_SESSION['myusername'];
$identity = $_GET['identify'];
?>			

					<?php
include('connect-db.php');
					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
					while($rowteam = mysql_fetch_array( $resultteam )) {
					//echo 'Team to join:'. $rowteam['team_title'];
					$teamtitle = $rowteam['team_title'];
					$image = $rowteam['team_image'];
					$teamdesription = $rowteam['team_description'];
						
					}
					
					?>
					</br>
            	<div><span class="style3">Confirm Team Membership</span></div>
                <br />
				<?php
				if ($image == "teamimages/"){
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
							include("resize-class.php");
							$resizeObj = new resize($image);
							$resizeObj -> resizeImage(80, 80, 'auto');
							$resizeObj -> saveImage('imageresize/'.$image, 100);
							echo '
							<div class="boxprofile" style="float: left; width: 80px; height: 80px;">
							<table width="100%" height="100%" align="center" valign="center">
							<tr><td>
							<center><img src="imageresize/'.$image.'"></center>
							</td></tr>
							</table>
							</div>
							';
						}
				?>

                <div style="float: left; width: 485px; height: auto;">
                	<div><span class="style3">Team: </span><span class="style4"><?php echo $teamtitle; ?></span></div>
                    <div><span class="style5"><?php echo $teamdesription; ?></span></div>
                   <!-- <div><span class="style6">Team Emissions: </span><span class="style7">-->
			<?php/*		
					$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid'") or die(mysql_error());  
					$totalemm = 0;
					while($rowemission = mysql_fetch_array( $resultemission )) {
				
					$emm = $rowemission['member_emmision'];
					$totalemm +=  $emm;
					}
					
				
					if ($emm) {
					$totalteamemm = $totalemm + $rowteam['team_emissions'];
					echo $totalteamemm;
					}
					else
					{
					echo $rowteam['team_emissions'];
					}
					echo 'mT</span></div>';
					
					
				*/	
			?>
					
					
					</span></div>
                </div>
                <div class="clear"></div>
                <br />
				   <div><span class="style5" style="font-weight: bolder;">Click Here to Confirm Membership</span></div>
		<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">
		<p><input type="hidden" name="identify" value="inviteuser"/></p>
		<p><input type="hidden" name="teamid" value="<?php echo $teamid; ?>"/></p>
		<p><input type="hidden" name="user_username" value="<?php echo $username; ?>"/></p>
		<p><input type="hidden" name="teamtitle" value="<?php echo $teamtitle; ?>"/></p>
		<p><input type="submit" value="Join Team Now" class="userform" />	</p>
		</form>


<?php 
}
else
{
header("location:http://beta.earthdeeds.com/ask-team-leaders/");
}
}

if ($userreg=="registered") {
?>
<div> 
<center>

<div><span class="style5" style="font-weight: bolder;">You're registered!  Welcome to Earth Deeds</span></div>
<div><span class="style20" style="font-weight: bolder;">Click Here to view <a href="mystuff.php">your accounts </a></span></div>

</center>
</div>
 <div class="clear"></div>
 </div>
<?
}
?>



          

         <!-- start of right ---------------------------------------------------- -->
        
        <div class="clear"></div>
        </div>
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
