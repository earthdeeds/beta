<?php
session_start();
$username = $_SESSION['myusername'];
include('connect-db.php');
$username = $_SESSION['myusername'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Checkout : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">

  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  	<script type="text/Javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/Javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>


<body>
<div class="header">
    	<div class="logo"></div>
        <div class="login">
		<?php
		if ($username){
					echo '
        	       	<span class="style1">Logged in as </span><span class="style2"><a href="mystaff.php">'.$username.'</a>  | <a href="logout.php">Log Out</a></span> ';  
				
					}
					else
					{
					echo '<span style="margin: 0 50px 0 0;" class="style2"><a href="login.php">Login</a></span>';
}
					?>
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

      	 <div class="box" style="width: 800px; margin: auto;">
			<div style="text-align:center;"><span class="style3">Check out</span></div>
            <br />
            <div>
			<?php
	
			$result = mysql_query("SELECT * FROM checkout_paypal ORDER BY payment_trans_id DESC LIMIT 1") or die(mysql_error());  
					while($row = mysql_fetch_array( $result )) {
						$txid = $row['payment_trans_id'];
						$prjid = $row['project_id'];
						
						
						}
			
			$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$prjid'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultproj);			
			while($rowproj = mysql_fetch_array( $resultproj )) {
						$projectteamid = $rowproj['team_idnum'];
						$titleproj = $rowproj['project_title'];
						}
			
			$resultsup = mysql_query("SELECT * FROM wp_cc_project_support ORDER BY project_support_id DESC LIMIT 1") or die(mysql_error());  
					while($rows = mysql_fetch_array( $resultsup )) {
						$txidsup = $rows['project_support_id'];
						$prjidsup = $rows['project_id'];
						
						
						}
			
			$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$prjidsup'") or die(mysql_error());  
			$rowCheck = mysql_num_rows($resultproj);			
			while($rowproj = mysql_fetch_array( $resultproj )) {
						$projectteamids = $rowproj['team_idnum'];
						$titleprojs = $rowproj['project_title'];
						}
			
			
				

$pp_hostname = "www.paypal.com"; // Change to www.sandbox.paypal.com to test against sandbox


// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-synch';
 
$tx_token = $_GET['tx'];
$tx_stat = $_GET['st'];
$tx_curr = $_GET['cc'];
$auth_token = "SgV0nkct6tImzHhR0lixderPD8GqgSwmBbXrNBXM_LFFhA0qbf_FoUx2C4C";
$req .= "&tx=$tx_token&at=$auth_token";
 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
//set cacert.pem verisign certificate path in curl using 'CURLOPT_CAINFO' field here,
//if your server does not bundled with default verisign certificates.
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
$res = curl_exec($ch);
curl_close($ch);

if(!$res){
    //HTTP ERROR
}else{
     // parse the data
    $lines = explode("\n", $res);
    $keyarray = array();
    if (strcmp ($lines[0], "SUCCESS") == 0) {
        for ($i=1; $i<count($lines);$i++){
        list($key,$val) = explode("=", $lines[$i]);
        $keyarray[urldecode($key)] = urldecode($val);
    }
    // check the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process payment
    $firstname = $keyarray['first_name'];
    $lastname = $keyarray['last_name'];
    $itemname = $keyarray['item_name'];
    $amount = $keyarray['payment_gross'];
   /*  
    echo ("<p><h3>Thank you for your purchase!</h3></p>");
     
    echo ("<b>Payment Details</b><br>\n");
    echo ("<li>Name: $firstname $lastname</li>\n");
    echo ("<li>Item: $itemname</li>\n");
    echo ("<li>Amount: $amount</li>\n");
    echo ("");*/
	echo '<div><span class="style8">Earth Deeds and '.$titleproj.' thank you for your contribution of $'.$amount;
	echo '</br></br><a href="mystuff.php">Click</a> to return to your MyStuff Page </span></div>';
	
				mysql_query("UPDATE  `shantiom_sandbeta`.`checkout_paypal` SET  `pp_tx_id` =  '$tx_token', `pp_total_amount` =  '$amount', `pp_name` =  '$firstname $lastname', `pp_item` =  '$itemname', `pp_tx_status` =  '$tx_stat', `pp_currency` =  '$tx_curr' WHERE  `checkout_paypal`.`payment_trans_id` = '$txid';") or die(mysql_error());		

				mysql_query("UPDATE  `shantiom_sandbeta`.`wp_cc_project_support` SET  `pp_tx_id` =  '$tx_token', `pp_total_amount` =  '$amount', `pp_name` =  '$firstname $lastname', `pp_tx_status` =  '$tx_stat' WHERE  `wp_cc_project_support`.`project_support_id` ='$txidsup';") or die(mysql_error());
    }
    else if (strcmp ($lines[0], "FAIL") == 0) {
        // log for manual investigation
    }
}
 
?>
</div>
 <div class="clear"></div> 
          </div><!-- END OF BOX ------------------------------------------------------------------ -->   
		</div>
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
