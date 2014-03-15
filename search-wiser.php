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
error_reporting(0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search Page : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style type="text/css">
input.linkbut[type="submit"] {
   background: none repeat scroll 0 0 transparent;
    border: medium none;
    box-shadow: none;
    color: #0000FF;
    cursor: pointer;
    font-size: 18px;
    margin: 0;
    padding: 5px 0;
    text-decoration: underline;

}
</style>
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
<?php				
$username = $_SESSION['myusername'];
$teamid = $_GET['teamid'];
$projid = $_GET['projid'];
$pagenav = $_GET['pagenav'];
$loginerror = $_GET['loginerror'];
$currpage = $_GET['s'];

if ($currpage){
$phrase = $_GET['phrase'];
$location = $_GET['location'];
$varwiser = 'wiser';

}
else
{
$phrase = $_POST['phrase'];
$anchor_lat = $_POST['lat'];
$anchor_long = $_POST['long'];
$location = $_POST['location'];
$distance = $_POST['distance'];
$varwiser = $_POST['varwiser'];
}

?>
        	<div style="text-align:center;"><span class="style3">Advanced Search via Wiser.org </span></div>
            <div style="text-align:center;"><span class="style27"><a href="wiser-info.php">Click here for more info on this program</a></span></div>
            <br />
	<div class="left3">
                <div class="box">
                   <div><span class="style10">Search Options</span></div>
                   <br />
				   <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                   <div><span class="style27">Phrase Keyword</span></div>
                   <div><input name="phrase" type="text" class="input-search"/></div>
                  <!-- <div><span class="style27">Latitude</span></div>
                   <div><input name="lat" type="text" class="input-search"/></div>
                   <div><span class="style27">Longitude</span></div>
                   <div><input name="long" type="text" class="input-search"/></div>
                   <div><span class="style27">Distance</span></div>
                   <div><input name="distance" type="text" class="input-search"/></div> -->
				   <div><span class="style27">Location</span></div>
                   <div><input name="location" type="text" class="input-search"/></div>
				   <input name="varwiser" type="hidden" value="wiser"/>

                   <br />
                   <div style="text-align: center; margin: auto;">
                        <input type = "submit" name="submit" value="SEARCH" style="width: 200px;">
                   </div>
				   </form>
                	<br />
                </div>
        </div><!-- end of right ---------------------------------------------------- -->
		 <div class="right3"> 

					<?php
					
					
					include('api_helper.php');
					
					
					
/*if ($varwiser){


for ($x=0; $x<=3; $x++){

$apiKey = 'f9db17962e68feb90fdb466cd787775c';
$secret = 'e6c2545b2849c5f31927d1ee0a9438b8';
$sig = md5('page'.$x.'phrase'.$phrase.'location'.$location.$secret);
$url = 'http://www.wiser.org/organizations/api_search?page='.$x.'&phrase='.$phrase.'&location='.$location.'&sig='.$sig.'&key='.$apiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);

if ($response){
$xml = new SimpleXMLElement($response);

foreach ($xml->results->organization as $element) {
$range = $range +1;
}
curl_close($ch); }
}
echo 'range:'.$range;
}
					
			*/		
					
					


if ($varwiser){
$apiKey = 'f9db17962e68feb90fdb466cd787775c';
$secret = 'e6c2545b2849c5f31927d1ee0a9438b8';
$sig = md5('page'.$currpage.'phrase'.$phrase.'location'.$location.$secret);
$url = 'http://www.wiser.org/organizations/api_search?page='.$currpage.'&phrase='.$phrase.'&location='.$location.'&sig='.$sig.'&key='.$apiKey;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);

if ($response){
$xml = new SimpleXMLElement($response);
foreach ($xml->results->organization as $element) {
		$abouthtml = htmlentities( $element->About, ENT_QUOTES );
		if( get_magic_quotes_gpc() )
		{
			$data = stripslashes( $abouthtml);
			}
 $about= mysql_real_escape_string( $abouthtml);  
$address = $element['City'].' '.$element['Province'].'  '.$element['State'].'  '.$element['Country'];
$desc = $element['Name'];
  
  
$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
$response = json_decode($response);
$lat = $response->results[0]->geometry->location->lat;
$long = $response->results[0]->geometry->location->lng;

$variable .= '[\''.$desc.'\', '.$lat.', '.$long.'],';
}
curl_close($ch); }

}
else
{
$lat = 43.6387;
$long = 116.2413;
}

					?>

								<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
								<!--<div id="map" style="border: 1px solid black; width: 600px; height: 400px;"></div>-->

								<div id="map" style="border: 10px solid #f5f5f5; width: 600px; height: 300px;"></div>

								  <script type="text/javascript">
									var locationsp = [      
									<?php echo $variable; ?>  
									];
									var locationst = [      
									<?php echo $variablet; ?>  
									];

									var map = new google.maps.Map(document.getElementById('map'), {
									  zoom: 2,
									  /*center: new google.maps.LatLng( <?php echo $lat; ?>, <?php echo $long; ?>),*/
									  center: <?php if ($center) {
									  echo $center; }
									  else
									  {
									echo 'new google.maps.LatLng( '.$lat.', '.$long.')';
									  }
									  ?>,
									  mapTypeId: google.maps.MapTypeId.ROADMAP
									});

									var infowindow = new google.maps.InfoWindow();

									var markerp, markert, i;

									for (i = 0; i < locationsp.length; i++) {  
										markerp = new google.maps.Marker({
										position: new google.maps.LatLng(locationsp[i][1], locationsp[i][2]),
										map: map
									  });

									  google.maps.event.addListener(markerp, 'mouseover', (function(markerp, i) {
										return function() {
										  infowindow.setContent(locationsp[i][0]);
										  infowindow.open(map, markerp);
										}
									  })(markerp, i));
									}
									
									for (i = 0; i < locationst.length; i++) { 	
										markert = new google.maps.Marker({
										position: new google.maps.LatLng(locationst[i][1], locationst[i][2]),
										map: map
									  });

									  google.maps.event.addListener(markert, 'mouseover', (function(markert, i) {
										return function() {
										  infowindow.setContent(locationst[i][0]);
										  infowindow.open(map, markert);
										}
									  })(markert, i));
									}
								  </script>
								  
								  
		     </div> <!-- End of left ---------------------------------------------------- -->
         <!-- start of right ---------------------------------------------------- -->
        <div class="clear"></div>
        </div>
		<?php

		if ($varwiser){
		$pmax = 150;
$apiKey = 'f9db17962e68feb90fdb466cd787775c';
$secret = 'e6c2545b2849c5f31927d1ee0a9438b8';
$sig = md5('page'.$currpage.'phrase'.$phrase.'location'.$location.$secret);
$url = 'http://www.wiser.org/organizations/api_search?page='.$currpage.'&phrase='.$phrase.'&location='.$location.'&sig='.$sig.'&key='.$apiKey;
//echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
if ($response){
$xml = new SimpleXMLElement($response);
if ($xml->results->organization){
// echo 'aaaaa';
}
else{
 echo 'No Result Found';
}
foreach ($xml->results->organization as $element) {
 
	echo'<div class="wiser-box">';
		if ($element['Avatar'] == 'http://www.wiser.org/images/icons/org/non_profit_lg.png'){		
			echo '<div class="left-search" style = "height: 50px;">&nbsp;</div>';	
			}			
			else
			{
			echo '<div class="left-search"><img src="'.$element['Avatar'].'" /></div>';	
			}
			/*				$orig    = '<br />
<br />
<br />';
				$replace = '<br />';

				$newstr = str_replace($orig, $replace, $element->About);
				$descriptiowiser = substr($newstr, 0, 150);*/  
				$descriptiowiser = substr($element->About, 0, 150);  
	echo'           		
			<a style="font-weight: bold;"> '.$element['Name'].'</a>
			<form method="post" action="wiser-project-submittal1.php">
			<input name="titleorg" type="hidden" value="'.$element['Name'].'"/>
			<input name="profpic" type="hidden" value="'.$element['Avatar'].'"/>
			<input name="idorg" type="hidden" value="'.$element['id'].'"/>
			<input name="urlorg" type="hidden" value="'.$url.'"/>
			<input name="websiteorg" type="hidden" value="'.$element['Website'].'"/>
			<input name="locationorg" type="hidden" value="'.$element['City'].' '.$element['Province'].'  '.$element['State'].'  '.$element['Country'].'"/>
			<input name="descorg" type="hidden" value="'.$about.'"/>
			<div class="right-search">
			<div><span class="style8">'.strip_tags($descriptiowiser).'.....</span></div>
            </div>
            <div style="float: left; margin-top: 10px;"><input type = "submit" name="submit" value="Learn More" class="button2"></div>
			</form>
			
			<div class="clear"></div>
			</div>
		';
  
}
curl_close($ch); 

}

else
{

echo 'no result found';
}
}



// Script name:  
//    generates sliding pagination bar 
//    derived from very nice PHP script posted by Dagon 080418 (thanks!) 
    // @var int _GET["s"] => requested page number 
    // @var int _GET["c"] => # of line item (i.e., row) at top of requested pager 

//  [soap box deleted to comply with PHPBuilder size restrictions - icehose 080803] 

//    icehose 080802 

// here's a simple error logging function to facilitate debugging (aka, "instrumentation") 
    // @var string $sMessage => string to be written to error log 
function logExc($sMessage) 
{ 
    $_sMsg = (string) date("j F Y, g:i a: "); 
    $_sMsg .= (string) $sMessage; 
    $_sMsg .= (string) "\n"; 
    error_log($_sMsg, 3, "errors.log"); // change to direct output to your preferred log file location 
} // end logExc 

//---- start optional 
    // set php configuration variables to illustrate strict compliance 
    //        strongly advisable during code development and debugging! 
    ini_set("track_errors", "1"); // error tracking 
    error_reporting(E_ALL); // enable error notices 
//---- end optional 

// script constants (could/should be in .cfg file) 
$ROWCOUNT = 25; // # rows per page (set by you) 
$RANGE = 10; // number of page numbers in pageBar (set by you) 

// calculate local control constants (could/should be precalculated and stored as CONSTANTS in .cfg file) 
//$iRangeMin = (int) ($RANGE % 2 == 0) ? ($RANGE / 2) - 1 : ($RANGE - 1) / 2; // Dagon's elegant original 
//$iRangeMax = (int) ($RANGE % 2 == 0) ? $iRangeMin + 1 : $iRangeMin; // Dagon's elegant original 
if ($RANGE % 2 == 0) // calculate modulo only once for both constants 
{ 
    $iRangeMin = (int) ($RANGE / 2) - 1; 
    $iRangeMax = $iRangeMin + 1; 
} 
else 
{ 
    $iRangeMin = (int) ($RANGE - 1) / 2; 
    $iRangeMax = $iRangeMin; 
} 

// GET working variables 
$iPageNum = 1; // set default page number 
if (!empty($_GET["s"])) // page number passed via GET 
{ 
    $iPageNum = $_GET["s"]; // get actual page number 
} 
$iCursor = 0; // set default page cursor 
if (!empty($_GET["cursor"])) // cursor passed via GET 
{ 
    $iCursor = $_GET["cursor"]; // get actual cursor value 
} 

// Remember that databases, e.g., MySQL, have no concept of "page", so passing both page # AND cursor 
//    via your URL guarantees that you immediately have the page # info you need to generate the next pagination bar 
//    AND the LIMIT info you need to launch your next query (I prefer this to generating one from the other) 

// set initial value(s) 
//        Note: here is where you set the actual size of the data set using, e.g., a MySQL query 
//        Change this value manually to see the effects this number has on the pagination bar 
$iRows = 2000; // total # of rows in data set 

// calculate local control variables 
$iPages = (int) ceil($iRows / $ROWCOUNT); 

//---- Start new code 
// Dagon's original code calculated the following control variables using a round-about technique; 
//        however, the same variables can be calculated directly from page # and base constants as follows: 
if ($iPageNum < ($iRangeMax + 1)) // ramp up phase 
{ 
    $iPageMin = 1; 
    $iPageMax = $RANGE; 
} 
else // stable state, with min function to take care of ramp down phase 
{ 
    $iPageMin = min(($iPageNum - $iRangeMin), ($iPages - ($RANGE - 1))); 
    $iPageMax = min(($iPageNum + $iRangeMax), $iPages); 
} 
//---- End new code 

// create two different versions of pagination bar: <div>...</div> and <table>...</table> 
$sPageButtons = ""; // set default (for strict correctness) 
if ($iPages > 1 ) // we need to generate a pagination bar 
{ 
    $s = 0; // initialize 
    $c = 0; // initialize 
    $p = 0; // initialize 
    if ($iPageMin > 1) // generate at least Prev button (New: simplified control structure) 
    { 
        if ($iPageMin > 2) // but first generate left arrow button (New: simplified control structure) 
        { 
            $s = 1; // pro forma 
//            logExc("<: s = ".$s."; c = ".$c); // debugging instrumentation 
            $aPageButtons[++$p] = "<td><a href=\"?phrase=".$phrase."&location=".$location."&s=1&cursor=0\">&lt;</a></td>\r"; 
            $sPageButtons .= "\t\t<a href=\"?s=1&cursor=0\">&lt;</a>\r"; 
        } 
       // $s = $iPageMin - 1; 
	   	if (empty($_GET["s"])) // page number passed via GET 
		{ 
		$s = 1;  // get actual page number 
		} 
		else
		{
		$s = $_GET["s"];
		}
        $sx = $s - 1; 
        $c = ($s - 1) * $ROWCOUNT; 
//        logExc("Prev: s = ".$s."; c = ".$c); // debugging instrumentation 
        $aPageButtons[++$p] = "<td><a href=\"?phrase=".$phrase."&location=".$location."&s=".$sx."&cursor=".$c."\">Prev</a></td>\r"; 
        $sPageButtons .= "\t\t<a href=\"?phrase=".$phrase."&location=".$location."&s=".$sx."&cursor=".$c."\">Prev</a>\r"; 
    } 
    for ($i = $iPageMin; $i <= $iPageMax; $i++) // generate numbered buttons 
    { 
        if ($i == $iPageNum) 
        { 
            $s = $i; 
            $c = ($s - 1) * $ROWCOUNT; 
//            logExc($s.": s = ".$s."; c = ".$c); // debugging instrumentation 
            $aPageButtons[++$p] = "<td><b>".$i."</b></td>\r"; 
            $sPageButtons .= "\t\t<span><b>".$i."</b></span>\r"; 
        } 
        else 
        { 
            $s = $i; 
            $c = ($s - 1) * $ROWCOUNT; 
//            logExc($s.": s = ".$s."; c = ".$c); // debugging instrumentation 

            $aPageButtons[++$p] = "<td><a href=\"?phrase=".$phrase."&location=".$location."&s=".$s."&cursor=".$c."\">".$i."</a></td>\r"; 
            $sPageButtons .= "\t\t<a href=\"?phrase=".$phrase."&location=".$location."&s=".$s."&cursor=".$c."\">".$i."</a>\r"; 
        } 
    } 
    if ($iPageMax < $iPages) // generate Next button (New: simplified control structure) 
    { 
       // $s = $iPageMax + 1; 
		if (empty($_GET["s"])) // page number passed via GET 
		{ 
		$s = 1;  // get actual page number 
		} 
		else
		{
		$s = $_GET["s"];
		}
        $sx = $s + 1; 
        $c = ($s - 1) * $ROWCOUNT; 
//        logExc("Next: s = ".$s."; c = ".$c); // debugging instrumentation 
        $aPageButtons[++$p] = "<td><a href=\"?phrase=".$phrase."&location=".$location."&s=".$sx."&cursor=".$c."\">Next</a></td>\r"; 
        $sPageButtons .= "\t\t<a href=\"?phrase=".$phrase."&location=".$location."&s=".$sx."&cursor=".$c."\">Next</a>\r"; 
        if ($s < $iPages) // also generate right arrow button (New: simplified control structure) 
        { 
            $s = $iPages; 
            $c = ($s - 1) * $ROWCOUNT; 
//            logExc(">: s = ".$s."; c = ".$c); // debugging instrumentation 
            $aPageButtons[++$p] = "<td><a href=\"?phrase=".$phrase."&location=".$location."&s=".$s."&cursor=".$c."\">&gt;</a></td>\r"; 
            $sPageButtons .= "\t\t<a href=\"?phrase=".$phrase."&location=".$location."&s=".$s."&cursor=".$c."\">&gt;</a>\r"; 
        } 
    } 
    $aPage["PAGINATION"] = "\t<div align=\"center\">\r".$sPageButtons."\t</div>\r"; // build <div>...</div> form
} // end generation of pagination bar 


// start output to browser 
?> 


<?php 
if ($varwiser){
echo $aPage["PAGINATION"];  // display <div>...</div> form 

// build/display <table>...</table> form 
//        Note: if your page is already in table format, you can delete the <table ...> and </table> lines 
//              leaving only the <tr> thru </tr> lines ... unless you need the align="center" table attribute 
?> 
    <table align="center"> 
        <tr> 
<?php 
foreach ($aPageButtons as $sPageButton) 
{ 
    if (!empty($sPageButton)) 
    { 
?> 
            <?php //print $sPageButton ?> 
<?php 
    } 
} 

// close output to browser 
?> 
        </tr> 
    </table> 
<?php
}
?>


		    <!--     <div class="wiser-box">
            <div class="left-search"><img src="images/list-image3.jpg" /></div>
            <div class="right-search">
                <div><span class="style9"><a href="#">Ekopia - Findhorn Wind Park</a></span></div>
                <div><span class="style8">The Community operated a Wind Park division, incorporating a 75kW windmill, from 1989 to 2006.</span></div>
            </div>
            <div style="float: left; margin-top: 10px;"><input type = "submit" name="submit" value="Request project" class="button2"></div>
          <div class="clear"></div>
        </div>
  
        
         <div style="text-align:center;"><span class="style27"><a href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">5</a> <a href="#">6</a> <a href="#">7</a> <a href="#">8</a> <a href="#">9</a> <a href="#">10</a> <a href="#">Next</a></span></div>-->
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
