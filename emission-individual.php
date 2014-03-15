<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://earthdeeds.aws.af.cm/login.php?url=".$_SERVER['REQUEST_URI']);
}
include('connect-db.php');
$teamid = $_GET['teamid'];
$sort = $_GET['sort'];
$username = $_SESSION['myusername'];
$loginerror = $_GET['loginerror'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Emissions : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
<!--[if IE]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->

<!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="style-ie.css" />
<![endif]-->
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
        	<div class="box">
<?php		
$username = $_SESSION['myusername'];
?>
	<script type="text/Javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/Javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	

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

    		<?php	
				echo '</style>';
					$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
					while($rowteam = mysql_fetch_array( $resultteam )) {
					
					echo '
						<h1 class="entry-title" style = "font-size: 24px;">List of Member Emissions for '.$rowteam['team_title'].'</h1><br/>';
			
					}
					
			?>
			<script Language="JavaScript">
					function copy() {
					/*document.getElementById("label").innerHTML = document.getElementById("topcat").value*/

					var topcat;
					var teamid;
					topcat= document.getElementById("topcat").value		
					teamid= document.getElementById("teamid").value		
					
					window.location.href = "emission-individual.php?teamid=" + teamid +"&sort=" + topcat ; 
					}
					
					</script>
					<div>
					Sort by:
					<input type="hidden" id="teamid" value="<?php echo $teamid;?>" />
					<select name="sort" class="input-search2" onchange="copy();" id="topcat">
					<?php
					if ($sort == "date_added"){
					echo '
					<option value="date_added">date</option>
					<option value="user_username">username</option>
					<option value="tag">tags</option>
					';
					
					}
					else if ($sort == "user_username"){
						echo '
					<option value="user_username">username</option>
					<option value="date_added">date</option>
					<option value="tag">tags</option>
					';
					}
					else if ($sort == "tag"){
						echo '
					<option value="tag">tags</option>
					<option value="date_added">date</option>
					<option value="user_username">username</option>
					';
					}
					else{
											echo '
					<option value="date_added">date</option>
					<option value="user_username">username</option>
					<option value="tag">tags</option>
					';
					
					}
					?>

					</select></div>
	<table border="1" width="850px" align="center">
			<tr>
				<td width="100px"><div style="text-align:center;font-weight:bold"><font size="4">Username</font></div></td>
				<td width="100px"><div style="text-align:center;font-weight:bold"><font size="4">Tag</font></div></td>
				<td width="100px"><div style="text-align:center;font-weight:bold"><font size="4">Date</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Car</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Train</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Bus</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Plane</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Total</font></div></td>
				<td width="200px"><div style="text-align:center;font-weight:bold"><font size="4">Notes</font></div></td>
			</tr>
					
		<?php
if ($sort){
$orderlist = $sort;
}
else
{
$orderlist = "date_added";
}
			$result = mysql_query("SELECT * FROM wp_cc_team_emmision where team_id = '$teamid' ORDER BY $orderlist ASC")or die(mysql_error()); 
			while($rowEmm = mysql_fetch_array( $result )) {
				$userid = $rowEmm['user_id'];

	
			
					echo '<tr><td>'.$rowEmm['user_username'].'</td>';					
					echo '<td>'.$rowEmm['tag'].'</td>';

					//echo '<td>'.$rowEmm['date_added'].'</td>';
$date = date_format(new DateTime($rowEmm['date_added']), "Y-m-d");
if ($date == '-0001-11-30'){
echo '<td>N/A</td>';
}
else{
					echo '<td>'.$date.'</td>';
					}
					echo '<td>'.$rowEmm['car_emm'].'</td>';
					echo '<td>'.$rowEmm['train_emm'].'</td>';
					echo '<td>'.$rowEmm['bus_emm'].'</td>';
					echo '<td>'.$rowEmm['plane_emm'].'</td>';
					echo '<td>'.$rowEmm['member_emmision'].'</td>';
					echo '<td>'.$rowEmm['notes'].'</td></tr>';
		
				

			}
			
			mysql_close();
		?>
	</table>
    </div> 
	</div> 
	</div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>    
</div>  <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
