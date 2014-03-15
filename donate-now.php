<?php
session_start();
$username = $_SESSION['myusername'];
include('connect-db.php');
$username = $_SESSION['myusername'];
$teamid = $_GET['teamid'];
$projid = $_GET['projid'];
$amount = $_POST['amount'];
$loginerror = $_GET['loginerror'];

if ($amount){

mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_project_support` (`project_support_id`, `team_id`, `project_support`, `project_id`, `user_id`, `date_added`) VALUES (NULL, '$teamid1', '$amount', '$projid1', '$userid', now());") or die(mysql_error()); 

mysql_query("INSERT INTO `shantiom_sandbeta`.`checkout_paypal` (`payment_trans_id`, `date`, `team_id`, `user_id`, `project_id`, `strategic_partner_id`, `trans_project_amount`, `trans_project_actual_amount`, `trans_earthdeeds_additional_amount`, `trans_project_admin_amount`, `trans_total_amount`) VALUES (NULL, now(), '$teamid1', '$userid', '$projid1', 'stpartid', '$amount1', '$amount2', '$sup1', '$sup2', '$amount');") or die(mysql_error());

?>

<form name="_xclick" action="https://www.paypal.com/ph/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="webincome@earthdeeds.com">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name" value="Earth Deeds Donation">
<input type="hidden" name="amount" value="<?php echo $amount; ?>">

</form>
	

     
     <script language="javascript" type="text/javascript">
    document._xclick.submit();
     </script>
     <noscript><input type="submit" value="verify submit"></noscript>
<?php
}
?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Donate Now : Earth Deeds</title>
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
        	<div class="box">
				<div><span class="style3">Donate to Earth Deeds</span></div>
				</br>
				<div><span class="style8">Earth Deeds offers innovative online tools for understanding and then transforming carbon footprints through supporting sustainability projects of our choice.  Your donation will help more groups and individuals become Carbon Conscious and fund projects working for a healthy planet.  </br></br>Thank you for your generous support!</span></br></br>
				
				 <form name="userform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
				<input type="text" name="amount"/></br><span class="style12" style="font-size: 11px;">Donation amount in $US</span></br></br>
				<input  style="font-weight: normal;" type="submit" value="Donate Now" name="submit">
				</form>
				</br></br>
				<span class="style12" style="font-size: 11px;">Please Note: Earth Deeds is a social venture incorporated as a Low-Profit Limited Liability Corporation (L3C).  As such, any donations are not tax deductible.  Please contact us if you would like more information on L3Cs or how donations are used at Earth Deeds.</span>	

                </div>


		
        <div class="clear"></div>
        </div>
        </div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
