<?php if ( ! defined( 'ABSPATH' ) ) exit;   $vcode = $this->_config["vcode"];  ?>
<script type='text/javascript' language='javascript'>var default_category_id_<?php echo $vcode; ?> = '<?php echo $this->_config["category_id"]; ?>';  <?php echo $this->avptab_js_obj( $this->_config ); ?></script>
<?php
	$_avptab_default_date_open = $this->_config["avptab_default_date_open"]; 
	$avptab_category_type = $this->_config["avptab_category_type"]; 
	$post_type = $this->_config["post_type"]; 
	$date_format = $this->_config["date_format"]; 
	$_is_rtl_enable = $this->_config["avptab_enable_rtl"];
	$avptab_enable_post_count = $this->_config["avptab_enable_post_count"];
	$avptab_hide_empty_category = $this->_config["avptab_hide_empty_category"];
	$avptab_default_date_open = $this->_config["avptab_default_date_open"];
	$avptab_short_category_name_by = $this->_config["avptab_short_category_name_by"];
	$avptab_show_all_pane = $this->_config["avptab_show_all_pane"];	
    //$avptab_exclude_category = $this->_config["avptab_exclude_category"]; 
	$_panel_list = $this->getTabsArray($post_type, $date_format); 
	$avptab_hide_paging = $this->_config["avptab_hide_paging"]; 
	$avptab_hide_post_image = $this->_config["avptab_hide_post_image"]; 
	$avptab_hide_post_short_content = $this->_config["avptab_hide_post_short_content"]; 
	$avptab_select_paging_type = $this->_config["avptab_select_paging_type"];  
	$avptab_hide_post_short_content_length = $this->_config["avptab_hide_post_short_content_length"];  
	$avptab_read_more_link = $this->_config["avptab_read_more_link"]; 	
	$avptab_image_content_width = $this->_config["avptab_image_content_width"];	
	$avptab_image_height = $this->_config["avptab_image_height"]; 	
	$avptab_shorting_posts_by = $this->_config["avptab_shorting_posts_by"]; 
	$avptab_post_ordering_type = $this->_config["avptab_post_ordering_type"]; 
	$avptab_mouse_hover_effect = $params["avptab_mouse_hover_effect"];  
	
	$avptab_space_margin_between_posts = $this->_config["avptab_space_margin_between_posts"];
	$avptab_posts_grid_alignment = $this->_config["avptab_posts_grid_alignment"];
	$avptab_posts_loading_effect_on_pagination = $this->_config["avptab_posts_loading_effect_on_pagination"];
	$avptab_mouse_hover_effect = $this->_config["avptab_mouse_hover_effect"];
	$avptab_show_author_image_and_name = $this->_config["avptab_show_author_image_and_name"]; 
	$template = $this->_config["template"];

	$_u_agent = $_SERVER['HTTP_USER_AGENT'];
	$_m_browser = '';  
	if(strpos($_u_agent,'MSIE')>-1)
		$_m_browser = 'cls-ie-browser';
?>
 <div id="archivesposttab" style="width:<?php echo esc_attr($this->_config["tp_widget_width"]); ?>"  class="  <?php echo ((trim($_is_rtl_enable)=="yes")?"avptab-rtl-enabled":""); ?>  cls-<?php echo $avptab_posts_grid_alignment; ?> <?php echo $template; ?>">
	<?php if($this->_config["hide_widget_title"]=="no"){ ?>
		<div class="ik-panel-tab-title-head" style="background-color:<?php echo esc_attr($this->_config["header_background_color"]); ?>;color:<?php echo esc_attr($this->_config["header_text_color"]); ?>"  >
			<?php echo $this->_config["widget_title"]; ?>   
		</div>
	<?php } ?> 
	<span class='wp-load-icon'>
		<img width="18px" height="18px" src="<?php echo avptab_media.'images/loader.gif'; ?>" />
	</span>
	<div class="wea_content  <?php echo $_m_browser; ?> lt-tab <?php echo esc_attr($avptab_select_paging_type); ?> ">
		<?php 
		
			$_image_width_item = 0;
			if( intval($avptab_image_content_width) > 0 ) {
				$_image_width_item = intval($avptab_image_content_width); 
			}	 
			?><input type="hidden" class="imgwidth" value = "<?php echo $_image_width_item; ?>" /><?php 
			$_total_post_count = 0;
			$_category_res_n = array(); 
			
			$_date_range_array = array(); 
				
			if( count( $_panel_list ) > 0 ) {
					 
		        $category_id = $this->_config["category_id"]; 
				foreach( $_panel_list as $__pane_key => $__pane_text ) {  
					if( trim($avptab_enable_post_count) == "yes" ) 
						$_count_all_posts = $this->avptab_getTotalPosts( $__pane_key, 0, "", 0, 0 );
					else
						$_count_all_posts = 0;
					
					$_total_post_count = $_count_all_posts + $_total_post_count; 
					$_date_range_array[$__pane_key] = array( "value" => $__pane_text, "count" => $_count_all_posts );
				}
					
			 
				if( trim($avptab_show_all_pane) == "yes" ) { 
				 					
					$arr_category_title = array();
					if( count( $_date_range_array ) > 0 ) {
						foreach( $_date_range_array as $_ckey => $_category_item ) {
							$_category_res_n[$_ckey] = $_category_item;
							$arr_category_title[$_ckey] = array( "value" => $_category_item["value"], "count" => $_category_item["count"] );
						}
					} 
					if($avptab_short_category_name_by=="asc")
						array_multisort($arr_category_title,SORT_ASC,$_category_res_n);
					else
						array_multisort($arr_category_title,SORT_DESC,$_category_res_n);
						
					$_category_res_n = array();
					if( count( $_date_range_array ) > 0 ) {
						$_category_res_n['all'] =   array( "value" => __( 'All', 'archivesposttab' ), "count" => $_total_post_count );
						foreach( $_date_range_array as $_ckey => $_category_item ) {
							$_category_res_n[$_ckey] = $_category_item; 
						}
					} 	
						
					$_date_range_array = $_category_res_n;
					
				} 
				
				 
				foreach( $_date_range_array as $__pane_key => $__pane_text ) {
				
				$__pn_item_class = "";
				if( trim( $avptab_default_date_open ) != "" && trim( $avptab_default_date_open ) == $__pane_key ) { 
					$__pn_item_class = " pn-active";
				} 
				
				  ?>
					<div class="item-panel-list">
						<div class="panel-item <?php echo esc_attr($__pn_item_class); ?>"  onmouseout="avptab_panel_ms_out( this )" onmouseover="avptab_panel_ms_hover( this )" id="<?php echo esc_attr($vcode).'-'.esc_attr($__pane_key); ?>" onclick="avptab_fillPosts( this.id, '<?php echo esc_js($__pane_key);?>', request_obj_<?php echo esc_js($vcode); ?>, 1 )"  style="color:<?php echo esc_attr($this->_config["panel_text_color"]); ?>;background-color:<?php echo esc_attr($this->_config["tab_background_color"]); ?>;" >
							<div class="panel-item-text"  onmouseout="avptab_panel_ms_out( this.parentNode )" onmouseover="avptab_panel_ms_hover( this.parentNode )">
								<?php echo $__pane_text["value"]; ?> 
								<?php 
									if( trim($avptab_enable_post_count) == "yes" ) 
										echo "(".$__pane_text["count"].")"; 
								?>
							</div>
							<div class="ld-panel-item-text"></div>
							<div class="clr"></div>
						</div>	 
					 </div>  
				   <?php
				}
				?>
				<div class="clr"></div>
				<div class="item-posts <?php echo $avptab_mouse_hover_effect; ?>">
						<input type="hidden" class="ikh_templates" value="<?php echo $avptab_posts_grid_alignment; ?>" />
						<input type="hidden" class="ikh_posts_loads_from" value="<?php echo $avptab_posts_loading_effect_on_pagination; ?>" />
						<input type="hidden" class="ikh_border_difference" value="0" />
						<input type="hidden" class="ikh_margin_bottom" value="<?php echo $avptab_space_margin_between_posts; ?>" />
						<input type="hidden" class="ikh_margin_left" value="<?php echo $avptab_space_margin_between_posts; ?>" />
						<input type="hidden" class="ikh_image_height" value="<?php echo $avptab_image_height; ?>" />
						<input type="hidden" class="ikh_item_area_width" value="<?php echo $_image_width_item; ?>" /> 
						<div class="item-posts-wrap">
							
							<?php 
								 	// Default category opened category start
									if( trim( $avptab_default_date_open ) != ""  ) { 
									
										     $_date_format = $avptab_default_date_open;  
											 $post_search_text =  "" ; 
											 $_limit_start = 0;
											 $_limit_end =  $this->_config["number_of_post_display"]; 
											 $is_default_category_with_hidden = 0; 
											 if( $this->_config["hide_categorybox"] == "yes" )
												$is_default_category_with_hidden = 1; 
											 
											 $this->_config["category_id"] = $category_id;
											 ?><script type='text/javascript' language='javascript'><?php echo $this->avptab_js_obj( $this->_config ); ?></script><?php
											if( $this->avptab_getTotalPosts( $_date_format, 0, $post_search_text, 0, $is_default_category_with_hidden ) > 0 ) {
											
												$_category_res = $this->getCategories( $category_id, $avptab_category_type, $avptab_hide_empty_category );
												if( count( $_category_res ) > 0 && !( sanitize_text_field( $this->_config["hide_searchbox"] ) == 'yes' && sanitize_text_field( $this->_config["hide_categorybox"] )=='yes' ) ) {
											 	?> 
													<div class="ik-post-category"> 
														<?php if( sanitize_text_field( $this->_config["hide_searchbox"] ) == 'no' ) { ?>
															 <input type="text" name="txtSearch" placeholder="<?php echo __( 'Search', 'archivesposttab' ); ?>" value="<?php echo esc_html( htmlspecialchars( stripslashes( $post_search_text ) ) ); ?>" class="ik-post-search-text"  /> 
														<?php } ?>
														
														<?php if( sanitize_text_field( $this->_config["hide_categorybox"] ) == 'no' ) {
														 ?>
																<select name="drpCategory"   class="ik-drp-post-category" >
																	<option value="<?php echo $category_id; ?>" ><?php echo __('All', 'archivesposttab') ?></option>
																	<?php
																		foreach($_category_res as $_category){ 
																			$_category_name = $_category->name;
																			$_category_id = $_category->term_id;
																			?><option value="<?php echo $_category_id; ?>"><?php echo ($this->get_hierarchy_dash($_category->term_group)).esc_html( $_category_name ); ?></option><?php																			 
																		}
																	?>
																</select>  
														<?php } ?>
														
														<span class="ik-search-button" onclick='avptab_fillPosts( "<?php echo esc_js( $this->_config["vcode"]."-".$_date_format ); ?>", "<?php echo esc_js( $_date_format ); ?>",  request_obj_<?php echo esc_js( $this->_config["vcode"] ); ?>, 2)'> <img width="18px" alt="Search" height="18px" src="<?php echo avptab_media.'images/searchicon.png'; ?>" />
														</span>
														<div class="clrb"></div>
													</div>
												 <?php
												}
											} else { echo "<input type='hidden' value='".$category_id."' class='ik-drp-post-category' />"; }
											$_total_posts = $this->avptab_getTotalPosts( $_date_format, $category_id, $post_search_text, 1, $is_default_category_with_hidden );
											if( $_total_posts <= 0 ) {
												?><div class="ik-post-no-items"><?php echo __( 'No posts found.', 'archivesposttab' ); ?></div><?php 
											} 
											 	 
											$post_list = $this->getSqlResult( $_date_format, $category_id, $post_search_text, 0, $_limit_end);
											 
											foreach ( $post_list as $_post ) { 
												$image  = $this->getPostImage( $_post->post_image, $_image_width_item, $this->_config["avptab_image_height"] ); 
												$_author_name = esc_html($_post->display_name);
												$_author_image = get_avatar($_post->post_author,25);
												?>
												<div style="width:<?php echo esc_attr( $avptab_image_content_width ); ?>px;" class='ikh-post-item-box pid-<?php echo esc_attr( $_post->post_id ); ?>'> 
													<div class="ikh-post-item ikh-simple">
														<?php
														ob_start();
														if( $avptab_hide_post_image == "no" ) { ?>
															<div class='ikh-image'> 	 
																<a href="<?php echo get_permalink( $_post->post_id ); ?>"> 
																	<?php echo $image; ?>
																</a> 
															</div>  
														<?php } 
														$_ob_image = ob_get_clean(); 
														
														ob_start();
														?> 
														<div class='ikh-content'> 
															<div class="ikh-content-data">  
																<div class='ik-post-name'>
																
																	<?php if( sanitize_text_field( $this->_config["hide_post_title"] ) =='no'){ ?> 
																		<a href="<?php echo get_permalink( $_post->post_id ); ?>" style="color:<?php echo esc_attr( $this->_config["title_text_color"] ); ?>" >
																			<?php echo esc_html( $_post->post_name ); ?>
																		</a>
																	<?php } ?> 
																	
																	<?php if( sanitize_text_field(  $this->_config["avptab_hide_posted_date"] ) =='no') { ?> 
																		<div class='ik-post-date'>
																			<i><?php echo date(get_option("date_format"),strtotime($_post->post_date)); ?></i>
																		</div>
																	<?php } ?>
																	
																	<?php if( $avptab_hide_post_short_content == "no" ) { ?>
																		<div class='ik-post-sub-content'>
																			<?php 																		
																			 if( strlen( strip_tags( $_post->post_content ) ) > intval( $avptab_hide_post_short_content_length ) ) 	
																				echo substr( strip_tags( $_post->post_content ), 0, $avptab_hide_post_short_content_length )."..";  
																			 else
																				echo trim( strip_tags( $_post->post_content ) );																			
																			?> 
																		</div>
																	<?php } ?>	
																	
																</div> 
															
																<?php if( sanitize_text_field(  $this->_config["avptab_hide_comment_count"] ) =='no') { ?> 
																	<div class='ik-post-comment'>
																		<?php 
																			$_total_comments = (get_comment_count($_post->post_id)); 
																			if($_total_comments["total_comments"] > 0) {
																				echo $_total_comments["total_comments"]; 
																				?> <?php echo (($_total_comments["total_comments"]>1)?__( 'Comments', 'archivesposttab' ):__( 'Comment', 'archivesposttab' )); 
																			}
																		?>
																	</div>
																<?php } ?>	  
																
																<?php if( sanitize_text_field( $this->_config["avptab_show_author_image_and_name"] ) =='yes') { ?> 
																	<div class='ik-post-author'>
																		<?php echo (($_author_image!==FALSE)?$_author_image:"<img src='".avptab_media."images/user-icon.png' width='25' height='25' />"); ?> <?php echo __( 'By', 'archivesposttab' ); ?> <?php echo $_author_name; ?>
																	</div>
																<?php } ?>

																<?php if( $avptab_read_more_link == "no" ) { ?>
																	<div class="avptab-read-more-link">
																		<a class="lnk-post-content" href="<?php echo get_permalink( $_post->post_id ); ?>" >
																			<?php echo __( 'Read More', 'archivesposttab' ); ?>
																		</a>
																	</div>
																<?php } ?> 
															</div>	
														</div>	
														<?php
														$_ob_content = ob_get_clean(); 
													
														if($avptab_mouse_hover_effect=='ikh-image-style-40'|| $avptab_mouse_hover_effect=='ikh-image-style-41' ){
															echo $_ob_content;
															echo $_ob_image;
														} else {
															echo $_ob_image;
															echo $_ob_content;														
														}	
													?>
													<div class="clr"></div>
													</div>
												</div> 
												<?php 
											} 
											
											if( $avptab_hide_paging == "no" &&  $avptab_select_paging_type == "load_more_option" && $_total_posts > sanitize_text_field( $this->_config["number_of_post_display"] ) ) { 

													?>
													<div class="clr"></div>
													<div style="display:none"  class='ik-post-load-more'  align="center" onclick='avptab_loadMorePosts( "<?php echo esc_js( $_date_format ); ?>", "<?php echo esc_js( $_limit_start+$_limit_end ); ?>", "<?php echo esc_js( $this->_config["vcode"]."-".$_date_format ); ?>", "<?php echo esc_js( $_total_posts ); ?>", request_obj_<?php echo esc_js( $this->_config["vcode"] ); ?> )'>
														<?php echo __('Load More', 'archivesposttab' ); ?>
													</div>
													<?php   
												 
											} else if( $avptab_hide_paging == "no" &&  $avptab_select_paging_type == "next_and_previous_links" ) { 

												  ?><div class="clr"></div>
													<div style="display:none"  class="avptab-simple-paging"><?php
													echo $this->displayPagination(  0, $_total_posts, $_date_format, $_limit_start, $_limit_end, $this->_config["vcode"], 2 );
													?></div><div class="clr"></div><?php

											} else if( $avptab_hide_paging == "no" &&  $avptab_select_paging_type == "simple_numeric_pagination" ) { 
													?><div class="clr"></div>
													<div  style="display:none" class="avptab-simple-paging"><?php
													echo $this->displayPagination(  0, $_total_posts, $_date_format, $_limit_start, $_limit_end, $this->_config["vcode"], 1 );
													?></div><div class="clr"></div><?php
											} else {
												?><div class="clr"></div><?php
											}
											
									
									}  
									// End Default category opened.
							?> 
						
					</div>	
				</div>
				<div class="clr"></div>
					
				<?php
				
			}			
		?>
		<div class="clr"></div>
	</div>
</div>
