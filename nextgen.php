<?php
session_start();

$username = $_SESSION['myusername'];
include('connect-db.php');
$username = $_SESSION['myusername'];
$teamid = $_GET['teamid'];
$projid = $_GET['projid'];
$loginerror = $_GET['loginerror'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nextgen : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
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
			     	
                <br />
            	<div><span class="style8">
				<b>This page gives instructions on how to donate to the NextGEN July 2013 team and projects using EarthDeeds.&nbsp;</b>
				<p>Currently you need to become a virtual member of the NextGEN July 2013 team on EarthDeeds to donate in this manner.</p>
				<p>There are basically two steps:</p>
				<p><b>Step 1</b> - register as an Earth Deeds user and become virtual member of the NextGEN July 2013 team</p>
				<p>Go to this link, which will open in a new window</p><p><a href="http://beta.earthdeeds.com/confirm.php?teamid=75" target="_blank">http://beta.earthdeeds.com/<wbr>confirm.php?teamid=75</a></p>
				<p>Click on the "register here" link on the page that opens.</p><p>
				You will need to enter in a username, email, name, and a EarthDeeds password and then hit the "Register Here" button at the bottom .</p><p>
				Once you do that you will go to a page to confirm your membership in the NextGEN July 2013 team. When you hit the button called "Activate Membership" you will be taken to the NextGEN July 2013 team page.</p>
				<p><b>Step 2</b> - donate:</p> <p>Once you are on the NextGEN July 2013 team page, hit the "Checkout Now" button in the upper right or lower left portion of the page (it shows up twice).</p>
				<p>There are two boxes you can fill out - both are in US dollars. One is the amount to donate to the project, and the other is for a donation to EarthDeeds (if you'd also like to support this start-up).</p>
				<p>Once you fill in those amounts hit the Pay Now button and you will be transferred to PayPal to accomplish the secure financial transaction.&nbsp;</p>
				<p>You can pay using your PayPal account or you can hit the link on the payment page titled "Don't have a PayPal account?" and you will be able to contribute using a credit card.</p>
				<b>Two Notes:</b><p>1) If you navigate around first and want to come back to the team page to donate, this is the direct link, but it is only viewable if you are logged in as an EarthDeeds user (which was accomplished in step one)</p>
				<p><a href="http://beta.earthdeeds.com/team.php?teamid=75" target="_blank">http://beta.earthdeeds.com/<wbr>team.php?teamid=75</a></p><p>2) We are a new start up company and are creating a much simpler way to do this that is not ready yet, so we very much appreciate your patience with this process and your support of these great teams and projects.</p>
                </div>
                <br />
                <br />

	      <div class="clear"></div>
        </div>
        </div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
	
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>