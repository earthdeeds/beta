<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://beta.earthdeeds.com/login.php");
}
$username = $_SESSION['myusername'];
include('connect-db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Update : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
    	<div class="logo"></div>
         <div class="login">
        	<span class="style1">Logged in as </span><span class="style2"><a href="mystuff.php"><?php echo $username; ?></a>  | <a href="logout.php">Log Out</a></span>       
        </div>	
    <div class="clear"></div>
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
				echo "&nbsp; <img border=\"0\" src=\"imagesprofiles/avatar.jpg\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				}
				else
				{
				echo "&nbsp;  <img border=\"0\" src=\"".$row['user_profile_photo']."\" width=\"102\" alt=\"".$row['user_first_name']."\" height=\"91\"><br />";
				
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
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
