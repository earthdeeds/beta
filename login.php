<?php
require 'facebook.php';
include_once "fbmain.php";
$facebook = new Facebook(array(
  'appId'  => '241738939291376',
  'secret' => '52b2d7acd4729b1d0eb3cf3a17fb5694',
));
session_start();

if(session_is_registered(myusername)){
header("location:http://beta.earthdeeds.com".$url);
}

$autologin = $_GET['autologin'];
$uname = $_GET['uname'];

if ($autologin=="true"){
$myusername = $uname;
session_register("myusername");
}
$teamid = $_GET['teamid'];
$teamreg = $_GET['teamreg'];
$ufb = $_GET['userfb'];
$loginerror = $_GET['loginerror'];
include('connect-db.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login : Earth Deeds</title>
<link rel="stylesheet" type="text/css" href="style.css">


  	<script type="text/javascript">
	function verifynotify(field1, field2, result_id, match_html, nomatch_html) {
		this.field1 = field1;
		this.field2 = field2;
		this.result_id = result_id;
		this.match_html = match_html;
		this.nomatch_html = nomatch_html;
		this.check = function() {
		if (!this.result_id) { return false; }
		if (!document.getElementById){ return false; }
		r = document.getElementById(this.result_id);
		if (!r){ return false; }
		if (this.field1.value != "" && this.field1.value == this.field2.value) {
		r.innerHTML = this.match_html;
		} 
		else if ((this.field1.value != "" && this.field1.value != this.field2.value) || (this.field2.value != "" && this.field1.value != this.field2.value)) {
			r.innerHTML = this.nomatch_html;
		}
		if(this.field1.value == "Password" && this.field2.value == "Repeat Password"){
			r.innerHTML = this.nooutput_html;
		}
		}
	}
	</script>  	
	<style>

		input.input5 {padding: 3px; background:url(images/button5.jpg) repeat; font-family:MyriadPro-Regular, 'Myriad Pro Regular', MyriadPro, 'Myriad Pro', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: bold; color: #fffbd2; text-decoration:none; behavior: url(/border-radius.htc); -moz-border-radius: 25px; -webkit-border-radius: 25px; -khtml-border-radius: 25px;    border-radius: 25px; text-decoration: none; height: 30px;  margin: 0px; text-transform: none;}
	input.inputlog5xx {padding: 3px; font-family:MyriadPro-Regular, 'Myriad Pro Regular', MyriadPro, 'Myriad Pro', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: bold; color: #fffbd2; text-decoration:none; behavior: url(/border-radius.htc); -moz-border-radius: 25px; -webkit-border-radius: 25px; -khtml-border-radius: 25px;    border-radius: 25px; text-decoration: none; height: 30px; margin: 0px; text-transform: none;}
	</style>

</head>

<body>
<div class="header">
    	<div class="logo"></div>
<?php
if ($ufb == "unset"){
unset($user);
}
?>
		
		
		
        <div class="login">
		<?php
		if ($username){
					echo '
        	       	<span class="style1">Logged in as </span><span class="style2"><a href="http://beta.earthdeeds.com/my_stuff/">'.$username.'</a>  | <a href="logout.php">Log Out</a></span> ';  
				
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
    
   <div style="width: auto; margin: auto;"> <!-- start of Content ---------------------------------------------------- -->


<div id="fb-root"></div>
    <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
     <script type="text/javascript">
       FB.init({
         appId  : '<?=$fbconfig['appid']?>',
         status : true, // check login status
         cookie : true, // enable cookies to allow the server to access the session
         xfbml  : true  // parse XFBML
       });
       
     </script>
	
      <div>
        <!-- start of left ---------------------------------------------------- -->


			
			<!-----------------------------------------------fb log-------------------------------------------------------->
			<?php if (!$user) { ?>
	
	<div class="box" style="padding: 20px; width: 280px; margin: 40px auto;">
				<form name="form1" method="post" action="includes/checklogin.php?url=<?php echo $url; ?>">
				<!--<div><img src="images/fb-button.jpg" /></div>-->
				
				<div style="text-align:center;"><span class="style3">Member Login</span></div>
                <br />
				<?php 
				if ($loginerror== "logerror"){	
				echo "<p class=\"errorpassmain\">Error Login Details</p>";
				}
				?>
				<center>
				<input type="hidden" name="teamreg" value="<?php echo $teamreg; ?>" class="userform" size="40" />
				<input type="hidden" name="teamid" value="<?php echo $teamid; ?>" class="userform" size="40" />
				<div><input name="myusername" id="myusername" placeholder="Username" type="text" class="input" style="width: 260px; color: #bababa; font-style: 12px; font-weight: normal;"/></div>
                <div><input name="mypassword" id="mypassword" placeholder="Password" type="password" class="input" style="width: 260px; color: #bababa; font-style: 12px; font-weight: normal;"/></div>
             </center>
				<div>
					<div style="float: left; margin-right: 10px;"><!--<input name="Keep me logged in" type="checkbox" id="Keep me logged in" value="Keep me logged in" checked="checked" /><span class="style8" style="vertical-align: top;">Keep me logged in</span></div>
                  	<div style="float: right; width: 135px;"><span class="style8"><a href="#">Forgot your password?</a></span></div>-->
                   	<div class="clear"></div>
				</div>

				<div style="margin: auto; text-align: center;">
					<input type="submit" name="Submit" class="inputlog5xx" value="Login" style="text-align: center; width: 280px;">
				</div>
				</form>
	</div> 
		  <center><a class="style2" href="Pass-update.php?type=user">Forgot Password?</a></center>	
	 </br>
		 <div style="text-align:center;"><span class="style33">No account? 
				<?php	if ($teamreg == "member"){	
				echo "<a href=\"User-Registration.php?teamid=".$teamid."&teamreg=member\">Sign up</a>";
				}
				else
				{
				echo '<a href="User-Registration.php">Sign up</a>';
				}
				?>
				</span></div>
				<div style="text-align:center;"><span class="style33">or</span></div>
				<div><a style="text-decoration: none;"  href="<?=$loginUrl?>"><input type = "submit" name="submit" class="input5" value="Sign in with Facebook" style="text-align: center; width: 280px;"></a></div>

				<?php } else { ?>
				<div class="box" style="padding: 20px; width: 280px; margin: 40px auto;">
				<div style="text-align:center;">

				<div style="text-align:center;"><span class="style5">Login using this account?</span></div>
				<span class="style8"><a href="<?=$logoutUrl?>">Facebook Logout</a></span> | <span class="style8"><a href="login.php?userfb=unset">Back to normal user login</a></span>
				</div>
				<?php 

				$fbsign = $_GET['fbsign'];
				if ($fbsign == 'false') {

				}
				else
				{
				?>
				
	            <div class="box">
				
				<?php 
				if ($loginerror== "logerror"){	
				echo "<p class=\"errorpassmain\">Error Login Details</p>";
				}
				?>
				<div style="text-align:center;">
				<form name="form1" method="post" action="includes/checklogin.php?url=<?php echo $url; ?>">
				
				<input type="hidden" value = "<?php echo $userInfo['name']; ?>" name="name" />
				<input type="hidden" value = "<?php echo $userInfo['first_name']; ?>" name="firstname" /> 
				<input type="hidden" value = "<?php echo $userInfo['last_name']; ?>" name="lastname" />
				<input type="hidden" value = "<?php echo $userInfo['username']; ?>" name="fbusername" />
				<input type="hidden" value = "<?php echo $userInfo['email']; ?>" name="email" />
				<input type="hidden" value = "<?php echo $userInfo['gender']; ?>" name="gender"  />
				
				<input name="identify" type="hidden" id="myusername" value = "fblogin"/>
				
				
				<?php //d($fqlResult); 
			    echo '<img src="'.$fqlResult[0]['pic_square'].'" width="150px" height="150px" />';
			   $imgprofile = $fqlResult[0]['pic_square'];
			    echo '</br>';
				echo 'Welcome '.$userInfo['name']; 
				echo '<input type="hidden" name="imgpro" value="'.$imgprofile.'" class="userform" />';
				echo '</br></br><input type="submit" name="Submit" value="Login with Facebook" />';
				//echo '</br><span class="style8">note: (first time on this page, please sign-up below to get youre password)</span>';
			   
			   ?>
			   </form>
			   </br>
			 <!-- <span class="style8"><a href ="login.php?fbmember=true&fbsign=false">Signup Here</a> with youre facebook account</span>-->
			  </div>
            </div>
				
</div>
    <?php }} ?>
	
<?php 

$fbmember = $_GET['fbmember'];
if ($fbmember == 'true') {
?>
    <!-- all time check if user session is valid or not -->
    <?php if ($user){ ?>
				<div style="text-align:center;">
	                <div class="box">
				<?php //d($fqlResult); 
			    echo '<img src="'.$fqlResult[0]['pic_square'].'" width="150px" height="150px" />';
			   $imgprofile = $fqlResult[0]['pic_square'];	
			   ?>
                </div>
                </div>

                <!-- Data retrived from user profile are shown here -->
                <div class="box">
                    <?php// d($userInfo); ?>
					
					<form name="userform" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" action="includes/submituser.php" class="userform">

				 <!--<span class="style8">(note details can not be changed except for the password)</span></br>-->
				<div style="text-align:center;"><span class="style8" style="font-weight: bolder;"><a href ="<?php echo $userInfo['link']; ?>" target="_blank">Click here to view your Profile</a></span></div></br>
				<span class="style8">Name:  <?php echo $userInfo['name']; ?> </span></br>
				<span class="style8">First Name:  <?php echo $userInfo['first_name']; ?> </span></br>
				<span class="style8">	Last Name: <?php echo $userInfo['last_name']; ?> </span></br>
				<span class="style8">Username:  <?php echo $userInfo['username']; ?>  </span></br>
				<span class="style8">Email: <?php echo $userInfo['email']; ?> </span> </span></br>
				<span class="style8">Gender:   <?php echo $userInfo['gender']; ?> </span></br>
				<input type="hidden" name="identify" value="userfb" class="userform" />
				<input type="hidden" name="imgpro" value="<?php echo $imgprofile; ?>" class="userform" />
				<span class="style8">Password:  </span><!--<input type="password" name="password"  class="userform" size="40" />-->
				<input name="password" placeholder="Password" type="password" class="input" style="width: 250px;" onkeyup="verify.check()" onfocus="if (this.value=='Password') this.value = ''"; onblur="if (this.value=='') this.value ='Password'"; id="input" /> <br />
				<input name="password2" placeholder="Repeat Password" type="password" class="input" style="width: 250px;" onkeyup="verify.check()" id="input" onfocus="if (this.value=='Repeat Password') this.value = ''"; onblur="if (this.value=='') this.value = 'Repeat Password'"; />&nbsp; <span id="password_result" style="color:red"></span>
				
				</br></br>
				<div style="text-align:center;"><input type="submit" name="Submit" value="Register Facebook Profile"></div>
				</form>
					
                </div>


    <?php }} ?>

		<script type="text/javascript">
			verify = new verifynotify();
			verify.field1 = document.userform.password;
			verify.field2 = document.userform.password2;
			verify.result_id = "password_result";
			verify.match_html = "<SPAN STYLE=\"color:green\">Match<\/SPAN>";
			verify.nomatch_html = "<SPAN STYLE=\"color:red\">MisMatch<\/SPAN>";
			verify.nooutput_html = "<SPAN STYLE=\"color:red\"><\/SPAN>";
			verify.check();
		</script>		
				
				
<!------------------------------------------------fb log end------------------------------------------------------->	
			
			
			
			
			
			
			
			
        
        <div class="clear"></div>
		</div>
<!-- End of Content ---------------------------------------------------- -->
   </div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>