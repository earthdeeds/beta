<?php

session_start();


$autologin = $_GET['autologin'];
$uname = $_GET['uname'];

if ($autologin=="true"){
$myusername = $uname;
session_register("myusername");
}
include('connect-db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
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

        
        <div> <!-- start of Content TOP ---------------------------------------------------- -->
        	<div class="beta-box">
            	<div><img src="images/beta-image1.jpg" /></div>
                <br />
                <div><span class="style6">Create/Join Teams</span></div>
                <div style="text-align:left;">
                	<span class="style26">Teams with others (friends, family, co-workers, or even strangers across the globe)</span>
                </div>
                <br />
                <div>
                	<div class="beta-button"><span><a href="team-view.php">More</a></span></div>
                    <div class="clear"></div>
                </div>
            </div>	
            
            <div class="beta-box">
            	<div><img src="images/beta-image2.jpg" /></div>
                <br />
                <div><span class="style6">Measure Emissions</span></div>
                <div style="text-align:left;">
                	<span class="style26">From real-world events (weddings, conferences, commuting, etc.)</span>
                </div>
                <br /><br />
                <div>
                	<div class="beta-button"><span><a href="measure.php">More</a></span></div>
                    <div class="clear"></div>
                </div>
            </div>	
            
            <div class="beta-box">
            	<div><img src="images/beta-image3.jpg" /></div>
                <br />
                <div><span class="style6">Reduce Emissions</span></div>
                <div style="text-align:left;">
                	<span class="style26">Through simple lifestyle changes travel, food, heating / cooling, etc.)</span>
                </div>
                <br /><br />
                <div>
                	<div class="beta-button"><span><a href="reduce.php">More</a></span></div>
                    <div class="clear"></div>
                </div>
            </div>	
            
            <div class="beta-box">
            	<div><img src="images/beta-image4.jpg" /></div>
                <br />
                <div><span class="style6">Support Projects</span></div>
                <div style="text-align:left;">
                	<span class="style26">Community-based solutions to climate change and peak oil</span>
                </div>
                <br /><br />
                <div>
                	<div class="beta-button"><span><a href="support_projects.php">More</a></span></div>
                    <div class="clear"></div>
                </div>
            </div>	
            <div class="clear"></div>
        </div>  <!-- End of Content TOP ---------------------------------------------------- -->
        
        <div> <!-- start of Content MIDDLE ---------------------------------------------------- -->
        	<div class="beta-middle-box">
            	<br /><br />
            	<div class="button4">
                	<span><a href="User-Registration.php">START NOW!</a></span>               
                </div>
                <br />
                <div><span class="style5">(it&#39;s free!)</span></div>
                <div><span class="style6">to make personal, collective and global changes for a more healthy planet. <a href="User-Registration.php">Register now</a></span></div>
            </div>
            
            <div class="beta-middle-box">
            	<div class="video">
                	<div style="width: 315px; height: 190px; background: #000000;">
                	<!-- insert width of video is 315px, height is 190px ---------------------------------------------------- -->

					<iframe src="http://player.vimeo.com/video/63244295" width="315px" height="190px" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div> <!-- End of Content MIDDLE ---------------------------------------------------- -->
        
        <div class="shadow2"></div>
        
        <div> <!-- start of Content BOTTOM ---------------------------------------------------- -->
        	<div class="beta-middle-box">
            	<br /><br />
            	<img src="images/beta-image.jpg" />
            </div>
            
            <div class="beta-middle-box">
            	 <br /><br />
            	 <div style="text-align: left;"><span class="style6">This is not Carbon Offsetting!</span></div>
                 <br />
                 <div style="text-align: left;"><span class="style25">While supporting valid projects, offsetting also gives the wrong message that we can buy a clean conscience while delaying meaningful action. Instead, eCO2 Solutions promotes carbon consciousness and karma mitigation which is as much about education & lifestyle change as supporting carbon mitigation projects. Plus, 100% of donations go directly to the projects! learn more&#46;&#46;&#46;
<br /><br />
<strong>Highlights (example)</strong><br />
<br />
$1,837,446&#46;&#46;&#46;.Total Support!<br />
25,873&#46;&#46;&#46;&#46;&#46;&#46;&#46;&#46;&#46;.Total Supporters!<br />
688&#46;&#46;&#46;&#46;&#46;&#46;&#46;&#46;&#46;&#46;&#46;&#46;..Total Projects!</span></div>
            </div>
            <div class="clear"></div>
        </div> <!-- End of Content BOTTOM ---------------------------------------------------- -->
        
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>