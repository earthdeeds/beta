<?php
/* 
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

 // Database Variables (edit with your own server information)
 
			$sDatabase = 'shantiom_sandbeta';
			$sHostname = 'localhost';
			$sUsername = 'shantiom_sandbet';
			$sPassword = 'sandbeta';
			$tbl= 'wp_cc_user_account_info';
			$tblproject= 'wp_cc_project_account';
			$tblorg = 'wp_cc_organization_account';
			$tblteam = 'wp_cc_team_account';
			$tblextra = 'wp_cc_user_project_extra_info';
 // Connect to Database
 
  mysql_connect($sHostname, $sUsername, $sPassword) or die(mysql_error());
			mysql_select_db($sDatabase);
?>