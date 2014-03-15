<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://earthdeeds.aws.af.cm/login.php?url=".$_SERVER['REQUEST_URI']);
}
$username = $_SESSION['myusername'];
include('connect-db.php');
$projid = $_GET['projid'];
$identity = $_GET['identify'];
$teamid = $_GET['teamid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project Registration : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div class="header">
    	<div class="logo"></div>
                <div class="login">
        	<span class="style1">Logged in as </span><span class="style2"><a href="mystuff.php"><?php echo $username; ?></a>  | <a href="logout.php">Log Out</a></span>       
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

        	<!--<div><span class="style10">Project Registration Form</span></div>-->
            <br />
        	<div class="box">
   <?php         
$username = $_SESSION['myusername'];
$orgid = $_GET['orgid'];
$identity = $_GET['identify'];

include('connect-db.php');
			$resultedit = mysql_query("SELECT * FROM $tbl where user_username = '$username' OR user_facebook_id =  '$username'") 
			or die(mysql_error());  

			$rowCheck = mysql_num_rows($resultedit);			

			while($row = mysql_fetch_array( $resultedit )) {
			$useridedit = $row['ID'];

}
?>


	<script language="javascript">
function validateFormOnSubmit(userform) {
    if (document.userform.User-Name.value.length == 0) {
        userform.User-Name.style.background = 'Yellow'; 
        error = "The required field has not been filled in.\n"
    } else {
        userform.User-Name.style.background = 'White';
    }
    return error;  
}

		</script>
		<style>
		body {background-color:#b0c4de;}
		form { width: 300px; height: 1000px: }
		table tr td form { width: 150px;}
		label { float: left; width: 150px; }
		input[type=text] { float: left; width: 450px; }
		input[type="varchar(250)"] { float: left; width: 450px; }
		.clear { clear: both; height: 0; line-height: 0; }
		.floatright { right; }
		</style>
		<script type="text/javascript">
				function validateForm()
				{
				var x=document.forms["userform"]["userinfoname"].value;
				var uname=document.forms["userform"]["user_username"].value;
				var fname=document.forms["userform"]["contact_first_name"].value;
				var lname=document.forms["userform"]["contact_last_name"].value;
				if (x==null || x=="")
				{
				alert("User Account (username):  must be filled out with registered username");
				return false;
				}
				else if (uname==null || uname=="")
				{
				alert("Username name must be filled out");
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
				  var x=document.forms["userform"]["email"].value;
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
				<?php
				if($identity == 'orgedit'){
					echo "<h1 style=\"font-size: 25px;\">Organization Edit Page</h1>";
									$resultorg = mysql_query("SELECT * FROM $tblorg where Organization_account_idnum = '$orgid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultorg);			
			if($rowCheck > 0){
			while($roworg = mysql_fetch_array( $resultorg )) {
			echo $rowproj['project_title'];
		
			
				?>
			<a href="#top">Manage Organization</a>	</br>
			<a href="http://beta.earthdeeds.com/invitation-organization/?orgid=<?php echo $orgid; ?>">Click here to invite members</a>
			<h1 style="font-size: 25px;">Organization Registration Form</h1>
			<form name="userform" method="post" onsubmit="return validateForm()" action="http://beta.earthdeeds.com/submituser.php" class="userform">
			<input type="hidden" name="identify" value="organizationedit"/>
			<input value="<?php echo $username; ?>" type="hidden" name="user_username">
			<p>Title:<input type="text" name="org_title" value="<?php echo $roworg['Organization_title']; ?>"></p>
			<p>Description:<input type="text" name="org_description" value="<?php echo $roworg['Organization_description']; ?>"></p>
			<p>Keyword:<input type="text" name="keyword" value="<?php echo $roworg['Organization_keyword']; ?>"></p>
			<p>Email(required): <input type="text" name="email" value="<?php echo $roworg['Organization_email']; ?>"></p>
			Organization Password: <br><input type="password" onkeyup="verify.check()" name="password" value="<?php echo $roworg['Organization_password']; ?>">
			<br>Verify Organization Password: <br><input type="password" onkeyup="verify.check()" name="password2" value="<?php echo $roworg['Organization_password']; ?>">
			&nbsp; <span id="password_result" style="color:red"></span>
			<p>Profile Photo: <input type="file" name="profile_photo" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"></p>
			<p>Policy: YES<input type="checkbox" name="policy" value="<?php echo $roworg['Organization_policy']; ?>">NO<input type="checkbox" name="policy" value="no"></p>
			<p>Current Location: <input type="text" name="location" value="<?php echo $roworg['Organization_location']; ?>"></p>
			<p>URL: <input type="text" name="Organizational_URL" value="<?php echo $roworg['Organizational_URL']; ?>"></p>
			<p>Status: <input type="text" name="status" value="<?php echo $roworg['Organization_status']; ?>"></p>
			
			Long Description:
			 <textarea width= "350px" cols="100" rows="15" id="long_description" name="long_description">
			 <?php echo $roworg['Organization_long_description']; ?>

				  </textarea>
				  <script type="text/javascript" src="tiny_mce/tinymce.min.js"></script>
<script type="text/javascript" src="/tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: "textarea",
theme: "modern",
plugins: [
	"advlist autolink lists link image charmap print preview hr anchor pagebreak",
	"searchreplace wordcount visualblocks visualchars code fullscreen",
	"insertdatetime media nonbreaking save table contextmenu directionality",
	"emoticons template paste textcolor moxiemanager"
],
toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
toolbar2: "print preview media | forecolor backcolor emoticons",
image_advtab: true,
width : 850,
height: 200,
templates: [
	{title: 'Test template 1', content: 'Test 1'},
	{title: 'Test template 2', content: 'Test 2'}
]
});
</script>
			<br/>
			
			   <div style="width: 635px; text-align: right;">
                	<input type = "submit" id="maininp" name="submit" value="UPDATE ORGANIZATION">
                </div>
		</form>
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
			}
			else
			{
			echo "no record found";
			}		
		?>	

					<a name="top" id="top"></a>		

					<table width="300px"><th>Project</th><th>Action</th>
					<?php
					$resultproj = mysql_query("SELECT * FROM $tblproject") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultproj);			
					if($rowCheck > 0){
					while($rowproj = mysql_fetch_array( $resultproj )) {
					echo "<tr><td>";
					echo $rowproj['project_title'];
					echo "</td>";
					echo "<td>"; 
					echo '<form name="userform" method="post" onsubmit="return validateForm()" action="http://beta.earthdeeds.com/submituser.php" class="userform">
					<input type="hidden" name="projid" value="'.$rowproj['project_account_idnum'].'"/>
					<input type="hidden" name="orgid" value="'.$orgid.'"/>
					<input type="hidden" name="userid" value="'.$useridedit.'"/>
					<input type="hidden" name="identify" value="addproj-org"/>
					<input type="submit" name="submit" value="add to org"/>
					</form>
					</td></tr>';

					}
					}
					else
					{
					echo "no project found";

					}



						?></table>
						
						<table  width="300px"> <th>Team</th><th>Action</th>
						
						<?php
					$resultteam = mysql_query("SELECT * FROM $tblteam") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
					if($rowCheck > 0){
					while($rowteam = mysql_fetch_array( $resultteam )) {
					
					
					echo "<tr><td>";
					echo $rowteam['team_title'];
					echo "</td>";
					echo "<td>"; 
					echo '<form name="userform" method="post" onsubmit="return validateForm()" action="http://beta.earthdeeds.com/submituser.php" class="userform">
					<input type="hidden" name="teamid" value="'.$rowteam['Team_account_idnum'].'"/>
					<input type="hidden" name="orgid" value="'.$orgid.'"/>
					<input type="hidden" name="userid" value="'.$useridedit.'"/>
					<input type="hidden" name="identify" value="addteam-org"/>
					<input type="submit" name="submit" value="add to org"/>
					</form>
					</td></tr>';
					

								}
								}
								else
								{
								echo "no team found";
								
								}
						
						
						
									?>
									

									
					</table>
					</div>
					
					<div id="orgside">
					<h2>Related:</h2>
					<table width="220px">
					<tr>
					<th>Project</th><th>Team</th>
					</tr>
					<tr>
					<td>
					<?php
					
					$orgprojmem = mysql_query("SELECT * FROM  wp_cc_orgprojmember where user_id = '$useridedit' AND org_id_current = '$orgid'") or die(mysql_error());  	
					while($roworgproj = mysql_fetch_array( $orgprojmem )) {
					$projidorg = $roworgproj['proj_id'];
					
					$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projidorg'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultproj);			
					while($rowproj = mysql_fetch_array( $resultproj )) {
					echo '<p style="font-size: 10px;">'.$rowproj['project_title'].'<p>';
			
					}
					}		
					
					?>
					</td>
					<td>
					<?php
					
					$orgteammem = mysql_query("SELECT * FROM  wp_cc_orgteammember where user_id = '$useridedit' AND org_id_current = '$orgid'") or die(mysql_error());  	
					while($roworgteam = mysql_fetch_array( $orgteammem )) {
					$teamidorg = $roworgteam['team_id'];
					
					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamidorg'") or die(mysql_error());  			
					while($rowteam = mysql_fetch_array( $resultteam )) {
					echo '<p style="font-size: 10px;">'.$rowteam['team_title'].'<p>';
			
					}
					}		
					
					?>
					</td>
					</tr>
					</table>
					</div>
					<?php	
				
				}
				else
				
				{
				
				?>
				
		
		<h1 style="font-size: 25px;">Organization Registration Form</h1>
		<form name="userform" method="post" onsubmit="return validateForm()" action="create-manage-funct.php" class="userform">
			<input type="hidden" name="identify" value="organization"/>
			<input value="<?php echo $username; ?>" type="hidden" name="user_username">
			<p>Title:<input type="text" name="org_title"></p>
			<p>Description:<input type="text" name="org_description"></p>
			<p>Keyword:<input type="text" name="keyword"></p>
			<p>Email(required): <input type="text" name="email"></p>
			Project Password: <br><input type="password" onkeyup="verify.check()" name="password">
			<br>Verify Project Password: <br><input type="password" onkeyup="verify.check()" name="password2">
			&nbsp; <span id="password_result" style="color:red"></span>
			<p>Profile Photo: <input type="file" name="profile_photo" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"></p>
			<p>Policy: YES<input type="checkbox" name="policy" value="yes">NO<input type="checkbox" name="policy" value="no"></p>
			<p>Current Location: <input type="text" name="location"></p>
			<p>URL: <input type="text" name="Organizational_URL"></p>
			<p>Status: <input type="text" name="status"></p>
			
			Long Description:
			 <textarea width= "350px" cols="100" rows="15" id="long_description" name="long_description">

				  </textarea>
<script type="text/javascript" src="/tiny_mce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: "textarea",
theme: "modern",
plugins: [
	"advlist autolink lists link image charmap print preview hr anchor pagebreak",
	"searchreplace wordcount visualblocks visualchars code fullscreen",
	"insertdatetime media nonbreaking save table contextmenu directionality",
	"emoticons template paste textcolor moxiemanager"
],
toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
toolbar2: "print preview media | forecolor backcolor emoticons",
image_advtab: true,
width : 850,
height: 200,
templates: [
	{title: 'Test template 1', content: 'Test 1'},
	{title: 'Test template 2', content: 'Test 2'}
]
});
</script>
			<br/>
			
					<div style="width: 635px; text-align: right;">
						<input type = "submit" id="maininp" name="submit" value="CREATE ORGANIZATION">
					</div>
		</form>
		<script type="text/javascript">
			verify = new verifynotify();
			verify.field1 = document.userform.password;
			verify.field2 = document.userform.password2;
			verify.result_id = "password_result";
			verify.match_html = "<SPAN STYLE=\"color:green\">Match<\/SPAN>";
			verify.nomatch_html = "<SPAN STYLE=\"color:red\">MisMatch<\/SPAN>";
			verify.check();
		</script>	
		<?php } ?>
</div>
        </div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
