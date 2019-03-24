<?php if ( ! defined( 'ABSPATH' ) ) exit;  ?> 

<div class="meta-box-sortables ui-sortable">
	<div class="postbox">
		<button type="button" class="handlediv button-link" <?php echo (($type=="widget")?"onclick='archivesposttab_show_tab(this)'":""); ?>  aria-expanded="true">
			<span class="screen-reader-text">Settings</span>
			<span class="toggle-indicator" aria-hidden="true"></span>
		</button>
		<h2 class="hndle ui-sortable-handle"><span><?php echo $group_title; ?></span></h2>
		<div class="inside"> 
			<table class="archivesposttab-admin <?php echo (($type=="widget")?"archivesposttab-admin-widget":""); ?>" cellspacing="0" cellpadding="0">
				<?php echo $group_field; ?>
			</table>
		</div>
	</div> 
</div>