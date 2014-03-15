<?php
session_start();

$username = $_SESSION['myusername'];
include('connect-db.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Registration : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->

<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->
	<script type="text/javascript">
		function validateForm()
		{
		var uname=document.forms["userform"]["User-Name"].value;
		var fname=document.forms["userform"]["First-Name"].value;

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

</head>

<body>
<div class="header">
    	<div class="logo"></div>
        
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

        	<div><span class="style10">User Registration Form</span>  <span class="style8">(All fields with  a * are required)</span></div>
        	<div class="box">
									
                <div style="float: left; width: 118px; height: auto;">      
                    <div><span class="style20">User Name:*</span></div>
                    <div><span class="style20">First Name:*</span></div>
                    <div><span class="style20">Your Email:*</span></div>
                    <div><span class="style20">Password:*</span></div>
                    <div><span class="style20">Verify Password:*</span></div>
                    <div><span class="style20">Profile Photo:</span></div>
               
       
                </div>
                
                <div style="float: left;">
				 			</style>			

	<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="create-manage-funct.php">
						<input type="hidden" name="identify" value="user" class="userform" size="40" />
		<input type="hidden" name="teamreg" value="<?php echo $teamreg; ?>" class="userform" size="40" />
		<input type="hidden" name="teamid" value="<?php echo $teamid; ?>" class="userform" size="40" />
                    <div><input name="User-Name" type="text" class="input" style="width: 300px;"/></div>
                    <div><input name="First-Name" type="text" class="input" style="width: 300px;"/></div>
                    <div><input name="your-email" type="text" class="input" style="width: 300px;"/></div>

                    <div><input name="password" type="password" onkeyup="verify.check()" class="input" style="width: 300px;"/></div>
                    <div><input name="password2" type="password" onkeyup="verify.check()" class="input" style="width: 300px;"/>&nbsp; <span id="password_result" style="color:red"></span></div>	
                 <!--  <div ><img src="" class="user-profile"/></div>-->
                    <div style="margin-top: 12px;">
                    	<div style="float: left;"><input accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" name="Photo" type="file" class="input" style="width: 300px;"/></div>
                      <!--<div style="float: left; margin-top: 8px; margin-left: 10px;"><div class="button2"><a href="#">Browse...</a></div>
                        </div>-->
						<span class="style18"> &nbsp;(Profile photo need to be square in shape and less than 2Mb)</span>
                        <div class="clear"></div>
						
                  </div>
              </div>
   
                <div class="clear"></div>
                
                <div><span class="style20">By registering you are agreeing to our <a target="_blank" href="page-TOC.php">Terms and Conditions</a></span></div>
                <div style="width: 610px; margin-left: 118px;">
				<input type="submit" id="maininp" value="Register" class="userform" />
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
