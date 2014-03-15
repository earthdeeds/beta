<?php
session_start();

$username = $_SESSION['myusername'];
include('connect-db.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Organization Page : Earth Deeds </title>
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
				           	<div><span class="style3">Organization</span></div>
                <br />
           	  <div><span class="style8">Organizations can be involved in creating a more sustainable world by participating through Earth Deeds as a <strong><a href="http://beta.earthdeeds.com/project-view.php">Project </a></strong> or a <strong><a href="http://beta.earthdeeds.com/team-view.php">Team</a></strong>.
              <br /><br />
                
               Registered users of the site can create an <a href="add-edit-org.php"><strong>organization profile here</strong></a>.                
               </div>
                <br />
                <br />

			<?php
			$resultproj = mysql_query("SELECT * FROM $tblorg where Organization_status = 3") or die(mysql_error());
		
  			while($rowproj = mysql_fetch_array( $resultproj )) {
						//$projectteamid = $rowproj['team_idnum'];
						$orgtid = $rowproj['Organization_account_idnum'];
						$address = $rowproj['Organization_address1'];
						$orgname = $rowproj['Organization_title'];
						$orgdescicon = '<a class=\"usertext\" href=\"org.php?orgid='.$orgid.'\">'.$orgname.'</a>';
						
				$response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&sensor=true');
				$response = json_decode($response);
				$lat = $response->results[0]->geometry->location->lat;
				$long = $response->results[0]->geometry->location->lng;
					
					$variable .= '[\''.$orgdescicon.'\', '.$lat.', '.$long.'],';
				}	
			?>

<script src="http://maps.google.com/maps/api/js?sensor=false" 
          type="text/javascript"></script>
<div id="map" style="margin: auto; text-align:center; width: 800px; height: 500px;"></div>

  <script type="text/javascript">
    var locations = [      
    <?php echo $variable; ?>  
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 2,
      center: new google.maps.LatLng(33.0971, 3.2318),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
        <div class="clear"></div>
        </div>
        </div>
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
