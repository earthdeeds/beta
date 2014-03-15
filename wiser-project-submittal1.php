<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://beta.earthdeeds.com/login.php");
}
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
<title>Wiser Project Submittal: Earth Deeds</title>
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
    	
        
        <div>
		<br />
		<div style="float: left;"><a href="search.php" class="style8" > <input type = "submit" name="submit" value="BACK TO SEARCH"> </a></div>
				<div class="clear"></div>
      	 <div class="box" style="width: 800px; margin: auto;">
		
		 
		 
		 <?php

		 $urlorg = $_POST['urlorg'];
		 $idorg = $_POST['idorg'];
		 

		 include('api_helper.php');
$apiKey = 'f9db17962e68feb90fdb466cd787775c';
$secret = 'e6c2545b2849c5f31927d1ee0a9438b8';

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $urlorg);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec($ch);
				$xml = new SimpleXMLElement($response);
				foreach ($xml->results->organization as $element) {
				//echo$element['Name'].'</br>';
				if ($element['id'] == $idorg){
	
				
			
			 $titleorg = $element['Name'];
			$profpictemp = $element['Avatar'];
			$websiteorg = $element['Website'];
			$locationorg = $element['City'].' '.$element['Province'].'  '.$element['State'].'  '.$element['Country'];
			
								$areaorg =$element['Area'];
				}

				}

		 ?>
            <div>
            	<div style="float: left; width: 100px; height: auto;">
				
				<?PHP
						if ($profpictemp == 'http://www.wiser.org/images/icons/org/non_profit_lg.png'){		
			echo '<div class="user-profile1">&nbsp;</div>';	
			}			
			else
			{
			echo '<div><img src="'.$profpictemp.'" class="user-profile"/></div>';	
			}
				
				?>
				
				
				
                    
                </div>
                <div style="float: left; width: 300px;">
                		<div><span class="style3"><?php echo $titleorg; ?></span></div>
                        <div><span class="style31">(Non Governmental Organization)</span></div>
                    	<div><span class="style9"><a href="<?php echo 'http://'.$websiteorg; ?>"><?php echo $websiteorg; ?></a></span></div>
                        <div><span class="style32"><?php echo $locationorg; ?></span></div>

              </div>
                <div style="float: right; width: 330px; height: auto; background: #f7f7f7; border:1px solid #d0d0d0; padding: 10px;">
                    <div><span class="style8">This is one of the many organizstions listed on Wiser.org - a global village of 100,000+ people and organizations working toward social justice, indigenous rights, and environmental stewardship.</span></br><a href="#Bot">Submit a Project Request</a></div>
                </div>
                
                <div class="clear"></div>    
				          
			</div>
            
            <br />

           <div style="letter-spacing:1px; background: #fbf5df; border: 1px solid #ddd7c0;padding: 5px;">
           	<span class="style14">Issue Areas</span>
            <br />
            <span class="style32"><?php echo str_replace(',', ', ', $areaorg); ?> </span>          
            </div> 
            <br />
            
            <div>
            <!--<img src="images/wiser-photo.jpg"   style="border: none !important;"/>-->
            </div>
              <br />
            <div>
            	<span class="style8">
				<?php 
				$orig    = '<br />
<br />
<br />';
				$replace = '<br />';

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $urlorg);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec($ch);
				$xml = new SimpleXMLElement($response);
				foreach ($xml->results->organization as $element) {
				//echo$element['Name'].'</br>';
				if ($element['id'] == $idorg){
				//echo $element->About;
				echo $newstr = str_replace($orig, $replace, $element->About);
				}

				}
				?>
			
			
			

                </span>
            </div>  
			<br />
			<hr></hr>
			<br />	
<div style="letter-spacing:1px; background: #f7f7f7; border:1px solid #d0d0d0; padding: 5px;">			
			  <div style="letter-spacing:1px;"><span class="style14">If you would like this organization to submit a project to Earth Deeds to be able receive support, please do so below. We’ll follow up with them and let you know when they have submitted a project. <br />
<b>Please type in a short note below explaining why you would like this org to submit a project to Earth Deeds:</b>
</span></div>		
			<form name="userform" method="post" onsubmit="return validateForm();" action="includes/wisersubmission.php" class="userform">			
			<div>
            	<textarea cols="40" rows="8" name="usernotes" class="input4"></textarea>
			</div>
							<?php 
				$orig    = '<br />
<br />
<br />';
				$replace = '<br />';

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $urlorg);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$response = curl_exec($ch);
				$xml = new SimpleXMLElement($response);
				foreach ($xml->results->organization as $element) {
				//echo$element['Name'].'</br>';
				if ($element['id'] == $idorg){
				$newstr = str_replace($orig, $replace, $element->About);
				echo '
			
			<input name="worgname" type="hidden" value="'.$element['Name'].'"/>
			<input name="profpic" type="hidden" value="'.$element['Avatar'].'"/>
			<input name="idorg" type="hidden" value="'.$element['id'].'"/>
			<input name="worgarea" type="hidden" value="'.$element['Area'].'"/>
			<input name="worgwebsite" type="hidden" value="'.$element['Website'].'"/>
			<input name="worgupdated" type="hidden" value="'.$element['Website'].'"/>
			<input name="worglocation" type="hidden" value="'.$element['City'].' '.$element['Province'].'  '.$element['State'].'  '.$element['Country'].'"/>
			<input name="worgdescription" type="hidden" value="'.strip_tags ($newstr).'"/>				
				';
				}
				}
				?>

            <div style="text-align: left;"><input type="submit" class="button2" value="Submit Project Request" name="submit"></div>
			</form>        
        <a name="Bot"></a>
            </div>  
			</div>
              <br /><br />
     <div class="clear"></div>   
            
          </div><!-- END OF BOX ------------------------------------------------------------------ -->   

        <br />
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
