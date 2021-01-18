<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$result = [];
$back = '';
if ($action != "Add" && isset($_GET['carid'])) {
	$result = $this->get_data_by_id($_GET['carid'],$this->custom_table);
	$check = "false";
	if (!empty($result)) {
		extract($result[0]);
		$check = "true";
	}
}else{
	if (isset($_SERVER['HTTP_REFERER'])) {
		$back = $_SERVER['HTTP_REFERER'];	
	}
}

$category['segment'] = ['Car','Pickup','Sports','SUV','Van'];
$category['class'] = ['Standard','Luxury'];
$category['type'] = ['Coupe','Sedan'];
$category['size'] = ['Small','Midsize','Large'];
$category['size_2'] = ['Subcompact','Compact'];
$category['segment_1'] = ['American Muscle','Euro Sports Car','Supercar', 'Hypercar', 'Premium Sports Car'];
$category['segment_2'] = ['Gas', 'Hybrid', 'Electrical'];
$category['segment_3'] = ['Commercial Van', 'Minivan'];
$category['segment_4'] = ['Small Pickup','Full Size Pickup'];
$category['segment_5'] = ['Warm Hatch','Tall Hatch','City'];
$engine['aspiration'] = ['Natural','Supercharged','Turbocharged'];
$engine['position'] = ['Front','Rear','Mid etc'];

?>
<section class="wrap">
	<a href="<?php echo AUTO_SPECS_PLUGIN_PAGE_PATH;?>" class='button button-primary'>Back</a>
	<form action="<?php echo $back; ?>" method="post">
		<div class="flexible_section">
			<div>
				<table class="form-table">
					<tr>
						<th scope="row">Manufacturer</th>
						<td><input name="manufacturer" type="text" class="regular-text" value="<?php echo isset($manufacturer)?$manufacturer:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Brand</th>
						<td><input name="brand" type="text" class="regular-text" value="<?php echo isset($brand)?$brand:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Model</th>
						<td><input name="model" type="text" class="regular-text" value="<?php echo isset($model)?$model:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Trim</th>
						<td><input name="_trim" type="text" class="regular-text" value="<?php echo isset($_trim)?$_trim:''?>"></td>
					</tr>
					<tr>
						<th scope="row">Generation</th>
						<td><input name="generation" type="text" class="regular-text" value="<?php echo isset($generation)?$generation:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Model Year</th>
						<td><input name="model_year" min="1900" type="number" class="regular-text" value="<?php echo isset($model_year)?$model_year:1900; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Years Built</th>
						<td><input name="years_built" type="text" class="regular-text" value="<?php echo isset($years_built)?$years_built:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Production</th>
						<td><input name="production" type="text" class="regular-text" value="<?php echo isset($production)?$production:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Presentation</th>
						<td><input name="presentation" type="text" class="regular-text" value="<?php echo isset($presentation)?$presentation:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Designed By</th>
						<td><input name="designed_by" type="text" class="regular-text" value="<?php echo isset($designed_by)?$designed_by:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Origin Country</th>
						<td><input name="origin_country" type="text" class="regular-text" value="<?php echo isset($origin_country)?$origin_country:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Segment</th>
						<td><select name="segment" class="regular-text">
							<?php foreach ($category['segment'] as $key) { ?>
								<option <?php echo isset($segment) && $key == $segment?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Class</th>
						<td><select name="class" class="regular-text">
							<?php foreach ($category['class'] as $key) { ?>
								<option <?php echo isset($class) && $key == $class?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Type</th>
						<td><select name="type" class="regular-text">
							<option value="">Not Selected</option>
							<?php foreach ($category['type'] as $key) { ?>
								<option <?php echo isset($class) && $key == $type?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Size</th>
						<td><select name="size" class="regular-text">
							<?php foreach ($category['size'] as $key) { ?>
								<option <?php echo isset($size) && $key == $size?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Size 2</th>
						<td><select name="size_2" class="regular-text">
							<option value="">Not Selected</option>
							<?php foreach ($category['size_2'] as $key) { ?>
								<option <?php echo isset($size_2) && $key == $size_2?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Segment 1</th>
						<td><select name="segment_1" class="regular-text">
							<option value="">Not Selected</option>
							<?php foreach ($category['segment_1'] as $key) { ?>
								<option <?php echo isset($segment_1) && $key == $segment_1?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Segment 2</th>
						<td><select name="segment_2" class="regular-text">
							<option value="">Not Selected</option>
							<?php foreach ($category['segment_2'] as $key) { ?>
								<option <?php echo isset($segment_2) && $key == $segment_2?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Segment 3</th>
						<td><select name="segment_3" class="regular-text">
							<option value="">Not Selected</option>
							<?php foreach ($category['segment_3'] as $key) { ?>
								<option <?php echo isset($segment_3) && $key == $segment_3?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Segment 4</th>
						<td><select name="segment_4" class="regular-text">
							<option value="">Not Selected</option>
							<?php foreach ($category['segment_4'] as $key) { ?>
								<option <?php echo isset($segment_4) && $key == $segment_4?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Segment 5</th>
						<td><select name="segment_5" class="regular-text">
							<option value="">Not Selected</option>
							<?php foreach ($category['segment_5'] as $key) { ?>
								<option <?php echo isset($segment_5) && $key == $segment_5?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Overall Length</th>
						<td><input name="overall_length" type="text" class="regular-text" value="<?php echo isset($overall_length)?$overall_length:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Overall Width</th>
						<td><input name="overall_width" type="text" class="regular-text" value="<?php echo isset($overall_width)?$overall_width:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Overall Height</th>
						<td><input name="overall_height" type="text" class="regular-text" value="<?php echo isset($overall_height)?$overall_height:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Wheelbase</th>
						<td><input name="wheelbase" type="text" class="regular-text" value="<?php echo isset($wheelbase)?$wheelbase:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Front Track</th>
						<td><input name="front_track" type="text" class="regular-text" value="<?php echo isset($front_track)?$front_track:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rear Track</th>
						<td><input name="rear_track" type="text" class="regular-text" value="<?php echo isset($rear_track)?$rear_track:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Ground Clearance</th>
						<td><input name="ground_clearance" type="text" class="regular-text" value="<?php echo isset($ground_clearance)?$ground_clearance:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Front Overhang</th>
						<td><input name="front_overhang" type="text" class="regular-text" value="<?php echo isset($front_overhang)?$front_overhang:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rear Overhang</th>
						<td><input name="rear_overhang" type="text" class="regular-text" value="<?php echo isset($rear_overhang)?$rear_overhang:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Weight</th>
						<td><input name="weight" type="text" class="regular-text" value="<?php echo isset($weight)?$weight:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Distribution</th>
						<td><input name="distribution" type="text" class="regular-text" value="<?php echo isset($distribution)?$distribution:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Structure</th>
						<td><input name="structure" type="text" class="regular-text" value="<?php echo isset($structure)?$structure:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Body</th>
						<td><input name="body" type="text" class="regular-text" value="<?php echo isset($body)?$body:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Suspension (Front)</th>
						<td><input name="suspension_front" type="text" class="regular-text" value="<?php echo isset($suspension_front)?$suspension_front:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Suspension (Rear)</th>
						<td><input name="suspension_rear" type="text" class="regular-text" value="<?php echo isset($suspension_rear)?$suspension_rear:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Driven wheels</th>
						<td><input name="driven_wheels" type="text" class="regular-text" value="<?php echo isset($driven_wheels)?$driven_wheels:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">ESP</th>
						<td><input name="esp" type="text" class="regular-text" value="<?php echo isset($esp)?$esp:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Brakes Front</th>
						<td><input name="brakes_front" type="text" class="regular-text" value="<?php echo isset($brakes_front)?$brakes_front:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Brakes Rear</th>
						<td><input name="brakes_rear" type="text" class="regular-text" value="<?php echo isset($brakes_rear)?$brakes_rear:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Brakes Description</th>
						<td><input name="brakes_description" type="text" class="regular-text" value="<?php echo isset($brakes_description)?$brakes_description:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Steering Type</th>
						<td><input name="steering_type" type="text" class="regular-text" value="<?php echo isset($steering_type)?$steering_type:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Turning Circle</th>
						<td><input name="turning_circle" type="text" class="regular-text" value="<?php echo isset($turning_circle)?$turning_circle:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Front Tire Size</th>
						<td><input name="front_tire_size" type="text" class="regular-text" value="<?php echo isset($front_tire_size)?$front_tire_size:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rear Tire Size</th>
						<td><input name="rear_tire_size" type="text" class="regular-text" value="<?php echo isset($rear_tire_size)?$rear_tire_size:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Tire Type</th>
						<td><input name="tire_type" type="text" class="regular-text" value="<?php echo isset($tire_type)?$tire_type:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Front Wheel</th>
						<td><input name="front_wheel" type="text" class="regular-text" value="<?php echo isset($front_wheel)?$front_wheel:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rear Wheel</th>
						<td><input name="rear_wheel" type="text" class="regular-text" value="<?php echo isset($rear_wheel)?$rear_wheel:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Wheel Type</th>
						<td><input name="wheel_type" type="text" class="regular-text" value="<?php echo isset($wheel_type)?$wheel_type:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rear Spoiler</th>
						<td><input name="rear_spoiler" type="text" class="regular-text" value="<?php echo isset($rear_spoiler)?$rear_spoiler:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Mirrors</th>
						<td><input name="mirrors" type="text" class="regular-text" value="<?php echo isset($mirrors)?$mirrors:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Airbags</th>
						<td><input name="airbags" type="text" class="regular-text" value="<?php echo isset($airbags)?$airbags:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Engine Type</th>
						<td><input name="engine_type" type="text" class="regular-text" value="<?php echo isset($engine_type)?$engine_type:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Aspiration</th>
						<td>
							<select name="aspiration" class="regular-text">
							<?php foreach ($engine['aspiration'] as $key) { ?>
								<option <?php echo isset($aspiration) && $key == $aspiration?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select>
						</td>
					</tr>
					<tr>
						<th scope="row">Position</th>
						<td><select name="position" class="regular-text">
							<?php foreach ($engine['position'] as $key) { ?>
								<option <?php echo isset($position) && $key == $position?"selected":""; ?>><?php echo $key; ?></option>
							<?php } ?>
						</select></td>
					</tr>
					<tr>
						<th scope="row">Displacement</th>
						<td><input name="displacement" type="text" class="regular-text" value="<?php echo isset($displacement)?$displacement:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Weight Distribution</th>
						<td><input name="weight_distribution" type="text" class="regular-text" value="<?php echo isset($weight_distribution)?$weight_distribution:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Main Bearings</th>
						<td><input name="main_bearings" type="text" class="regular-text" value="<?php echo isset($main_bearings)?$main_bearings:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Bore Stroke</th>
						<td><input name="bore_stroke" type="text" class="regular-text" value="<?php echo isset($bore_stroke)?$bore_stroke:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Valve Gear</th>
						<td><input name="valve_gear" type="text" class="regular-text" value="<?php echo isset($valve_gear)?$valve_gear:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Valvetrain</th>
						<td><input name="valvetrain" type="text" class="regular-text" value="<?php echo isset($valvetrain)?$valvetrain:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Compression Ratio</th>
						<td><input name="compression_ratio" type="text" class="regular-text" value="<?php echo isset($compression_ratio)?$compression_ratio:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Horsepower</th>
						<td><input name="horsepower" type="text" class="regular-text" value="<?php echo isset($horsepower)?$horsepower:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Torque</th>
						<td><input name="torque" type="text" class="regular-text" value="<?php echo isset($torque)?$torque:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Redline</th>
						<td><input name="redline" type="text" class="regular-text" value="<?php echo isset($redline)?$redline:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Cooling System</th>
						<td><input name="cooling_system" type="text" class="regular-text" value="<?php echo isset($cooling_system)?$cooling_system:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Emission Control</th>
						<td><input name="emission_control" type="text" class="regular-text" value="<?php echo isset($emission_control)?$emission_control:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Ignition</th>
						<td><input name="ignition" type="text" class="regular-text" value="<?php echo isset($ignition)?$ignition:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Engine Management</th>
						<td><input name="engine_management" type="text" class="regular-text" value="<?php echo isset($engine_management)?$engine_management:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Electrical System</th>
						<td><input name="electrical_system" type="text" class="regular-text" value="<?php echo isset($electrical_system)?$electrical_system:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Alternator</th>
						<td><input name="alternator" type="text" class="regular-text" value="<?php echo isset($alternator)?$alternator:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Fuel System</th>
						<td><input name="fuel_system" type="text" class="regular-text" value="<?php echo isset($fuel_system)?$fuel_system:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Fuel Type</th>
						<td><input name="fuel_type" type="text" class="regular-text" value="<?php echo isset($fuel_type)?$fuel_type:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Fuel Consumption / MPG</th>
						<td><input name="fuel_consumption_mpg" type="text" class="regular-text" value="<?php echo isset($fuel_consumption_mpg)?$fuel_consumption_mpg:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Lubrication</th>
						<td><input name="lubrication" type="text" class="regular-text" value="<?php echo isset($lubrication)?$lubrication:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Specific output</th>
						<td><input name="specific_output" type="text" class="regular-text" value="<?php echo isset($specific_output)?$specific_output:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Power Weight Ratio</th>
						<td><input name="power_weight_ratio" type="text" class="regular-text" value="<?php echo isset($power_weight_ratio)?$power_weight_ratio:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Transmission Type</th>
						<td><input name="transmission_type" type="text" class="regular-text" value="<?php echo isset($transmission_type)?$transmission_type:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Clutch</th>
						<td><input name="clutch" type="text" class="regular-text" value="<?php echo isset($clutch)?$clutch:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Clutch Disc Diameter</th>
						<td><input name="clutch_disc_diameter" type="text" class="regular-text" value="<?php echo isset($clutch_disc_diameter)?$clutch_disc_diameter:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1st gear ratio</th>
						<td><input name="transmission_1st_gear_ratio" type="text" class="regular-text" value="<?php echo isset($transmission_1st_gear_ratio)?$transmission_1st_gear_ratio:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">2nd gear ratio</th>
						<td><input name="transmission_2nd_gear_ratio" type="text" class="regular-text" value="<?php echo isset($transmission_2nd_gear_ratio)?$transmission_2nd_gear_ratio:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">3rd gear ratio</th>
						<td><input name="transmission_3rd_gear_ratio" type="text" class="regular-text" value="<?php echo isset($transmission_3rd_gear_ratio)?$transmission_3rd_gear_ratio:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">4th gear ratio</th>
						<td><input name="transmission_4th_gear_ratio" type="text" class="regular-text" value="<?php echo isset($transmission_4th_gear_ratio)?$transmission_4th_gear_ratio:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">5th gear ratio</th>
						<td><input name="transmission_5th_gear_ratio" type="text" class="regular-text" value="<?php echo isset($transmission_5th_gear_ratio)?$transmission_5th_gear_ratio:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">6th gear ratio</th>
						<td><input name="transmission_6th_gear_ratio" type="text" class="regular-text" value="<?php echo isset($transmission_6th_gear_ratio)?$transmission_6th_gear_ratio:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Reverse gear ratio</th>
						<td><input name="reverse_gear_ratio" type="text" class="regular-text" value="<?php echo isset($reverse_gear_ratio)?$reverse_gear_ratio:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Front differential</th>
						<td><input name="front_differential" type="text" class="regular-text" value="<?php echo isset($front_differential)?$front_differential:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rear differential</th>
						<td><input name="rear_differential" type="text" class="regular-text" value="<?php echo isset($rear_differential)?$rear_differential:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Fuel</th>
						<td><input name="capacities_fuel" type="text" class="regular-text" value="<?php echo isset($capacities_fuel)?$capacities_fuel:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Engine Oil</th>
						<td><input name="engine_oil" type="text" class="regular-text" value="<?php echo isset($engine_oil)?$engine_oil:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Cooling System</th>
						<td><input name="capacities_cooling_system" type="text" class="regular-text" value="<?php echo isset($capacities_cooling_system)?$capacities_cooling_system:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Luggage</th>
						<td><input name="luggage" type="text" class="regular-text" value="<?php echo isset($luggage)?$luggage:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">US MSRP</th>
						<td><input name="us_msrp" type="text" class="regular-text" value="<?php echo isset($us_msrp)?$us_msrp:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">EU MSRP</th>
						<td><input name="eu_msrp" type="text" class="regular-text" value="<?php echo isset($eu_msrp)?$eu_msrp:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Current Value</th>
						<td><input name="current_value" type="text" class="regular-text" value="<?php echo isset($current_value)?$current_value:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Auction History Value</th>
						<td><input name="auction_history_value" type="text" class="regular-text" value="<?php echo isset($auction_history_value)?$auction_history_value:''; ?>"></td>
					</tr>
				</table>
				<?php if ($action == "Update") { ?>
					<input type="hidden" value="<?php echo $id; ?>" name='update_id'>
				<?php  } ?>
				<button class="button button-primary" name="list_save_<?php echo $action ?>"><?php echo $action ?></button>
			</div>
		</div>
	</form>	
</section>

