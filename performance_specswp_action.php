<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$car_ids = $this->get_all_data("id",$this->custom_table);
$car_ids2 = $this->get_all_data("car_id",$this->performance_custom_table);
$car_id = 0;
$result = [];
$back = '';
if ($action != "Add" && isset($_GET['per_id'])) {
	$result = $this->get_data_by_id($_GET['per_id'],$this->performance_custom_table);
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

foreach ($car_ids2 as $key2) {
	foreach ($car_ids as $key =>$value) {
		if ($value["id"] == $key2["car_id"] && $value["id"] != $car_id) {
			unset($car_ids[$key]);
		}
	}
}
?>
<section class="wrap">
	<a href="<?php echo AUTO_PERFORMANCE_PLUGIN_PAGE_PATH;?>" class='button button-primary'>Back</a>
	<form action="<?php echo $back; ?>" method="post">
		<div class="flexible_section">
			<div>
				<table class="form-table">
					<tr>
						<th scope="row">Car ID</th>
						<td>
							<?php if (!empty($car_ids)) { ?>
								<select name="car_id" class="regular-text">
									<option value="0">Select Car ID</option>
									<?php foreach ($car_ids as $key) { 
										if ($car_id == $key['id']) { ?>
											<option value='<?php echo $key["id"] ?>' selected><?php echo $key['id'] ?></option>
									<?php }else{ ?>
										    <option value='<?php echo $key["id"] ?>' ><?php echo $key['id'] ?></option>
									<?php }
									 }
									 ?>
								</select>
							<?php }else{ ?>
									<span>There is no car you can assign</span>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<th scope="row">Top Speed (MPH)</th>
						<td><input name="top_speed_mph" type="text" class="regular-text" value="<?php echo isset($top_speed_mph)?$top_speed_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Top Speed (kmph)</th>
						<td><input name="top_speed_kmph" type="text" class="regular-text" value="<?php echo isset($top_speed_kmph)?$top_speed_kmph:''; ?>" required></td>
					</tr>
					<tr>
						<th scope="row">Est Max Accelaration</th>
						<td><input name="est_max_accelaration" type="text" class="regular-text" required value="<?php echo isset($est_max_accelaration)?$est_max_accelaration:''; ?>" required></td>
					</tr>
					<tr>
						<th scope="row">18m slalom</th>
						<td><input name="performance_18m_slalom" type="text" class="regular-text" value="<?php echo isset($performance_18m_slalom)?$performance_18m_slalom:''?>"></td>
					</tr>
					<tr>
						<th scope="row">Est. Emissions</th>
						<td><input name="est_emissions" type="text" class="regular-text" value="<?php echo isset($est_emissions)?$est_emissions:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Lateral Accelaration</th>
						<td><input name="lateral_accelaration" type="text" class="regular-text" value="<?php echo isset($lateral_accelaration)?$lateral_accelaration:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Acceleration 0-30 mph</th>
						<td><input name="acceleration_0_30_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_30_mph)?$acceleration_0_30_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-40 mph</th>
						<td><input name="acceleration_0_40_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_40_mph)?$acceleration_0_40_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-50 mph</th>
						<td><input name="acceleration_0_50_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_50_mph)?$acceleration_0_50_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-60 mph</th>
						<td><input name="acceleration_0_50_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_60_mph)?$acceleration_0_60_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-70 mph</th>
						<td><input name="acceleration_0_70_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_50_mph)?$acceleration_0_70_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-80 mph</th>
						<td><input name="acceleration_0_80_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_80_mph)?$acceleration_0_80_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-90 mph</th>
						<td><input name="acceleration_0_90_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_90_mph)?$acceleration_0_90_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-100 mph</th>
						<td><input name="acceleration_0_100_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_100_mph)?$acceleration_0_100_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-150 mph</th>
						<td><input name="acceleration_0_150_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_150_mph)?$acceleration_0_150_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-124 mph</th>
						<td><input name="acceleration_0_124_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_124_mph)?$acceleration_0_124_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1/8 mile</th>
						<td><input name="acceleration_1_8_mile" type="text" class="regular-text" value="<?php echo isset($acceleration_1_8_mile)?$acceleration_1_8_mile:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1/4 mile</th>
						<td><input name="acceleration_1_4_mile" type="text" class="regular-text" value="<?php echo isset($acceleration_1_4_mile)?$acceleration_1_4_mile:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1/2 mile</th>
						<td><input name="acceleration_1_2_mile" type="text" class="regular-text" value="<?php echo isset($acceleration_1_2_mile)?$acceleration_1_2_mile:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1/8 mile Time</th>
						<td><input name="acceleration_1_8_mile_time" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_1_8_mile_time)?$acceleration_1_8_mile_time:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1/8 mile Speed</th>
						<td><input name="acceleration_1_8_mile_speed" type="text" class="regular-text" value="<?php echo isset($acceleration_1_8_mile_speed)?$acceleration_1_8_mile_speed:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1/4 mile Time</th>
						<td><input name="acceleration_1_4_mile_time" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_1_4_mile_time)?$acceleration_1_4_mile_time:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1/4 mile Speed</th>
						<td><input name="acceleration_1_4_mile_speed" type="text" class="regular-text" value="<?php echo isset($acceleration_1_4_mile_speed)?$acceleration_1_4_mile_speed:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1/2 mile Time</th>
						<td><input name="acceleration_1_2_mile_time" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_1_2_mile_time)?$acceleration_1_2_mile_time:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1/2 mile Speed</th>
						<td><input name="acceleration_1_2_mile_speed" type="text" class="regular-text" value="<?php echo isset($acceleration_1_2_mile_speed)?$acceleration_1_2_mile_speed:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Acceleration 0-40 kmph</th>
						<td><input name="acceleration_0_40_mph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_40_mph)?$acceleration_0_40_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-50 kmph</th>
						<td><input name="acceleration_0_50_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_50_kmph)?$acceleration_0_50_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-60 kmph</th>
						<td><input name="acceleration_0_60_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_60_kmph)?$acceleration_0_60_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-70 kmph</th>
						<td><input name="acceleration_0_70_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_70_kmph)?$acceleration_0_70_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-80 kmph</th>
						<td><input name="acceleration_0_80_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_80_kmph)?$acceleration_0_80_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-90 kmph</th>
						<td><input name="acceleration_0_90_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_90_kmph)?$acceleration_0_90_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-100 kmph</th>
						<td><input name="acceleration_0_100_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_100_kmph)?$acceleration_0_100_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-120 kmph</th>
						<td><input name="acceleration_0_120_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_120_kmph)?$acceleration_0_120_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-130 kmph</th>
						<td><input name="acceleration_0_130_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_130_kmph)?$acceleration_0_130_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-140 kmph</th>
						<td><input name="acceleration_0_140_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_140_kmph)?$acceleration_0_140_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-150 kmph</th>
						<td><input name="acceleration_0_150_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_150_kmph)?$acceleration_0_150_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-160 kmph</th>
						<td><input name="acceleration_0_160_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_160_kmph)?$acceleration_0_160_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-170 kmph</th>
						<td><input name="acceleration_0_170_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_170_kmph)?$acceleration_0_170_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-180 kmph</th>
						<td><input name="acceleration_0_180_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_180_kmph)?$acceleration_0_180_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-190 kmph</th>
						<td><input name="acceleration_0_190_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_190_kmph)?$acceleration_0_190_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-200 kmph</th>
						<td><input name="acceleration_0_200_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_200_kmph)?$acceleration_0_200_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-220 kmph</th>
						<td><input name="acceleration_0_220_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_220_kmph)?$acceleration_0_220_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-250 kmph</th>
						<td><input name="acceleration_0_250_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_250_kmph)?$acceleration_0_250_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-260 kmph</th>
						<td><input name="acceleration_0_260_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_260_kmph)?$acceleration_0_260_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-270 kmph</th>
						<td><input name="acceleration_0_270_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_270_kmph)?$acceleration_0_270_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">0-300 kmph</th>
						<td><input name="acceleration_0_300_kmph" type="text" class="newtype regular-text" value="<?php echo isset($acceleration_0_300_kmph)?$acceleration_0_300_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">1000m</th>
						<td><input name="acceleration_1000m" type="text" class="regular-text" value="<?php echo isset($acceleration_1000m)?$acceleration_1000m:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Braking 100-0 mph</th>
						<td><input name="braking_100_0_mph" type="text" class="regular-text" value="<?php echo isset($braking_100_0_mph)?$braking_100_0_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Braking 60-0 mph</th>
						<td><input name="braking_60_0_mph" type="text" class="regular-text" value="<?php echo isset($braking_60_0_mph)?$braking_60_0_mph:''; ?>"></td>
					</tr>
					<tr>	
						<th scope="row">Braking 200-0 kmph</th>
						<td><input name="braking_200_0_kmph" type="text" class="regular-text" value="<?php echo isset($braking_200_0_kmph)?$braking_200_0_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Braking 100-0 kmph</th>
						<td><input name="braking_100_0_kmph" type="text" class="regular-text" value="<?php echo isset($braking_100_0_kmph)?$braking_100_0_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rolling Acceleration 5-60 mph</th>
						<td><input name="rolling_acceleration_5_60_mph" type="text" class="newtype regular-text" value="<?php echo isset($rolling_acceleration_5_60_mph)?$rolling_acceleration_5_60_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rolling Acceleration 60-100 mph</th>
						<td><input name="rolling_acceleration_60_100_mph" type="text" class="newtype regular-text" value="<?php echo isset($rolling_acceleration_60_100_mph)?$rolling_acceleration_60_100_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rolling Acceleration 100-150 mph</th>
						<td><input name="rolling_acceleration_100_150_mph" type="text" class="newtype regular-text" value="<?php echo isset($rolling_acceleration_100_150_mph)?$rolling_acceleration_100_150_mph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rolling Acceleration 60-100 kmph</th>
						<td><input name="rolling_acceleration_60_100_kmph" type="text" class="newtype regular-text" value="<?php echo isset($rolling_acceleration_60_100_kmph)?$rolling_acceleration_60_100_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rolling Acceleration 100-200 kmph</th>
						<td><input name="rolling_acceleration_100_200_kmph" type="text" class="newtype regular-text" value="<?php echo isset($rolling_acceleration_100_200_kmph)?$rolling_acceleration_100_200_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Rolling Acceleration 200-300 kmph</th>
						<td><input name="rolling_acceleration_200_300_kmph" type="text" class="newtype regular-text" value="<?php echo isset($rolling_acceleration_200_300_kmph)?$rolling_acceleration_200_300_kmph:''; ?>"></td>
					</tr>
					<tr>
						<th scope="row">Nurburgring Time</th>
						<td><input name="nurburgring_time" type="text" class="regular-text" value="<?php echo isset($nurburgring_time)?$nurburgring_time:''; ?>"></td>
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

