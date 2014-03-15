<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://earthdeeds.aws.af.cm/login.php?url=".$_SERVER['REQUEST_URI']);
}
$username = $_SESSION['myusername'];
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
<title>Reduce Page : Earth Deeds</title>
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
        	<div class="box">
<?php		
$username = $_SESSION['myusername'];
?>
	<script type="text/Javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/Javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	

			<style>
			.singular 
			.entry-title, 
			.singular 
			.entry-meta {
    			padding-right: 0;
			}
			.singular
			.entry-title {
    				color: #000000;
    				font-size: 36px;
    				font-weight: bold;
    				margin: -40px 0;
    				text-decoration: none;
   				text-shadow: 1px 4px 6px rgba(0, 0, 0, 0.2), 0 -5px 35px rgba(255, 255, 255, 0.3);
   				font-family: 'Helvetica Neue',sans-serif;
    			}

		</style>
	
<script type="text/javascript">
function getVal(chk, adto,dte){
	if (chk.checked) {
	document.getElementById(adto).value = chk.value;
	document.getElementById(dte).focus();
	document.getElementById(adto).focus();

	}
	else{
		document.getElementById(dte).value = '';
		document.getElementById(adto).value = '';
		document.getElementById(adto).focus();
	}
	}
  
 function getVal2(chk, adto, mult,dte){
	
	if (chk.checked) {
		document.getElementById(adto).value = chk.value*document.getElementById(mult).value;
		document.getElementById(dte).focus();
		document.getElementById(adto).focus();
	}
	else{
		document.getElementById(adto).value = '';
		document.getElementById(mult).value = '';
		document.getElementById(dte).value = '';
		document.getElementById(adto).focus();
		document.getElementById(mult).focus();
	}
  }
 function inputChar(val,chk, adto, mult,dte){
 	if(document.getElementById(mult).value==''){
    	document.getElementById(chk).checked=false;
		document.getElementById(adto).value = '';
		document.getElementById(dte).value = '';
		document.getElementById(adto).focus();
		document.getElementById(mult).focus();
 	}
	else{
		document.getElementById(chk).checked=true;
		document.getElementById(adto).value = val*document.getElementById(mult).value;
		document.getElementById(dte).focus();
		document.getElementById(adto).focus();
		document.getElementById(mult).focus();
	}	
 }

</script>
		

  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
  
  <script>
  $(document).ready(function() {
    	
            $('.datepicker').datepicker({
                minDate: new Date(),
                dateFormat: 'yy-mm-dd',
                beforeShow: function (input, inst) {
         		var offset = $(input).offset();
         		var height = $(input).height();
         		window.setTimeout(function () {
             			inst.dpDiv.css({ top: (offset.top + height+10) + 'px', left: offset.left + 'px' })
         		}, 1);
     		}
            });
        });
    </script>


		
		<form name="myform" method="post" onsubmit="return validateForm()" action="includes/reducecalc.php" class="userform">
		<input type="hidden" value="<?php echo $username; ?>" name="username">
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">HOME</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">kg CO<sub>2</sub>/yr</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Reduction</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="20" onclick="getVal(this, 'home_computer_amt','home_computer_date')"> Plug computer into a power strip and turn off when not in use<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">20</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_computer_amt" id="home_computer_amt" size="7" readonly></td>
				<td><input style="text-align:center" name="home_computer_date" id="home_computer_date" class="datepicker" readonly></td>				
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="109" onclick="getVal(this, 'home_entertain_eq_amt','home_entertain_eq_date')"> Ditto for home entertainment equipment<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">109</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_entertain_eq_amt" id="home_entertain_eq_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_entertain_eq_date" id="home_entertain_eq_date" class="datepicker" readonly></td>	
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="136" onclick="getVal(this, 'home_no_tv_amt','home_no_tv_date')"> Choose not to own a TV<sup><font style="font-weight:bold">15</font></sup></td>
				<td><div style="text-align:center;font-weight:bold">136</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_no_tv_amt" id="home_no_tv_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_no_tv_date" id="home_no_tv_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="227" onclick="getVal(this, 'home_new_energystar_fridge_amt','home_new_energystar_fridge_date')"> Replace a pre-2001 refrigerator with an Energy Star model<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">227</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_new_energystar_fridge_amt" id="home_new_energystar_fridge_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_new_energystar_fridge_date" id="home_new_energystar_fridge_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="318" onclick="getVal(this, 'home_fridge_maint_amt','home_fridge_maint_date')"> Check refrigerator door seals, clean coils, defrost, keep top clear<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">318</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_fridge_maint_amt" id="home_fridge_maint_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_fridge_maint_date" id="home_fridge_maint_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home"  value="363" onclick="getVal(this, 'home_seal_air_leaks_amt','home_seal_air_leaks_date')"> Thoroughly seal air leaks in your home<sup>8</sup></td>
				<td><div style="text-align:center;font-weight:bold">363</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_seal_air_leaks_amt" id="home_seal_air_leaks_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_seal_air_leaks_date" id="home_seal_air_leaks_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="227" onclick="getVal(this, 'home_new_energystar_washer_amt','home_new_energystar_washer_date')"> Replace a washing machine with an Energy Star front load washer<sup>8</sup></td>
				<td><div style="text-align:center;font-weight:bold">227</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_new_energystar_washer_amt" id="home_new_energystar_washer_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_new_energystar_washer_date" id="home_new_energystar_washer_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="318" onclick="getVal(this, 'home_use_clothesline_amt','home_use_clothesline_date')"> Use a clothesline instead of a dryer for 6 months/year<sup>9</sup></td>
				<td><div style="text-align:center;font-weight:bold">318</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_use_clothesline_amt" id="home_use_clothesline_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_use_clothesline_date" id="home_use_clothesline_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="79" onclick="getVal(this, 'home_clean_ac_filter_amt','home_clean_ac_filter_date')"> Clean a dirty air conditioner unit filter<sup>10</sup></td>
				<td><div style="text-align:center;font-weight:bold">79</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_clean_ac_filter_amt" id="home_clean_ac_filter_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_clean_ac_filter_date" id="home_clean_ac_filter_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="977" onclick="getVal(this, 'home_use_no_ac_amt','home_use_no_ac_date')"> Choose not to own an air conditioner<sup>15</sup></td>
				<td><div style="text-align:center;font-weight:bold">977</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_use_no_ac_amt" id="home_use_no_ac_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_use_no_ac_date" id="home_use_no_ac_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="45" onclick="getVal(this, 'home_dishw_energy_saving_amt','home_dishw_energy_saving_date')"> Only run dishwasher when full and use energy-saving setting<sup>9</sup></td>
				<td><div style="text-align:center;font-weight:bold">45</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_dishw_energy_saving_amt" id="home_dishw_energy_saving_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_dishw_energy_saving_date" id="home_dishw_energy_saving_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="57" onclick="getVal(this, 'home_replace_dishw_amt','home_replace_dishw_date')"> Replace a pre-2001 dishwasher with an Energy Star model<sup>8</sup></td>
				<td><div style="text-align:center;font-weight:bold">57</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_replace_dishw_amt" id="home_replace_dishw_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_replace_dishw_date" id="home_replace_dishw_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="110" onclick="getVal(this, 'home_ac_to_74_amt','home_ac_to_74_date')"> Raise air conditioner thermostat to 74<sup>o</sup>F from 72<sup>o</sup>F<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">110</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_ac_to_74_amt" id="home_ac_to_74_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_ac_to_74_date" id="home_ac_to_74_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="220" onclick="getVal(this, 'home_ac_to_76_amt','home_ac_to_76_date')"> Raise air conditioner thermostat to 76<sup>o</sup>F from 72<sup>o</sup>F<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">220</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_ac_to_76_amt" id="home_ac_to_76_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_ac_to_76_date" id="home_ac_to_76_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="54" onclick="getVal(this, 'home_push_lawnmower_amt','home_push_lawnmower_date')"> Replace gas lawnmower with a manual push mower<sup>6</sup></td>
				<td><div style="text-align:center;font-weight:bold">54</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_push_lawnmower_amt" id="home_push_lawnmower_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_push_lawnmower_date" id="home_push_lawnmower_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="45" onclick="getVal(this, 'home_rake_lawn_amt','home_rake_lawn_date')"> Rake a one acre lawn instead of using a leaf blower<sup>6</sup></td>
				<td><div style="text-align:center;font-weight:bold">45</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_rake_lawn_amt" id="home_rake_lawn_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_rake_lawn_date" id="home_rake_lawn_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" id="home_replace_incand_w_cfl_checkbox" name="home_replace_incand_w_cfl_checkbox"  value="25" onclick="getVal2(this, 'home_replace_incand_w_cfl_amt', 'home_replace_incand_w_cfl_var','home_replace_incand_w_cfl_date')">Replace # 75w incand. bukg w/ 19w CFLs<sup>2</sup>
					<font style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#:<input type="text" style="text-align:center" name="home_replace_incand_w_cfl_var" id="home_replace_incand_w_cfl_var" size="4" onkeyup="inputChar(25,'home_replace_incand_w_cfl_checkbox','home_replace_incand_w_cfl_amt', 'home_replace_incand_w_cfl_var','home_replace_incand_w_cfl_date')" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</font>
				</td>
				<td><div style="text-align:center;font-weight:bold">25</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_replace_incand_w_cfl_amt" id="home_replace_incand_w_cfl_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_replace_incand_w_cfl_date" id="home_replace_incand_w_cfl_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="home_purchase_100kW_rec_checkbox" id="home_purchase_100kW_rec_checkbox" value="91" onclick="getVal2(this, 'home_purchase_100kW_rec_amt', 'home_purchase_100kW_rec_var','home_purchase_100kW_rec_date')"> Purchase # 100kWh or &rsquo;&rsquo;Green Electricity&rsquo;&rsquo;<sup>2</sup>
					<font style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#:<input type="text" style="text-align:center" name="home_purchase_100kW_rec_var" id="home_purchase_100kW_rec_var" size="4" onkeyup="inputChar(91,'home_purchase_100kW_rec_checkbox','home_purchase_100kW_rec_amt', 'home_purchase_100kW_rec_var','home_purchase_100kW_rec_date')" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</font>
				</td>
				<td><div style="text-align:center;font-weight:bold">91</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_purchase_100kW_rec_amt" id="home_purchase_100kW_rec_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_purchase_100kW_rec_date" id="home_purchase_100kW_rec_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="home_reduce_showers_checkbox" id="home_reduce_showers_checkbox" value="78" onclick="getVal2(this, 'home_reduce_showers_amt', 'home_reduce_showers_var','home_reduce_showers_date')"> Reduce showers by # minutes for one year<sup>2</sup>
					<font style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#:<input type="text" style="text-align:center" name="home_reduce_showers_var" id="home_reduce_showers_var" size="4" onkeyup="inputChar(78,'home_reduce_showers_checkbox','home_reduce_showers_amt', 'home_reduce_showers_var','home_reduce_showers_date')" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</font>
				</td>
				<td><div style="text-align:center;font-weight:bold">78</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_reduce_showers_amt" id="home_reduce_showers_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_reduce_showers_date" id="home_reduce_showers_date" class="datepicker" readonly></td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="home_plant_trees_checkbox" id="home_plant_trees_checkbox" value="11" onclick="getVal2(this, 'home_plant_trees_amt', 'home_plant_trees_var','home_plant_trees_date')"> Plant # trees<sup>8</sup>
					<font style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#:<input type="text" style="text-align:center" name="home_plant_trees_var" id="home_plant_trees_var" size="4" onkeyup="inputChar(11,'home_plant_trees_checkbox','home_plant_trees_amt', 'home_plant_trees_var','home_plant_trees_date')" value="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</font>
				</td>
				<td><div style="text-align:center;font-weight:bold">11</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_plant_trees_amt" id="home_plant_trees_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_plant_trees_date" id="home_plant_trees_date" class="datepicker" readonly></td>
			</tr>
		</table><br/><br/>
		
		<script type="text/javascript">

function getVal3(rad, adto, dte){

/*for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
	if (chk.checked) {
	document.getElementById(adto).value = radios[i].value;
	document.getElementById(adto).focus();
	}
	else
	{document.getElementById(adto).value = '';}
	}

    }*/
    if (document.getElementById(rad).checked) {
	document.getElementById(adto).value = document.getElementById(rad).value;
	document.getElementById(adto).focus();
	document.getElementById(rad).focus();
    }
    else if(document.getElementById(rad).checked && !document.getElementById(chk).checked){
	document.getElementById(rad).checked=false;
	document.getElementById(adto).value = '';
	document.getElementById(dte).value = '';
	document.getElementById(adto).focus();
	document.getElementById(rad).focus();
    }
    else{
	document.getElementById(rad).checked=false;
	document.getElementById(adto).value = ''; 
	document.getElementById(rad).focus();	
    }
}
	
</script>
		
		
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">HOME (Utility Based)</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Electric</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Gas</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Reduction</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td>Wash clothes in cold water for one year<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" onclick="getVal3('a','home_wash_clothes_cold_w_amt','home_wash_clothes_cold_w_date')" value="113" name="a" id="a"> 113</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" onclick="getVal3('b','home_wash_clothes_cold_w_amt','home_wash_clothes_cold_w_date')" value="50" name="a" id="b"> 50</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_wash_clothes_cold_w_amt" id="home_wash_clothes_cold_w_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_wash_clothes_cold_w_date" id="home_wash_clothes_cold_w_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td>Change showerhead to low-flow device<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="102" id="c" name="b" onclick="getVal3('c','home_low_flow_showerhead_amt','home_low_flow_showerhead_date')"> 102</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="45" id="d" name="b" onclick="getVal3('d','home_low_flow_showerhead_amt','home_low_flow_showerhead_date')"> 45</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_low_flow_showerhead_amt" id="home_low_flow_showerhead_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_low_flow_showerhead_date" id="home_low_flow_showerhead_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td>Lower hot-water thermostat to 130<sup>o</sup>F from 140<sup>o</sup>F<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="109" id="e" name="c" onclick="getVal3('e','home_hot_water_to_130_amt','home_hot_water_to_130_date')"> 109</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="48" id="f" name="c" onclick="getVal3('f','home_hot_water_to_130_amt','home_hot_water_to_130_date')"> 48</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_hot_water_to_130_amt" id="home_hot_water_to_130_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_hot_water_to_130_date" id="home_hot_water_to_130_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td>Lower hot water thermostat to 120<sup>o</sup>F from 140<sup>o</sup>F<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="218" id="g" name="d" onclick="getVal3('g','home_hot_water_to_120_amt','home_hot_water_to_120_date')"> 218</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="96" id="h" name="d" onclick="getVal3('h','home_hot_water_to_120_amt','home_hot_water_to_120_date')"> 96</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_hot_water_to_120_amt" id="home_hot_water_to_120_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_hot_water_to_120_date" id="home_hot_water_to_120_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td>Lower thermostat 68<sup>o</sup>F from 80<sup>o</sup>F in winter<sup>2</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="214" id="i" name="e" onclick="getVal3('i','home_thermostat_to_68_amt','home_thermostat_to_68_date')"> 214</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="290" id="j" name="e" onclick="getVal3('j','home_thermostat_to_68_amt','home_thermostat_to_68_date')"> 290</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_thermostat_to_68_amt" id="home_thermostat_to_68_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_thermostat_to_68_date" id="home_thermostat_to_68_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td>Lower thermostat 66<sup>o</sup>F from 80<sup>o</sup>F in winter<sup>2</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="428" id="k" name="f" onclick="getVal3('k','home_thermostat_to_66_amt','home_thermostat_to_66_date')"> 428</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="581" id="l" name="f" onclick="getVal3('l','home_thermostat_to_66_amt','home_thermostat_to_66_date')"> 581</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_thermostat_to_66_amt" id="home_thermostat_to_66_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_thermostat_to_66_date" id="home_thermostat_to_66_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td>Wrap water heater in an insulating blanket<sup>10</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="499" id="m" name="g" onclick="getVal3('m','home_wrap_water_heater_amt','home_wrap_water_heater_date')"> 499</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="100" id="n" name="g" onclick="getVal3('n','home_wrap_water_heater_amt','home_wrap_water_heater_date')"> 100</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_wrap_water_heater_amt" id="home_wrap_water_heater_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_wrap_water_heater_date" id="home_wrap_water_heater_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td>Caulk and weather strip your homeCont<sup>2</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="214" id="o" name="h" onclick="getVal3('o','home_weatherstrip_amt','home_weatherstrip_date')"> 214</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="290" id="p" name="h" onclick="getVal3('p','home_weatherstrip_amt','home_weatherstrip_date')"> 290</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_weatherstrip_amt" id="home_weatherstrip_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_weatherstrip_date" id="home_weatherstrip_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td>Insulate attic of a six room house<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="2009" id="q" name="i" onclick="getVal3('q','home_insultate_attic_amt','home_insultate_attic_date')"> 2009</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="630" id="r" name="i" onclick="getVal3('r','home_insultate_attic_amt','home_insultate_attic_date')"> 630</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_insultate_attic_amt" id="home_insultate_attic_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_insultate_attic_date" id="home_insultate_attic_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
		</table><br/><br/>

		
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">WASTE</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">#</font></div></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">kg CO<sub>2</sub>/yr</font></div></td>	
				<td><div style="text-align:center;font-weight:bold"><font size="4">Reduction</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste_reuse_plastic_bags_checkbox" id="waste_reuse_plastic_bags_checkbox" value="10" onclick="getVal2(this, 'waste_reuse_plastic_bags_amt', 'waste_reuse_plastic_bags_var','waste_reuse_plastic_bags_date')"> Reduce/re-use # plastic bags/week<sup>3</sup></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_plastic_bags_var" id="waste_reuse_plastic_bags_var" size="10" onkeyup="inputChar(10,'waste_reuse_plastic_bags_checkbox','waste_reuse_plastic_bags_amt', 'waste_reuse_plastic_bags_var','waste_reuse_plastic_bags_date')" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">10</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_reuse_plastic_bags_amt" id="waste_reuse_plastic_bags_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_plastic_bags_date" id="waste_reuse_plastic_bags_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste_reuse_plastic_bottles_checkbox" id="waste_reuse_plastic_bottles_checkbox" value="26" onclick="getVal2(this, 'waste_reuse_plastic_bottles_amt', 'waste_reuse_plastic_bottles_var','waste_reuse_plastic_bottles_date')"> Reduce/re-use # plastic bottles/week<sup>3</sup></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_plastic_bottles_var" id="waste_reuse_plastic_bottles_var" size="10" value="" onkeyup="inputChar(26,'waste_reuse_plastic_bottles_checkbox','waste_reuse_plastic_bottles_amt', 'waste_reuse_plastic_bottles_var','waste_reuse_plastic_bottles_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">26</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_reuse_plastic_bottles_amt" id="waste_reuse_plastic_bottles_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_plastic_bottles_date" id="waste_reuse_plastic_bottles_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste_reuse_alum_cans_checkbox" id="waste_reuse_alum_cans_checkbox" value="8" onclick="getVal2(this, 'waste_reuse_alum_cans_amt', 'waste_reuse_alum_cans_var','waste_reuse_alum_cans_date')"> Reduce/re-use # aluminum cans/week<sup>7</sup></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_alum_cans_var" id="waste_reuse_alum_cans_var" size="10" value="" onkeyup="inputChar(8,'waste_reuse_alum_cans_checkbox','waste_reuse_alum_cans_amt', 'waste_reuse_alum_cans_var','waste_reuse_alum_cans_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">8</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_reuse_alum_cans_amt" id="waste_reuse_alum_cans_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_alum_cans_date" id="waste_reuse_alum_cans_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste_reuse_glass_bottles_checkbox" id="waste_reuse_glass_bottles_checkbox" value="7" onclick="getVal2(this, 'waste_reuse_glass_bottles_amt', 'waste_reuse_glass_bottles_var','waste_reuse_glass_bottles_date')"> Reduce/re-use # glass bottles/week<sup>7</sup></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_glass_bottles_var" id="waste_reuse_glass_bottles_var" size="10" value="" onkeyup="inputChar(7,'waste_reuse_glass_bottles_checkbox','waste_reuse_glass_bottles_amt', 'waste_reuse_glass_bottles_var','waste_reuse_glass_bottles_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">7</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_reuse_glass_bottles_amt" id="waste_reuse_glass_bottles_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_glass_bottles_date" id="waste_reuse_glass_bottles_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste_recycle_paper_checkbox" id="waste_recycle_paper_checkbox" value="5" onclick="getVal2(this, 'waste_recycle_paper_amt', 'waste_recycle_paper_var','waste_recycle_paper_date')"> Recycle # kg paper/week<sup>7</sup></td>
				<td><input type="text" style="text-align:center" name="waste_recycle_paper_var" id="waste_recycle_paper_var" size="10" value="" onkeyup="inputChar(5,'waste_recycle_paper_checkbox','waste_recycle_paper_amt', 'waste_recycle_paper_var','waste_recycle_paper_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">5</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_recycle_paper_amt" id="waste_recycle_paper_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_recycle_paper_date" id="waste_recycle_paper_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste" value="8" onclick="getVal(this, 'waste_bring_own_bags_amt','waste_bring_own_bags_date')"> Bring your own shopping bags to the grocery store<sup>13</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">8</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_bring_own_bags_amt" id="waste_bring_own_bags_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_bring_own_bags_date" id="waste_bring_own_bags_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste" value="42" onclick="getVal(this, 'waste_get_off_junk_mail_amt','waste_get_off_junk_mail_date')"> Take yourself off junk mailing lists<sup>14</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">42</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_get_off_junk_mail_amt" id="waste_get_off_junk_mail_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_get_off_junk_mail_date" id="waste_get_off_junk_mail_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
		</table><br/><br/>
		
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">TRANSPORTATION</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">#</font></div></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">kg CO<sub>2</sub>/yr</font></div></td>	
				<td><div style="text-align:center;font-weight:bold"><font size="4">Reduction</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans_carpool_checkbox" id="trans_carpool_checkbox" value="363" onclick="getVal2(this, 'trans_carpool_amt', 'trans_carpool_var','trans_carpool_date')"> Carpool # days/week<sup>9</sup></td>
				<td><input type="text" style="text-align:center" name="trans_carpool_var" id="trans_carpool_var" size="26" onkeyup="inputChar(363,'trans_carpool_checkbox','trans_carpool_amt', 'trans_carpool_var','trans_carpool_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">363</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_carpool_amt" id="trans_carpool_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_carpool_date" id="trans_carpool_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans_fly_less_miles_checkbox" id="trans_fly_less_miles_checkbox" value="0.7" onclick="getVal2(this, 'trans_fly_less_miles_amt', 'trans_fly_less_miles_var','trans_fly_less_miles_date')"> Fly # fewer km<sup>3</sup></td>
				<td><input type="text" style="text-align:center" name="trans_fly_less_miles_var" id="trans_fly_less_miles_var" size="26" onkeyup="inputChar(0.7,'trans_fly_less_miles_checkbox','trans_fly_less_miles_amt', 'trans_fly_less_miles_var','trans_fly_less_miles_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">0.7</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_fly_less_miles_amt" id="trans_fly_less_miles_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_fly_less_miles_date" id="trans_fly_less_miles_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans_better_mpg_car_checkbox" id="trans_better_mpg_car_checkbox"  value="16" onclick="getVal2(this, 'trans_better_mpg_car_amt', 'trans_better_mpg_car_var','trans_better_mpg_car_date')"> Buy a car with # better kpl than current car<sup>5</sup></td>
				<td><input type="text" style="text-align:center" name="trans_better_mpg_car_var" id="trans_better_mpg_car_var" size="26" onkeyup="inputChar(16,'trans_better_mpg_car_checkbox','trans_better_mpg_car_amt', 'trans_better_mpg_car_var','trans_better_mpg_car_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">16</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_better_mpg_car_amt" id="trans_better_mpg_car_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_better_mpg_car_date" id="trans_better_mpg_car_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
<script type="text/javascript">		
		
		
 function getVal10(chk, adto, temp1, temp2,dte){
	
	if (chk.checked) {
		var divide = document.getElementById(temp1).value/document.getElementById(temp2).value;
		document.getElementById(adto).value = chk.value*divide;
		document.getElementById(dte).focus();
		document.getElementById(adto).focus();	
	}
	else{
		document.getElementById(adto).value = '';
		document.getElementById(temp1).value = '';
		document.getElementById(temp2).value = '';
		document.getElementById(dte).value = '';
		document.getElementById(adto).focus();
	}
  }
   function inputChar10(val,chk, adto, temp1, temp2,dte){
 	if(document.getElementById(temp1).value=='' || document.getElementById(temp2).value==''){
    	document.getElementById(chk).checked=false;
		document.getElementById(dte).value = '';
		document.getElementById(adto).value = '';
		document.getElementById(adto).focus();
 	}
	else {
		var divide = document.getElementById(temp1).value/document.getElementById(temp2).value;
		document.getElementById(chk).checked=true;
		document.getElementById(adto).value = val*divide;
		document.getElementById(adto).focus();
		document.getElementById(dte).focus();
		document.getElementById(temp1).focus();
		document.getElementById(temp2).focus();
	}	
 }

  </script>
				<td><input type="checkbox" name="trans_drive_less_miles_checkbox" id="trans_drive_less_miles_checkbox" value="2143" onclick="getVal10(this, 'trans_drive_less_miles_var', 'tmp1', 'tmp2','trans_drive_less_miles_date')"> Drive # fewer km/week<sup>7</sup></td>
				<!-- Note: Here value for #: input is tmp1 divided by tmp2 = trans_drive_less_miles_var-->
				<td><input type="text" style="text-align:center" name="tmp1" id="tmp1" size="2" onkeyup="inputChar10(2143,'trans_drive_less_miles_checkbox','trans_drive_less_miles_var', 'tmp1', 'tmp2','trans_drive_less_miles_date')"><font size="2">(km/week)</font>&nbsp;&nbsp;/&nbsp;&nbsp;<input type="text" style="text-align:center" name="tmp2" id="tmp2" size="2" onkeyup="inputChar10(566,'trans_drive_less_miles_checkbox','trans_drive_less_miles_var', 'tmp1', 'tmp2','trans_drive_less_miles_date')"><font size="2" >kpl</font></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">2143</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_drive_less_miles_var" id="trans_drive_less_miles_var" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_drive_less_miles_date" id="trans_drive_less_miles_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="93" onclick="getVal(this, 'trans_train_instead_of_flight_amt','trans_train_instead_of_flight_date')"> For a 800 km flight, take the train instead<sup>2</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">93</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_train_instead_of_flight_amt" id="trans_train_instead_of_flight_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_train_instead_of_flight_date" id="trans_train_instead_of_flight_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="408" onclick="getVal(this, 'trans_tun_up_car_amt','trans_tun_up_car_date')"> Tune up your car<sup>7</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">408</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_tun_up_car_amt" id="trans_tun_up_car_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_tun_up_car_date" id="trans_tun_up_car_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="113" onclick="getVal(this, 'trans_car_adeq_tire_press_amt','trans_car_adeq_tire_press_date')"> Maintain adequate tire pressure (usually around 32 psi)<sup>7</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">113</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_car_adeq_tire_press_amt" id="trans_car_adeq_tire_press_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_car_adeq_tire_press_date" id="trans_car_adeq_tire_press_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="227" onclick="getVal(this, 'trans_car_max_tire_press_amt','trans_car_max_tire_press_date')"> Maintain maximum tire pressure (usually around 35 psi)<sup>7</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">227</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_car_max_tire_press_amt" id="trans_car_max_tire_press_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_car_max_tire_press_date" id="trans_car_max_tire_press_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
		</table><br/><br/>
		
<script type="text/javascript" >
 function getVal7(chk, adto, mult,dte){
	
	if (chk.checked) {document.getElementById(adto).value = chk.value*document.getElementById(mult).value;}
	else{
		document.getElementById(adto).value = '';
		document.getElementById(mult).value = '';
		document.getElementById(dte).value = '';
		document.getElementById(adto).focus();
		document.getElementById(mult).focus();
	}
  }
 function inputChar7(val,chk, adto, mult,dte){
 	if(document.getElementById(mult).value==''){
    	document.getElementById(chk).checked=false;
		document.getElementById(adto).value = '';
		document.getElementById(dte).value = '';
		document.getElementById(adto).focus();
		document.getElementById(mult).focus();
 	}
	else if(document.getElementById(mult).value>0 && document.getElementById(mult).value<100){
		document.getElementById(chk).checked=true;
		document.getElementById(adto).value = val*document.getElementById(mult).value/100;
		document.getElementById(dte).focus();
		document.getElementById(adto).focus();
		document.getElementById(mult).focus();
	}
	else if(document.getElementById(mult).value<0 || document.getElementById(mult).value>100){
		document.getElementById(chk).checked=false;
		document.getElementById(dte).value = '';
		document.getElementById(adto).value = '';
		document.getElementById(adto).focus();
		document.getElementById(mult).focus();
	}
		
 }

</script>		
		
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">FOOD</font><font size="2"><em> (Use the % change you are willing to make)</em></font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">%</font></div></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">kg CO<sub>2</sub>/yr</font></div></td>	
				<td><div style="text-align:center;font-weight:bold"><font size="4">Reduction</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food_replace_red_meat_checkbox" id="food_replace_red_meat_checkbox" value="431" onclick="getVal2(this, 'food_replace_red_meat_amt', 'food_replace_red_meat_var','food_replace_red_meat_date')"> Replace red meat with fish, eggs, and poultry<sup>2</sup></td>
				<td><input type="text" style="text-align:center" name="food_replace_red_meat_var" id="food_replace_red_meat_var" size="10" value="" onkeyup="inputChar7(431,'food_replace_red_meat_checkbox','food_replace_red_meat_amt', 'food_replace_red_meat_var','food_replace_red_meat_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">431</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_replace_red_meat_amt" id="food_replace_red_meat_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="food_replace_red_meat_date" id="food_replace_red_meat_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food_meat_to_vegetarian_checkbox" id="food_meat_to_vegetarian_checkbox" value="978" onclick="getVal2(this, 'food_meat_to_vegetarian_amt', 'food_meat_to_vegetarian_var','food_meat_to_vegetarian_date')"> Move from meat diet to ovo-lacto veg. diet<sup>1</sup></td>
				<td><input type="text" style="text-align:center" name="food_meat_to_vegetarian_var" id="food_meat_to_vegetarian_var" size="10" value="" onkeyup="inputChar7(978,'food_meat_to_vegetarian_checkbox','food_meat_to_vegetarian_amt', 'food_meat_to_vegetarian_var','food_meat_to_vegetarian_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">978</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_meat_to_vegetarian_amt" id="food_meat_to_vegetarian_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="food_meat_to_vegetarian_date" id="food_meat_to_vegetarian_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food_vegetarian_to_organic_checkbox" id="food_vegetarian_to_organic_checkbox" value="1417" onclick="getVal2(this, 'food_vegetarian_to_organic_amt', 'food_vegetarian_to_organic_var','food_vegetarian_to_organic_date')"> Move closer to 100% organics as a vegetarian<sup>1</sup></td>
				<td><input type="text" style="text-align:center" name="food_vegetarian_to_organic_var" id="food_vegetarian_to_organic_var" size="10" value="" onkeyup="inputChar7(1417,'food_vegetarian_to_organic_checkbox','food_vegetarian_to_organic_amt', 'food_vegetarian_to_organic_var','food_vegetarian_to_organic_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">1417</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_vegetarian_to_organic_amt" id="food_vegetarian_to_organic_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="food_vegetarian_to_organic_date" id="food_vegetarian_to_organic_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food_vegetarian_to_vegan_checkbox" id="food_vegetarian_to_vegan_checkbox" value="838" onclick="getVal2(this, 'food_vegetarian_to_vegan_amt', 'food_vegetarian_to_vegan_var','food_vegetarian_to_vegan_date')"> Move from ovo-lacto diet to vegan diet<sup>1</sup></td>
				<td><input type="text" style="text-align:center" name="food_vegetarian_to_vegan_var" id="food_vegetarian_to_vegan_var" size="10" value="" onkeyup="inputChar7(838,'food_vegetarian_to_vegan_checkbox','food_vegetarian_to_vegan_amt', 'food_vegetarian_to_vegan_var','food_vegetarian_to_vegan_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">838</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_vegetarian_to_vegan_amt" id="food_vegetarian_to_vegan_amt" size="10"  readonly></td>
				<td><input type="text" style="text-align:center" name="food_vegetarian_to_vegan_date" id="food_vegetarian_to_vegan_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food_vegan_to_organic_checkbox" id="food_vegan_to_organic_checkbox" value="1018" onclick="getVal2(this, 'food_vegan_to_organic_amt', 'food_vegan_to_organic_var','food_vegan_to_organic_date')"> Move closer to 100% organics as a vegan<sup>1</sup></td>
				<td><input type="text" style="text-align:center" name="food_vegan_to_organic_var" id="food_vegan_to_organic_var" size="10" value="" onkeyup="inputChar7(1018,'food_vegan_to_organic_checkbox','food_vegan_to_organic_amt', 'food_vegan_to_organic_var','food_vegan_to_organic_date')"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">1018</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_vegan_to_organic_amt" id="food_vegan_to_organic_amt" size="10" value="" readonly>
				</td>
				<td><input type="text" style="text-align:center" name="food_vegan_to_organic_date" id="food_vegan_to_organic_date" class="datepicker" size="10" value="" readonly></td>
			</tr>
		</table>
		
		<center><input style="height: 30px; width: 150px; font-size: 20px; margin-top: 10px;" type="submit" value="Save" /></center>
		
		</form><br/>
		<h3><div style="margin-left:408px"><font style="font-weight:bold">TOTAL REDUCTIONS</font>&nbsp;&nbsp;=&nbsp;&nbsp; <span id="sum">0</span><!--<input type="text" name="reduct1_total" style="text-align:center;color:#ffffff;font-size:22px;background-color:#cccccc;height:50px" size="5" value="" readonly>--><span style="font-weight:bold">&nbsp;kg CO<sub>2</sub>/yr</span></div></h3>		
		
			
 
 
<script>
    $(document).ready(function(){

        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".txt").each(function() {
 
            $(this).focus(function(){
                calculateSum();
            });
        });
        $(window).keydown(function(event){
    		if(event.keyCode == 13) {
      			event.preventDefault();
      			return false;
    		}
  	});
    });
 
    function calculateSum() {
 
        var sum = 0;
        //iterate through each textboxes and add the values
        $(".txt").each(function() {
 
            //add only if the value is number
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value);
            }
 
        });
        //.toFixed() method will roundoff the final sum to 2 decimal places
        $("#sum").html(sum.toFixed(2));
    }
</script>
		


	<h2>SOURCES</h2>
	<table width="830px" style="font-size:10px;font-weight:bold">
			<tr>
				<td>a. <a href="http://www.eia.doe.gov/oiaf/1605/factors.html" target="_blank">http://www.eia.doe.gov/oiaf/1605/factors.html</a></td>
				<td>4. <a href="http://www.dep.state.fl.us/mainpage/tips/default.htm" target="_blank">http://www.dep.state.fl.us/mainpage/tips/default.htm</a></td>
			</tr>
			<tr>
				<td>b. <a href="http://pdf.wri.org/wri_co2guide.pdf" target="_blank">http://pdf.wri.org/wri_co2guide.pdf</td>
				<td>5. <a href="http://www.epa.gov/climatechange/emissions/ind_calculator.html" target="_blank">http://www.epa.gov/climatechange/emissions/ind_calculator.html</a></td>
			</tr>
			<tr>
				<td>c. <a href="http://en.wikipedia.org/wiki/Short-haul" target="_blank">http://en.wikipedia.org/wiki/Short-haul</a></td>
				<td>6. <a href="http://www.unc.edu/~mccarty/lawncareestimates.htm" target="_blank">http://www.unc.edu/~mccarty/lawncareestimates.htm</a></td>
			</tr>
			<tr>
				<td>d. <a href="http://www.epa.gov/cleanenergy/powerprofiler.htm" target="_blank">http://www.epa.gov/cleanenergy/powerprofiler.htm</a></td>
				<td>7. <a href="http://www.fiu.edu/~envstud/labs/CO2Audit.htm<" target="_blank">http://www.fiu.edu/~envstud/labs/CO2Audit.htm</a></td>
			</tr>
			<tr>
				<td>1. <a href="http://www.chesapeakeclimate.org/pages/page.cfm?page_id=29" target="_blank">http://www.chesapeakeclimate.org/pages/page.cfm?page_id=29</a></td>
				<td>8. Gershon, David. Low Carbon Diet. Empowerment Institute, 2006</td>
			</tr>
			<tr>
				<td>2. <a href="http://www.thegreenguide.com/doc/119/calculator" target="_blank">http://www.thegreenguide.com/doc/119/calculator</a></td>
				<td>9. <a href="http://www.climatecrisis.net/takeaction/whatyoucando/" target="_blank">http://www.climatecrisis.net/takeaction/whatyoucando/</a></td>
			</tr>
			<tr>
				<td>3. <a href="http://www.timeforchange.org/what-is-a-carbon-footprint-definition" target="_blank">http://www.timeforchange.org/what-is-a-carbon-footprint-definition</a></td>
				<td>10. <a href="http://www.powerscorecard.org/reduce_energy.cfm" target="_blank">http://www.powerscorecard.org/reduce_energy.cfm</a></td>
			</tr>
	</table><br/><br/>
        <div class="clear"></div>
        </div>
        </div>
    </div> <!-- End of Content ---------------------------------------------------- -->
    <div class="shadow"></div>
    
<?php include('footer.php'); ?>
    
</div> <!-- End of Container ---------------------------------------------------- -->

</body>
</html>
