<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <script>
            function callResize()
            {
                var height = document.body.scrollHeight;
                parent.resizeIframe(height);
            }
            window.onload =callResize;
			
			function resizeIframe(newHeight)
{
    document.getElementById('blogIframe').style.height = parseInt(newHeight,10) + 10 + 'px';
}
        </script>

    </head>
	
	
	<body onload='parent.resizeIframe(document.body.scrollHeight)'>

	


<?php
$teamid = $_GET['teamid'];
$projid = $_GET['projid'];
$userid = $_GET['userid'];


			$sDatabase = 'shantiom_sandbox';
			$sHostname = 'localhost';
			$sUsername = 'shantiom_sandbox';
			$sPassword = 'sandbox';
			$tbl= 'wp_cc_user_account_info';
			$tblproject= 'wp_cc_project_account';
			$tblorg = 'wp_cc_organization_account';
			$tblteam = 'wp_cc_team_account';
			$tblextra = 'wp_cc_user_project_extra_info';
			mysql_connect($sHostname, $sUsername, $sPassword) or die(mysql_error());
			mysql_select_db($sDatabase);
	 
	if ($banner == 'side'){?>
			<style>
			#widget {
    			border: 2px solid #034022;
				width: 200px;
				text-align: center;
				padding: 5px;
			}
			
</style>
	<div id="widget">
	<?php

		$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projid'") or die(mysql_error());  
		
					while($rowproj = mysql_fetch_array( $resultproj )) {
						$projectteamid = $rowproj['team_idnum'];
						$projectid = $rowproj['project_account_idnum'];
						if ($rowproj['project_profile_photo'] == "images/"){
						echo "<img class=\"alignleft\" border=\"0\" src=\"http://sandbox.earthdeeds.com/projimages/project.jpg\" width=\"102\" alt=\"".$rowproj['project_creator_username']."\">";
						}
						else
						{
						echo "<img class=\"alignleft\" border=\"0\" src=\"http://sandbox.earthdeeds.com/".$rowproj['project_profile_photo']."\" width=\"102\" alt=\"".$rowproj['project_creator_username']."\">";
						}
						echo '</br><span style="color: #0000FF; font-size: 24px;"> '.$rowproj['project_title'].'</span>'; 
						echo '</br></br>'.$rowproj['project_description'];
						$longdesc = html_entity_decode( $rowteam['project_long_description'] );
		
		echo $longdesc;
		}
		?></div><?php
		}
		else
		{?>
			<style>
	#widget {
		border: 2px solid #034022;
		width: 550px;
		padding: 5px;
	}
	.alignleft {
    float: left;
    margin-right: 1.625em;
	
	}
	</style>
	<div id="widget">
		<?php
			$resultproj = mysql_query("SELECT * FROM $tblproject where project_account_idnum = '$projid'") or die(mysql_error());  
		
					while($rowproj = mysql_fetch_array( $resultproj )) {
						$projectteamid = $rowproj['team_idnum'];
						$projectid = $rowproj['project_account_idnum'];
						if ($rowproj['project_profile_photo'] == "images/"){
						echo "<img class=\"alignleft\" border=\"0\" src=\"http://sandbox.earthdeeds.com/projimages/project.jpg\" width=\"102\" alt=\"".$rowproj['project_creator_username']."\">";
						}
						else
						{
						echo "<img class=\"alignleft\" border=\"0\" src=\"http://sandbox.earthdeeds.com/".$rowproj['project_profile_photo']."\" width=\"102\" alt=\"".$rowproj['project_creator_username']."\">";
						}
						echo '<span style="color: #0000FF; font-size: 24px;"> '.$rowproj['project_title'].'</span>'; 
						echo '</br>'.$rowproj['project_description'];
						$longdesc = html_entity_decode( $rowteam['project_long_description'] );
		
		echo '</br></br></br>'.$longdesc;
		}
		?></div> <?php
		}
					
?>
</div>
</body>
</html>

