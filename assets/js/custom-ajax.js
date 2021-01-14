jQuery(function(){
	let $ = jQuery;

	if ($('#custom_css').length > 0) {
		wp.codeEditor.initialize($('#custom_css'), cm_settings);
	}

	$(".button_remove").click(function(){
		let id = $(this).attr("data-id");
		let table = $(this).attr("data-table");
		$.ajax({
			type: "POST",
			data:{action : "remove_data",id:id,table:table},
			url: wp_admin_ajax_object.ajax_url,
			success: function (result) {
				location.reload();
			}
		});
	});

	$(".auto_specs_modal_open").click(function(){
		let action = $(this).attr("data-action");
		let modal = $(".auto_specs_modal").attr("data-modal");
		if (modal == "off") {
			$(".auto_specs_modal").attr("data-modal","on");
			if ($("#shortcode_id_aute").attr("disabled") && $("#shortcode_id_perf").attr("disabled")) {
				$("button[form='short_form_submit']").hide();
			}
		}else{
			$(".auto_specs_modal").attr("data-modal","off");
		}
		if (action == "edit") {
			let id = $(this).attr("data-id");
			let name = $(this).parent().parent().find("td[name='shortcode_name']").text();
			let car_id = $(this).parent().parent().find("td[name='car_id']").attr("data-id");
			
			$("#shortcode_name").val(name);
			$("#shortcode_id").val(car_id);
			$("#short_form_submit").append("<input type='hidden' value='"+id+"' name='update_id'>");
			$("button[name='add_short']").attr("name","update_short");
		}

	});

	$('.newtype').keypress(function (event) {
	        return isNumber(event, this)
	});

	// THE SCRIPT THAT CHECKS IF THE KEY PRESSED IS A NUMERIC OR DECIMAL VALUE.
	function isNumber(evt, element) {
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (            
	        (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
	        (charCode < 48 || charCode > 57))
	        return false;
	        return true;
	}

	$("#enable_shortcode_pagination").click(function(){
		if ($("#enable_shortcode_pagination")[0].checked == true) {
			$(".rows_shortcode_pagination").fadeIn(300)
		}else{
			$(".rows_shortcode_pagination").fadeOut(300)
		}
	});
	$("#enable_admin_pagination").click(function(){
		if ($("#enable_admin_pagination")[0].checked == true) {
			$(".rows_admin_pagination").fadeIn(300)
		}else{
			$(".rows_admin_pagination").fadeOut(300)
		}
	});

	$(".pagination_next_prev span[role='next']").click(function(){
		let id = $(this).parent().attr("data-id");
		let row = Number($(this).parent().attr("data-row"));
		let count = $(this).parent().attr("data-count");
		let start = Number($(this).parent().attr("data-start"));
		if (count > (start+row)) {
			$(this).parent().attr("data-start",(start+row));
		}
		start = Number($(this).parent().attr("data-start"))-1;
		$(".shortcode_table_view[data-id='"+id+"'] .field_val").each(function(e){
			if (start < e && e < (start+row)+1) {
				$(this).removeClass("hide_table_field");
				if ($(this).prev().hasClass("hide_table_field") && $(this).prev().hasClass("category_title")) {
					$(this).prev().removeClass("hide_table_field");
				}
			}else{
				$(this).addClass("hide_table_field");
				if (!$(this).prev().hasClass("hide_table_field") && $(this).prev().hasClass("category_title")) {
					$(this).prev().addClass("hide_table_field");
				}
			}
		});

	});

	$(".pagination_next_prev span[role='prev']").click(function(){
		let id = $(this).parent().attr("data-id");
		let row = Number($(this).parent().attr("data-row"));
		let count = $(this).parent().attr("data-count");
		let start = Number($(this).parent().attr("data-start"));
		if (start > 0) {
			let num = (start-row)+'';
			$(".shortcode_table_view[data-id='"+id+"'] .field_val").each(function(e){
				num = num.replace('-1','0');
				if (start > e && e > (Number(num)-1)) {
					$(this).removeClass("hide_table_field");
					if ($(this).prev().hasClass("hide_table_field") && $(this).prev().hasClass("category_title")) {
						$(this).prev().removeClass("hide_table_field");
					}
				}else{
					$(this).addClass("hide_table_field");
					if (!$(this).prev().hasClass("hide_table_field") && $(this).prev().hasClass("category_title")) {
						$(this).prev().addClass("hide_table_field");
					}
				}
			});

			if (start >= row) {
				$(this).parent().attr("data-start",(start-row));
			}else{
				$(this).parent().attr("data-start",0);
			}
		}
	});
});