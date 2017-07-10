<?php
/**
 * AlainSchlesser.com Speaking Page Plugin.
 *
 * @package   AlainSchlesser\Speaking
 * @author    Alain Schlesser <alain.schlesser@gmail.com>
 * @license   MIT
 * @link      https://www.alainschlesser.com/
 * @copyright 2017 Alain Schlesser
 */

namespace AlainSchlesser\Speaking\CustomPostType;

/**
 * Class Talk.
 *
 * @since   0.1.0
 *
 * @package AlainSchlesser\Speaking
 * @author  Alain Schlesser <alain.schlesser@gmail.com>
 */
final class Talk extends BaseCustomPostType {

	const SLUG = 'talk';

	/**
	 * Get the slug to use for the custom post type.
	 *
	 * @since 0.1.0
	 *
	 * @return string Custom post type slug.
	 */
	protected function get_slug() {
		return self::SLUG;
	}

	/**
	 * Get the arguments that configure the custom post type.
	 *
	 * @since 0.1.0
	 *
	 * @return array Array of arguments.
	 */
	protected function get_arguments() {
		return [
			'label'               => __( 'Talk', 'as-speaking' ),
			'description'         => __( 'Talks for the Speaking page', 'as-speaking' ),
			'labels'              => $this->get_labels(),
			'supports'            => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'custom-fields',
			),
			'taxonomies'          => array( 'category', 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-media-interactive',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
		];
	}

	/**
	 * Get the localized labels for the custom post type UI.
	 *
	 * @since 0.1.0
	 *
	 * @return array Associative array of localized strings.
	 */
	private function get_labels() {
		return [
			'name'                  => _x( 'Talks', 'Post Type General Name', 'as-speaking' ),
			'singular_name'         => _x( 'Talk', 'Post Type Singular Name', 'as-speaking' ),
			'menu_name'             => __( 'Talks', 'as-speaking' ),
			'name_admin_bar'        => __( 'Talk', 'as-speaking' ),
			'archives'              => __( 'Item Archives', 'as-speaking' ),
			'attributes'            => __( 'Item Attributes', 'as-speaking' ),
			'parent_item_colon'     => __( 'Parent Item:', 'as-speaking' ),
			'all_items'             => __( 'All Items', 'as-speaking' ),
			'add_new_item'          => __( 'Add New Item', 'as-speaking' ),
			'add_new'               => __( 'Add New', 'as-speaking' ),
			'new_item'              => __( 'New Item', 'as-speaking' ),
			'edit_item'             => __( 'Edit Item', 'as-speaking' ),
			'update_item'           => __( 'Update Item', 'as-speaking' ),
			'view_item'             => __( 'View Item', 'as-speaking' ),
			'view_items'            => __( 'View Items', 'as-speaking' ),
			'search_items'          => __( 'Search Item', 'as-speaking' ),
			'not_found'             => __( 'Not found', 'as-speaking' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'as-speaking' ),
			'featured_image'        => __( 'Featured Image', 'as-speaking' ),
			'set_featured_image'    => __( 'Set featured image', 'as-speaking' ),
			'remove_featured_image' => __( 'Remove featured image', 'as-speaking' ),
			'use_featured_image'    => __( 'Use as featured image', 'as-speaking' ),
			'insert_into_item'      => __( 'Insert into item', 'as-speaking' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'as-speaking' ),
			'items_list'            => __( 'Items list', 'as-speaking' ),
			'items_list_navigation' => __( 'Items list navigation', 'as-speaking' ),
			'filter_items_list'     => __( 'Filter items list', 'as-speaking' ),
		];
	}
}
