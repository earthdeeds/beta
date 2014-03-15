<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://beta.earthdeeds.com/login.php");
}
$username = $_SESSION['myusername'];
include('connect-db.php');



$userID = $_POST['userid'];
$username = $_POST['username'];
$teamID = $_POST['team_id'];

$car_miles = $_POST['car_miles'];
$car_mpg = $_POST['car_mpg'];
$avg_car_mpg = $_POST['avg_car_mpg'];
$train_miles = $_POST['train_miles'];
$bus_miles = $_POST['bus_miles'];
$plain_miles = $_POST['plain_miles'];
$additional_emm = $_POST['additional_emm'];
$startplain = $_POST['startplain'];
$endplain = $_POST['endplain'];
$startplain2 = $_POST['startplain2'];
$endplain2 = $_POST['endplain2'];
$startplain3 = $_POST['startplain3'];
$endplain3 = $_POST['endplain3'];
$startplain4 = $_POST['startplain4'];
$endplain4 = $_POST['endplain4'];

$plane_emission = $_POST['plane_emm'];
$car_emission = $_POST['car_emm'];
$train_emission = $_POST['train_emm'];
$bus_emission = $_POST['bus_emm'];
$total_emm = $_POST['total_emm'];
$tot_travel_emm = $plane_emission + $car_emission + $train_emission + $bus_emission + $additional_emm;
$selected_team = $_POST['Referred_team'];
$notes = $_POST['notes'];
$tag = $_POST['tag'];

			$sDatabase = 'shantiom_sandbeta';
			$sHostname = 'localhost';
			$sUsername = 'shantiom_sandbeta';
			$sPassword = 'sandbox';
			$tbl= 'wp_cc_user_account_info';
			$tblproject= 'wp_cc_project_account';
			$tblorg = 'wp_cc_organization_account';
			$tblteam = 'wp_cc_team_account';
			$tblextra = 'wp_cc_user_project_extra_info';
			
			$teamid = $_POST['Reffered_team'];

 
$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
					while($rowteam = mysql_fetch_array( $resultteam )) {
					
					$teamname = $rowteam['team_title'];
			
					}
					
					
$identify = $_POST['identify'];
if ($identify == "adminemission"){
mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_emmision` (`team_emmision_id`, `user_id`, `team_id`, `user_username`, `car_emm`, `train_emm`, `bus_emm`, `plane_emm`, `member_emmision`, `date_added`, `notes`, `tag`, `team_name`, `plain_miles`, `car_miles`, `car_mpg`, `avg_car_mpg`, `additional_emm`, `train_miles`, `bus_miles`, `startplain`, `endplain`, `startplain2`, `endplain2`, `startplain3`, `endplain3`, `startplain4`, `endplain4`, `status` )VALUES (NULL , '$userID', '$teamid', '$username', '$car_emission', '$train_emission', '$bus_emission', '$plane_emission', '$tot_travel_emm', now(), '$notes', '$tag', '$teamname', '$plain_miles', '$car_miles', '$car_mpg', '$avg_car_mpg', '$additional_emm', '$train_miles', '$bus_miles', '$startplain', '$endplain', '$startplain2', '$endplain2', '$startplain3', '$endplain3', '$startplain4', '$endplain4', 'admin');") or die(mysql_error()); 

header("Location: http://beta.earthdeeds.com/mystuff.php");
}
else
{

$submitVar=$_POST['submit'];

if ($submitVar=="Check Out Now") {
  
/*mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_emmision` (`team_emmision_id`, `user_id`, `team_id`, `user_username`, `car_emm`, `train_emm`, `bus_emm`, `plane_emm`, `member_emmision`, `date_added`, `notes`, `tag`, `team_name` )VALUES (NULL , '$userID', '$teamid', '$username', '$car_emission', '$train_emission', '$bus_emission', '$plane_emission', '$total_emm', now(), '$notes', '$tag', '$teamname');") or die(mysql_error()); */

  
mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_emmision` (`team_emmision_id`, `user_id`, `team_id`, `user_username`, `car_emm`, `train_emm`, `bus_emm`, `plane_emm`, `member_emmision`, `date_added`, `notes`, `tag`, `team_name`, `car_miles`, `car_mpg`, `train_miles`, `bus_miles`, `startplain`, `endplain`, `startplain2`, `endplain2`, `startplain3`, `endplain3`, `startplain4`, `endplain4` )VALUES (NULL , '$userID', '$teamid', '$username', '$car_emission', '$train_emission', '$bus_emission', '$plane_emission', '$tot_travel_emm', now(), '$notes', '$tag', '$teamname', '$car_miles', '$car_mpg', '$train_miles', '$bus_miles', '$startplain', '$endplain', '$startplain2', '$endplain2', '$startplain3', '$endplain3', '$startplain4', '$endplain4');") or die(mysql_error()); 


header("Location: http://beta.earthdeeds.com/checkoutmeasure.php?teamid=$teamid&notes=calc&totalemm=$tot_travel_emm");
  
} 

elseif ($submitVar=="Save Emissions") {
  
mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_emmision` (`team_emmision_id`, `user_id`, `team_id`, `user_username`, `car_emm`, `train_emm`, `bus_emm`, `plane_emm`, `member_emmision`, `date_added`, `notes`, `tag`, `team_name`, `car_miles`, `car_mpg`, `train_miles`, `bus_miles`, `startplain`, `endplain`, `startplain2`, `endplain2`, `startplain3`, `endplain3`, `startplain4`, `endplain4` )VALUES (NULL , '$userID', '$teamid', '$username', '$car_emission', '$train_emission', '$bus_emission', '$plane_emission', '$tot_travel_emm', now(), '$notes', '$tag', '$teamname', '$car_miles', '$car_mpg', '$train_miles', '$bus_miles', '$startplain', '$endplain', '$startplain2', '$endplain2', '$startplain3', '$endplain3', '$startplain4', '$endplain4');") or die(mysql_error()); 

header("Location: http://beta.earthdeeds.com/mystuff.php");
  
}
/*mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_team_emmision` (`team_emmision_id`, `user_id`, `team_id`, `user_username`, `member_emmision`, `date_added`, `notes` )VALUES (NULL , '$userid', '$teamid', '$username', '$total_emm', now(), '$notes');") or die(mysql_error()); 

header("Location: http://beta.earthdeeds.com/checkout.php?teamid=$teamid&notes=calc");*/

}

?>