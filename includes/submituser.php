<?php
$identify = $_POST['identify'];
if ($identify == "user"){

$uploadDir = '../imagesprofiles/'; //Image Upload Folder
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
			$username = $_POST['User-Name'];
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
include('../connect-db.php');			
			
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
			
			
			
			
			$resultfilteruser = mysql_query("SELECT * FROM $tbl where user_username = '$username'")or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultfilteruser);			
			if($rowCheck > 0){
			header("Location: http://beta.earthdeeds.com/"); 
			}
			
			else
			{

			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_user_account_info` (`ID`, `user_username`, `user_first_name`, `user_last_name`, `user_email`, `user_password`, `user_profile_photo`, `user_address1`, `user_address2`, `user_city`, `user_state`, `user_zip`, `user_phone`, `user_location`, `user_facebook_id`, `user_facebook_password`, `user_policy`, `team_id`,`user_date`) VALUES (NULL, '$username', '$firstnameinput', '$lastnameinput', '$email', '$password', '$filePath', '$add1input', '$add2input', '$cityinput', '$stateinput', '$zipinput', '$phoneinput', '$location', '$fbid', '$fbpassword', '$policy', '$teamid',now());") or die(mysql_error()); 
			
			 
if ($teamreg == "member"){	
	header("Location: http://beta.earthdeeds.com/welcome/?teamid=$teamid&autologin=true&uname=$username"); 
	}
	else
	{
	header("Location: http://beta.earthdeeds.com/mystuff.php"); 
	}
			 }
	}	
	
	/*----------------------------------------------------------------------*/
	else if ($identify == "useredit"){
	$uploadDir = '../imagesprofiles/'; //Image Upload Folder
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
				//$username = $_POST['User-Name'];
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
include('../connect-db.php');
				
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
				
				
				
				$result = mysql_query("SELECT * FROM $tbl where ID = '$userid'") or die(mysql_error());  
 
				$rowCheck = mysql_num_rows($result);			
				if($rowCheck > 0){
				if ($filePath == "images/") {
				$result = mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_user_account_info` SET `user_first_name` = '$firstnameinput', `user_last_name` = '$lastnameinput', `user_email` = '$email', `user_address1` = '$add1input', `user_city` = '$cityinput', `user_state` = '$stateinput', `user_zip` = '$zipinput', `user_phone` = '$phoneinput', `user_password` = '$password',`user_date` = now() WHERE `wp_cc_user_account_info`.`ID` ='$userid';") or die(mysql_error()); 
				
				 header("Location: http://beta.earthdeeds.com/mystuff.php"); 
				 }
				 else
				{
				$result = mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_user_account_info` SET `user_first_name` = '$firstnameinput', `user_last_name` = '$lastnameinput', `user_email` = '$email', `user_address1` = '$add1input', `user_city` = '$cityinput', `user_state` = '$stateinput', `user_zip` = '$zipinput', `user_phone` = '$phoneinput',`user_profile_photo`='$filePath', `user_password` = '$password',`user_date` = now() WHERE `wp_cc_user_account_info`.`ID` ='$userid';") or die(mysql_error()); 
				
				 header("Location: http://beta.earthdeeds.com/mystuff.php"); 
				 
				 }
	}
	}
	
	/*----------------------------------------------------------------------*/
	
else if ($identify == "userfb")
	{
	
				$firstname = $_POST['firstname'];
				$lastname = $_POST['lastname'];
				$fbusername = $_POST['fbusername'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$imagefile = $_POST['imgpro'];
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
				include('../connect-db.php');

				mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_user_account_info` (`ID`, `user_username`, `user_first_name`, `user_last_name`, `user_email`, `user_password`, `user_profile_photo`, `user_address1`, `user_address2`, `user_city`, `user_state`, `user_zip`, `user_phone`, `user_location`, `user_facebook_id`, `user_facebook_password`, `user_policy`, `team_id`,`user_date`) VALUES (NULL, '$username', '$firstname', '$lastname', '$email', '$password', '$imagefile', '$add1', '$add2', '$city', '$state', '$zip', '$phone', '$location', '$fbusername', '$fbpassword', '$policy', '$teamid',now());") or die(mysql_error()); 
				$myusername = $fbusername;
				session_register("myusername");
				header("location:http://beta.earthdeeds.com/mystuff.php?firstlogin=flogin&fb-login=true");

	}
	
	else if ($identify == "project")
	{

	$uploadDir = '../projimages/'; //Image Upload Folder
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
	
			$projtitle = $_POST['projtitle'];
			$teamid = $_POST['team_idnum'];
			$teameditid = $_POST['teameditid'];
			$username = $_POST['username'];
			$description = $_POST['description'];
			$longdescription = $_POST['longdescription'];
			$keyword = $_POST['description'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$pass = $_POST['projpassword'];
			$policy = $_POST['policy'];
			$facebookid = $_POST['facebookid'];
			$fpass = $_POST['fpass'];
			$address1 = $_POST['address1'];
			$address2 = $_POST['address2'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zipcode = $_POST['zipcode'];
			$phone = $_POST['phone']; 
			$location = $_POST['location'];
			$purl = $_POST['purl'];
			$pstatus = $_POST['pstatus'];
			$tblignit = 'wp_ign_products';

		    include('../connect-db.php');
			

		$longdescriptionhtml = htmlentities( $longdescription, ENT_QUOTES );
		$projtitlehtml = htmlentities( $projtitle, ENT_QUOTES );
		$descriptionhtml = htmlentities( $description, ENT_QUOTES );
		$keywordhtml = htmlentities( $keyword, ENT_QUOTES );
		$purlhtml = htmlentities( $purl, ENT_QUOTES );
		$address1html = htmlentities( $address1, ENT_QUOTES );
		if( get_magic_quotes_gpc() )
		{
			$data = stripslashes( $longdescriptionhtml);
			$data1 = stripslashes( $projtitlehtml);
			$data2 = stripslashes( $descriptionhtml);
			$data3 = stripslashes( $keywordhtml);
			$data4 = stripslashes( $purlhtml);
			$data5 = stripslashes( $address1html);
		}

		 $longdescriptioninput= mysql_real_escape_string( $longdescriptionhtml);  
		 $projtitleinput= mysql_real_escape_string( $projtitlehtml);
		 $descriptioninput= mysql_real_escape_string( $descriptionhtml);
		 $keywordinput= mysql_real_escape_string( $keywordhtml);
		 $purlinput= mysql_real_escape_string( $purlhtml);
		 $address1input= mysql_real_escape_string( $address1html);


	$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
 
	$rowCheck = mysql_num_rows($result);			
	if($rowCheck > 0){
	
	        while($row = mysql_fetch_array( $result )) {
		
		
		$userid = $row['ID'];
		
                }
				
						
				

		mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_project_account` (`project_account_idnum`, `user_account_id`, `team_idnum`, `project_creator_username`, `project_title`,  `project_description`, `project_long_description`, `project_keyword`, `project_contact_first_name`, `project_contact_last_name`, `project_email`, `project_password`, `project_profile_photo`, `project_policy`, `project_facebook_id`, `project_facebook_password`, `project_address1`, `project_address2`, `project_city`, `project_state`, `project_zip`, `project_phone`, `project_location`, `project_URL`, `project_status`, `project_date`) VALUES (NULL, '$userid', '$teamid', '$username', '$projtitleinput', '$descriptioninput', '$longdescriptioninput', '$keywordinput', '$firstname', '$lastname', '$email', '$pass', '$filePath', '$policy', '$facebookid', '$fpass', '$address1input', '$address2', '$city', '$state', '$zipcode', '$phone', '$location', '$purlinput', '$pstatus', now());") or die(mysql_error()); 
	
		 header("Location: http://beta.earthdeeds.com/mystuff.php"); 
		
	}
	
	else
	{

		header("Location: http://beta.earthdeeds.com/error/"); 
	
	}
}

	else if ($identify == "saveproject")
	{
	if(!empty($_FILES["Photo"]["name"])) {
	
	$uploadDir = '../projimages/'; //Image Upload Folder
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
	}
	else
	{
	$filePath = $_POST['mainimagedefault'];
	}
	//if ($_FILES['501c3image'] != "projimages/") {
	if(!empty($_FILES["501c3image"]["name"])) {

	
	$uploadDir1 = '../projimages/'; //Image Upload Folder
	$fileName1 = $_FILES['501c3image']['name'];
	$tmpName1 = $_FILES['501c3image']['tmp_name'];
	$fileSize1 = $_FILES['501c3image']['size'];
	$fileType1 = $_FILES['501c3image']['type'];
	$filePath1 = $uploadDir1 . $fileName1;
	$resultimages1 = move_uploaded_file($tmpName1, $filePath1);
	
	if(!get_magic_quotes_gpc())
	{
	$fileName1 = addslashes($fileName1);
	$filePath1 = addslashes($filePath1);
	}
	}
	else
	{
	$filePath1 = $_POST['503imagedefault'];
	
	
	}
			$teameditid = $_POST['teameditid'];
			$projid = $_POST['projid'];
			$projtitle = $_POST['projtitle'];
			$teamid = $_POST['team_idnum'];
			$username = $_POST['username'];
			$description = $_POST['description'];
			$longdescription = $_POST['longdescription'];
			$keyword = $_POST['description'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$pass = $_POST['projpassword'];
			$check501 = $_POST['501c3check'];
			$policy = $_POST['policy'];
			$facebookid = $_POST['facebookid'];
			$fpass = $_POST['fpass'];
			$address1 = $_POST['address1'];
			$address2 = $_POST['address2'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zipcode = $_POST['zipcode'];
			$phone = $_POST['phone'];
			$location = $_POST['location'];
			$purl = $_POST['purl'];
			$pstatus = $_POST['pstatus'];
			$tblignit = 'wp_ign_products';

		    include('../connect-db.php');
			
			
		$longdescriptionhtml = htmlentities( $longdescription, ENT_QUOTES );
		$projtitlehtml = htmlentities( $projtitle, ENT_QUOTES );
		$descriptionhtml = htmlentities( $description, ENT_QUOTES );
		$keywordhtml = htmlentities( $keyword, ENT_QUOTES );
		$purlhtml = htmlentities( $purl, ENT_QUOTES );
		if( get_magic_quotes_gpc() )
		{
			$data = stripslashes( $longdescriptionhtml);
			$data1 = stripslashes( $projtitlehtml);
			$data2 = stripslashes( $descriptionhtml);
			$data3 = stripslashes( $keywordhtml);
			$data4 = stripslashes( $purlhtml);
		}

		 $longdescriptioninput= mysql_real_escape_string( $longdescriptionhtml);  
		 $projtitleinput= mysql_real_escape_string( $projtitlehtml);
		 $descriptioninput= mysql_real_escape_string( $descriptionhtml);
		 $keywordinput= mysql_real_escape_string( $keywordhtml);
		 $purlinput= mysql_real_escape_string( $purlhtml);

				$result = mysql_query("SELECT * FROM wp_cc_project_account where project_account_idnum = '$projid'") or die(mysql_error());  
			 
				$rowCheck = mysql_num_rows($result);			
				if($rowCheck > 0){

					$result =	mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_project_account` SET `project_title` = '$projtitleinput', `project_description` = '$descriptioninput', `project_long_description` = '$longdescriptioninput', `project_URL` = '$purlinput', `project_password` = '$pass', `project_profile_photo` = '$filePath', `501c3image` = '$filePath1', `501c3check` = '$check501', `project_address1`='$address1',`project_date` = now() WHERE `wp_cc_project_account`.`project_account_idnum` = '$projid';") or die(mysql_error()); 
					header("Location: http://beta.earthdeeds.com/project.php?projid=$projid&teamid=$teameditid"); 
					
	}
	
	else
	{

		header("Location: http://beta.earthdeeds.com/project.php"); 
	
	}
	}

	else if ($identify == "organization")
	{
	$uploadDir = '../orgimages/'; //Image Upload Folder
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
	
			$orgtitle = $_POST['org_title'];
			$user_username = $_POST['user_username'];
			$description = $_POST['org_description'];
			$long_description = $_POST['long_description'];
			$keyword = $_POST['keyword'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$profile_photo = $_POST['profile_photo'];
			$policy = $_POST['policy'];
			$facebook_id = $_POST['facebook_id'];
			$facebook_password = $_POST['facebook_password'];
			$address1 = $_POST['address1'];
			$address2 = $_POST['address2'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip = $_POST['zip'];
			$phone = $_POST['phone'];
			$location = $_POST['location'];
			$URL = $_POST['URL'];
			$status = $_POST['status'];
		    include('../connect-db.php');
			
		$long_descriptionhtml = htmlentities( $long_description, ENT_QUOTES );
		$orgtitlehtml = htmlentities( $orgtitle, ENT_QUOTES );
		$descriptionhtml = htmlentities( $description, ENT_QUOTES );
		$keywordhtml = htmlentities( $keyword, ENT_QUOTES );
		$URLhtml = htmlentities( $URL, ENT_QUOTES );
		$locationhtml = htmlentities( $location, ENT_QUOTES );
		$statushtml = htmlentities( $status, ENT_QUOTES );
		if( get_magic_quotes_gpc() )
		{
			$data = stripslashes( $long_descriptionhtml);
			$data1 = stripslashes( $orgtitlehtml);
			$data2 = stripslashes( $descriptionhtml);
			$data3 = stripslashes( $keywordhtml);
			$data4 = stripslashes( $URLhtml);
			$data5 = stripslashes( $locationhtml);
			$data6 = stripslashes( $statushtml);
		}

		 $long_descriptioninput= mysql_real_escape_string( $long_descriptionhtml);  
		 $orgtitleinput= mysql_real_escape_string( $orgtitlehtml);
		 $descriptioninput= mysql_real_escape_string( $descriptionhtml);
		 $keywordinput= mysql_real_escape_string( $keywordhtml);
		 $URLinput= mysql_real_escape_string( $URLhtml);
		 $locationinput= mysql_real_escape_string( $locationhtml);
		 $statusinput= mysql_real_escape_string( $statushtml);

	$result = mysql_query("SELECT * FROM $tbl where user_username = '$user_username'") or die(mysql_error());  
 
	$rowCheck = mysql_num_rows($result);			
	if($rowCheck > 0){
	
	        while($row = mysql_fetch_array( $result )) {
		
		
		$userid = $row['ID'];
		
                }

			
		mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_organization_account` (`Organization_account_idnum`, `user_account_id`, `Organization_user_username`, `Organization_title`, `Organization_description`, `Organization_long_description`, `Organization_keyword`, `Organization_contact_first_name`, `Organization_contact_last_name`, `Organization_email`, `Organization_password`, `Organization_profile_photo`, `Organization_policy`, `Organization_address1`, `Organization_address2`, `Organization_city`, `Organization_state`, `Organization_zip`, `Organization_phone`, `Organization_location`, `Organizational_URL`, `Organization_status`,`organization_date`) VALUES (NULL, '$userid', '$user_username', '$orgtitleinput', '$descriptioninput', '$long_descriptioninput', '$keywordinput', '$contact_first_name', '$contact_last_name', '$email', '$password', '$filePath', '$policy', '$address1', '$address2', '$city', '$state', '$zip', '$phone', '$locationinput', '$URLinput', '$statusinput',now());") or die(mysql_error()); 
	
		 header("Location: http://beta.earthdeeds.com/mystuff.php"); 
		
	}
	
	else
	{

		header("Location: http://beta.earthdeeds.com/error/"); 
	
	}
}

else if ($identify == "organizationedit")
	{
	$uploadDir = '../orgimages/'; //Image Upload Folder
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
	
			$orgtitle = $_POST['org_title'];
			$user_username = $_POST['user_username'];
			$description = $_POST['org_description'];
			$long_description = $_POST['long_description'];
			$keyword = $_POST['keyword'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$profile_photo = $_POST['profile_photo'];
			$policy = $_POST['policy'];
			$facebook_id = $_POST['facebook_id'];
			$facebook_password = $_POST['facebook_password'];
			$address1 = $_POST['address1'];
			$address2 = $_POST['address2'];
			$city = $_POST['city'];
			$state = $_POST['state'];
			$zip = $_POST['zip'];
			$phone = $_POST['phone'];
			$location = $_POST['location'];
			$URL = $_POST['URL'];
			$status = $_POST['status'];
			



		    include('../connect-db.php');
			
		$long_descriptionhtml = htmlentities( $long_description, ENT_QUOTES );
		$orgtitlehtml = htmlentities( $orgtitle, ENT_QUOTES );
		$descriptionhtml = htmlentities( $description, ENT_QUOTES );
		$keywordhtml = htmlentities( $keyword, ENT_QUOTES );
		$URLhtml = htmlentities( $URL, ENT_QUOTES );
		$locationhtml = htmlentities( $location, ENT_QUOTES );
		$statushtml = htmlentities( $status, ENT_QUOTES );
		if( get_magic_quotes_gpc() )
		{
			$data = stripslashes( $long_descriptionhtml);
			$data1 = stripslashes( $orgtitlehtml);
			$data2 = stripslashes( $descriptionhtml);
			$data3 = stripslashes( $keywordhtml);
			$data4 = stripslashes( $URLhtml);
			$data5 = stripslashes( $locationhtml);
			$data6 = stripslashes( $statushtml);
		}

		 $long_descriptioninput= mysql_real_escape_string( $long_descriptionhtml);  
		 $orgtitleinput= mysql_real_escape_string( $orgtitlehtml);
		 $descriptioninput= mysql_real_escape_string( $descriptionhtml);
		 $keywordinput= mysql_real_escape_string( $keywordhtml);
		 $URLinput= mysql_real_escape_string( $URLhtml);
		 $locationinput= mysql_real_escape_string( $locationhtml);
		 $statusinput= mysql_real_escape_string( $statushtml);

	$result = mysql_query("SELECT * FROM $tbl where user_username = '$user_username'") or die(mysql_error());  
 
	$rowCheck = mysql_num_rows($result);			
	if($rowCheck > 0){
	
	        while($row = mysql_fetch_array( $result )) {
		
		
		$userid = $row['ID'];
		
                }

			
		mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_organization_account` SET 
`Organization_description` = '$descriptioninput',
`Organization_long_description` = '$long_descriptioninput',
`Organization_keyword` = '$keywordinput',
`Organization_email` = 'teste',
`Organization_policy` = 'ddfd',
`Organization_address1` = 'fdfdfd',
`Organization_city` = ' iloilo',
`Organization_state` = 'ph',
`Organization_zip` = '5000',
`Organization_phone` = '2346',
`Organizational_URL` = '$URLinput', 
`organization_date` = now() WHERE `wp_cc_organization_account`.`Organization_account_idnum` =6;") or die(mysql_error()); 
	
		 header("Location: http://beta.earthdeeds.com/mystuff.php"); 
		
	}
	
	else
	{

		header("Location: http://beta.earthdeeds.com/error/"); 
	
	}
}

	else if ($identify == "team")
	{
	
$uploadDir = '../teamimages/'; //Image Upload Folder
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
	
			$team_title = $_POST['team_title'];
			$team_password = $_POST['team_password'];
			$team_status = $_POST['team_status'];
			$team_initiator = $_POST['team_initiator'];
			$team_description = $_POST['team_description'];
			$team_long_description = $_POST['team_long_description'];
			$team_location = $_POST['team_location'];			
			$team_url = $_POST['team_url'];
			$team_emissions = $_POST['team_emissions'];
			$team_member_emissions = $_POST['team_member_emissions'];
			



		    include('../connect-db.php');
			
			
			
		$team_long_descriptionhtml = htmlentities( $team_long_description, ENT_QUOTES );
		$team_titlehtml = htmlentities( $team_title, ENT_QUOTES );
		$team_descriptionhtml = htmlentities( $team_description, ENT_QUOTES );
		$team_locationhtml = htmlentities( $team_location, ENT_QUOTES );
		$team_urlhtml = htmlentities( $team_url, ENT_QUOTES );
		
		if( get_magic_quotes_gpc() )
		{
			$data = stripslashes( $team_long_descriptionhtml);
			$data1 = stripslashes( $team_titlehtml);
			$data2 = stripslashes( $team_descriptionhtml);
			$data3 = stripslashes( $team_locationhtml);
			$data4 = stripslashes( $team_urlhtml);
		}
			$team_long_descriptioninput= mysql_real_escape_string( $team_long_descriptionhtml);
			$team_titleinput= mysql_real_escape_string( $team_titlehtml);
			$team_descriptioninput= mysql_real_escape_string( $team_descriptionhtml);
			$team_locationinput= mysql_real_escape_string( $team_locationhtml);
			$team_urlinput= mysql_real_escape_string( $team_urlhtml);		 
		

	$result = mysql_query("SELECT * FROM $tbl where user_username = '$team_initiator'") or die(mysql_error());  
 
	$rowCheck = mysql_num_rows($result);			
	if($rowCheck > 0){
	
	        while($row = mysql_fetch_array( $result )) {

				$userid = $row['ID'];
				
				}


		mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_account` (`Team_account_idnum`, `user_account_id`, `team_title`, `team_initiator`, `team_description`, `team_long_description`, `team_location`, `team_image`, `team_password`, `team_status`, `team_url`, `team_emissions`, `team_member_emissions`,`team_date`) VALUES (NULL, '$userid', '$team_titleinput', '$team_initiator', '$team_descriptioninput', '$team_long_descriptioninput', '$team_locationinput', '$filePath', '$team_password', '$team_status', '$team_urlinput', '$team_emissions', '$team_member_emissions',now());") or die(mysql_error()); 
		
	
		 header("Location: http://beta.earthdeeds.com/mystuff.php"); 
		
	}
	
	else
	{

		header("Location: http://beta.earthdeeds.com/error/"); 
	
	}
}


else if ($identify == "teamedit")
	{
	
$uploadDir = '../teamimages/'; //Image Upload Folder
$fileName = $_FILES['Photo']['name'];
$tmpName = $_FILES['Photo']['tmp_name'];
$fileSize = $_FILES['Photo']['size'];
$fileType = $_FILES['Photo']['type'];
$filePath = $uploadDir . $fileName;
$resultimagesteam = move_uploaded_file($tmpName, $filePath);


if(!get_magic_quotes_gpc())
{
$fileName = addslashes($fileName);
$filePath = addslashes($filePath);
}
			$teamid = $_POST['teamid'];
			$team_title = $_POST['team_title'];
			$team_password = $_POST['team_password'];
			$team_status = $_POST['team_status'];
			$team_initiator = $_POST['team_initiator'];
			$team_description = $_POST['team_description'];
			$team_long_description = $_POST['team_long_description'];
			$team_location = $_POST['team_location'];			
			$team_url = $_POST['team_url'];
			$team_emissions = $_POST['team_emissions'];
			$team_member_emissions = $_POST['team_member_emissions'];
			



		    include('../connect-db.php');

		$team_long_descriptionhtml = htmlentities( $team_long_description, ENT_QUOTES );
		$team_titlehtml = htmlentities( $team_title, ENT_QUOTES );
		$team_descriptionhtml = htmlentities( $team_description, ENT_QUOTES );
		$team_locationhtml = htmlentities( $team_location, ENT_QUOTES );
		$team_urlhtml = htmlentities( $team_url, ENT_QUOTES );
		
		if( get_magic_quotes_gpc() )
		{
			$data = stripslashes( $team_long_descriptionhtml);
			$data1 = stripslashes( $team_titlehtml);
			$data2 = stripslashes( $team_descriptionhtml);
			$data3 = stripslashes( $team_locationhtml);
			$data4 = stripslashes( $team_urlhtml);
		}
			$team_long_descriptioninput= mysql_real_escape_string( $team_long_descriptionhtml);
			$team_titleinput= mysql_real_escape_string( $team_titlehtml);
			$team_descriptioninput= mysql_real_escape_string( $team_descriptionhtml);
			$team_locationinput= mysql_real_escape_string( $team_locationhtml);
			$team_urlinput= mysql_real_escape_string( $team_urlhtml);		


	$result = mysql_query("SELECT * FROM wp_cc_team_account where Team_account_idnum = '$teamid'") or die(mysql_error());  
 
	$rowCheck = mysql_num_rows($result);			
	if($rowCheck > 0){
		if ($filePath == "../teamimages/") {

			$result = mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_team_account` SET `team_title` = '$team_titleinput', `team_description` = '$team_descriptioninput', `team_long_description` = '$team_long_descriptioninput', `team_location` = '$team_locationinput', `team_password`='$team_password', `team_url` = '$team_urlhtml',`team_date` = now() WHERE `wp_cc_team_account`.`Team_account_idnum` ='$teamid';") or die(mysql_error());
			header("Location: http://beta.earthdeeds.com/team.php?teamid=$teamid"); 
			}
			else
			{
			$result = mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_team_account` SET `team_title` = '$team_titleinput', `team_description` = '$team_descriptioninput', `team_long_description` = '$team_long_descriptioninput', `team_location` = '$team_locationinput',`team_image` = '$filePath', `team_password`='$team_password', `team_url` = '$team_urlhtml',`team_date` = now() WHERE `wp_cc_team_account`.`Team_account_idnum` ='$teamid';") or die(mysql_error());
			header("Location: http://beta.earthdeeds.com/team.php?teamid=$teamid"); 
			}
}
}


else if ($identify == "pdonation")
	{
	
	
			$projectid = $_POST['project-id'];
			$donationtype = $_POST['donation_type'];
			$projectdonation = $_POST['project_donation'];
			$projectusername = $_POST['project-username'];
			



		    include('../connect-db.php');

	$result = mysql_query("SELECT * FROM $tbl where user_username = '$projectusername'") or die(mysql_error());  
 
	$rowCheck = mysql_num_rows($result);			
	if($rowCheck > 0){
	
	        while($row = mysql_fetch_array( $result )) {

				$userid = $row['ID'];
				
				}


		mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_user_project_extra_info` (`project_user_id`, `user_id`, `Project_account_idnum`, `project_action_type`, `project_donation`, `admin_project_donation`) VALUES (NULL, '$userid', '$projectid', '$donationtype', '$projectdonation', '$projectdonation');") or die(mysql_error());
	
		 header("Location: http://beta.earthdeeds.com/mystuff.php"); 
		
	}
	
	else
	{

		header("Location: http://beta.earthdeeds.com/error/"); 
	
	}
}
else if ($identify == "projteamsupportowned")
	{
	
	
			$teamid = $_POST['teamid'];
			$teamprojsupport = $_POST['teamprojsupport'];
			$projid = $_POST['projid'];
			$userid = $_POST['userid'];
			


		    include('../connect-db.php');
			
			
$deleteVar=$_POST['delete'];
$sumitVar=$_POST['update'];
if ($deleteVar=="Remove Project") {
  
    	mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_project_account` SET `team_idnum` = '0' WHERE `wp_cc_project_account`.`team_idnum` = '$teamid';") or die(mysql_error());
	
		header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit"); 
  
}
elseif ($sumitVar =="Update") {
  	mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_project_account` SET `project_support` = '$teamprojsupport', `pp_tx_status` = 'admin' WHERE `wp_cc_project_account`.`project_account_idnum` ='$projid';") or die(mysql_error());
	
		header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit");  
} 
}

else if ($identify == "projteamsupport")
	{
	
	
			$teamid = $_POST['teamid'];
			$teamprojsupport = $_POST['teamprojsupport'];
			$projid = $_POST['projid'];
			$userid = $_POST['userid'];
			$fname = $_POST['userfname'];
			


		    include('../connect-db.php');
			
			
$deleteVar=$_POST['delete'];
$sumitVar=$_POST['update'];

if ($deleteVar=="Remove Project") {
  
    	mysql_query("DELETE FROM `shantiom_sandbeta`.`wp_cc_teamproject` WHERE `wp_cc_teamproject`.`project_id` = '$projid' AND `team_id` = '$teamid';") or die(mysql_error());
	
		header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit"); 
  
} 

elseif ($deleteVar=="Unlink to Team") {
  
    	mysql_query("DELETE FROM `shantiom_sandbeta`.`wp_cc_teamproject` WHERE `wp_cc_teamproject`.`project_id` = '$projid' AND `team_id`  = '$teamid' ;") or die(mysql_error());
	
		header("Location: http://beta.earthdeeds.com/project-team.php?projid=$projid"); 
  
}

elseif ($deleteVar=="Delete Member") {
  
    	mysql_query("DELETE FROM `shantiom_sandbeta`.`wp_cc_team_member` WHERE `wp_cc_team_member`.`team_id` = '$teamid' AND `user_id` = '$userid';") or die(mysql_error());
	
		header("Location: http://beta.earthdeeds.com/manage-team-member/?teamid=$teamid"); 
  
}

elseif ($sumitVar =="Update") {
  	mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_project_account` SET `project_support` = '$teamprojsupport' , `pp_tx_status` = 'admin' WHERE `wp_cc_project_account`.`project_account_idnum` ='$projid';") or die(mysql_error());
	
		header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit");  
}
elseif ($sumitVar =="Add Support") {
  mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_project_support` (`project_support_id`, `team_id`, `project_support`, `project_id`, `user_id`, `pp_tx_status`, `date_added`) VALUES (NULL, '$teamid', '$teamprojsupport', '$projid', '$userid', 'admin', now());") or die(mysql_error());
	
		header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit");  
}
elseif ($sumitVar =="Add Team Manager") {
	mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_manager` (`team_manger_id`, `team_manager_userid`, `team_id`, `manager_fname`) VALUES (NULL, '$userid', '$teamid', '$fname');") or die(mysql_error());
	
		header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit");  
} 

elseif ($deleteVar=="Delete Team Manager") {
  
    	mysql_query("DELETE FROM `shantiom_sandbeta`.`wp_cc_team_manager` WHERE `wp_cc_team_manager`.`team_manager_userid` = '$userid' AND `wp_cc_team_manager`.`team_id` = '$teamid';") or die(mysql_error());
	
		header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit");
  
}
	
		
}

else if ($identify == "emission")
	{
	
			$teamid = $_POST['team_id'];
			$userid = $_POST['user_id'];
			$team_emissions = $_POST['team_emissions'];
			$username = $_POST['username'];
		//	$team_member_emissions = $_POST['team_member_emissions'];
			



		    include('../connect-db.php');
			
				

		mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_emmision` (`team_emmision_id`, `user_id`, `team_id`, `user_username`, `member_emmision` )VALUES (NULL , '$userid', '$team_id', '$username', '$team_emissions');") or die(mysql_error()); 
		
	//	mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_team_account` SET `team_emissions` = '$team_emissions' WHERE `wp_cc_team_account`.`Team_account_idnum` ='$teamid';") or die(mysql_error()); 
		
	
		 header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit&emmupdate=updated");  

}
else if ($identify == "addprojtoteam")
	{
	
		$teamid = $_POST['teamid'];
		$projid = $_POST['projid'];
		$userid = $_POST['userid'];
		
include('../connect-db.php');

	
		mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_teamproject` (`teamproject_id`, `team_id`, `project_id`, `user_id`) VALUES (NULL, '$teamid', '$projid', '$userid');") or die(mysql_error()); 
		
	
		header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit");   

}
else if ($identify == "inviteuser")
	{
	
			$teamid = $_POST['teamid'];
			$username = $_POST['user_username'];	
			$teamtitle = $_POST['teamtitle'];	

			


			$tblproject= 'wp_cc_project_account';
			$tblorg = 'wp_cc_organization_account';
			$tblteam = 'wp_cc_team_account';
			$tblextra = 'wp_cc_user_project_extra_info';
		
		    include('../connect-db.php');
			
			
			
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username' || user_facebook_id = '$username'") or die(mysql_error());  

			$rowCheck = mysql_num_rows($result);			

			while($row = mysql_fetch_array( $result )) {

			$userid = $row['ID'];

			}
			$resultmember = mysql_query("SELECT * FROM  wp_cc_team_member where team_id = '$teamid' and user_id='$userid'")or die(mysql_error());
			$rowCheck = mysql_num_rows( $resultmember );
			
			$resultteamcheck = mysql_query("SELECT * FROM  $tblteam  where Team_account_idnum = '$teamid' and user_account_id='$userid'")or die(mysql_error());
			$rowCheck2 = mysql_num_rows( $resultteamcheck );
			
			if($rowCheck2 > 0 || $rowCheck > 0){

			
			//header("Location: http://beta.earthdeeds.com/mystuff.php?existmember=existmember");  
			header("Location: http://beta.earthdeeds.com/team.php?teamid=$teamid&existmember=existmember");  
			}
			else
			{
						$teamtitlehtml = htmlentities( $teamtitle, ENT_QUOTES );
			$teamtitle1= mysql_real_escape_string( $teamtitlehtml);
			/*$teamtitlehtml = htmlentities( $teamtitle, ENT_QUOTES );
			if( get_magic_quotes_gpc() )
			{
				$data = stripslashes( $teamtitlehtml);
			}

			 $teamtitle= mysql_real_escape_string( $teamtitlehtml);  */

			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_member` (`team_member_id`, `team_id`, `user_id`, `user_first_name`, `team_name`) VALUES (NULL, '$teamid', '$userid', '$username', '$teamtitle1');") or die(mysql_error());

			
			header("Location: http://beta.earthdeeds.com/team.php?teamwelcome=teamwelcome&teamtitle=$teamtitle&teamid=$teamid");  
			}

}
else if ($identify == "projsupport")
	{
	
			$teamid = $_POST['teamid'];
			$projid = $_POST['projid'];
			$username = $_POST['username'];
			$projsupport = $_POST['projsupport'];	
			


			$tblproject= 'wp_cc_project_account';
			$tblorg = 'wp_cc_organization_account';
			$tblteam = 'wp_cc_team_account';
			$tblextra = 'wp_cc_user_project_extra_info';

		    include('../connect-db.php');
			
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  



			while($row = mysql_fetch_array( $result )) {

			$userid = $row['ID'];

			}
			
				$resultsupport = mysql_query("SELECT * FROM wp_cc_project_support where project_id = '$projid' AND user_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultsupport);			
				if($rowCheck > 0){
					while($rowsupport = mysql_fetch_array( $resultsupport )) {
					
					
					mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_project_support` SET `project_support` = '$projsupport' where project_id = '$projid' AND user_id = '$userid';") or die(mysql_error());
					}
					}
					else
					
					{
			
			
			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_project_support` (`project_support_id`, `team_id`, `project_support`, `project_id`, `user_id`) VALUES (NULL, '$teamid', '$projsupport', '$projid', '$userid');") or die(mysql_error());
}
						
	
		 header("Location: http://beta.earthdeeds.com/mystuff.php");  
			

}
else if ($identify == "teamemission")
	{
	
			$teamid = $_POST['teamid'];
			$projid = $_POST['projid'];
			$username = $_POST['username'];
			$teamemission = $_POST['teamemission'];	
			


			$tblproject= 'wp_cc_project_account';
			$tblorg = 'wp_cc_organization_account';
			$tblteam = 'wp_cc_team_account';
			$tblextra = 'wp_cc_user_project_extra_info';

		    include('../connect-db.php');
			
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  



			while($row = mysql_fetch_array( $result )) {

			$userid = $row['ID'];

			}
			
				$resultsupport = mysql_query("SELECT * FROM wp_cc_team_emmision where team_id = '$teamid' AND user_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultsupport);			
				if($rowCheck > 0){
					while($rowsupport = mysql_fetch_array( $resultsupport )) {
					
					
					mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_team_emmision` SET `member_emmision` = '$teamemission' where team_id = '$teamid' AND user_id = '$userid';") or die(mysql_error());
					}
					}
					else
					
					{
			
			
			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_emmision` (`team_emmision_id`, `user_id`, `team_id`, `user_username`, `member_emmision`) VALUES (NULL, '$userid', '$teamid', '$username', '$teamemission');") or die(mysql_error());
}
						
	
		 header("Location: http://beta.earthdeeds.com/mystuff.php");  
			

}
else if ($identify == "deleteteam")
	{
	
			$teamid = $_POST['teamid'];
			



		    include('../connect-db.php');

		
			mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_project_account` SET `team_idnum` = '$teamid' WHERE `wp_cc_project_account`.`project_account_idnum` ='$projid';") or die(mysql_error()); 
			
		
		header("Location: http://beta.earthdeeds.com/add-edit-team.php?teamid=$teamid&identify=teamedit");   

}
else if ($identify == "fbuser")
	{
	
			//$teamid = $_POST['teamid'];
			
			$fbusername = $_POST['fbusername'];
			$username = $_POST['username'];



		    include('../connect-db.php');

		
			mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_user_account_info` SET `user_facebook_id` = '$fbusername' WHERE `wp_cc_user_account_info`.`user_username` ='$username';") or die(mysql_error()); 
			
		
	header("Location: http://beta.earthdeeds.com/mystuff.php"); 

}
else if ($identify == "addproj-org")
	{
	
			$userid = $_POST['userid'];
			$progid = $_POST['projid'];
			$orgid = $_POST['orgid'];
			
			$fbusername = $_POST['fbusername'];
			$username = $_POST['username'];



		    include('../connect-db.php');

		
			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_orgprojmember` (`org_mem_id_proj`, `user_id`, `proj_id`, `org_id_current`) VALUES (NULL, '$userid', '$progid', '$orgid');") or die(mysql_error()); 
			
		
	header("Location: http://beta.earthdeeds.com/organization-form/?orgid=$orgid&identify=orgedit"); 

}
else if ($identify == "addteam-org")
	{
	
			$userid = $_POST['userid'];
			$teamid = $_POST['teamid'];
			$orgid = $_POST['orgid'];
			
			$fbusername = $_POST['fbusername'];
			$username = $_POST['username'];



		    include('../connect-db.php');

		
			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_orgteammember` (`org_mem_id_team`, `user_id`, `team_id`, `org_id_current`) VALUES (NULL, '$userid', '$teamid', '$orgid');") or die(mysql_error()); 
			
		
	header("Location: http://beta.earthdeeds.com/organization-form/?orgid=$orgid&identify=orgedit"); 

}

else if ($identify == "inviteuser-org")
	{
	
			$orgid = $_POST['orgid'];
			$username = $_POST['user_username'];	
			$orgtitle = $_POST['orgtitle'];	
			


			$tblproject= 'wp_cc_project_account';
			$tblorg = 'wp_cc_organization_account';
			$tblteam = 'wp_cc_team_account';
			$tblextra = 'wp_cc_user_project_extra_info';

		    include('../connect-db.php');
			
			
			
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  

			$rowCheck = mysql_num_rows($result);			

			while($row = mysql_fetch_array( $result )) {

			$userid = $row['ID'];

			}
			$resultmember = mysql_query("SELECT * FROM  wp_cc_orgmember where org_id = '$orgid' and user_id='$userid'")or die(mysql_error());
			$rowCheck = mysql_num_rows( $resultmember );
			
			$resultteamcheck = mysql_query("SELECT * FROM  $tblorg  where Organization_account_idnum = '$orgid' and user_account_id='$userid'")or die(mysql_error());
			$rowCheck2 = mysql_num_rows( $resultteamcheck );
			
			if($rowCheck2 > 0 || $rowCheck > 0){

			
			//header("Location: http://beta.earthdeeds.com/mystuff.php?existmember=existmember");  
			header("Location: http://beta.earthdeeds.com/related-organization/?orgid=$orgid&existmember=existmember");  
			}
			else
			{

			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_orgmember` (`org_mem_id`, `user_id`, `org_id`) VALUES (NULL, '$userid', '$orgid');") or die(mysql_error());

			
			header("Location: http://beta.earthdeeds.com/organization-user-welcome/?orgwelcome=orgwelcome&orgtitle=$orgtitle&orgid=$orgid");  
			}

}

else if ($identify == "calculate-emission")
	{
			$car_emm = $_POST['car_emm'];
			$train_emm = $_POST['train_emm'];
			$bus_emm = $_POST['bus_emm'];
			$plain_emm = $_POST['plain_emm'];
			$userid = $_POST['userid'];
			$teamid = $_POST['teamid'];
			$totalemm = $_POST['totalemm'];

			$fbusername = $_POST['fbusername'];
			$username = $_POST['username'];
			include('../connect-db.php');	
		
			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_useremissionlist` (`emmlist_id`, `user_id`, `team_id`, `car_emm`, `plane_emm`, `train_emm`, `bus_emm`) VALUES (NULL, '$userid', '$teamid', '$car_emm', '$plain_emm', '$train_emm', '$bus_emm');") or die(mysql_error()); 
			
			
				$resultsupport = mysql_query("SELECT * FROM wp_cc_team_emmision where team_id = '$teamid' AND user_id = '$userid'") or die(mysql_error());  
				$rowCheck = mysql_num_rows($resultsupport);			
				if($rowCheck > 0){
					while($rowsupport = mysql_fetch_array( $resultsupport )) {
					
					if($totalemm == 0 ){
					 header("Location: http://beta.earthdeeds.com/mystuff.php");  
					}
					else
					{
					header("Location: http://beta.earthdeeds.com/mystuff.php");  
					//mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_team_emmision` SET `member_emmision` = '$totalemm' where team_id = '$teamid' AND user_id = '$userid';") or die(mysql_error());
					}
					
					}
					}
					else
					
					{
			
			
			mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_emmision` (`team_emmision_id`, `user_id`, `team_id`, `member_emmision`) VALUES (NULL, '$userid', '$teamid', '$totalemm');") or die(mysql_error());
			}
									
				
					 header("Location: http://beta.earthdeeds.com/mystuff.php");  

			}
else if ($identify == "teamupdatepost")
	{

			$userid = $_POST['userid'];
			$teamid = $_POST['teamid'];
			$username = $_POST['username'];
			$title = $_POST['team_title'];
			$content = $_POST['team_update_description'];
			include('../connect-db.php');	
		
			mysql_query("INSERT INTO `shantiom_sandbeta`.`post_updates_team` (`team_update_id`, `user_id`, `team_id`, `team_post_title`, `team_post_content`, `username`, `date`) VALUES (NULL, '$userid', '$teamid', '$title ', '$content', '$username', now());") or die(mysql_error()); 

					 header("Location: http://beta.earthdeeds.com/mystuff.php");  

			}else if ($identify == "projectupdatepost")
	{

			$userid = $_POST['userid'];
			$projidid = $_POST['projid'];
			$username = $_POST['username'];
			$title = $_POST['proj_title'];
			$content = $_POST['proj_update_description'];
			include('../connect-db.php');	
		
			mysql_query("INSERT INTO `shantiom_sandbeta`.`post_updates_project` (`project_update_id`, `user_id`, `project_id`, `project_post_title`, `project_post_content`, `username`, `date`) VALUES (NULL, '$userid', '$projidid', '$title', '$content', '$username', now());") or die(mysql_error()); 

					 header("Location: http://beta.earthdeeds.com/mystuff.php");  

			}
	else if ($identify == "userfbconnect")
	{

$usercurr = $_POST['usercurr'];
$passwordcurr = $_POST['passwordcurr'];
$fbusername = $_POST['fbusername'];
$fbuserid = $_POST['fbuserid'];
include('../connect-db.php');

$submitVar=$_POST['fbuserupdate'];

if ($submitVar=="Connect") {
			$sql="SELECT * FROM $tbl WHERE user_username='$usercurr' and user_password='$passwordcurr'";
			$result= mysql_query($sql);
			$count= mysql_num_rows($result);
			if($count==1){
  
    	mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_user_account_info` SET `user_facebook_id` = '$fbusername' WHERE `wp_cc_user_account_info`.`user_username` ='$usercurr';") or die(mysql_error()); 
    	mysql_query("DELETE FROM `shantiom_sandbeta`.`wp_cc_user_account_info` WHERE `wp_cc_user_account_info`.`ID` = '$fbuserid';") or die(mysql_error()); 
		
				
				 header("Location: http://beta.earthdeeds.com/mystuff.php");  
				 
				 }
				 else
				 {
				 header("location:http://beta.earthdeeds.com/mystuff.php?firstlogin=flogin&fb-login=true&derror=error");
				 }
  
} 

elseif ($submitVar=="Cancel") {
  
mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_user_account_info` SET `user_username` = '$fbusername', `user_password` = 'test$fbuserid' WHERE `wp_cc_user_account_info`.`user_facebook_id` ='$fbusername';") or die(mysql_error()); 
   header("Location: http://beta.earthdeeds.com/mystuff.php"); 
}
	

	}				
			
			
		
?>