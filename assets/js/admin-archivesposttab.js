
jQuery(document).ready(function(){

	jQuery('.archivesposttab-color-field-1').wpColorPicker();
	jQuery('.archivesposttab-color-field-2').wpColorPicker();
	jQuery('.archivesposttab-color-field-3').wpColorPicker();
	jQuery('.archivesposttab-color-field-4').wpColorPicker();
	jQuery('.archivesposttab-color-field-5').wpColorPicker(); 
	jQuery('.archivesposttab-color-field-6').wpColorPicker(); 
	jQuery('.archivesposttab-color-field-7').wpColorPicker(); 
	jQuery('.archivesposttab-color-field-8').wpColorPicker(); 
	jQuery('.archivesposttab-color-field-9').wpColorPicker(); 
	
	 jQuery(document).ajaxComplete(function(d){  
		jQuery('.avptab-color-field').each(function(){
			   
			var obj_parent = jQuery(this).parent().parent().parent();
			jQuery(this).removeClass("wp-color-picker"); 
			jQuery(this).removeAttr("style");
			jQuery(this).show();
			jQuery(this).parent().find('.wp-picker-clear').remove();
			var hmt_color_picker_val =  jQuery(this).val();
			var hmt_color_picker = jQuery(this).parent().html();
			jQuery(obj_parent).html("<td class='text-fld-color tp-label'>"+jQuery(obj_parent).find("td:eq(0)").text()+"</td><td>"+hmt_color_picker+"</td>");
			jQuery(obj_parent).find(".archivesposttab-color-field-1").wpColorPicker();  
			jQuery(obj_parent).find(".archivesposttab-color-field-2").wpColorPicker();  
			jQuery(obj_parent).find(".archivesposttab-color-field-3").wpColorPicker();  
			jQuery(obj_parent).find(".archivesposttab-color-field-4").wpColorPicker();  
			jQuery(obj_parent).find(".archivesposttab-color-field-5").wpColorPicker();  
			jQuery(obj_parent).find('.archivesposttab-color-field-6').wpColorPicker(); 
			jQuery(obj_parent).find('.archivesposttab-color-field-7').wpColorPicker(); 
			jQuery(obj_parent).find('.archivesposttab-color-field-8').wpColorPicker(); 
			jQuery(obj_parent).find('.archivesposttab-color-field-9').wpColorPicker(); 
			jQuery(obj_parent).find("td").each(function(){
				if(jQuery.trim(jQuery(this).text())=="" || jQuery.trim(jQuery(this).text())=="Color value"){
					jQuery(this).remove();
				}
			}); 
		}); 
	}); 
	
	setInterval(function(){
		jQuery('.archivesposttab-admin-widget td').each(function(){
			if(jQuery(this).find("input").length <= 0 && jQuery(this).find("select").length <= 0 && (jQuery.trim(jQuery(this).text())=="" || jQuery.trim(jQuery(this).text())=="Color value")){
				jQuery(this).remove();
			} 
		});
		jQuery('.archivesposttab-admin-widget .text-fld-color.tp-label').each(function(){
			if(jQuery.trim(jQuery(this).text())=="" || jQuery.trim(jQuery(this).text())=="Color value"){
				jQuery(this).remove();
			} 
		});
		jQuery('.archivesposttab-admin-widget .cls-clr-fld').each(function(){
			 if(jQuery.trim(jQuery(this).text())=="" || jQuery.trim(jQuery(this).text())=="Color value"){
				jQuery(this).remove();
			 } 
		}); 
	},900);

}); 





function archivesposttab_show_tab(ob_tab) {	
	jQuery(document).ready(function($){		
		if( jQuery(ob_tab).parent().find(".inside").css("display") == "block") {
			jQuery(ob_tab).parent().find(".inside").css("display","none");
			jQuery(ob_tab).parent().addClass("closed");
		} else {
			jQuery(ob_tab).parent().find(".inside").css("display","block");
			jQuery(ob_tab).parent().removeClass("closed");
		}		
	});	
}

function archivesposttab_changeboolvalue(ob_bool){
	jQuery(document).ready(function($){
		
		var field_bool_val = $(ob_bool).attr("data_attr");
		if(field_bool_val=="yes") {
			field_bool_val="no";
		} else {
			field_bool_val="yes";
		}
		$(ob_bool).attr("data_attr",field_bool_val); 
		if(field_bool_val=="yes") {
			$(ob_bool).find(".cls-bool-field-ins").animate({ right:0, left:'50%'},function(){
				 $(this).css("background","#29e58e");
				 $(this).find("input").each(function(){
						if( $(this).val() == "yes" ) {
							$(this).prop( "checked", "checked" );
						}
				 });
			});
		} else {
			$(ob_bool).find(".cls-bool-field-ins").animate({ left:0,right:'50%'},function(){
				 
				 $(this).css("background","#ccc");
				 $(this).find("input").each(function(){
						if( $(this).val() == "no" ) {
							$(this).prop( "checked", "checked" );
						}
				 });
				 
			});
		}	
		$(".widget-control-save").removeAttr("disabled");
	});
}

function archivesposttab_show_tab(ob_tab) {	
	jQuery(document).ready(function($){		
		if( jQuery(ob_tab).parent().find(".inside").css("display") == "block") {
			jQuery(ob_tab).parent().find(".inside").css("display","none");
			jQuery(ob_tab).parent().addClass("closed");
		} else {
			jQuery(ob_tab).parent().find(".inside").css("display","block");
			jQuery(ob_tab).parent().removeClass("closed");
		}		
	});	
}

function ck_category_check(ob_check) {
		var is_checked_len = jQuery(ob_check).parent().parent().find('input:checked').length; 
		if( is_checked_len == 0 ) {
			ob_check.checked = true;
		} 
}

function avptab_exclude_category_list(ob){
	(function( $ ) {  
			var category_type = $(ob).val(); 
			var loading_image =  '<div id="avptab-temp-loader-ex"><img src="'+archivesposttab.avptab_media+'images/loader.gif" /></div>';
			$(ob).parent().parent().parent().parent().find(".category_on_types").html(loading_image); 
			$.ajax({
				url: archivesposttab.avptab_ajax_url,
				security: archivesposttab.avptab_security,
				data: {'action':'avptab_getExcludeCategoriesOnTypes',security: archivesposttab.avptab_security,category_type:category_type},
				success:function(data) {  
					$(ob).parent().parent().parent().parent().find(".category_on_types").html(data);
					 $("#avptab-temp-loader-ex").remove();
				},error: function(errorThrown){ console.log(errorThrown);}
			}); 
  })( jQuery );	 
}			

function avptab_exclude_category_list_widget(ob){
	(function( $ ) {  
			var category_type = $(ob).val();
			var category_field_name = $(ob).parent().find("input.hid-category-name").val();
			var loading_image =  '<div id="avptab-temp-loader-ex"><img src="'+archivesposttab.avptab_media+'images/loader.gif" /></div>';
			$(ob).parent().parent().parent().parent().parent().find(".category_on_types").html(loading_image); 
			$.ajax({
				url: archivesposttab.avptab_ajax_url,
				security: archivesposttab.avptab_security,
				data: {'action':'avptab_getExcludeCategoriesOnTypes',security: archivesposttab.avptab_security,category_field_name:category_field_name,category_type:category_type},
				success:function(data) {   
					 $(ob).parent().parent().parent().parent().parent().find(".category_on_types").html(data);
					 $("#avptab-temp-loader-ex").remove();
				},error: function(errorThrown){ console.log(errorThrown);}
			}); 
  })( jQuery );	 
}	

function sel_change_categories_on_type(ob){
	(function( $ ) { 
		$(function() {
			var category_type = $(ob).val();
			var loading_image =  '<div id="avptab-temp-loader"><img src="'+archivesposttab.avptab_media+'images/loader.gif" /></div>';
			$(ob).parent().parent().parent().parent().parent().find(".fld_checkbox_category_id").parent().append(loading_image);
			$(ob).parent().parent().parent().parent().parent().find(".fld_checkbox_category_id").hide();
			$.ajax({
				url: archivesposttab.avptab_ajax_url,
				security: archivesposttab.avptab_security,
				data: {'action':'avptab_getCategoriesOnTypes',security: archivesposttab.avptab_security,category_type:category_type},
				success:function(data) { 
					 $(ob).parent().parent().parent().parent().parent().find(".fld_checkbox_category_id").show();
					 $(ob).parent().parent().parent().parent().parent().find(".fld_checkbox_category_id").html(data);
					 $("#avptab-temp-loader").remove();
				},error: function(errorThrown){ console.log(errorThrown);}
			});    
			
		});  
		avptab_exclude_category_list(ob); 
	})( jQuery );	 
} 

function sel_change_categories_on_type_widget(ob){
	(function( $ ) { 
		$(function() {
			var category_type = $(ob).val();
			var loading_image =  '<div id="avptab-temp-loader"><img src="'+archivesposttab.avptab_media+'images/loader.gif" /></div>';
			$(ob).parent().parent().parent().parent().parent().find(".fld_checkbox_category_id").parent().append(loading_image);
			$(ob).parent().parent().parent().parent().parent().find(".fld_checkbox_category_id").hide();
			$.ajax({
				url: archivesposttab.avptab_ajax_url,
				security: archivesposttab.avptab_security,
				data: {'action':'avptab_getCategoriesOnTypes',security: archivesposttab.avptab_security,category_type:category_type},
				success:function(data) {
					 $(ob).parent().parent().parent().parent().parent().find(".fld_checkbox_category_id").show();
					 $(ob).parent().parent().parent().parent().parent().find(".fld_checkbox_category_id").html(data);
					 $("#avptab-temp-loader").remove();
				},error: function(errorThrown){ console.log(errorThrown);}
			});    
		});  
		avptab_exclude_category_list_widget(ob); 
	})( jQuery );	 
} 
 
function avptab_change_default_dates(ob) { 
	(function( $ ) { 
	 	$(function() { 
			var loading_image =  '<div id="avptab-temp-loader"><img src="'+archivesposttab.avptab_media+'images/loader.gif" /></div>';
			$(ob).parent().parent().parent().parent().parent().find(".avptab_default_date_open").parent().append(loading_image);
			$(ob).parent().parent().parent().parent().parent().find(".avptab_default_date_open").hide();
		 	$.ajax({
				url: archivesposttab.avptab_ajax_url,
				security: archivesposttab.avptab_security,
				data: { 'action':'avptab_getListDateArray', security: archivesposttab.avptab_security,date_format:$(ob).parent().parent().parent().parent().parent().find(".date_format").val(), pst_type:$(ob).parent().parent().parent().parent().parent().find(".ac_post_type").val() },
				success:function(data) { 
					 $(ob).parent().parent().parent().parent().parent().find(".avptab_default_date_open").show();
					 $(ob).parent().parent().parent().parent().parent().find(".avptab_default_date_open").html(data);
					 $("#avptab-temp-loader").remove(); 
					 if( $(ob).parent().parent().parent().parent().parent().find(".avptab_show_all_pane1" ).is( ":checked" ) ) {  
						$(ob).parent().parent().parent().parent().parent().find(".avptab_default_date_open").append( '<option selected="true" value="all">'+archivesposttab.avptab_all+'</option>' );  
					 }
				},error: function(errorThrown){ console.log(errorThrown);}
			});
			
		});  
	})( jQuery );	
}

function avptab_remove_all_option(ob_opt){ 
	(function( $ ) {  
		$(ob_opt).find("option[value='all']").remove();	 
	})( jQuery );		
} 

function avptab_allow_all_pane( rd_object_values ) { 

	(function( $ ) {  
		$(function() {
			avptab_remove_all_option($(rd_object_values).parent().parent().parent().parent().parent().find(".avptab_default_date_open"));
			if( rd_object_values.value == "yes" ) { 
				$(rd_object_values).parent().parent().parent().parent().parent().find(".avptab_default_date_open").append('<option selected="true" value="all">'+archivesposttab.avptab_all+'</option>'); 
			}   
		});   
	})( jQuery );	
	
}