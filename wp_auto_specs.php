<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/*
Plugin Name: WP Auto Specs
Version: 1.0.0
*/
define( 'AUTO_SPECS_PLUGIN_PAGE', 'wp_auto_specs_menu' );
define( 'AUTO_SPECS_PLUGIN_PAGE_PATH',admin_url().'admin.php?page=wp_auto_specs_menu');
define( 'AUTO_PERFORMANCE_PLUGIN_PAGE_PATH',admin_url().'admin.php?page=performance_specswp_menu');
define( 'AUTO_SPECS_PLUGIN_ASSETS',plugin_dir_url(__FILE__)."assets/");
/**
 * WP Auto Specs start
 */
class WpAutoSpecs {
	public $prefix;
	
	function __construct()
	{
		global $wpdb;
		$this->db = $wpdb;
		$this->custom_table = $wpdb->prefix."autospecs_table";
		$this->performance_custom_table = $wpdb->prefix."autospecs_performance_table";
		$this->shortcode_table = $wpdb->prefix."autospecs_shortcodes";
		register_activation_hook(__FILE__,[$this,'plugin_activation']);
		add_action("admin_menu", [$this,"wp_plugin_menu"]);
		add_action('admin_enqueue_scripts',[$this,'custom_wp_admin_enqueue'],10);
		add_action('wp_enqueue_scripts',[$this,'custom_wp_public_enqueue'],20);
		add_action("wp_ajax_remove_data",[$this,"remove_data"]);
		add_shortcode('carspecs', [$this,'shortcode_gen']);
		add_shortcode('performancespecs', [$this,'perf_shortcode_gen']);

		$this->general = false;
		$this->category = false;
		$this->dimensions = false;
		$this->chassis = false;
		$this->engine = false;
		$this->transmission = false;
		$this->capacities = false;
		$this->pricing = false;

		$this->general_perf = false;
		$this->acceleration_mph = false;
		$this->acceleration_kmph = false;
		$this->braking = false;
		$this->rolling_acceleration = false;

		$this->start_pagination = 0;

	}
	public function get_auto_title($index,$class){
		$html = '';
		if ($index < 12 && $this->general == false) {
			$html .= "<tr class='".$class."category_title' ><th colspan='2'>General</th></tr>";
			$this->general = true;
		}else if ($index > 10 && $index < 21 && $this->category == false) {
			$html .= "<tr class='".$class."category_title' ><th colspan='2'>Category</th></tr>";
			$this->category = true;
		}else if ($index > 20 && $index < 32 && $this->dimensions == false) {
		 	$html .= "<tr class='".$class."category_title' ><th colspan='2'>Dimensions</th></tr>";
		 	$this->dimensions = true;
		}else if ($index > 31 && $index < 52 && $this->chassis == false) {
		 	$html .= "<tr class='".$class."category_title' ><th colspan='2'>Chassis</th></tr>";
		 	$this->chassis = true;
		}else if ($index > 51 && $index < 76 && $this->engine == false) {
		 	$html .= "<tr class='".$class."category_title' ><th colspan='2'>Engine/PowerTrain</th></tr>";
		 	$this->engine = true;
		}else if ($index > 76 && $index < 89 && $this->transmission == false) {
		 	$html .= "<tr class='".$class."category_title' ><th colspan='2'>Transmission</th></tr>";
		 	$this->transmission = true;
		}else if ($index > 88 && $index < 93 && $this->capacities == false) {
		 	$html .= "<tr class='".$class."category_title' ><th colspan='2'>Capacities</th></tr>";
		 	$this->capacities = true;
		}else if ($index > 92 && $this->pricing == false) {
		 	$html .= "<tr class='".$class."category_title' ><th colspan='2'>Pricing</th></tr>";
		 	$this->pricing = true;
		}
		return $html;
	}
	public function get_perf_title($index,$class){
		$html = '';
		if ($index < 7 && $this->general_perf == false) {
			$html .= "<tr class='".$class."category_title' ><th colspan='2'>General Performance</th></tr>";
			$this->general_perf = true;
		}else if ($index > 6 && $index < 26 && $this->acceleration_mph == false) {
			$html .= "<tr class='".$class."category_title' ><th colspan='2'>Acceleration (mph)</th></tr>";
			$this->acceleration_mph = true;
		}else if ($index > 25 && $index < 48 && $this->acceleration_kmph == false) {
		 	$html .= "<tr class='".$class."category_title' ><th colspan='2'>Acceleration (kmph)</th></tr>";
		 	$this->acceleration_kmph = true;
		}else if ($index > 47 && $index < 52 && $this->braking == false) {
		 	$html .= "<tr class='".$class."category_title' ><th colspan='2'>Braking</th></tr>";
		 	$this->braking = true;
		}else if ($index > 51 && $index < 58 && $this->rolling_acceleration == false) {
		 	$html .= "<tr class='".$class."category_title' ><th colspan='2'>Rolling Acceleration</th></tr>";
		 	$this->rolling_acceleration = true;
		}else if ($index > 57) {
			$html .= "<tr class='".$class."category_title' ><th colspan='2'>Laptimes?</th></tr>";
		}
		return $html;
	}
	public function perf_shortcode_gen($atts){
		$html = "";
		$row = 0;
		if (isset($atts['id'])) {
			extract(shortcode_atts(array('id' => $atts['id'],), $atts));
			if (get_option('enable_shortcode_pagination') == "on" && get_option('row_shortcode_pagination') > 1) {
				$row = get_option('row_shortcode_pagination');
			}
			$data = $this->get_data_by_id($id,$this->performance_custom_table);
			$custom_class = "";
			if (!empty($data)) {
				$html = "<div><table class='form-table shortcode_perf_table_view shortcode_table_view' data-id='"."perf_".$id."'>";
				unset($data[0]['created_at']);
				unset($data[0]['id']);
				$search = [
					"_",
					"acceleration 0 ",
					"acceleration 1 ",
					"braking 200 ",
					"braking 100 ",
					"braking 60 ",
					"rolling acceleration 5 ",
					"rolling acceleration 60 ",
					"rolling acceleration 100 ",
					"rolling acceleration 200 ",
					"acceleration 1000"
				];
				$repalce = [" ","0-","1/","200-","100-","60-","5-","60-","100-","200-","1000"];
				$index = 0;
				foreach ($data[0] as $key => $value) {
					if ($row > 1 && $row <= $index) {
							$custom_class = "hide_table_field ";
					}
					if ($value != '' && $value != false) {
						$html .= $this->get_perf_title($index,$custom_class);
						$html .= "<tr class='".$custom_class."field_val'>";
						$html .= "<th>".ucfirst(str_replace($search,$repalce,$key))."</th>";
						$html .= "<td>";
						$html .= $value;
						$html .= "</td>";
						$html .= "</tr>";
					}
					$index++;
				}
				if ($row > 1) {
					$html .= "<tr><td class='pagination_cont' colspan='2'><div class='pagination_next_prev' data-id='"."perf_".$id."' data-count='".$index."' data-row='".$row."' data-start='0'>
							<span role='prev'>Prev</span>
							<span role='next'>Next</span>
							</div></td></tr>";
				}
				$html .= "</table></div>";
			}
		}
		return $html;
	}
	public function shortcode_gen($atts){
		$html = "";
		$row = 0;
		if (isset($atts['id'])) {
			extract(shortcode_atts(array('id' => $atts['id']), $atts));
			if (get_option('enable_shortcode_pagination') == "on" && get_option('row_shortcode_pagination') > 1) {
				$row = get_option('row_shortcode_pagination');
			}
			$data = $this->get_data_by_id($id,$this->custom_table);
			if (!empty($data)) {
				$html = "<div><table class='form-table shortcode_table_view shortcode_auto_view' data-id='"."auto_".$id."'>";
				unset($data[0]['created_at']);
				unset($data[0]['id']);
				$index = 0;
				$custom_class = "";
				foreach ($data[0] as $key => $value) {
					if ($row > 1 && $row <= $index) {
							$custom_class = "hide_table_field ";
					}
					if ($value != '' || $value != false) {
						$key = str_replace(["capacities_","transmission_"],'', $key);
						$html .= $this->get_auto_title($index,$custom_class);
						$html .= "<tr class='".$custom_class."field_val' >";
						$html .= "<th>".ucfirst(str_replace("_"," ",$key))."</th>";
						$html .= "<td>";
						$html .= $value;
						$html .= "</td>";
						$html .= "</tr>";
					}
					$index++;
				}
				if ($row > 1) {
					$html .= "<tr><td class='pagination_cont' colspan='2'><div class='pagination_next_prev' data-id='"."auto_".$id."' data-count='".$index."' data-row='".$row."' data-start='0'>
							<span role='prev'>Prev</span>
							<span role='next'>Next</span>
							</div></td></tr>";
				}
				$html .= "</table></div>";
			}
		}
		return $html;
	}
	public function remove_data(){
		$this->db->delete($_POST['table'],['id'=>$_POST['id']]);
		if ($_POST['table'] == $this->custom_table) {
			$this->db->update($this->performance_custom_table,["car_id"=>"0"],['car_id'=>$_POST['id']]);
			$this->db->update($this->shortcode_table,["auto_id"=>"0"],['auto_id'=>$_POST['id']]);
		}else if($_POST['table'] == $this->performance_custom_table){
			$this->db->update($this->shortcode_table,["perf_id"=>"0"],['perf_id'=>$_POST['id']]);
		}
		wp_send_json(["message"=> $id." data removed"]);die;
	}
	public function custom_wp_public_enqueue(){
		wp_enqueue_style("custom-wp-admin_style",AUTO_SPECS_PLUGIN_ASSETS."/css/style.css");
		if (null !== get_option("custom_css") && get_option("custom_css") == "on") {
			wp_enqueue_style("custom-wp-public_style",AUTO_SPECS_PLUGIN_ASSETS."/css/custom.css");
		}
		wp_enqueue_script('custom-wp-js',AUTO_SPECS_PLUGIN_ASSETS."/js/custom-ajax.js",array('jquery'),"125614654");
		wp_localize_script('custom-wp-js', 'wp_admin_ajax_object', array(
			'ajax_url' 			=> admin_url('admin-ajax.php')
		));
	}
	public function custom_wp_admin_enqueue(){
		// admin js
		wp_enqueue_script('custom-wp-admin',AUTO_SPECS_PLUGIN_ASSETS."/js/custom-ajax.js",array('jquery'),"125614654");
		wp_localize_script('custom-wp-admin', 'wp_admin_ajax_object', array(
			'ajax_url' 			=> admin_url('admin-ajax.php')
		));
		wp_enqueue_style("custom-wp-admin_style",AUTO_SPECS_PLUGIN_ASSETS."/css/admin_style.css");

		$cm_settings['codeEditor'] = wp_enqueue_code_editor(array('type' => 'text/css'));
		wp_localize_script('jquery', 'cm_settings', $cm_settings);
		wp_enqueue_script('wp-theme-plugin-editor');
		wp_enqueue_style('wp-codemirror');

	}
	public function plugin_activation(){
		update_option("remove_data_uninstall","off");
		$this->plugin_tables_integration();
	}
	public function wp_plugin_menu(){
		add_menu_page("WP Auto Specs", "WP Auto Specs", "manage_options", AUTO_SPECS_PLUGIN_PAGE, [$this,"auto_specs_dashboard"],'dashicons-car');
		add_submenu_page(AUTO_SPECS_PLUGIN_PAGE, __( 'Performance Specs','auto_specswp'), __('Performance Specs','auto_specswp'), "manage_options", "performance_specswp_menu", [$this,"performance_specswp"]);
		add_submenu_page(AUTO_SPECS_PLUGIN_PAGE, __( 'Shortcodes','auto_specswp'), __('Shortcodes','auto_specswp'), "manage_options", "auto_specswp_menu", [$this,"auto_specswp_shortcodes"]);
		add_submenu_page(AUTO_SPECS_PLUGIN_PAGE, __( 'Settings','auto_specswp'), __('Settings','auto_specswp'), "manage_options", "settings_specswp", [$this,"settings_specswp"]);
	}
	public function settings_specswp(){
		include "settings.php";
	}
	public function auto_specswp_shortcodes(){
		if (isset($_POST['add_short'])) {
			$name = $_POST['shortcode_name'];
			if (!isset($_POST['shortcode_auto_id'])) {
				$auto_id = '0';
			}else{
				$auto_id = $_POST['shortcode_auto_id'];
			}
			$ids_perf = $this->get_perf_data("id",$auto_id);
			if (!empty($ids_perf)) {
				$perf_id = $ids_perf[0]['id'];
			}else{
				$perf_id = 0;
			}
			$this->add_shortcode($name,$perf_id,$auto_id);
		}
		if (isset($_POST['update_short'])) {
			$name = $_POST['shortcode_name'];
			$auto_id = $_POST['shortcode_auto_id'];
			$ids_perf = $this->get_perf_data("id",$auto_id);
			if (!empty($ids_perf)) {
				$perf_id = $ids_perf[0]['id'];
			}else{
				$perf_id = 0;
			}
			$up_id = $_POST['update_id'];
			$this->update_shortcode($name,$auto_id,$perf_id,$up_id);
		}

		include "shortcodes_table.php";
	}
	public function get_perf_data($request,$car_id){
		$part = '';
		if ($car_id != 0) {
			$part = " WHERE car_id='{$car_id}'";
		}else{$part = "";}
		return $this->db->get_results("SELECT $request FROM $this->performance_custom_table ".$part,ARRAY_A);
	}
	public function update_shortcode($name,$auto_id,$perf_id,$up_id){
		$this->db->update($this->shortcode_table,["auto_id"=>$auto_id,"perf_id"=>$perf_id,"shortcode_name"=>$name],['id'=>$up_id]);
	}
	public function add_shortcode($name,$perf_id,$auto_id){
		$this->db->insert($this->shortcode_table,["auto_id"=>$auto_id,"perf_id"=>$perf_id,"shortcode_name"=>$name]);
	}
	public function get_shortcodes($row = 0,$data_row = 0){
		$part = '';
		if ($row != 0) {
			$part = " LIMIT ".$row;
			if ($data_row != 0) {
				$part .= " OFFSET $data_row;";
			}
		}else{$part = "";}
		return $this->db->get_results("SELECT * FROM $this->shortcode_table".$part);
	}
	public function get_shortcode_by_id($name,$id){
		if ($name == "car") {
			return $this->db->get_results("SELECT * FROM $this->shortcode_table WHERE auto_id='{$id}' AND perf_id='0'");
		}else{
			return $this->db->get_results("SELECT * FROM $this->shortcode_table WHERE perf_id='{$id}'");
		}
	}
	public function update_data($data,$table){
		$id = $data["update_id"];
		unset($data["update_id"]);
		unset($data["list_save_Update"]);
		$this->db->update($table,$data,['id'=>$id]);
		if ($table == $this->performance_custom_table) {
			if ($data['car_id'] == 0) {
				$scode = $this->get_shortcode_by_id("perf",$id);
				if (!empty($scode)) {
					$this->update_shortcode($scode[0]->shortcode_name,$scode[0]->auto_id,0,$scode[0]->id);
				}
			}else{
				$scode = $this->get_shortcode_by_id("car",$data['car_id']);
				if (!empty($scode)) {
					$this->update_shortcode($scode[0]->shortcode_name,$scode[0]->auto_id,$id,$scode[0]->id);
				}
			}
		}
	}
	public function insert_post($data,$table){
		unset($data["list_save_Add"]);
		$this->db->insert($table,$data);
		if ($table == $this->performance_custom_table && $data['car_id'] != 0) {
			$scode = $this->get_shortcode_by_id('car',$data['car_id']);
			if (!empty($scode)) {
				$this->update_shortcode($scode[0]->shortcode_name,$scode[0]->auto_id,$this->db->insert_id,$scode[0]->id);
			}
		}
	}
	public function get_data_by_id($id,$table){
		return $this->db->get_results("SELECT * FROM $table WHERE id='{$id}'",ARRAY_A);	
	}
	public function get_table_length($table){
		return $this->db->get_results("SELECT count(*) length FROM $table")[0]->length;
	}
	public function get_all_data($request = '',$table,$row = 0,$data_row = 0){
		$part = '';
		if ($row != 0) {
			$part = " LIMIT ".$row;
			if ($data_row != 0) {
				$part .= " OFFSET $data_row;";
			}
		}else{$part = "";}
		if ($request == '') {
			return $this->db->get_results("SELECT * FROM $table".$part,ARRAY_A);	
		}else{
			return $this->db->get_results("SELECT $request FROM $table".$part,ARRAY_A);
		}
	}
	public function performance_specswp(){
		$default_action = null;
		if (isset($_GET['action']) && $_GET['action'] == "Remove") {
			$this->data_remove($_GET['carid']);
		}
  		$action = isset($_GET['action']) ? $_GET['action'] : $default_action;
		if (isset($_POST['list_save_Add'])) {
			$this->insert_post($_POST,$this->performance_custom_table);
		}
		if (isset($_POST['list_save_Update'])) {
			$this->update_data($_POST,$this->performance_custom_table);
		}
		switch($action) :
		      case 'Update':
		        include 'performance_specswp_action.php';
		        break;
		      case 'Add':
		        include "performance_specswp_action.php";
		        break;
		      case null:
		      	include "performance_specswp.php";
		        break;
		    endswitch;
	}

	public function auto_specs_dashboard(){
		$default_action = null;
		if (isset($_GET['action']) && $_GET['action'] == "Remove") {
			$this->data_remove($_GET['carid']);
		}
  		$action = isset($_GET['action']) ? $_GET['action'] : $default_action;
		if (isset($_POST['list_save_Add'])) {
			$this->insert_post($_POST,$this->custom_table);
		}
		if (isset($_POST['list_save_Update'])) {
			$this->update_data($_POST,$this->custom_table);
		}
		switch($action) :
		      case 'Update':
		        include 'wp-custom-create-edit.php';
		        break;
		      case 'Add':
		        include "wp-custom-create-edit.php";
		        break;
		      case null:
		      	include "wp-custom-table.php";
		        break;
		    endswitch;
	}

	public function plugin_tables_integration(){
		include "database.php";
	}

}

new WpAutoSpecs();