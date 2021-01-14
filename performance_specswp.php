<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$row = 0;
$length = $this->get_table_length($this->performance_custom_table);
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

$all = $this->get_all_data('id,car_id',$this->performance_custom_table,$row,$this->start_pagination);
// print_r($all);die;
?>

<section class="wrap performance_specswp">
	<div class="main">
		<div class="custom_plugin_insert">
			<div>
				<h2>Performance Specs</h2>
			</div>
			<div><a class="button button-primary" href="<?php echo $_SERVER['REQUEST_URI']; ?>&action=Add">ADD</a></div>
		</div>
		<table class="custom_plugin_table">
			<tr>
				<th>ID</th>
				<th colspan="2">Car ID</th>
			</tr>
			<?php 
			if (!empty($all)) {
				foreach ($all as $key) { ?>
					<tr>
						<td><?php echo $key['id']; ?></td>
						<td><?php echo $key['car_id']; ?></td>
						<td><a class="button" href="<?php echo $_SERVER['REQUEST_URI'].'&action=Update&per_id='.$key['id']; ?>">Edit</a> &nbsp; <button class="button_remove" data-table='<?php echo $this->performance_custom_table; ?>' data-id="<?php echo $key['id'];?>">Remove</button></td>
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
			<?php }
			 ?>
			
		</table>
	</div>
</section>