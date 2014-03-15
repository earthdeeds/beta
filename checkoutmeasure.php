<?php
session_start();
$username = $_SESSION['myusername'];
include('connect-db.php');
$username = $_SESSION['myusername'];
$teamid = $_GET['teamid'];
$projid = $_GET['projid'];
$loginerror = $_GET['loginerror'];
/********************************************************************************************/
$amount= $_POST['amount'];
$amount1= $_POST['amount1'];
$amount2= $_POST['amount2'];
$sup1= $_POST['sup1'];
$sup2= $_POST['sup2'];
$userid= $_POST['userid'];
$projid1= $_POST['projid'];
$teamid1= $_POST['teamid'];
$mytotalemm = $_GET['totalemm'];
if ($sup1){

mysql_query("INSERT INTO `shantiom_sandbeta`.`checkout_paypal` (`payment_trans_id`, `date`, `team_id`, `user_id`, `project_id`, `strategic_partner_id`, `trans_project_amount`, `trans_project_actual_amount`, `trans_earthdeeds_additional_amount`, `trans_project_admin_amount`, `trans_total_amount`) VALUES (NULL, now(), '$teamid1', '$userid', '$projid1', 'stpartid', '$amount1', '$amount2', '$sup1', '$sup2', '$amount');") or die(mysql_error());

mysql_query("INSERT INTO `shantiom_sandbeta`.`wp_cc_project_support` (`project_support_id`, `team_id`, `project_support`, `project_id`, `user_id`, `date_added`) VALUES (NULL, '$teamid1', '$amount', '$projid1', '$userid', now());") or die(mysql_error()); 

?>
<form name="_xclick" action="https://www.paypal.com/ph/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="webincome@earthdeeds.com">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="item_name" value="Earth Deeds">
<input type="hidden" name="amount" id="testsum" value="<?php echo $amount; ?>">

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
            	<div style="float: left; width: 100px; height: auto;">
				
				<?php
				mysql_connect($sHostname, $sUsername, $sPassword) or die(mysql_error());
			mysql_select_db($sDatabase);

			$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());
			$rowteam = mysql_fetch_array( $resultteam );
			//echo '<span style="color: #0000FF; font-size: 24px;"> '.$rowteam['team_title'].'</span>'; 
				$result = mysql_query("SELECT * FROM $tbl where user_username = '$username'") or die(mysql_error());  
					while($row = mysql_fetch_array( $result )) {
						$userid = $row['ID'];
						}
						$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());  
					$rowCheck = mysql_num_rows($resultteam);			
					//if($rowCheck > 0){
					while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamuserid = $rowteam['user_account_id'];
						if ($rowteam['team_image'] == "teamimages/"){
						echo "<div><img width=\"83px\" height=\"107px\" src=\"imagesprofiles/team.jpg\"> </div>";						
						}
						else
						{
						echo "<div><img width=\"83px\" height=\"107px\" src=\"".$rowteam['team_image']."\" alt=\"".$rowteam['team_initiator']."\"></div>";
						}
						$teamtitle = $rowteam['team_title'];
						$cprice = $rowteam['carbon_price'];
						}
				
				?>
				
				
				
                    
                </div>
                <div style="float: left;">
                    	<div><span class="style10"><?php echo $teamtitle; ?></span></div>

                </div>
                <div class="clear"></div>    
			</div>
            
            <div>
            	<div style="float: left; width: 250px; height: auto;">
                    <div style="padding-top: 30px;"><span class="style14">Total Team Onset</span></div>
                    <div><span class="style14">My Share</span></div>
                </div>
                <div style="float: left; margin-right: 30px; text-align:right;">
                        <div><span class="style14"><strong>Carbon Emissions</strong></span></div>
                        <div><span class="style14">		
					<?php
						
						
						$longdesc = html_entity_decode( $rowteam['team_long_description'] );
						
					
					$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid'") or die(mysql_error());  
					$totalemm = 0;
					while($rowemission = mysql_fetch_array( $resultemission )) {
				
					$emm = $rowemission['member_emmision'];
					$totalemm +=  $emm;
					}
					

					if ($emm) {
					echo $totalemm.'mT';
					}
					else
					{
					echo 'N/A';
					}
					$alltotal = $totalemm;

				
				?></span></div>
						<div><span class="style14">
						
													<?php	
						if ($mytotalemm){							
						$finalmytotal = $mytotalemm;	
						echo $mytotalemm.'mT';	
						
						}
						else
						{
						echo 'N/A';	
						}
						
				
				?>
						
						
						</span></div>
                </div>
                <div style="float: left;text-align:right;">
                        <div><span class="style14"><strong>Amount in US $</strong></span></div>
                        <div><span class="style14"><?php echo '$'.number_format($alltotal, 2, '.', '') * $cprice; ?></span></div>
						<div><span class="style14"><?php echo '$'.number_format($finalmytotal, 2, '.', '') * $cprice; ?> </span></div>
                </div>
                <div class="clear"></div>    
			</div>
            <br />
            
            <div>
            	<div style="float: left; width: 380px; height: auto;">
                    <div><span class="style14">Amount to 
					
							<?php
			$resultproj = mysql_query("SELECT * FROM $tblproject where team_idnum = '$teamid'") or die(mysql_error());  
					$counter = 0;
					while(($rowproj = mysql_fetch_array( $resultproj )) and ($counter < 1)) {
					$projectid = $rowproj['project_account_idnum'];
					$projectuserid = $rowproj['user_account_id'];
					$projectuser = $rowproj['project_creator_username'];
																								
					echo $rowproj['project_title'];
					$counter++;
				}
				
				
				
									
			$resultprojadded = mysql_query("SELECT * FROM  wp_cc_teamproject where team_id = '$teamid'") or die(mysql_error());  
			
			$counter = 0;
			while(($rowprojadded = mysql_fetch_array( $resultprojadded )) and ($counter < 1)) {
			
			$projectaddid = $rowprojadded['project_id'];
			
			
			$resultprojteamadd = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projectaddid'") or die(mysql_error()); 
			
				while($rowprojteamadd = mysql_fetch_array( $resultprojteamadd ))  {
			
						$projectid2 = $rowprojteamadd['project_account_idnum'];																									
						echo $rowprojteamadd['project_title'];
							
												

					}
					$counter++;	
					}
					
				$test =	number_format($finalmytotal, 2, '.', '') * $cprice;
			$finalsup = $finalmytotal * $cprice;
			?>
					
					</span></div>
                    <div><span class="style14">Additional support for Earth Deeds</span></div>
                </div>

                <div style="float: left;text-align:right; margin-right: 30px;">
				   <form name="userform" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" onsubmit="return validateForm()">

						<input type="hidden" name="userid" value="<?php echo $userid;?>">						
						<input type="hidden" name="projid" value="<?php echo $projectaddid;?>">						
						<input type="hidden" name="teamid" value="<?php echo $teamid;?>">						
						<input type="hidden" name="amount1" value="<?php echo number_format($alltotal, 2, '.', '') * $cprice; ?>">
						<input type="hidden" name="amount2" value="<?php echo number_format($finalmytotal, 2, '.', '') * $cprice; ?>">

                        <div><span class="style14">
						<!--<input name="sup1" id="sup1" type="text" value="<?php //echo number_format($finalsup, 2, '.', ''); ?>" class="input2" />-->
						<input name="sup1" id="sup1" type="text" value="<?php echo $test; ?>" class="input2" />
						
						</span></div>
						<?php 
						$finaltest = $finalsup*.15; 
						$fresult = $totalsup + $finaltest;
						?>
						<div><span class="style14"><input name="sup2" id="sup2" type="text" value="<?php echo number_format($fresult, 2, '.', ''); ?>" class="input2"/></span></div>
						<script type="text/javascript" >
    $(document).ready(function(){
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".input2").each(function() {
 
            $(this).focusout(function(){
                calculateSum();
            });
        });
        $(window).keydown(function(event){
    		if(event.keyCode == 13) {
      			event.preventDefault();
      			return false;
    		}
  	});
    });
 
    function calculateSum() {
 
        var sum = 0;
        var xsum;
        //iterate through each textboxes and add the values
        $(".input2").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#sum").html(sum.toFixed(2));
        $("#testsum").html(sum.toFixed(2));
		xsum = sum.toFixed(2);
		$("#testsum").val(xsum);
		
    }
</script>

                        <div><span class="style14">Total <strong>$<span id="sum"> <?php echo number_format($fresult, 2, '.', '') + $test; ?></span></strong></span></div>
                </div>
				
				
				
 

		
              
                <div style="float: left;text-align:right; ">
                        <div><span class="style8"><strong>Please consider contributing more in <br />
order to further support this project</strong></span>
						</div>
						<div><span class="style14"><a href="graphic.html" target="blank">Why support Earth Deeds?</a></span></div>
                </div>
				 
                
                <div class="clear"></div>    
			</div>

            <br />
            <div style="text-align: center;">
			<input type="hidden" name="amount" id="testsum" value="<?php echo number_format($fresult, 2, '.', '') + number_format($finalsup, 2, '.', ''); ?>">
<input type="submit" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" value="Paynow">
</form>
           
                    
             </div>

                <br /><br />

          </div><!-- END OF BOX ------------------------------------------------------------------ -->   
		</div>
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
