<?php
if(session_is_registered(myusername)){
//header("location:http://beta.earthdeeds.com/mystuff.php");
}
$passtype = $_GET['changepasstype'];
$emailreset = $_GET['email'];
$passkey = $_GET['key'];
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
<script type="text/javascript">
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
</head>

<body>
<div class="header">
    	<div class="logo"></div>		
        <div class="login">

<span style="margin: 0 50px 0 0;" class="style2"><a href="login.php">Login</a></span>

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
				<div style="text-align:center;"><span class="style8" style="font-weight: bolder;">
	<?php
		$password = $_POST['password'];
		if ($password){
		$typeupdated = $_POST['passtypeupdated'];
		$emailupdated = $_POST['emailupdated'];
		$passkeyupdate = $_POST['keyupdate'];
		//echo $typeupdated.'//'.$emailupdated.'//'.$password.'//'.$passkeyupdate;	
		if($typeupdated == "user"){
		$passwordupdated = mysql_query("UPDATE `shantiom_sandbeta`.`wp_cc_user_account_info` SET `user_password` = '$password' WHERE `wp_cc_user_account_info`.`user_email` = '$emailupdated' AND `wp_cc_user_account_info`.`user_password` = '$passkeyupdate';") or die(mysql_error()); 		

				$message = "You have reset the password on your Earth Deeds user account.\r\n\r\nYour new password is: ".$password." \r\n\r\nThank you for using Earth Deeds.\r\n\r\nSincerely,\r\n\r\nThe Earth Deeds team";
				$headers = 'From: shanti@earthdeeds.com' . "\r\n" .
				'Reply-To: shanti@earthdeeds.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();	
				$message = wordwrap($message, 70, "\r\n");
				mail($emailupdated, 'Earthdeeds Password Reset', $message, $headers);

		}
		}
		
	?>
	<?php
	if ($passwordupdated) {
	echo '<div style="text-align:center; height: 400px;">';
	echo 'Password successfully updated';
	echo '<div>A confirmation email has been sent to your email address</div>';
	echo '</div>';
		}
		else
		{
	?>
	<div class="style8" style="text-align:center;">Enter youre new password twice:</div></br>
				 <form name="userform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()">
				<div><input name="password" type="password" onkeyup="verify.check()" class="input" value = "<?php echo $password; ?>" style="width: 300px;"/></div>
                    <div><input name="password2" type="password" onkeyup="verify.check()" class="input" value = "<?php echo $password; ?>" style="width: 300px;"/></br> <span id="password_result" style="color:red"></span></div>	
					<input type="hidden" name="passtypeupdated" value="<?php echo $passtype;?>"/>
					<input type="hidden" name="emailupdated" value="<?php echo $emailreset;?>"/>
					<input type="hidden" name="keyupdate" value="<?php echo $passkey;?>"/>
				<div style="text-align:center;"><input type="submit" name="Submit" value="Reset Password"></div>
				</form>
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
		<?php 
		}
		?>
        <div class="clear"></div>
		</div>
<!-- End of Content ---------------------------------------------------- -->
   </div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>