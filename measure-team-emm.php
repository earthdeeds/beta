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
<title>Emission Calculator : Earth Deeds</title>
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
							$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());
					while($rowteam = mysql_fetch_array( $resultteam )) {
					
					$teamtitle = $rowteam['team_title'];
					}
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
      		<?php
			
		$car_miles = $_POST['car_miles'];
		$car_mpg = $_POST['avg_car_mpg'];
		$train_miles = $_POST['train_miles'];
		$bus_miles = $_POST['bus_miles'];
		$plain_miles = $_POST['plain_miles'];
		$additional_emm = $_POST['additional_emm'];
		$start = $_POST['start'];
		$end = $_POST['end'];
		$start2 = $_POST['start2'];
		$end2 = $_POST['end2'];
		$start3 = $_POST['start3'];
		$end3 = $_POST['end3'];
		$start4 = $_POST['start4'];
		$end4 = $_POST['end4'];

		
if($car_miles){
				$car_emissions = ($car_miles*0.00892)/$car_mpg;
			}


			$train_emission =  (($train_miles*0.38)*0.4536)/2204.6226218;

			$bus_emission = (($bus_miles*0.66)*0.4536)/2204.6226218;
			if($plain_miles < 280){
			$plain_milestotal = ($plain_miles * 0.64) / 2204.6226218;
			}
			else if($plain_miles >= 280 && $plain_miles <= 1000){
			$plain_milestotal = ($plain_miles * 0.44) / 2204.6226218;
			}
			else{
			$plain_milestotal = ($plain_miles * 0.39) / 2204.6226218;
			}
?>

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

        	<div><span class="style10">Team Administrative Emissions Calculator - Travel</span></div>
        	<div class="box">
<p class="style28">For metric version of this calculator click <a href="measure-metric.php">here</a>.</p>
		<form id="float" action="measure-team-emm.php?teamid=<?php echo $teamid; ?>" method="post">
              <div>
              	<div style="float: left; width: 150px; height: auto;">  	
                    <div><span class="style28">Car Miles:</span></div>
                    <div><span class="style28">Average Car MPG:</span></div>
                    <div><span class="style28">Train Miles:</span></div>
                    <div><span class="style28">Bus Miles:</span></div>
                    <div><span class="style28">Plain Miles:</span></div>
                </div>
                <div style="float: left;">
                    <div><input name="car_miles" value="<?php echo $car_miles; ?>" type="text" class="input2" style="width: 200px;" tabindex=1/></div>
                    <div><input name="avg_car_mpg" value="<?php echo $car_mpg; ?>" type="text" class="input2" style="width: 200px;" tabindex=2/> The average car MPG in the USA is 17.1 MPG</div>
                    <div><input name="train_miles" value="<?php echo $train_miles; ?>" type="text" class="input2" style="width: 200px;" tabindex=3/></div>
                    <div><input name="bus_miles" value="<?php echo $bus_miles; ?>" type="text" class="input2" style="width: 200px;" tabindex=4/></div>
                    <div><input name="plain_miles" value="<?php echo $plain_miles; ?>" type="text" class="input2" style="width: 200px;" tabindex=4/> <!--Click here for more information on calculating plane miles--></div>
              	</div>
              <div class="clear"></div>
              </div>
                

              <div style="width: 610px;">
                	<input type = "submit" name="submit" value="Calculate Emissions">
              </div>
			  <br />			  
        </form>
              <p class="style28">All emissions are calculated in mT or Carbon Dioxide</p>
<?php
$plainemm = $emm+$emm2+$emm3+$emm4;

	echo '<form method="POST" action="verify.php">
		<input type="hidden" name="identify" value="adminemission" />
		<input type="hidden" name="car_miles" value="'.$car_miles.'" />
		<input type="hidden" name="avg_car_mpg" value="'.$car_mpg.'" />
		<input type="hidden" name="train_miles" value="'.$train_miles.'" />
		<input type="hidden" name="bus_miles" value="'.$bus_miles.'" />
		<input type="hidden" name="additional_emm" value="'.$additional_emm.'" />
		<input type="hidden" name="plain_miles" value="'.$plain_miles.'" />';
		
	?>	
	              <div>
              	<div style="float: left; width: 150px; height: auto;">  	
                    <div><span class="style28">Plane Emissions:</span></div>
                    <div><span class="style28">Car Emissions:</span></div>
                    <div><span class="style28">Train Emissions:</span></div>
                    <div><span class="style28">Bus Emissions:</span></div>
                    <div><span class="style28">Total Travel Emissions:</span></div>
                    <div><span class="style28" style="line-height: 19px;">Additional Non-Travel Emissions:</span></div>
					<div><span class="style28">Total Emissions:</span></div>
                </div>
				
                <div style="float: left;">
						<script type="text/javascript" >
		$(document).ready(function(){
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".add").each(function() {
 
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
        $(".add").each(function() {
 
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
	$(document).ready(function(){
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".addx").each(function() {
 
            $(this).focusout(function(){
                calculateSumx();
            });
        });
        $(window).keydown(function(event){
    		if(event.keyCode == 13) {
      			event.preventDefault();
      			return false;
    		}
  	});
    });
 
    function calculateSumx() {
 
        var sum = 0;
        var xsum;
        //iterate through each textboxes and add the values
        $(".addx").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#sumx").html(sum.toFixed(2));
        $("#testsumx").html(sum.toFixed(2));
		xsum = sum.toFixed(2);
		$("#testsumx").val(xsum);
		
    }
</script>
				<?php echo '
                    <div><input value="'.number_format($plain_milestotal, 2, '.', '').'" name="plane_emm" type="text" class="input2 addx" style="width: 200px;" /></div>
                    <div><input value="'.number_format($car_emissions, 2, '.', '').'" name="car_emm" type="text" class="input2 addx" style="width: 200px;" /></div>
                    <div><input value="'.number_format($train_emission, 2, '.', '').'" name="train_emm" type="text" class="input2 addx" style="width: 200px;" /></div>
                    <div><input value="'.number_format($bus_emission, 2, '.', '').'" name="bus_emm" type="text" class="input2 addx" style="width: 200px;" /></div>
					<div><input value="'.number_format($plain_milestotal+$car_emissions+$train_emission+$bus_emission, 2, '.', '').'" type="text" name="total_emm"  id="testsumx" class="input2 add" style="width: 200px;" readonly /></div>
                    <div><input name="additional_emm" type="text" class="input2 add" id="input2" style="width: 200px;" /> </div>';?>

<?php
					
                    echo '<div><input id = "testsum" value="'.number_format($plain_milestotal+$car_emissions+$train_emission+$bus_emission, 2, '.', '').'" name="tot_travel_emm" type="text" class="input2" style="width: 200px;" readonly /></div>

              	</div>
              <div class="clear"></div>
              </div>
              
    <div style=" background: #e7e8d2; padding: 10px;">
			  <table>
			  <tr><td>            
                  <div>
                    <div style="float: left; width: 350px; height: auto;">  	
                        <div><span class="style28">Connect these emissions with team: '.$teamtitle.'</span></div>
						<div><span class="style28">You can add a tag text here (optional):<input name="tag" type="text" class="input2" style="width: 90px;"/>
                    </div>
                    <div style="float: left;">
					<div>';

				$result = mysql_query("SELECT * FROM $tbl where user_username = '$username' OR user_facebook_id =  '$username'") 
				or die(mysql_error());  
				while($row = mysql_fetch_array( $result )) {
				if ($row['user_facebook_id']){
				$userid = $row['ID'];
				}
				else
				{
				$userid = $row['ID'];				
				}
				}

				?>

          </div>	
		  <input type="hidden" value="<?php echo $username; ?>" name="username" />
		  <input type="hidden" value="<?php echo $teamid; ?>" name="Reffered_team" />
		  <input type="hidden" value="<?php echo $userid; ?>" name="userid" />
                    </div>
                  	<div class="clear"></div>
                  </div>
				  </td>
				  <td>&nbsp;&nbsp;</td>
				  <td>
				  <div><span class="style28">Notes to be connected to these emissions (optional):<br /><textarea style="margin-top:-5px" width= "250px" cols="45" rows="5" name="notes"></textarea></span></div>
				  </td></tr>
				  </table>
            	</div>    
                <br/>
                <div>
                    <div style="float: left; width: 300px; height: auto;">  
                    	<input type = "submit" name="submit" value="Save Emissions">	
                    </div>
                    <div style="float: left;">
						<input type="submit" name="submit" value="Check Out Now">
                    </div>
              	<div class="clear"></div>
              	</div></form>
  
             <br />   
            </div>
      </div>
	   <div align="center"><p class="style28">Currently the methodology used for these calculations is taken from <a target="_blank" href="CustomO16C45F39728.pdf">this document from the World Resources Institute</a>.</p>
					
					 </div>
	  
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
    <div class="footer">
    	<div style="float: left; width: 590px; height: auto;"> 
        	<span class="style11"> <a href="page-aboutus.php">About Us</a>    |    <a href="page-contactus.php">Contact Us</a>     |   <a href="page-support.php"> Support </a>    |    <a href="page-TOC.php"> Terms and Conditions</a></span>         </div>
        <div style="float: right; width: 290px; text-align: right;">
        	<span class="style11">Copyright 2013. EarthDeeds. All Rights Reserved</span>
        </div>
        <div class="clear"></div>
    </div>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>