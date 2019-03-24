<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	 $params = $_REQUEST;  
	 $_date_format = ( isset( $params["date_format"] ) ? ( $params["date_format"] ) : 0 ); 
	 $category_id =( isset( $params["category_id"] ) ?  ( $params["category_id"] ) : 0 );
	 $avptab_default_category = ( isset( $params["avptab_default_category"] )?  $params["avptab_default_category"]:$category_id );
	 $post_search_text =( isset( $params["post_search_text"] ) ? esc_html( $params["post_search_text"] ) : "" ); 
	 $_limit_start =( isset( $params["limit_start"] ) ? intval( $params["limit_start"] ) : 0 );
	 $_limit_end = intval( $params["number_of_post_display"] );
	 $flg_pr =( isset( $params["flg_pr"] ) ? intval( $params["flg_pr"] ) : 0 );  
	 
	 $is_default_category_with_hidden = 0;
	 if( $params["hide_categorybox"] == "yes" )
		$is_default_category_with_hidden = 1; 
	
	$final_width = $params["avptab_image_content_width"];	  	
	$avptab_image_height = ( $params["avptab_image_height"] ); 
	$avptab_image_content_width = $final_width;
	$avptab_mouse_hover_effect = $params["avptab_mouse_hover_effect"];  
	   
	if( $this->avptab_getTotalPosts( $_date_format, 0, $post_search_text, 0, $is_default_category_with_hidden ) > 0 || $flg_pr==2 ) {
		$_category_res = $this->getCategories($category_id, sanitize_text_field($params["avptab_category_type"]), $params["avptab_hide_empty_category"]);
		if( count( $_category_res ) > 0 && !( sanitize_text_field( $params["hide_searchbox"] ) == 'yes' && sanitize_text_field( $params["hide_categorybox"] )=='yes' ) ) { 
			?> 
			<div class="ik-post-category"> 
				<?php if( sanitize_text_field( $params["hide_searchbox"] ) == 'no' ) { ?>
					 <input type="text" name="txtSearch" placeholder="<?php echo __( 'Search', 'archivesposttab' ); ?>" value="<?php echo esc_html( htmlspecialchars( stripslashes( $post_search_text ) ) ); ?>" class="ik-post-search-text"  /> 
				<?php } ?>
				
				<?php if( sanitize_text_field( $params["hide_categorybox"] ) == 'no' ) { ?>
					<select name="drpCategory" class="ik-drp-post-category" >
							<option <?php echo ((trim($params["avptab_default_category"])==trim($params["category_id"]))?'selected="true"':""); ?>  value="<?php echo esc_js( $params["category_id"]  ); ?>"><?php echo __('All', 'archivesposttab') ?></option>
							<?php
								foreach($_category_res as $_category){ 
									$_category_name = $_category->name;
									$_category_id = $_category->term_id;
									if((trim($params["avptab_default_category"])!=trim($params["category_id"])) && $avptab_default_category==$_category_id){
										?><option selected="true" value="<?php echo $_category_id; ?>"><?php echo ($this->get_hierarchy_dash($_category->term_group)).esc_html($_category_name ); ?></option><?php
									}else{
										?><option value="<?php echo $_category_id; ?>"><?php echo ($this->get_hierarchy_dash($_category->term_group)).esc_html( $_category_name ); ?></option><?php
									}
								}
							?>
						</select>  
				<?php } ?>
				
				<span class="ik-search-button" onclick='avptab_fillPosts( "<?php echo esc_js( $params["vcode"]."-".$_date_format ); ?>", "<?php echo esc_js( $_date_format ); ?>",  request_obj_<?php echo esc_js( $params["vcode"] ); ?>, 2)'>
					<img width="18px" alt="Search" height="18px" src="<?php echo avptab_media.'images/searchicon.png'; ?>" />
				</span>
				<div class="clrb"></div>
			</div>
		 <?php
		}
	} else { echo "<input type='hidden' value='".$category_id."' class='ik-drp-post-category' />"; }
	$_total_posts = $this->avptab_getTotalPosts( $_date_format, $avptab_default_category, $post_search_text, 1, $is_default_category_with_hidden );
	if( $_total_posts <= 0 ) {
		?><div class="ik-post-no-items"><?php echo __( 'No posts found.', 'archivesposttab' ); ?></div><?php
		die();
	} 
	$post_list = $this->getPostList( $avptab_default_category, $post_search_text, $_date_format, $_limit_end );	 
	 
	foreach ( $post_list as $_post ) { 
		$image  = $this->getPostImage( $_post->post_image, $final_width, $params["avptab_image_height"] );
		$_author_name = esc_html($_post->display_name);
	    $_author_image = get_avatar($_post->post_author,25);
		?>
		<div  style="width:<?php echo esc_attr( $final_width ); ?>px;" class='ikh-post-item-box pid-<?php echo esc_attr( $_post->post_id ); ?>'> 
			<div class="ikh-post-item ikh-simple"> 
			<?php
			ob_start();
			if( $params["avptab_hide_post_image"] == "no" ) { ?>
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
							
							<?php if( sanitize_text_field( $params["hide_post_title"] ) =='no'){ ?> 
								<a href="<?php echo get_permalink( $_post->post_id ); ?>" style="color:<?php echo esc_attr( $params["title_text_color"] ); ?>" >
									<?php echo esc_html( $_post->post_name ); ?>
								</a>	
							<?php } ?>
							
							<?php if( sanitize_text_field( $params["avptab_hide_posted_date"] ) =='no'){ ?> 
								<div class='ik-post-date'>
									<i><?php echo date(get_option("date_format"),strtotime($_post->post_date)); ?></i>
								</div>
							<?php } ?>	

							<?php if( $params["avptab_hide_post_short_content"] == "no" ) { ?>
								<div class='ik-post-sub-content'>
									<?php
									if( strlen( strip_tags( $_post->post_content ) ) > intval( $params["avptab_hide_post_short_content_length"] ) ) 	
										echo substr( strip_tags( $_post->post_content ), 0, $params["avptab_hide_post_short_content_length"] ).".."; 
									else
										echo trim( strip_tags( $_post->post_content ) );
									?> 
								</div>
							<?php } ?> 
					
						</div> 
						 
						
						<?php if( sanitize_text_field( $params["avptab_show_author_image_and_name"] ) =='yes') { ?> 
							<div class='ik-post-author'>
								<?php echo (($_author_image!==FALSE)?$_author_image:"<img src='".avptab_media."images/user-icon.png' width='25' height='25' />"); ?> <?php echo __( 'By', 'archivesposttab' ); ?> <?php echo $_author_name; ?>
							</div>
						<?php } ?>	 
  					
						<?php if( sanitize_text_field( $params["avptab_hide_comment_count"] ) =='no'){ ?> 
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
						
						<?php if( $params["avptab_read_more_link"] == "no" ) { ?>
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
	
	if( $params["avptab_hide_paging"] == "no" && $params["avptab_select_paging_type"] == "load_more_option"   && $_total_posts > sanitize_text_field( $params["number_of_post_display"] ) ) {
	
		?>	
		<div class="clr"></div>
		<div  style="display:none" class='ik-post-load-more'  align="center" onclick = 'avptab_loadMorePosts( "<?php echo esc_js( $_date_format ); ?>", "<?php echo esc_js( $_limit_start+$_limit_end ); ?>", "<?php echo esc_js( $params["vcode"]."-".$_date_format ); ?>", "<?php echo esc_js( $_total_posts ); ?>", request_obj_<?php echo esc_js( $params["vcode"] ); ?> )'>
			<?php echo __('Load More', 'archivesposttab' ); ?>
		</div>
		<?php 
		
	} else if( $params["avptab_hide_paging"] == "no" && $params["avptab_select_paging_type"] == "next_and_previous_links" ) {
	
			?><div class="clr"></div>
		 <div style="display:none"  class="avptab-simple-paging"><?php
			echo $this->displayPagination(  0, $_total_posts, $_date_format, $_limit_start, $_limit_end, $params["vcode"], 2 );
		  ?></div><div class="clr"></div><?php	
	
	} else if( $params["avptab_hide_paging"] == "no" && $params["avptab_select_paging_type"] == "simple_numeric_pagination" ) {
	
		?><div class="clr"></div>
		 <div   style="display:none" class="avptab-simple-paging"><?php
			echo $this->displayPagination(  0, $_total_posts, $_date_format, $_limit_start, $_limit_end, $params["vcode"], 1 );
		  ?></div><div class="clr"></div><?php	
	
	} else {
		?> <div class="clr"></div> <?php
	} 
	?><script type='text/javascript' language='javascript'><?php echo $this->avptab_js_obj( $params ); ?></script>
	