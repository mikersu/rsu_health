<li id="<?php echo $block->block_id; ?>" itemid="listitem_<?php echo $block->block_id; ?>" class="each-block<?php if ( $block->block_status == '0' ) {echo ' block-disabled';} ?>">
	<h4 class="block-title"><?php echo $this->blocks_model->get_block_data( $block->block_name, $block->block_file, 'title' ); ?></h4>
	<p><?php echo $this->blocks_model->get_block_data( $block->block_name, $block->block_file, 'description' ); ?></p>
	<ul class="actions-inline">
		<?php if ( $this->account_model->check_admin_permission( 'block_perm', 'block_edit_perm' ) ) {
			echo '<li class="action-item">'.anchor( 'site-admin/block/edit/'.$block->block_id, lang( 'admin_edit' ) ).'</li>';
		} ?>
		<?php if ( $this->account_model->check_admin_permission( 'block_perm', 'block_delete_perm' ) ): ?>
		<li class="action-item"><a href="#" onclick="return ajax_remove_block( $(this).parents('.each-block') )"><?php echo lang( 'admin_delete' ); ?></a></li>
		<?php endif; ?>
		<?php if ( $this->account_model->check_admin_permission( 'block_perm', 'block_edit_perm' ) ): ?> 
		<li class="action-item">
			<?php if ( $block->block_status == '1' ): ?><a href="#" onclick="return ajax_change_status( $(this).parents('.each-block'), '0', '<?php echo $block->area_name; ?>' )"><?php echo lang( 'block_disable' ); ?></a>
			<?php else: ?><a href="#" onclick="return ajax_change_status( $(this).parents('.each-block'), '1', '<?php echo $block->area_name; ?>' )"><?php echo lang( 'block_enable' ); ?></a>
			<?php endif; ?> 
		</li>
		<?php endif; ?> 
	</ul>
</li>