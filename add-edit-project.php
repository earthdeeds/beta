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
               <style>
			.singular 
			.entry-title, 
			.singular 
			.entry-meta {
    			padding-right: 0;
			}
			.singular
			.entry-title {
    				color: #000000;
    				font-size: 36px;
    				font-weight: bold;
    				margin: -40px 0;
    				text-decoration: none;
   				text-shadow: 1px 4px 6px rgba(0, 0, 0, 0.2), 0 -5px 35px rgba(255, 255, 255, 0.3);
   				font-family: 'Helvetica Neue',sans-serif;
    			}
			form { width: 300px; height: 1000px: }
			label { float: left; width: 150px; }	
			input[type=text] { float: left; width: 450px; }
			input[type="varchar(250)"] { float: left; width: 450px; }
			.clear { clear: both; height: 0; line-height: 0; }
			.floatright { right; }
			</style>
			
			<script type="text/javascript">
					function validateForm()
					{
					var x=document.forms["userform"]["projtitle"].value;
					var uname=document.forms["userform"]["username"].value;
					var fname=document.forms["userform"]["firstname"].value;
					var lname=document.forms["userform"]["lastname"].value;
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

			$teameditid = $_POST['teameditid'];
			$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projid'") or die(mysql_error());  

			if($identity == 'projedit'){
			while($rowproj = mysql_fetch_array( $resultproj )) {
			$projectteamid = $rowproj['team_idnum'];
			$projectid = $rowproj['project_account_idnum'];
			


			
			?>
			<h1 class="entry-title">Project Edit Form</h1>
			<a href="project-team.php?projid=<?php echo $projectid; ?>"> View Team's Linked on this Project </a></br>
			<a href="http://beta.earthdeeds.com/gencodes.php?projid=<?php echo $projectid; ?>"> Generate embedded widgets </a>
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
			<?php
			
			
			echo '	
				<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="create-manage-funct.php" class="userform">
				<input type="hidden" name="identify" value="saveproject"/>
				<input type = "hidden" value="'.$projid.'" name="projid">
				<input type = "hidden" value="'.$teameditid.'" name="teameditid">
				<p>Project Title:     	<input type = "text" name="projtitle" value="'.$rowproj['project_title'].'"><br/></p>
				<p>Short Description: 	<input type = "text" name="description" value="'.$rowproj['project_description'].'"><br/></p>';
				if ( $rowproj['501c3check'] == "3"){
		echo 'visible to public <input type="radio" name="501c3check" value="3" class="userform" checked /></br>';
		echo 'NOT visible to public <input type="radio" name="501c3check" value="0" class="userform" /></br>';
	} else
	{ 	echo 'visible to public <input type="radio" name="501c3check" value="3" class="userform"  /></br>';
		echo 'NOT visible to public <input type="radio" name="501c3check" value="0" class="userform" checked/></br>';
		}
			
			if ($rowproj['501c3image'] == "" || $rowproj['501c3image'] == "projimages/"){
						echo "<br><p class=\"errorpass\">No image uploaded for this project</p>";
						echo '<input type = "hidden"  value="projimages/" name="503imagedefault">';
						}
						else
						{
						echo "<br><img class=\"alignleft\" border=\"0\" src=\"".$rowproj['501c3image']."\" width=\"102\" alt=\"".$rowproj['project_creator_username']."\">";
						echo '<input type = "hidden"  value="'.$rowproj['501c3image'].'" name="503imagedefault">';
						}
						
			echo '</br></br></br></br><p>501c3image : <input type="file" name="501c3image" id="501c3image" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/></p>';
				
				if ($rowproj['project_profile_photo'] == "projimages/" || $rowproj['project_profile_photo'] == ""){
						echo "<br><p class=\"errorpass\">No image uploaded for this project</p>";
						echo '<input type = "hidden"  value="images/" name="mainimagedefault">';
						}
						else
						{
						echo "<br><img class=\"alignleft\" border=\"0\" src=\"".$rowproj['project_profile_photo']."\" width=\"102\" alt=\"".$rowproj['project_creator_username']."\">";
						echo '<input type = "hidden"  value="'.$rowproj['project_profile_photo'].'" name="mainimagedefault">';
						}
				echo '<p> <input type="file" name="Photo" value = "'.$rowproj['project_profile_photo'].'" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/></p>
				Long Description:
				 <textarea width= "350px" cols="100" rows="15" id="longdescription" name="longdescription">
					'.$rowproj['project_long_description'].'
					  </textarea>
				<p>Project Url: <input type = "text" name="purl" value="'.$rowproj['project_URL'].'"><br/></p>
				<p>Address: <input type = "text" name="address1" value="'.$rowproj['project_address1'].'"><br/></p>
				Project Password: <br><input type="password" onkeyup="verify.check()" name="projpassword" value="'.$rowproj['project_password'].'">
				<br>Verify Project Password: <br><input type="password" onkeyup="verify.check()" name="password2" value="'.$rowproj['project_password'].'">
				&nbsp; <span id="password_result" style="color:red"></span>
				<br/><br/>                
				<div style="width: 635px; text-align: right;">
                	<input type = "submit" id="maininp" name="submit" value="UPDATE PROJECT">
                </div><br/>
				</form>
				';
				
				echo '<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">
			<input type="hidden" name="identify" value="projectupdatepost"/>
			<input type="hidden" value="'.$projid.'" name="projid">
			<input type="hidden" name="username" value="'.$username.'">
			<input type="hidden" name="userid" value="'.$userid.'">
			Update Tite: </br> <input type="text" name="proj_title">
			</br>Update Content: </br> <textarea width= "350px" cols="100" rows="15" id="proj_update_description" name="proj_update_description"></textarea>
								  <script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: "moxiemanager link image",
	toolbar: "insertfile undo redo | fontselect fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	width : 850,
	height: 200
});
					  </script>
				<div style="width: 635px; text-align: right;">
                	<input type = "submit" id="maininp" name="submit" value="POST UPDATE">
                </div>
			</form>';
				

			}
		
			}
			
			
			else
			{
			
?>
			<h1 class="entry-title">Project Registration Form</h1>	<br>
			<script type="text/javascript" src="http://beta.earthdeeds.com/tiny_mce/tinymce.min.js"></script>
			<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="create-manage-funct.php">
			<p><input type="hidden" name="identify" value="project"/></p>
			<input type = "hidden" value="<?php echo $username; ?>" name="username">
			<input type = "hidden" value="<?php echo $teamid; ?>" name="team_idnum">
			<?php echo $teamid; ?>
			<p>Project Title:     	<input type = "text" name="projtitle"><br/></p>
			<p>Short Description: 	<input type = "text" name="description" value=""><br/></p>		
			Project Password: <br><input type="password" onkeyup="verify.check()" name="projpassword" value="">
			<br>Verify Project Password: <br><input type="password" onkeyup="verify.check()" name="password2">
			&nbsp; <span id="password_result" style="color:red"></span>
			<p>Keywords: 	<input type = "text" name="keyword"><br/></p>
			<p>Project Image: <input type="file" name="Photo" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/></p>
			<p>Project Url: <input type = "text" name="purl"><br/></p>
			<p>Address: <input type = "text" name="address1"><br/></p>
			<p>501c3check</p> 
			<p>Yes<input type="checkbox" name="user-policy" value="Yes" class="userform" />
			<p>501c3image : <input type="file" name="501c3image" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/></p>
			Long Description:
			 <textarea width= "350px" cols="100" rows="15" id="longdescription" name="longdescription">

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
                	<input type = "submit" id="maininp" name="submit" value="CREATE PROJECT">
                </div>
			</form>			
<?php }?>
		<script type="text/javascript">
			verify = new verifynotify();
			verify.field1 = document.userform.projpassword;
			verify.field2 = document.userform.password2;
			verify.result_id = "password_result";
			verify.match_html = "<SPAN STYLE=\"color:green\">Match<\/SPAN>";
			verify.nomatch_html = "<SPAN STYLE=\"color:red\">MisMatch<\/SPAN>";
			verify.check();
		</script>	
        </div>        
		</div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
