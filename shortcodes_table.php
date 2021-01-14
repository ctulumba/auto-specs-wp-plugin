<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$row = 0;
$length = $this->get_table_length($this->shortcode_table);
if (get_option('enable_admin_pagination') == 'on' && get_option('row_admin_pagination') != null) {
	$row = get_option('row_admin_pagination');
}

if (isset($_POST)) {
	if (isset($_POST["prev"])) {
		$this->start_pagination = $_POST['data-row']-$row;
	}else if (isset($_POST["next"])) {
		if ($length > $_POST['data-row']+$row) {
			$this->start_pagination = $_POST['data-row']+$row;
		}else{
			$this->start_pagination = $_POST['data-row'];
		}
	}
}
if ($this->start_pagination < 0) {
	$this->start_pagination = 0;
}

$all = $this->get_shortcodes($row,$this->start_pagination);
$ids_auto = $this->get_all_data("id",$this->custom_table);
?>
<section class="wrap">
	<div class="main">
		<div class="custom_plugin_insert">
			<div>
				<h2>Auto Specs Shortcodes</h2>
			</div>
			<div><button class="button button-primary auto_specs_modal_open" data-action='add'>ADD</button></div>
		</div>
		<table class="custom_plugin_table">
			<tr>
				<th>Shortcode Name</th>
				<th>Car Shortcode</th>
				<th colspan="2">Performance Shortcode</th>
			</tr>
			<?php
			if (!empty($all)) {
				foreach ($all as $key) { ?>
					<tr>
						<td name='shortcode_name'><?php echo $key->shortcode_name;?></td>
						<td name='shortcode_auto_id' data-id="<?php echo $key->auto_id;?>"><code><?php echo $key->auto_id != 0?"[carspecs id='".$key->auto_id."']":"Select Car ID"; ?></code></td>
						<td name='shortcode_perf_id' data-id="<?php echo $key->perf_id;?>"><code><?php echo $key->perf_id != 0?"[performancespecs id='".$key->perf_id."']":"Performance not found"; ?></code></td>
						<td><button class="button auto_specs_modal_open" data-action='edit' data-id="<?php echo $key->id;?>">Edit</button> &nbsp; <button class="button_remove shortcode_remove" data-table='<?php echo $this->shortcode_table; ?>' data-id="<?php echo $key->id;?>">Remove</button></td>
					</tr>
			<?php	}
			if ($row != 0) { ?>
						<tr>
							<td class="admin_pagination_contain" colspan="5">
								<form action="" method="post" id="form_row">
									<input type="hidden" value="<?php echo $this->start_pagination ?>" name="data-row">
								</form>
								<div class="admin_pagination">
									<button class="button" name='prev' form="form_row">Prev</button>
									<button class="button" name='next' form="form_row">Next</button>
								</div>
							</td>
						</tr>
				<?php	}
			}else{ ?>
				<tr><th colspan="4">There is no data yet</th></tr>
			<?php } ?>
			
		</table>
	</div>
</section>

<section class="auto_specs_modal" data-modal='off'>
	<header>
		<h2 align='center'>Shortcode Generate</h2>
	</header>
	<main>
		<form action="" method="post" id="short_form_submit">
			<table class="">
				<tr>
					<th>Shortcode Name</th>
					<td><input class="regular-width" type="text" id="shortcode_name" name="shortcode_name" required></td>
				</tr>
				<tr>
					<th>Auto ID</th>
					<td>
						<?php if (!empty($ids_auto)) { ?>
						<select class="regular-width" name="shortcode_auto_id" id="shortcode_auto_id" required>
							<?php 
							foreach ($ids_auto as $key) {
								?>
								<option value="<?php echo $key['id']; ?>"><?php echo $key['id']; ?></option>
							<?php }
							?>
						</select>
					<?php }else{
						echo "<input type='text' name='shortcode_auto_id' id='shortcode_id_aute' disabled placeholder='You need to create car data'/>";
					} ?>
					</td>
				</tr>
			</table>
		</form>
	</main>
	<footer align='center'><button form="short_form_submit" name="add_short" class="button button-primary">Save</button> <button class="button auto_specs_modal_open">Close</button></footer>
</section>