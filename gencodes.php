<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://sandbox.earthdeeds.com/login.php");
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
$username = $_SESSION['myusername'];
$projid = $_GET['projid'];
$teamid = $_GET['teamid'];

?>		
	
		<div id="primary">
			<div id="content" role="main">	
			<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>			

		<style>
		body {background-color:#b0c4de;}
		form { width: 300px; height: 1000px: }
		label { float: left; width: 150px; }
		input[type=text] { float: left; width: 450px; }
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
include('connect-db.php');
			
			$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
			while($row = mysql_fetch_array( $result )) {
			$userid = $row['ID'];
			}
	?>		
			
	<script type="text/javascript">
	var embedcode = document.getElementById('embedcode');
embedcode.onclick = function () {
    this.select();
}
</script>

Get youre embed code here, copy and paste code to your website:</br>
<?php if ($teamid) {?>
Team Generated Codes </br>
Side Banner: </br>
<textarea id="embedcode" cols="30" rows="2" wrap="VIRTUAL" readonly="readonly"><iframe id="childframe" src="youresite.php?teamid=<?php echo $teamid; ?>&userid=<?php echo $userid;?>&banner=side" frameborder="no" scrolling="no"></iframe></textarea>		
Body Banner: </br>
<textarea id="embedcode" cols="30" rows="2" wrap="VIRTUAL" readonly="readonly"><iframe id="childframe" src="youresite.php?teamid=<?php echo $teamid; ?>&userid=<?php echo $userid;?>&banner=body" frameborder="no" scrolling="no"></iframe> </textarea>	
For Wordpress</br>
install this plugin first, download plugin in this link <a href="generated-codewp.zip">Download Plugin Here</a>, upload and activate plugin, then paste code in wordpress html editor </br>
Side Banner(600 x 300): </br>
<textarea id="embedcode" cols="30" rows="2" wrap="VIRTUAL" readonly="readonly">[sidebanner src=youresite.php?teamid=<?php echo $teamid; ?>&userid=<?php echo $userid;?>&banner=side]</textarea>		
Body Banner(300 x 600): </br>
<textarea id="embedcode" cols="30" rows="2" wrap="VIRTUAL" readonly="readonly">[bodybanner src=youresite.php?teamid=<?php echo $teamid; ?>&userid=<?php echo $userid;?>&banner=body]</textarea>
<?php
}
else
{
?>	
<Strong>Project Generated Codes</Strong> </br>	
<em>Side Banner:</em> </br>
<textarea id="embedcode" cols="30" rows="2" wrap="VIRTUAL" readonly="readonly"><iframe id="childframe" src="youresite-proj.php?projid=<?php echo $projid; ?>&banner=side" frameborder="no" scrolling="no"></iframe></textarea>		
<em>Body Banner:</em> </br>
<textarea id="embedcode" cols="30" rows="2" wrap="VIRTUAL" readonly="readonly"><iframe id="childframe" src="youresite-proj.php?projid=<?php echo $projid; ?>&banner=body" frameborder="no" scrolling="no"></iframe></textarea>	
<Strong>For Wordpress</strong></br>
Install this plugin first, download plugin in this link <a href="generated-codewp.zip">Download Plugin Here</a>, upload and activate plugin, then paste code in wordpress html editor </br>
<em>Side Banner(600 x 300): </em></br>
<textarea id="embedcode" cols="30" rows="2" wrap="VIRTUAL" readonly="readonly">[sidebanner src=youresite-proj.php?projid=<?php echo $projid; ?>&banner=side]</textarea>		
<em>Body Banner(300 x 600): </em></br>
<textarea id="embedcode" cols="30" rows="2" wrap="VIRTUAL" readonly="readonly">[bodybanner src=youresite-proj.php?projid=<?php echo $projid; ?>&banner=body]</textarea>

<?php }?>
		</div>
		</div>

    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
    <div class="footer">
    	<div style="float: left; width: 590px; height: auto;"> 
        	<span class="style11"> <a href="page-aboutus.php">About Us</a>    |    <a href="page-contactus.php">Contact Us</a>     |   <a href="page-support.php"> Support </a>    |    <a href="page-TOC.php"> Terms and Conditions</a></span>        </div>
        <div style="float: right; width: 290px; text-align: right;">
        	<span class="style11">Copyright 2013. EarthDeeds. All Rights Reserved</span>
        </div>
        <div class="clear"></div>
    </div>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
