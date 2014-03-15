<?php
session_start();
if(!session_is_registered(myusername)){
header("location:http://beta.earthdeeds.com/system-login/");
}
/**
 * Template Name: Reduce Tool template
 * Description: A Page Template that adds a sidebar to pages
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); 

$username = $_SESSION['myusername'];
?>
	<script type="text/Javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/Javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

	
<div id="primary">
	<div id="content" role="main">	

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

    		<?php			

    			echo '</style><div style="float: right;">You are logged in as, <em><a href="http://beta.earthdeeds.com/my_stuff/">';
			echo $username; 
			echo '</a></em> | <a href="http://beta.earthdeeds.com/logout.php">Logout</a></div><br/>';
    			echo'<div><em><font style="font-weight:bold">Directions:</font> When there is a button or box to fill out in the middle of the chart, do that first and then hit the button on the left to calculate the total for the line.</em></div><br/><br/>
    			<h1 class="entry-title" style = "font-size: 24px;">Carbon Commitment Calculator</h1><br/><br/>';
			?>	
	
			<script type="text/javascript">
			function getVal(chk, adto){
				if (chk.checked) {
				document.getElementById(adto).value = chk.value;
				document.getElementById(adto).focus();

				}
				else
				{document.getElementById(adto).value = '';}
				}
			  
			 function getVal2(chk, adto, mult){
				
				if (chk.checked) {document.getElementById(adto).value = chk.value*document.getElementById(mult).value;}
				else
			  
				{document.getElementById(adto).value = '';}
			  }

			</script>



			  
			  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
			  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
			  
			  <script>
			  $(document).ready(function() {
				
				$('.datepicker').datepicker({ minDate: new Date() });

			  });
			  </script>





		<form name="myform" method="post" onsubmit="return validateForm()" action="http://beta.earthdeeds.com/reducecalc.php" class="userform">
		<input type="hidden" value="<?php echo $username; ?>" name="username">
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">HOME</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">lbs CO<sub>2</sub>/yr</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Offset</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="43" onclick="getVal(this, 'home_computer_amt')"> Plug computer into a power strip and turn off when not in use<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">43</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_computer_amt" id="home_computer_amt" size="7" readonly></td>
				<td><input style="text-align:center" name="home_computer_date" id="home_computer_date" class="datepicker" /></td>				
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="240" onclick="getVal(this, 'home_entertain_eq_amt')"> Ditto for home entertainment equipment<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">240</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_entertain_eq_amt" id="home_entertain_eq_amt" size="7" value="" readonly></td>
				<td><input style="text-align:center" name="home_entertain_eq_date" id="home_entertain_eq_date" class="datepicker" /></td>	
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="300" onclick="getVal(this, 'home_no_tv_amt')"> Choose not to own a TV<sup><font style="font-weight:bold">15</font></sup></td>
				<td><div style="text-align:center;font-weight:bold">300</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_no_tv_amt" id="home_no_tv_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_no_tv_date" id="home_no_tv_date"  class="datepicker" /></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="500" onclick="getVal(this, 'home_new_energystar_fridge_amt')"> Replace a pre-2001 refrigerator with an Energy Star model<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">500</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_new_energystar_fridge_amt" id="home_new_energystar_fridge_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_new_energystar_fridge_date" id="home_new_energystar_fridge_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="700" onclick="getVal(this, 'home_fridge_maint_amt')"> Check refrigerator door seals, clean coils, defrost, keep top clear<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">700</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_fridge_maint_amt" id="home_fridge_maint_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_fridge_maint_date" id="home_fridge_maint_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home"  value="800" onclick="getVal(this, 'home_seal_air_leaks_amt')"> Thoroughly seal air leaks in your home<sup>8</sup></td>
				<td><div style="text-align:center;font-weight:bold">800</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_seal_air_leaks_amt" id="home_seal_air_leaks_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_seal_air_leaks_date" id="home_seal_air_leaks_amt" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="500" onclick="getVal(this, 'home_new_energystar_washer_amt')"> Replace a washing machine with an Energy Star front load washer<sup>8</sup></td>
				<td><div style="text-align:center;font-weight:bold">500</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_new_energystar_washer_amt" id="home_new_energystar_washer_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_new_energystar_washer_date" id="home_new_energystar_washer_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="700" onclick="getVal(this, 'home_use_clothesline_amt')"> Use a clothesline instead of a dryer for 6 months/year<sup>9</sup></td>
				<td><div style="text-align:center;font-weight:bold">700</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_use_clothesline_amt" id="home_use_clothesline_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_use_clothesline_date" id="home_use_clothesline_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="175" onclick="getVal(this, 'home_clean_ac_filter_amt')"> Clean a dirty air conditioner unit filter<sup>10</sup></td>
				<td><div style="text-align:center;font-weight:bold">175</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_clean_ac_filter_amt" id="home_clean_ac_filter_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_clean_ac_filter_date" id="home_clean_ac_filter_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="2155" onclick="getVal(this, 'home_use_no_ac_amt')"> Choose not to own an air conditioner<sup>15</sup></td>
				<td><div style="text-align:center;font-weight:bold">2155</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_use_no_ac_amt" id="home_use_no_ac_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_use_no_ac_date" id="home_use_no_ac_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="100" onclick="getVal(this, 'home_dishw_energy_saving_amt')"> Only run dishwasher when full and use energy-saving setting<sup>9</sup></td>
				<td><div style="text-align:center;font-weight:bold">100</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_dishw_energy_saving_amt" id="home_dishw_energy_saving_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_dishw_energy_saving_date" id="home_dishw_energy_saving_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="125" onclick="getVal(this, 'home_replace_dishw_amt')"> Replace a pre-2001 dishwasher with an Energy Star model<sup>8</sup></td>
				<td><div style="text-align:center;font-weight:bold">125</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_replace_dishw_amt" id="home_replace_dishw_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_replace_dishw_date" id="home_replace_dishw_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="242" onclick="getVal(this, 'home_ac_to_74_amt')"> Raise air conditioner thermostat to 74<sup>o</sup>F from 72<sup>o</sup>F<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">242</div></td>	
				<td><input class="txt" type="text" style="text-align:center" name="home_ac_to_74_amt" id="home_ac_to_74_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_ac_to_74_date" id="home_ac_to_74_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="484" onclick="getVal(this, 'home_ac_to_76_amt')"> Raise air conditioner thermostat to 76<sup>o</sup>F from 72<sup>o</sup>F<sup>2</sup></td>
				<td><div style="text-align:center;font-weight:bold">484</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_ac_to_76_amt" id="home_ac_to_76_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_ac_to_76_date" id="home_ac_to_76_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="120" onclick="getVal(this, 'home_push_lawnmower_amt')"> Replace gas lawnmower with a manual push mower<sup>6</sup></td>
				<td><div style="text-align:center;font-weight:bold">120</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_push_lawnmower_amt" id="home_push_lawnmower_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_push_lawnmower_date" id="home_push_lawnmower_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="home" value="100" onclick="getVal(this, 'home_rake_lawn_amt')"> Rake a one acre lawn instead of using a leaf blower<sup>6</sup></td>
				<td><div style="text-align:center;font-weight:bold">100</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_rake_lawn_amt" id="home_rake_lawn_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_rake_lawn_date" id="home_rake_lawn_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="home" value="55" onclick="getVal2(this, 'home_replace_incand_w_cfl_amt', 'home_replace_incand_w_cfl_var')">Replace # 75w incand. bulbs w/ 19w CFLs<sup>2</sup>
					<font style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#:<input type="text" style="text-align:center" name="home_replace_incand_w_cfl_var" id="home_replace_incand_w_cfl_var" size="4" value="1" onfocus="value=''">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</font>
				</td>
				<td><div style="text-align:center;font-weight:bold">55</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_replace_incand_w_cfl_amt" id="home_replace_incand_w_cfl_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_replace_incand_w_cfl_date" id="home_replace_incand_w_cfl_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="home" value="200" onclick="getVal2(this, 'home_purchase_100kW_rec_amt', 'home_purchase_100kW_rec_var')"> Purchase # 100kWh or &rsquo;&rsquo;Green Electricity&rsquo;&rsquo;<sup>2</sup>
					<font style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#:<input type="text" style="text-align:center" name="home_purchase_100kW_rec_var" id="home_purchase_100kW_rec_var" size="4" value="1" onfocus="value=''">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</font>
				</td>
				<td><div style="text-align:center;font-weight:bold">200</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_purchase_100kW_rec_amt" id="home_purchase_100kW_rec_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_purchase_100kW_rec_date" id="home_purchase_100kW_rec_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="home" value="171" onclick="getVal2(this, 'home_reduce_showers_amt', 'home_reduce_showers_var')"> Reduce showers by # minutes for one year<sup>2</sup>
					<font style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#:<input type="text" style="text-align:center" name="home_reduce_showers_var" id="home_reduce_showers_var" size="4" value="1" onfocus="value=''">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</font>
				</td>
				<td><div style="text-align:center;font-weight:bold">171</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_reduce_showers_amt" id="home_reduce_showers_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_reduce_showers_date" id="home_reduce_showers_date" size="7" value="" readonly></td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="home" value="25" onclick="getVal2(this, 'home_plant_trees_amt', 'home_plant_trees_var')"> Plant # trees<sup>8</sup>
					<font style="font-weight:bold">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#:<input type="text" style="text-align:center" name="home_plant_trees_var" id="home_plant_trees_var" size="4" value="1" onfocus="value=''">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</font>
				</td>
				<td><div style="text-align:center;font-weight:bold">25</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_plant_trees_amt" id="home_plant_trees_amt" size="7" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_plant_trees_date" id="home_plant_trees_date" size="7" value="" readonly></td>
			</tr>
		</table><br/><br/>
		
		<script type="text/javascript">
function getVal3(chk, adto, rad){
var radios = document.getElementsByName(rad);
for (var i = 0, length = radios.length; i < length; i++) {
    if (radios[i].checked) {
	if (chk.checked) {
	document.getElementById(adto).value = radios[i].value;
	document.getElementById(adto).focus();
	}
	else
	{document.getElementById(adto).value = '';}
	}

    }
}
	
</script>
		
		
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">HOME (Utility Based)</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Electric</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Gas</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Offset</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="homeCont" onclick="getVal3(this, 'home_wash_clothes_cold_w_amt', 'a')"> Wash clothes in cold water for one year<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="250" name="a" id="a"> 250</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="110" name="a" id="a"> 110</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_wash_clothes_cold_w_amt" id="home_wash_clothes_cold_w_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_wash_clothes_cold_w_date" id="home_wash_clothes_cold_w_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="homeCont" onclick="getVal3(this, 'home_low_flow_showerhead_amt', 'b')"> Change showerhead to low-flow device<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="225" id="b" name="b"> 225</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="100" id="b" name="b"> 100</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_low_flow_showerhead_amt" id="home_low_flow_showerhead_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_low_flow_showerhead_date" id="home_low_flow_showerhead_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="homeCont" onclick="getVal3(this, 'home_hot_water_to_130_amt', 'c')"> Lower hot-water thermostat to 130<sup>o</sup>F from 140<sup>o</sup>F<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="240" id="c" name="c"> 240</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="106" id="c" name="c"> 106</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_hot_water_to_130_amt" id="home_hot_water_to_130_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_hot_water_to_130_date" id="home_hot_water_to_130_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="homeCont" onclick="getVal3(this, 'home_hot_water_to_120_amt', 'd')"> Lower hot water thermostat to 120<sup>o</sup>F from 140<sup>o</sup>F<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="480" id="d" name="d"> 480</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="212" id="d" name="d"> 212</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_hot_water_to_120_amt" id="home_hot_water_to_120_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_hot_water_to_120_date" id="home_hot_water_to_120_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="homeCont" onclick="getVal3(this, 'home_thermostat_to_68_amt', 'e')"> Lower thermostat 68<sup>o</sup>F from 80<sup>o</sup>F in winter<sup>2</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="472" id="e" name="e"> 472</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="640" id="e" name="e"> 640</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_thermostat_to_68_amt" id="home_thermostat_to_68_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_thermostat_to_68_date" id="home_thermostat_to_68_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="homeCont" onclick="getVal3(this, 'home_thermostat_to_66_amt', 'f')"> Lower thermostat 66<sup>o</sup>F from 80<sup>o</sup>F in winter<sup>2</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="944" id="f" name="f"> 944</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="1280" id="f" name="f"> 1280</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_thermostat_to_66_amt" id="home_thermostat_to_66_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_thermostat_to_66_date" id="home_thermostat_to_66_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="homeCont" onclick="getVal3(this, 'home_wrap_water_heater_amt', 'g')"> Wrap water heater in an insulating blanket<sup>10</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="1100" id="g" name="g"> 1100</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="220" id="g" name="g"> 220</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_wrap_water_heater_amt" id="home_wrap_water_heater_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_wrap_water_heater_date" id="home_wrap_water_heater_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="homeCont" onclick="getVal3(this, 'home_weatherstrip_amt', 'h')"> Caulk and weather strip your homeCont<sup>2</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="472" id="h" name="h"> 472</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="639" id="h" name="h"> 639</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_weatherstrip_amt" id="home_weatherstrip_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_weatherstrip_date" id="home_weatherstrip_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="homeCont" onclick="getVal3(this, 'home_insultate_attic_amt', 'i')"> Insulate attic of a six room house<sup>8</sup></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="4430" id="i" name="i"> 4430</div></td>
				<td><div style="text-align:left;font-weight:bold"><input type="radio" value="1390" id="i" name="i"> 1390</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="home_insultate_attic_amt" id="home_insultate_attic_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="home_insultate_attic_date" id="home_insultate_attic_date" size="10" value="" readonly></td>
			</tr>
		</table><br/><br/>
		
<script type="text/javascript">		
		
		
 function getVal4(chk, adto, mult){
	
	if (chk.checked) {
	document.getElementById(adto).value = chk.value*document.getElementById(mult).value;
	document.getElementById(adto).focus();
	}
	else
  
	{document.getElementById(adto).value = '';}
  }
  
  </script>
		
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">WASTE</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">#</font></div></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">lbs CO<sub>2</sub>/yr</font></div></td>	
				<td><div style="text-align:center;font-weight:bold"><font size="4">Offset</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste" value="23" onclick="getVal4(this, 'waste_reuse_plastic_bags_amt', 'waste_reuse_plastic_bags_var')"> Reduce/re-use # plastic bags/week<sup>3</sup></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_plastic_bags_var" id="waste_reuse_plastic_bags_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">23</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_reuse_plastic_bags_amt" id="waste_reuse_plastic_bags_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_plastic_bags_date" id="waste_reuse_plastic_bags_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste" value="57" onclick="getVal4(this, 'waste_reuse_plastic_bottles_amt', 'waste_reuse_plastic_bottles_var')"> Reduce/re-use # plastic bottles/week<sup>3</sup></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_plastic_bottles_var" id="waste_reuse_plastic_bottles_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">57</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_reuse_plastic_bottles_amt" id="waste_reuse_plastic_bottles_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_plastic_bottles_date" id="waste_reuse_plastic_bottles_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste" value="18" onclick="getVal4(this, 'waste_reuse_alum_cans_amt', 'waste_reuse_alum_cans_var')"> Reduce/re-use # aluminum cans/week<sup>7</sup></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_alum_cans_var" id="waste_reuse_alum_cans_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">18</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_reuse_alum_cans_amt" id="waste_reuse_alum_cans_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_alum_cans_date" id="waste_reuse_alum_cans_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste" value="16" onclick="getVal4(this, 'waste_reuse_glass_bottles_amt', 'waste_reuse_glass_bottles_var')"> Reduce/re-use # glass bottles/week<sup>7</sup></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_glass_bottles_var" id="waste_reuse_glass_bottles_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">16</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_reuse_glass_bottles_amt" id="waste_reuse_glass_bottles_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_reuse_glass_bottles_date" id="waste_reuse_glass_bottles_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste" value="10" onclick="getVal4(this, 'waste_recycle_paper_amt', 'waste_recycle_paper_var')"> Recycle # lbs paper/week<sup>7</sup></td>
				<td><input type="text" style="text-align:center" name="waste_recycle_paper_var" id="waste_recycle_paper_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">10</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_recycle_paper_amt" id="waste_recycle_paper_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_recycle_paper_date" id="waste_recycle_paper_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste" value="17" onclick="getVal(this, 'waste_bring_own_bags_amt')"> Bring your own shopping bags to the grocery store<sup>13</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">17</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_bring_own_bags_amt" id="waste_bring_own_bags_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_bring_own_bags_date" id="waste_bring_own_bags_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="waste" value="92" onclick="getVal(this, 'waste_get_off_junk_mail_amt')"> Take yourself off junk mailing lists<sup>14</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">92</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="waste_get_off_junk_mail_amt" id="waste_get_off_junk_mail_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="waste_get_off_junk_mail_date" id="waste_get_off_junk_mail_date" size="10" value="" readonly></td>
			</tr>
		</table><br/><br/>
		
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">TRANSPORTATION</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">#</font></div></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">lbs CO<sub>2</sub>/yr</font></div></td>	
				<td><div style="text-align:center;font-weight:bold"><font size="4">Offset</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="800" onclick="getVal4(this, 'trans_carpool_amt', 'trans_carpool_var')"> Carpool # days/week<sup>9</sup></td>
				<td><input type="text" style="text-align:center" name="trans_carpool_var" id="trans_carpool_var" size="16"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">800</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_carpool_amt" id="trans_carpool_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_carpool_date" id="trans_carpool_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="0.9" onclick="getVal4(this, 'trans_fly_less_miles_amt', 'trans_fly_less_miles_var')"> Fly # fewer miles<sup>3</sup></td>
				<td><input type="text" style="text-align:center" name="trans_fly_less_miles_var" id="trans_fly_less_miles_var" size="16"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">0.9</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_fly_less_miles_amt" id="trans_fly_less_miles_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_fly_less_miles_date" id="trans_fly_less_miles_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans"  value="83" onclick="getVal4(this, 'trans_better_mpg_car_amt', 'trans_better_mpg_car_var')"> Buy a car with # better mpg than current car<sup>5</sup></td>
				<td><input type="text" style="text-align:center" name="trans_better_mpg_car_var" id="trans_better_mpg_car_var" size="16"></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">83</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_better_mpg_car_amt" id="trans_better_mpg_car_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_better_mpg_car_date" id="trans_better_mpg_car_date" size="10" value="" readonly></td>
			</tr>
			<tr>
<script type="text/javascript">		
		
		
 function getVal10(chk, adto, temp1, temp2){
	
	if (chk.checked) {
	var divide = document.getElementById(temp1).value/document.getElementById(temp2).value;
	document.getElementById(adto).value = chk.value*divide;
	document.getElementById(adto).focus();
	}
	else
  
	{document.getElementById(adto).value = '';}
  }
  
  </script>
				<td><input type="checkbox" name="trans" value="1248" onclick="getVal10(this, 'trans_drive_less_miles_var', 'tmp1', 'tmp2')"> Drive # fewer miles/week<sup>7</sup></td>
				<!-- Note: Here value for #: input is tmp1 divided by tmp2 = trans_drive_less_miles_var-->
				<td><input type="text" style="text-align:center" name="tmp1" id="tmp1" size="2"><font style="font-size:10px">mi</font>&nbsp;/&nbsp;&nbsp;<input type="text" style="text-align:center" name="tmp2" id="tmp2" size="2"><font style="font-size:10px">mpg</font></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">1248</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_drive_less_miles_var" id="trans_drive_less_miles_var" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_drive_less_miles_date" id="trans_drive_less_miles_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="205" onclick="getVal(this, 'trans_train_instead_of_flight_amt')"> For a 500 mile flight, take the train instead<sup>2</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">205</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_train_instead_of_flight_amt" id="trans_train_instead_of_flight_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_train_instead_of_flight_date" id="trans_train_instead_of_flight_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="900" onclick="getVal(this, 'trans_tun_up_car_amt')"> Tune up your car<sup>7</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">900</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_tun_up_car_amt" id="trans_tun_up_car_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_tun_up_car_date" id="trans_tun_up_car_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="250" onclick="getVal(this, 'trans_car_adeq_tire_press_amt')"> Maintain adequate tire pressure (usually around 32 psi)<sup>7</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">250</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_car_adeq_tire_press_amt" id="trans_car_adeq_tire_press_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_car_adeq_tire_press_date" id="trans_car_adeq_tire_press_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="trans" value="500" onclick="getVal(this, 'trans_car_max_tire_press_amt')"> Maintain maximum tire pressure (usually around 35 psi)<sup>7</sup></td>
				<td></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold">500</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="trans_car_max_tire_press_amt" id="trans_car_max_tire_press_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="trans_car_max_tire_press_date" id="trans_car_max_tire_press_date" size="10" value="" readonly></td>
			</tr>
		</table><br/><br/>
		
		
		<script type="text/javascript">		
		
		
 function getVal7(chk, adto, mult){
	
	if (chk.checked) {
	document.getElementById(adto).value = chk.value*document.getElementById(mult).value/100;
	document.getElementById(adto).focus();
	}
	else
  
	{document.getElementById(adto).value = '';}
  }
  
  </script>
		
		<table border="1" width="850px" align="center">
			<tr>
				<td><div style="text-align:center;font-weight:bold"><font size="4">FOOD</font><font size="2"><em> (Use the % change you are willing to make)</em></font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">%</font></div></td>
				<td></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">lbs CO<sub>2</sub>/yr</font></div></td>	
				<td><div style="text-align:center;font-weight:bold"><font size="4">Offset</font></div></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">Start Date</font></div></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food" value="950" onclick="getVal7(this, 'food_replace_red_meat_amt', 'food_replace_red_meat_var')"> Replace red meat with fish, eggs, and poultry<sup>2</sup></td>
				<td><input type="text" style="text-align:center" name="food_replace_red_meat_var" id="food_replace_red_meat_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">950</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_replace_red_meat_amt" id="food_replace_red_meat_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="food_replace_red_meat_date" id="food_replace_red_meat_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food" value="2156" onclick="getVal7(this, 'food_meat_to_vegetarian_amt', 'food_meat_to_vegetarian_var')"> Move from meat diet to ovo-lacto veg. diet<sup>1</sup></td>
				<td><input type="text" style="text-align:center" name="food_meat_to_vegetarian_var" id="food_meat_to_vegetarian_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">2156</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_meat_to_vegetarian_amt" id="food_meat_to_vegetarian_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="food_meat_to_vegetarian_date" id="food_meat_to_vegetarian_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food" value="3124" onclick="getVal7(this, 'food_vegetarian_to_organic_amt', 'food_vegetarian_to_organic_var')"> Move closer to 100% organics as a vegetarian<sup>1</sup></td>
				<td><input type="text" style="text-align:center" name="food_vegetarian_to_organic_var" id="food_vegetarian_to_organic_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">3,124</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_vegetarian_to_organic_amt" id="food_vegetarian_to_organic_amt" size="10" value="" readonly></td>
				<td><input type="text" style="text-align:center" name="food_vegetarian_to_organic_date" id="food_vegetarian_to_organic_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food" value="1848" onclick="getVal7(this, 'food_vegetarian_to_vegan_amt', 'food_vegetarian_to_vegan_var')"> Move from ovo-lacto diet to vegan diet<sup>1</sup></td>
				<td><input type="text" style="text-align:center" name="food_vegetarian_to_vegan_var" id="food_vegetarian_to_vegan_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">1,848</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_vegetarian_to_vegan_amt" id="food_vegetarian_to_vegan_amt" size="10"  readonly></td>
				<td><input type="text" style="text-align:center" name="food_vegetarian_to_vegan_date" id="food_vegetarian_to_vegan_date" size="10" value="" readonly></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="food" value="2244" onclick="getVal7(this, 'food_vegan_to_organic_amt', 'food_vegan_to_organic_var')"> Move closer to 100% organics as a vegan<sup>1</sup></td>
				<td><input type="text" style="text-align:center" name="food_vegan_to_organic_var" id="food_vegan_to_organic_var" size="10" value=""></td>
				<td><div style="text-align:center;font-weight:bold"><font size="4">X</font></div></td>
				<td><div style="text-align:center;font-weight:bold">2,244</div></td>
				<td><input class="txt" type="text" style="text-align:center" name="food_vegan_to_organic_amt" id="food_vegan_to_organic_amt" size="10" value="" readonly>
				</td>
				<td><input type="text" style="text-align:center" name="food_vegan_to_organic_date" id="food_vegan_to_organic_date" size="10" value="" readonly></td>
			</tr>
		</table>

		<center><input style="height: 30px; width: 150px; font-size: 20px; margin-top: 10px;" type="submit" name="submit" value="Save" /></center>
		
		</form><br/>
		
		<h3><div style="margin-left:408px">TOTAL REDUCTIONS&nbsp;&nbsp;=&nbsp;&nbsp; <span id="sum">0</span><!--<input type="text" name="reduct1_total" style="text-align:center;color:#ffffff;font-size:22px;background-color:#cccccc;height:50px" size="5" value="" readonly>--></div></h3>		
		
			
 
 
<script>
    $(document).ready(function(){
 
        //iterate through each textboxes and add keyup
        //handler to trigger sum event
        $(".txt").each(function() {
 
            $(this).focus(function(){
                calculateSum();
            });
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
				<td>a. http://www.eia.doe.gov/oiaf/1605/factors.html</td>
				<td>4. http://www.dep.state.fl.us/mainpage/tips/default.htm</td>
			</tr>
			<tr>
				<td>b. http://pdf.wri.org/wri_co2guide.pdf</td>
				<td>5. http://www.epa.gov/climatechange/emissions/ind_calculator.html</td>
			</tr>
			<tr>
				<td>c. http://en.wikipedia.org/wiki/Short-haul</td>
				<td>6. http://www.unc.edu/~mccarty/lawncareestimates.htm</td>
			</tr>
			<tr>
				<td>d. http://www.epa.gov/cleanenergy/powerprofiler.htm</td>
				<td>7. http://www.fiu.edu/~envstud/labs/CO2Audit.htm</td>
			</tr>
			<tr>
				<td>1. http://www.chesapeakeclimate.org/pages/page.cfm?page_id=29</td>
				<td>8. Gershon, David. Low Carbon Diet. Empowerment Institute, 2006</td>
			</tr>
			<tr>
				<td>2. http://www.thegreenguide.com/doc/119/calculator</td>
				<td>9. http://www.climatecrisis.net/takeaction/whatyoucando/</td>
			</tr>
			<tr>
				<td>3. http://www.timeforchange.org/what-is-a-carbon-footprint-definition</td>
				<td>10. http://www.powerscorecard.org/reduce_energy.cfm</td>
			</tr>
	</table><br/><br/>
	</div> <!-- End of Content -->	
</div> <!-- End of Primary -->

	
<?php get_footer(); ?>