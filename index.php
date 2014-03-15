<?php
include('connect-db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Beta Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style-home.css">
    <link rel="stylesheet" href="bjqs.css">
	    <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="js/bjqs-1.3.min.js"></script>
      
</head>

<body>

<div class="container">
	<div class="header">
    	<div class="nav">
        	<ul>
            	<li><span><a href="http://beta.earthdeeds.com/">Home</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/mystuff.php">My Stuff</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/project-view.php">Projects</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/team-view.php">Teams</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/org-view.php">Orgs</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/measure.php">Measure</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/reduce.php">Reduce</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/search.php">Search</a></span></li>                                                                   
                <li><span><a href="http://beta.earthdeeds.com/login.php">Login</a></span></li>                                                                   
            </ul>
        </div>
        <br /><br /><br /><br />
        <div style="width: 960px;">
        	<div class="button"><a href="http://beta.earthdeeds.com/login.php"><img src="imageshome/button1.png" /></a></div>
            <div class="clear"></div>
        </div>
        <div style="width: 960px;">
        	<div class="button"><a href="#Top"><img src="imageshome/button2.png" /></a></div>
            <div class="clear"></div>
        </div>
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <a href="#"><div class="down"></div></a>
        
    </div><!-- Dulo of header ---------------------------------------------------- -->
    
    <div class="content">
    	<br /><br />
	    	<div class="slider">
		<a name="Top"></a>
        <div class="slides" id="banner-slide">	<!--<img src="imageshome/slider1.png" />-->
			
			        <ul class="bjqs">
		  <li><img src="imageshome/slider1.png" ></li>
		  <li><img src="imageshome/slider2.png" ></li> 
          <li><img src="imageshome/slider3.png" ></li>
        </ul>
			
			<!-- attach the plug-in to the slider parent element and adjust the settings as required -->
      <script class="secret-source">
        jQuery(document).ready(function($) {
          
          $('#banner-slide').bjqs({
            animtype      : 'slide',
            height        : 479,
            width         : 960,
            responsive    : true,
            randomstart   : false
          });
          
        });
      </script>
			
			</div>
			
			
            <br />
            <div style="width: 90px; margin: auto;">
            	<div class="clear">
            </div>
        </div><!-- Dulo of slider ---------------------------------------------------- -->
        </br>
        <div class="divider"></div>
        
        <div>
        	<div class="left">

            	<span class="style2">Video Overview</span>
            	<div class="video">			<iframe src="http://player.vimeo.com/video/84367314" width="513px" height="280px" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>
            </div><!-- Dulo of left ---------------------------------------------------- --> 
            <div class="right">
            	<span class="style2">Testimonials</span>
                <br /><br />
                <div>
                	<div class="test-pic"><img height="62px" width="62px" src="imageshome/JoannaMacy.jpg" /></div>
                    <div class="testi">
                    	<div class="quote1"></div>
                        <p><span class="style3">I am excited that Earth Deeds is offering us all such invaluable tools for becoming carbon conscious. What an ingenious gift to the Great Turning!
                        </span>
                        <br />
                        </p>
                        <div style="text-align:right">
                        	<span class="style4" style="text-align: right;"><a class="style4" href="http://www.joannamacy.net/aboutjoannamacy.html"> Joanna Macy</a></br> Environmental Activist & Author</span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <br />
                <div>
                	<div class="test-pic"><img height="62px" width="62px" src="imageshome/OmSunisa.jpg" /></div>
                    <div class="testi">
                    	<div class="quote1"></div>
                        <p><span class="style3">I feel thankful for this donation and that others have faith in what we are doing. In addition to our reforestation work, it is a long term program where we provide educational programs and do practical works with the children.This money will help us in our long way journey.
                        </span>
                        <br />
                        </p>
                        <div style="text-align:right">
                        	<span class="style4" style="text-align: right;">OmSunisa Jamwiset </br><a class="style4" href="http://beta.earthdeeds.com/project.php?projid=98">Nature Youth Camp in Thailand</a></span>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <br />

            </div><!-- Dulo of right ---------------------------------------------------- -->
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div>
       		<div class="left2" style="margin-left: 20px;">
			
			  	<span class="style2">Featured Teams</span>
                <br /><br />
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
						$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$t1' or Team_account_idnum = '$t2' or Team_account_idnum = '$t3'") or die(mysql_error());  

		while($rowteam = mysql_fetch_array( $resultteam )) {
$longdesc = html_entity_decode( $rowteam['team_long_description'] );
$teamdesc = strip_tags($longdesc);
	if ($rowteam['team_image'] == "teamimageshome/"){
						$teamimage = '<div class="test-pic"><img width="62px" height = "62px"  src="../teamimageshome/team.jpg" /></div>';						
						}
						else
						{
							$teamimage = '<div class="test-pic"><img width="62px" height = "62px" src="../'.$rowteam['team_image'].'" /></div>';	
						}
       echo '         <div>
                    '.$teamimage.'
                    <div class="featured">
                <span class="style3"><a href="http://beta.earthdeeds.com/team.php?teamid='.$rowteam['Team_account_idnum'].'">'.$rowteam['team_title'].'</a> '.substr($teamdesc, 0, 150).'... </span>                
                    </div>
                    <div class="clear"></div>
                </div>
                <br />';
		
				}
				?>
              
                
            </div> <!-- Dulo of left2 ---------------------------------------------------- -->
            <div class="left2">
            	<span class="style2">Featured Projects</span>
            	<br /><br />
								<?php 
 

				$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$p1' or project_account_idnum = '$p2' or project_account_idnum = '$p3'") or die(mysql_error());  

		while($rowproj = mysql_fetch_array( $resultproj )) {
	$projid = $rowproj['project_account_idnum'];
		
	$resultprojteam = mysql_query("SELECT * FROM  wp_cc_teamproject where project_id = '$projid'") or die(mysql_error()); 
	$rowprojteam = mysql_fetch_array( $resultprojteam );
													
													
$longdescproj = html_entity_decode( $rowproj['project_long_description'] );
$projdesc = strip_tags($longdescproj);
	if ($rowproj['team_image'] == "projimageshome/"){
						$projimage = '<div class="test-pic"><img width="62px" height = "62px"  src="../teamimageshome/team.jpg" /></div>';						
						}
						else
						{
						$projimage = '<div class="test-pic"><img width="62px" height = "62px" src="../'.$rowproj['project_profile_photo'].'" /></div>';	
						}
       echo '         <div>
                    '.$projimage.'
                    <div class="featured">
                        <span class="style3"><a href="http://beta.earthdeeds.com/project.php?projid='.$rowproj['project_account_idnum'].'&teamid='.$rowprojteam['team_id'].'">'.$rowproj['project_title'].'</a> '.substr($projdesc, 0, 150).'...</span>                
                    </div>
                    <div class="clear"></div>
                </div>
                <br />';
		
				}
				?>
				

            
            </div> <!-- Dulo of left2 ---------------------------------------------------- -->
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>

    </div> <!-- Dulo of Content ---------------------------------------------------- -->
    
    <div class="footer">
        <div>
       
        <div class="footer-contact" style="float: right; margin: 20px 0 0 0;">
        	<span class="style5">Follow Us on</span>
            <div>
            	<div class="social"><a href="http://www.facebook.com/EarthDeeds"><img src="imageshome/facebook.png" /></a></div>
                <div class="social"><a href="http://www.linkedin.com/company/2997728"><img src="imageshome/linkedin.png" /></a></div>
                <div class="social"><a href="https://twitter.com/Earth_Deeds"><img src="imageshome/twitter.png" /></a></div>
                <div class="clear"></div>
            </div>


            
        </div>
        <div class="clear"></div>
        </div>
        <br />
        <div class="nav-foot">
        	<ul>
            	<li><span><a href="http://beta.earthdeeds.com/page-aboutus.php">About Us</a></span></li>
                <li><span><a href="http://blog.earthdeeds.com">Blog</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/page-contactus.php">Contact Us</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/page-support.php">Support</a></span></li>
                <li><span><a href="http://beta.earthdeeds.com/page-TOC.php">Terms and Conditions</a></span></li>
                <ri><span>Copyright © 2013. Earth Deeds. All Rights Reserved.</span></ri>                                              
            </ul>
        </div>
    </div><!-- Dulo of footer ---------------------------------------------------- -->
    
</div> <!-- Dulo of Container ---------------------------------------------------- -->

</body>
</html>
