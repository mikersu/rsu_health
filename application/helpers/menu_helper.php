<?php
/**
 * 
 * PHP version 5
 * 
 * @package agni cms
 * @author vee w.
 * @license http://www.opensource.org/licenses/GPL-3.0
 *
 */

/**
 *  show_menuitem_nested_sortable
 * @param array $array
 * @param boolean $first
 * @return string
 */
if ( !function_exists( 'show_menuitem_nested_sortable' ) ) {
	function show_menuitem_nested_sortable( $array, $first = true ) {
		if (!is_array($array))
			return '';
		
		$ci =& get_instance();
		
		if ( $first === true ) {
			$output = '<ol class="menu-tree menu-tree-sortable sortable tree-sortable">';
		} else {
			$output = '<ol>';
		}
		
		foreach ($array as $item) {

			$output .= '<li id="list_'.$item->mi_id.'"><div><span class="sort-handle">&nbsp;</span> <span class="item-name">';
			
			if ( $item->custom_link != null ) {
				$output .= $item->custom_link;
			} else {
				switch ( $item->mi_type ) {
					case 'category':
						$output .= anchor( $item->link_url, $item->link_text );
						break;
					case 'tag':
						$output .= anchor( 'tag/'.$item->link_url, $item->link_text );
						break;
					case 'article':
						$output .= anchor( 'post/'.$item->link_url, $item->link_text );
						break;
					case 'page':
						$output .= anchor( $item->link_url, $item->link_text );
						break;
					default:
						$output .= anchor( $item->link_url, $item->link_text );
						break;
				}
			}
			
			$output .= '</span>';
			$output .= ' &nbsp; &nbsp; <span class="item-actions">';
			
			if ( $ci->account_model->check_admin_permission( 'menu_perm', 'menu_edit_perm' ) ) {
				$output .= '<a href="#" class="ico16-edit" title="'.lang( 'admin_edit' ).'" onclick="return edit_menu_item(\''.$item->mi_id.'\');">'.lang( 'admin_edit' ).'</a>';
			}
			
			if ( $ci->account_model->check_admin_permission( 'menu_perm', 'menu_edit_perm' ) && $ci->account_model->check_admin_permission( 'menu_perm', 'menu_delete_perm' ) ) {
				$output .= ' | ';
			}
			
			if ( $ci->account_model->check_admin_permission( 'menu_perm', 'menu_delete_perm' ) ) {
				$output .= '<a href="#" class="ico16-delete" title="'.lang( 'admin_delete' ).'" onclick="return delete_menu_item(\''.$item->mi_id.'\');">'.lang( 'admin_delete' ).'</a>';
			}
			
			$output .= '</span>';
			$output .= '<div class="inline-edit" id="inline-edit-'.$item->mi_id.'"></div>';
			$output .= '</div>';

			if (property_exists($item, 'childs')) {
				$output .= show_menuitem_nested_sortable( $item->childs, false );
			}

			$output .= '</li>';
		}
		
		$output .= '</ol>';
		return $output;
	}// show_menuitem_nested_sortable
}


if ( !function_exists( 'show_menuitem_nested' ) ) {
	function show_menuitem_nested( $array, $first = true ) {
		if (!is_array($array))
			return '';
		
		$ci =& get_instance();
		
		if ( $first === true ) {
			$output = '<ul class="menu-tree">';
		} else {
			$output = '<ul>';
		}
		
		foreach ($array as $item) {

			$output .= '<li id="list_'.$item->mi_id.'">';
			if ( $item->custom_link != null ) {
				$output .= $item->custom_link;
			} else {
				switch ( $item->mi_type ) {
					case 'category':
						$output .= anchor( $item->link_url, $item->link_text );
						break;
					case 'tag':
						$output .= anchor( 'tag/'.$item->link_url, $item->link_text );
						break;
					case 'article':
						$output .= anchor( 'post/'.$item->link_url, $item->link_text );
						break;
					case 'page':
						$output .= anchor( $item->link_url, $item->link_text );
						break;
					default:
						$output .= anchor( $item->link_url, $item->link_text );
						break;
				}
			}

			if (property_exists($item, 'childs')) {
				$output .= show_menuitem_nested( $item->childs, false );
			}

			$output .= '</li>';
		}
		
		$output .= '</ul>';
		return $output;
	}// show_menuitem_nested
}