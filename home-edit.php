
<?php
include('connect-db.php');
// Define your username and password
$username = "EarthDeeds";
$password = "Carbon2013";
$featuredid= $_POST['featuredid'];
$team1= $_POST['team1'];
$team2= $_POST['team2'];
$team3= $_POST['team3'];
$project1= $_POST['project1'];
$project2= $_POST['project2'];
$project3= $_POST['project3'];
if ($featuredid){

mysql_query("UPDATE  `shantiom_sandbeta`.`home_featured` SET  `team1` =  '$team1', `team2` =  '$team2', `team3` =  '$team3', `project1` =  '$project1', `project2` =  '$project2', `project3` =  '$project3';") or die(mysql_error()); 
$_POST['txtUsername'] ="EarthDeeds";
$_POST['txtPassword'] ="Carbon2013";
}
if ($_POST['txtUsername']){
if ($_POST['txtUsername'] != $username || $_POST['txtPassword'] != $password) {
echo '<p style="color: red;">Error Logging in.</p>';
}
}

if ($_POST['txtUsername'] != $username || $_POST['txtPassword'] != $password) {
?>
<h1>Login</h1>
<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p><label for="txtUsername">Username:</label>
    <br /><input type="text" title="Enter your Username" name="txtUsername" /></p>
    <p><label for="txtpassword">Password:</label>
    <br /><input type="password" title="Enter your password" name="txtPassword" /></p>
    <p><input type="submit" name="Submit" value="Login" /></p>
</form>
<?php
}
else {

?>
		<h3>Home Featured Page</h3>
	<form name="userform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" >
	<?php
		
		$resultfeat= mysql_query("SELECT * FROM home_featured") or die(mysql_error());  

		while($rowfeat = mysql_fetch_array( $resultfeat )) {
		$t1 = $rowfeat['team1'];
		$t2 = $rowfeat['team2'];
		$t3 = $rowfeat['team3'];		
		$p1 = $rowfeat['project1'];
		$p2 = $rowfeat['project2'];
		$p3 = $rowfeat['project3'];
		}
		?>
<p>Team Featured ID</p>
<input type="text" name="team1" value = "<?php echo $t1; ?>"size="10px"/>
<input type="text" name="team2" value = "<?php echo $t2; ?>" size="10px"/>
<input type="text" name="team3" value = "<?php echo $t3; ?>" size="10px"/>
<p>Project Featured ID</p>
<input type="text" name="project1" value = "<?php echo $p1; ?>" size="10px"/>
<input type="text" name="project2" value = "<?php echo $p2; ?>" size="10px"/>
<input type="text" name="project3" value = "<?php echo $p3; ?>" size="10px"/>		
<input type="hidden" name="featuredid" value="featuredid"/>		
		</div></br>
<input type="submit" name="submit" value="submit"/>		<a href="http://beta.earthdeeds.com/"target="_blank">View Homepage</a>	
		</form>
		       
<?php
}
?> 
