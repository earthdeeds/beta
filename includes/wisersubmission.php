<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://beta.earthdeeds.com/login.php");
}
include('../connect-db.php');
$username = $_SESSION['myusername'];

$usernotes  = $_POST['usernotes'];
$profpic  = $_POST['profpic'];
$worgname  = $_POST['worgname'];
$idorg  = $_POST['idorg'];
$worgarea  = $_POST['worgarea'];
$worgwebsite  = $_POST['worgwebsite'];
$worgupdated  = $_POST['worgupdated'];
$worglocation  = $_POST['worglocation'];
$worgdescription  = $_POST['worgdescription'];
						
		$usernoteshtml = htmlentities( $usernotes, ENT_QUOTES );
		$worgnamehtml = htmlentities( $worgname, ENT_QUOTES );
		$worgareahtml = htmlentities( $worgarea, ENT_QUOTES );
		$worglocationhtml = htmlentities( $worglocation, ENT_QUOTES );
		$worgdescriptionhtml = htmlentities( $worgdescription, ENT_QUOTES );
		if( get_magic_quotes_gpc() )
		{
			$data = stripslashes( $usernoteshtml);
			$data = stripslashes( $worgnamehtml);
			$data = stripslashes( $worgareahtml);
			$data = stripslashes( $worglocationhtml);
			$data = stripslashes( $worgdescriptionhtml);

		}

		 $usernotesinput= mysql_real_escape_string( $usernoteshtml);  
		 $worgnameinput= mysql_real_escape_string( $worgnamehtml);  
		 $worgareainput= mysql_real_escape_string( $worgareahtml);  
		 $worglocationinput= mysql_real_escape_string( $worglocationhtml);  
		 $worgdescriptioninput= mysql_real_escape_string( $worgdescriptionhtml);  
			
			
			
		

	$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
 
	$rowCheck = mysql_num_rows($result);			
	if($rowCheck > 0){
	
	        while($row = mysql_fetch_array( $result )) {
		
		$userid = $row['ID'];
		$uname = $row['user_username'];
		$fname = $row['user_first_name'];
		$lname = $row['user_last_name'];
		$email = $row['user_email'];
		
                }

			
		mysql_query("INSERT INTO `shantiom_sandbeta`.`wiser_project_requests` (`wiser_organization_id`, `wiser_organization_name`, `wiser_organization_orgid`, `wiser_organization_description`, `user_id`, `wiser_organization_website`, `wiser_organization_area`, `wiser_organization_location`, `wiser_organization_updated`, `user_notes`, `wiser_organization_date_created`, `profile_image`) VALUES (NULL, '$worgnameinput', '$idorg', '$worgdescriptioninput', '$userid', '$worgwebsite', '$worgareainput', '$worglocationinput', '$worgupdated', '$usernotesinput', now(), '$profpic');") or die(mysql_error()); 
		
	/*----------------------------------------mailing-----------------------------------------------------------------------*/

/* multiple recipients
$to  = 'shanti@earthdeeds.com' . ', '; // note the comma
$to .= 'wiserprojectrequests@earthdeeds.com';*/
$to = 'wiserprojectrequests@earthdeeds.com';

// subject
$subject = 'Wiser Organization Request';

// message
$message = '
Personal Information  <br />
Username: '.$uname.'<br />
Real Name:'.$fname.' '.$lname.'<br />
Email:'.$email.'<br />
<br />
Organization Information  <br />
Organization Name: '.$worgnameinput.'<br />
Organization Website: '.$worgwebsiteinput.' <br />
Organization Area: '.$worgareainput.' <br />
Organization Location: '.$worgnameinput.' <br />
Organization Updated: '.$worglocationinput.' <br />
Organization User Note: '.$usernotesinput.' <br />
Description:  <br />
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
'.$worgdescription.' 

</body>
</html>

';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
/* Additional headers
$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";*/

// Mail it
mail($to, $subject, $message, $headers);
	
	
	/*----------------------------------------mailing-----------------------------------------------------------------------*/
		
		
	
		 header("Location: http://beta.earthdeeds.com/wiser-thankyou.php"); 
		
	}
	
	else
	{

		header("Location: http://beta.earthdeeds.com/login.php"); 
	
	}

		
?>