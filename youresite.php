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

	

<div id="widget">
<?php
$teamid = $_GET['teamid'];
$projid = $_GET['projid'];
$userid = $_GET['userid'];
$banner = $_GET['banner'];


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
	<?php
	
	$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());

						
							while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamuserid = $rowteam['user_account_id'];

						if ($rowteam['team_image'] == "images/"){
						echo "<img class=\"alignleft\" border=\"0\" src=\"http://sandbox.earthdeeds.com/teamimages/team.jpg\" width=\"102\">";						
						}
						else
						{
						echo "<br><img class=\"alignleft\" border=\"0\" src=\"http://sandbox.earthdeeds.com/".$rowteam['team_image']."\" width=\"102\" alt=\"".$rowteam['team_initiator']."\">";
						}
						echo '</br><span style="color: #0000FF; font-size: 24px;"> '.$rowteam['team_title'].'</span>'; 
						echo '</br></br>'.$rowteam['team_description'];
						$longdesc = html_entity_decode( $rowteam['team_long_description'] );
						
					
					$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid' AND user_id = '$userid'") or die(mysql_error());  
					$totalemm = 0;
					while($rowemission = mysql_fetch_array( $resultemission )) {
				
					$emm = $rowemission['member_emmision'];
					$totalemm +=  $emm;
					}
					
					echo '</br><span  style="font-size: 20px; color: #ff0000;">Team Emissions: ';
					if ($emm) {
					$totalteamemm = $totalemm + $rowteam['team_emissions'];
					echo $totalteamemm;
					}
					else
					{
					echo '<font>'.$rowteam['team_emissions'].'</font>';
					}
					echo 'mT</span>';
					
					}
					
					echo $longdesc;
		
		}
		else
		{
		?>
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
	<?php
	
	$resultteam = mysql_query("SELECT * FROM $tblteam where Team_account_idnum = '$teamid'") or die(mysql_error());

						
							while($rowteam = mysql_fetch_array( $resultteam )) {
					$teamuserid = $rowteam['user_account_id'];

						if ($rowteam['team_image'] == "images/"){
						echo "<img class=\"alignleft\" border=\"0\" src=\"http://sandbox.earthdeeds.com/teamimages/team.jpg\" width=\"102\">";						
						}
						else
						{
						echo "<img class=\"alignleft\" border=\"0\" src=\"http://sandbox.earthdeeds.com/".$rowteam['team_image']."\" width=\"102\" alt=\"".$rowteam['team_initiator']."\">";
						}
						echo '<span style="color: #0000FF; font-size: 24px;"> '.$rowteam['team_title'].'</span>'; 
						echo '</br>'.$rowteam['team_description'];
						$longdesc = html_entity_decode( $rowteam['team_long_description'] );
						
					
					$resultemission = mysql_query("SELECT * FROM  wp_cc_team_emmision where team_id = '$teamid' AND user_id = '$userid'") or die(mysql_error());  
					$totalemm = 0;
					while($rowemission = mysql_fetch_array( $resultemission )) {
				
					$emm = $rowemission['member_emmision'];
					$totalemm +=  $emm;
					}
					
					echo '</br><span  style="font-size: 20px; color: #ff0000;">Team Emissions: ';
					if ($emm) {
					$totalteamemm = $totalemm + $rowteam['team_emissions'];
					echo $totalteamemm;
					}
					else
					{
					echo '<font>'.$rowteam['team_emissions'].'</font>';
					}
					echo 'mT</span>';
					
					}
					
					echo $longdesc;
		}
		
?>
</div>
</body>
</html>

