<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$checked = "";
$style = '';
$checked2 = "";
$style2 = '';
$code = "";
$checked3 = "";
if (!empty($_POST)) {
	if ($_POST["custom_css"] != '') {
		//mkdir(plugin_dir_path(__FILE__)."assets/css/custom.css",0777,true);
		// chmod(ABSPATH."wp-content/plugins", 0777);
		// chmod(plugin_dir_path(__FILE__)."assets/css/custom.css", 0777);
		$handle = fopen(plugin_dir_path(__FILE__)."assets/css/custom.css", "w");
		$read = fopen(plugin_dir_path(__FILE__)."assets/css/custom.css", "r");
		fwrite($handle,stripslashes($_POST["custom_css"]));
		$code = fread($read,1000);
		fclose($handle);
		update_option("custom_css","on");
	}else{
		update_option("custom_css","off");
	}
	if (!isset($_POST['enable_shortcode_pagination'])) {
		$_POST['enable_shortcode_pagination'] = "off";
	}
	update_option("enable_shortcode_pagination",$_POST['enable_shortcode_pagination']);
	update_option("row_shortcode_pagination",$_POST['row_shortcode_pagination']);
	if (!isset($_POST['enable_admin_pagination'])) {
		$_POST['enable_admin_pagination'] = "off";
	}
	update_option("enable_admin_pagination",$_POST['enable_admin_pagination']);
	update_option("row_admin_pagination",$_POST['row_admin_pagination']);
	if (!isset($_POST['remove_data_uninstall'])) {
		$_POST['remove_data_uninstall'] = "off";
	}
	update_option("remove_data_uninstall",$_POST['remove_data_uninstall']);
}
$row = get_option('row_shortcode_pagination');
$row_admin = get_option('row_admin_pagination');
if (get_option('enable_shortcode_pagination') == "on") {
	$checked = "checked";
	$style = "style='display:table-row'";
}
if (get_option('enable_admin_pagination') == "on") {
	$checked2 = "checked";
	$style2 = "style='display:table-row'";
}
if (get_option('remove_data_uninstall') == "on") {
	$checked3 = "checked";
}
?>

<section class="wrap">
	<h2>Settings</h2>
	<form action="" method="post">
		<table class="form-table">
			<tr>
				<th scope="now">Enable Pagination for shortcode view</th>
				<td ><label for="enable_shortcode_pagination"><input type="checkbox" <?php echo $checked; ?> name="enable_shortcode_pagination" id="enable_shortcode_pagination">Tables will have pagination</label></td>
			</tr>
			<tr class="rows_shortcode_pagination" <?php echo $style; ?>>
				<th scope="now">Pagination Rows</th>
				<td ><input type="number" name="row_shortcode_pagination" value="<?php echo $row; ?>" id="row_shortcode_pagination"></td>
			</tr>
			<tr>
				<th scope="now">Enable Pagination for admin tables</th>
				<td ><label for="enable_admin_pagination"><input type="checkbox" <?php echo $checked2; ?> name="enable_admin_pagination" id="enable_admin_pagination">Tables will have pagination</label></td>
			</tr>
			<tr class="rows_admin_pagination" <?php echo $style2; ?>>
				<th scope="now">Pagination Rows</th>
				<td ><input type="number" name="row_admin_pagination" value="<?php echo $row_admin; ?>" id="row_admin_pagination"></td>
			</tr>
			<tr>
				<th scope="now">Remove all plugin data on uninstall</th>
				<td ><input type="checkbox" <?php echo $checked3; ?> name="remove_data_uninstall" id="remove_data_uninstall"></td>
			</tr>
			<tr class="custom_css">
				<th scope="now">Custom CSS</th>
				<td ><textarea name="custom_css" id="custom_css"><?php echo esc_textarea($code); ?></textarea></td>
			</tr>
		</table>
		<button class="button button-primary">Save</button>
	</form>
</section>