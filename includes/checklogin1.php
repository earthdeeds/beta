<?php

include('../connect-db.php');

			
$identify = $_POST['identify'];
if ($identify == "projectedit"){
$projid = $_POST['projectid'];
$projpassword = $_POST['projpassword'];

$sql="SELECT * FROM $tblproject WHERE project_account_idnum='$projid' and project_password='$projpassword'";
$result= mysql_query($sql);
$rowCheck = mysql_num_rows($result);			
			if($rowCheck > 0){
			while($rowproj = mysql_fetch_array( $result )) {
			
			header("Location: http://beta.earthdeeds.com/add-edit-project.php?projid=$projid&identify=projedit"); 
			}
			}
			else
			{
			header("Location: http://beta.earthdeeds.com/project.php?projid=$projid&loginerror=logerror");
			}
}
else if ($identify == "teamedit"){
$teamid = $_POST['teamid'];
$teampassword = $_POST['teampassword'];

$sql="SELECT * FROM $tblteam WHERE Team_account_idnum='$teamid' and team_password='$teampassword'";
$result= mysql_query($sql);
$rowCheck = mysql_num_rows($result);			
			if($rowCheck > 0){
			while($rowproj = mysql_fetch_array( $result )) {
			
			header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit"); 
			}
			}
			else
			{
			header("Location: http://beta.earthdeeds.com/team.php?teamid=$teamid&loginerror=logerror");
			}
}

else if ($identify == "orgedit"){
$orgid = $_POST['orgid'];
$orgpassword = $_POST['orgpassword'];

$sql="SELECT * FROM $tblorg WHERE Organization_account_idnum='$orgid' and Organization_password='$orgpassword'";
$result= mysql_query($sql);
$rowCheck = mysql_num_rows($result);			
			if($rowCheck > 0){
			while($rowproj = mysql_fetch_array( $result )) {
			
			header("Location: http://beta.earthdeeds.com/add-edit-org.php?orgid=$orgid&identify=orgedit"); 
			}
			}
			else
			{
			header("Location: http://beta.earthdeeds.com/org.php?orgid=$orgid&loginerror=logerror");
			}
}



else if ($identify == "fblogin")
{

include('../connect-db.php');
			

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
//$mypassword = stripslashes($mypassword);
$mypassword = $mypassword;
$myusername = mysql_real_escape_string($myusername);
//$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl WHERE user_facebook_id='$myusername' and user_password='$mypassword'";
$result= mysql_query($sql);

// Mysql_num_row is counting table row
$count= mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword");
	if ($teamreg == "member"){	
	header("Location: http://beta.earthdeeds.com/mystuff.php?teamid=$teamid"); 
	}
	else
	{
	header("Location: http://beta.earthdeeds.com/mystuff.php"); 
	}
 
}
else {
header("Location: http://beta.earthdeeds.com/index.php?loginerror=logerror"); 
}

}



else
{
$teamid = $_POST['teamid'];
$teamreg = $_POST['teamreg'];

include('../connect-db.php');
				$resultteam = mysql_query("SELECT * FROM $tblteam") or die(mysql_error());  



// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
//$mypassword = stripslashes($mypassword);
$mypassword = $mypassword;
$myusername = mysql_real_escape_string($myusername);
//$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl WHERE user_username='$myusername' and user_password='$mypassword'";
$result= mysql_query($sql);

// Mysql_num_row is counting table row
$count= mysql_num_rows($result);

// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
session_register("myusername");
session_register("mypassword");

if ($teamreg == "member"){	
	header("Location: http://beta.earthdeeds.com/confirm.php?teamid=$teamid"); 
	}
else
{
	header("Location: http://beta.earthdeeds.com/mystuff.php"); 
}
 
}
else {
header("Location: http://beta.earthdeeds.com/login.php?loginerror=logerror"); 
}

}



?>