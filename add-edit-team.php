<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://earthdeeds.aws.af.cm/login.php?url=".$_SERVER['REQUEST_URI']);
}
$username = $_SESSION['myusername'];
include('connect-db.php');
$username = $_SESSION['myusername'];
$projid = $_GET['projid'];
$identity = $_GET['identify'];
$teamid = $_GET['teamid'];
$emmstatus = $_GET['emmupdate'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Team Registration : Earth Deeds</title>
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
    	
        <?php
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
			while($row = mysql_fetch_array( $result )) {
			$userid = $row['ID'];
			}
			
			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
		
		
		?>
        <div>

        	<div class="box">
            
                
       

			<script type="text/javascript" src="/tiny_mce/tinymce.min.js"></script>			

		<style>
		form { width: 300px; height: 1000px: }
		label { float: left; width: 150px; }
		input[type=text] { float: left; width: 450px; }
		input[type=text]#support{ width: 70px; margin: 5px 0;}
		.clear { clear: both; height: 0; line-height: 0; }
		.floatright { right; }
		</style>
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
<?php

			
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
			while($row = mysql_fetch_array( $result )) {
			$userid = $row['ID'];
			}
			
			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
			
			if($identity == 'teamedit'){
			
			?>
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
    			</style>
<h1 class="entry-title">Team Administration/Edit Page</h1>
Invite:</br>
			<a href="invite-members.php?teamid=<?php echo $teamid; ?>">Click Here to Invite People to Join this Team</a></br></br>

Add Projects:</br>
			<a href='add-project-team.php?teamid=<?php echo $teamid; ?>'>Click Here to add an existing Project to this team</a></br></br>

Public Funding Link:</br>
			<a href="teamfunding.php?teamid=<?php echo $teamid; ?>">Team Funding link</a></br></br>

Emissions:</br>
			<a href="measure-team-emm.php?teamid=<?php echo $teamid; ?>">Click here to add or enter team emissions that are not from individual travel </a></br>
			<a href='member-emissions.php?teamid=<?php echo $teamid; ?>'>List of Member Emissions</a></br>
			<a href='emission-individual.php?teamid=<?php echo $teamid; ?>'>List of Individual Emission</a></br></br>

Manage Members:</br>
			<a href='viewteammember.php?teamid=<?php echo $teamid; ?>'>Manage team members - make managers or remove</a></br></br>

Widgets:</br>
			<a href="gencodes.php?teamid=<?php echo $teamid; ?>"> Generate embedded widgets </a></br>

				<?php 
				if ($emmstatus== "updated"){	
				echo "<span class=\"emmupdate\">Emission Updated</span>";
				}
				?>
			
			</br>
			
			
				<?php
				echo "Enter or change team admin project support";
				$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamid'") or die(mysql_error());  
		
				echo '<table width="490px">';
				echo '<tr>';
				echo '<th class="proj" width="310px">Project</th> <th class="proj" width="130px">Admin Support</th><th width="50px">Action</th><th width="50px">Remove Project</th></tr>';
					while($rowproj = mysql_fetch_array( $resultproj )) {
				$projectid = $rowproj['project_account_idnum'];
				$useridproj = $rowproj['user_account_id'];			


				echo '<tr>';
				echo '<form name="userform" method="post" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">';	
				echo '<input type="hidden" value="'.$teamid.'" name="teamid">';
				echo '<input type="hidden" value="'.$projectid.'" name="projid">';
				echo '<input type="hidden" name="identify" value="projteamsupportowned"/>';
				echo '<td width="300px"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$projectid.'">'.$rowproj['project_title'].'</a></td> <td width="150px"><input name="teamprojsupport" id="support" type = "text" value="'.$rowproj['project_support'].'"/>  $ </td>';
				echo '<td><input type="Submit" name="update" value="Update" /></td>';
				echo '<td><input type="Submit" name="delete" value="Remove Project" /></td>';
				echo '</form>';
				echo '</tr>';
					}
			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamid'") or die(mysql_error());  
			
			while($rowprojadded = mysql_fetch_array( $resultprojadded )) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd )) {
				$projectid = $rowprojteamadd['project_account_idnum'];
				$useridproj = $rowprojteamadd['user_account_id'];			


				echo '<tr>';
				echo '<form name="userform" method="post" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">';	
				echo '<input type="hidden" value="'.$teamid.'" name="teamid">';
				echo '<input type="hidden" value="'.$projectid.'" name="projid">';
				echo '<input type="hidden" value="'.$userid.'" name="userid">';
				echo '<input type="hidden" name="identify" value="projteamsupport"/>';
				echo '<td width="300px"><a class="usertext" href="http://beta.earthdeeds.com/project.php?projid='.$projectid.'">'.$rowprojteamadd['project_title'].'</a></td> <td width="150px">';
				
				echo '<input name="teamprojsupport" id="support" type = "text" value=""/>';
				
				echo '  $ </td>';
				echo '<td><input type="Submit" name="update" value="Add Support" /></td>';
				echo '<td><input type="Submit" name="delete" value="Remove Project" /></td>';
				echo '</form>';
				echo '</tr>';
					}	
					
				}
					
					
					
				echo '</table>';?>
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
			
			
			while($rowteam = mysql_fetch_array( $resultteam )) {
			 
			echo '
			<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="create-manage-funct.php" class="userform">		
			<input type="hidden" name="identify" value="teamedit"/>
			<input type="hidden" name="team_status">
			<input type="hidden" value="'.$teamid.'" name="teamid">
			<p>Team Title: <input type="text" name="team_title" value="'.$rowteam['team_title'].'"></p>
			<p>Team Description: <input type="text" name="team_description" value="'.$rowteam['team_description'].'"></p>
			<p>Current Location: <input type="text" name="team_location" value="'.$rowteam['team_location'].'"></p>';
						if ($rowteam['team_image'] == "teamimages/"){
						
						echo "<br><p class=\"errorpass\">No image uploaded for this team</p>";
						}
						else
						{
						echo "<br><img class=\"alignleft\" border=\"0\" src=\"".$rowteam['team_image']."\" width=\"102\" alt=\"".$rowteam['team_initiator']."\">";
						}
			echo '<p> <input type="file" name="Photo" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/></p>';
			echo '<p>Team URL: <input type="text" name="team_url" value="'.$rowteam['team_url'].'"></p>
			Team Password: <br><input type="password" onkeyup="verify.check()" name="team_password" value="'.$rowteam['team_password'].'">
			<br>Verify Team Password: <br><input type="password" onkeyup="verify.check()" name="password2" value="'.$rowteam['team_password'].'">
			&nbsp; <span id="password_result" style="color:red"></span><br>
			<p>Team Long Description:
			 <textarea width= "350px" cols="100" rows="15" id="team_long_description" name="team_long_description">'.$rowteam['team_long_description'].'</textarea></p>
			    <div style="width: 635px; text-align: right;">
                	<input type = "submit" id="maininp" name="submit" value="UPDATE TEAM">
                </div>
			</form>	
			';
	
						
			echo '<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">
			<input type="hidden" name="identify" value="teamupdatepost"/>
			<input type="hidden" value="'.$teamid.'" name="teamid">
			<input type="hidden" name="username" value="'.$username.'">
			<input type="hidden" name="userid" value="'.$userid.'">
			Update Tite: </br> <input type="text" name="team_title">
			</br>Update Content: </br> <textarea width= "350px" cols="100" rows="15" id="team_update_description" name="team_update_description"></textarea>
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



$postTitle = $_POST['title'];
$post = $_POST['description'];
$submit = $_POST['submit'];

			}

			}
			else
			{
			?>
<h1 class="entry-title">Team Registration Form</h1>

<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="create-manage-funct.php">	
		<input type="hidden" name="identify" value="team"/>
		<input type="hidden" name="team_status">
		<input type="hidden" value="<?php echo $username; ?>" name="team_initiator">
		Team Title: <input type="text" name="team_title"><br/>
		Team Description: <input type="text" name="team_description"><br/>
		Current Location: <input type="text" name="team_location"><br/>
		Team URL: <input type="text" name="team_url"><br/>
		Team Image:<input type="file" name="Photo" accept="image/gif, image/jpeg, image/x-ms-bmp, image/x-png" size="26"><br/>
		Team Password: <br><input type="password" onkeyup="verify.check()" name="team_password">
		<br>Verify Team Password: <br><input type="password" onkeyup="verify.check()" name="password2">
		&nbsp; <span id="password_result" style="color:red"></span><br>
		<p>Team Long Description:
			 <textarea width= "350px" cols="100" rows="15" id="team_long_description" name="team_long_description"></textarea></p>
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
                <div style="width: 635px; text-align: right;">
                	<input type = "submit" id="maininp" name="submit" value="CREATE TEAM">
                </div>
		</form>
		<?php }?>
		<script type="text/javascript">
			verify = new verifynotify();
			verify.field1 = document.userform.team_password;
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
