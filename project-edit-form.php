<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Project Edit Form : Earth Deeds</title>
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

        	<div><span class="style10">Project Edit Form</span></div>
            <div><span class="style14"><a href="#">View Teams Linked on this Project</a></span></div>
            <div><span class="style14"><a href="#">Generate embedded widgets </a></span></div>
      <br />
      	 <div class="box">
        	<div>
                <div style="float: left; width: 300px; height: auto;">
                    <br />
                    <div><span class="style20">Project Title: </span></div>
                    <div><span class="style20">Short Description (140 character limit): </span></div>
                    <div>
                    	<div style="float:left;"><span class="style20">Visible to Public </span><input name="Visible to Public" type="radio" value="" checked style="vertical-align:text-top"/></div>
                        <div style="float:left; margin-left: 10px;"><span class="style20">NOT Visible to Public</span><input name="Visible to Public" type="radio" value="" style="vertical-align:text-top"/></div>
                        <div class="clear"></div>
                    </div>
            	</div>
                <div style="float: left;">

                	<br />
                    <div><input name="" type="text" class="input"/></div>
                    <div><input name="" type="text" class="input"/></div>
                    <div><br /></div>
                </div>
                <div class="clear"></div>
            </div>     
              
            <div>
            	<div style="float: left; width: 150px; height: auto;">
                	<div><span class="style23">Project Profile Image</span></div>
                    <div><img src="images/user-profile.jpg" class="user-profile"/></div>
                    <div><span class="style23">NGO Certification Image</span></div>
                    <div class="user-profile" style="width: 89px; height: 110px; background:#faf7d6;"></div>
                </div>
                <div style="float: left;">
                    <div><br /></div>
                    <div><br /></div>
                    <div><br /></div>
                    <div><br /></div>
                    <div style="margin-top: 12px;">
                    	<div style="float: left;"><input name="" type="text" class="input" style="width: 240px;"/></div>
                      	<div style="float: left; margin-top: 8px; margin-left: 10px;"><div class="button2"><a href="#">Browse...</a></div></div>
                        <div style="float: left; margin-top: 8px; margin-left: 10px;"><div class="button2"><a href="#">Upload</a></div></div>
                        <div class="clear"></div>
                  	</div>
                    <div><br /></div>
                    <div><br /></div>
                    <div><br /></div>
                    <div><br /></div>
                    <div><br /></div>
                    <div><br /></div>
					<div style="margin-top: 12px;">
                    	<div style="float: left;"><input name="" type="text" class="input" style="width: 240px;"/></div>
                      	<div style="float: left; margin-top: 8px; margin-left: 10px;"><div class="button2"><a href="#">Browse...</a></div></div>
                        <div style="float: left; margin-top: 8px; margin-left: 10px;"><div class="button2"><a href="#">Upload</a></div></div>
                        <div class="clear"></div>
                  	</div>
                </div>
                <div class="clear"></div>    
			</div>
            <br />
            <div><!-- NOTE: I DON't KNOW THE CODE ON PUTTING THE EDIT WORD HERE ------------------------------------------------------------------ -->       
            	<img src="images/word.jpg" />
            </div>
            
            <div>
                <div style="float: left; width: 225px; height: auto;">
                    <br />
                    <div><span class="style20">Project Url: </span></div>
                    <div><span class="style20">Street Address:</span></div>
                    <div><span class="style20">City:</span></div>
                    <div><span class="style20">State:</span></div>
                    <div><span class="style20">Project Password:</span></div>
                    <div><span class="style20">Verify Project Password:</span></div>
            	</div>
                <div style="float: left;">

                	<br />
                    <div><input name="" type="text" class="input"/></div>
                    <div><input name="" type="text" class="input"/></div>
                    <div><input name="" type="text" class="input"/></div>
                    <div>
                    	<div style="float: left;"><input name="" type="text" class="input" style="width: 150px;"/></div>
                        <div style="float: left; margin-left: 16px;"><span class="style20">Zip Code:</span></div>
                        <div style="float: left; margin-left: 16px;"><input name="" type="text" class="input" style="width: 150px;"/></div>
                        <div class="clear"></div>
                    </div>
                    <div><input name="" type="text" class="input"/></div>
                    <div><input name="" type="text" class="input"/></div>
                    <div><br /></div>
                </div>
                <div class="clear"></div>
            </div>
            <div style="width: 640px; text-align: right;">
                	<div class="button"><a href="#">UPDATE</a></div>
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
