<?php
/**
 * Program Post Type
 *
 * @package   Program_Post_Type
 * @author    Devin Price
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      http://wptheming.com/program-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 */

/**
 * program category taxonomy.
 *
 * @package Program_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Program_Post_Type_Taxonomy_Category extends Gamajo_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'program_category';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => __( 'Program Categories', 'program-post-type' ),
			'singular_name'              => __( 'Program Category', 'program-post-type' ),
			'menu_name'                  => __( 'Program Categories', 'program-post-type' ),
			'edit_item'                  => __( 'Edit Program Category', 'program-post-type' ),
			'update_item'                => __( 'Update Program Category', 'program-post-type' ),
			'add_new_item'               => __( 'Add New Program Category', 'program-post-type' ),
			'new_item_name'              => __( 'New Program Category Name', 'program-post-type' ),
			'parent_item'                => __( 'Parent Program Category', 'program-post-type' ),
			'parent_item_colon'          => __( 'Parent Program Category:', 'program-post-type' ),
			'all_items'                  => __( 'All Program Categories', 'program-post-type' ),
			'search_items'               => __( 'Search Program Categories', 'program-post-type' ),
			'popular_items'              => __( 'Popular Program Categories', 'program-post-type' ),
			'separate_items_with_commas' => __( 'Separate program categories with commas', 'program-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove program categories', 'program-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used program categories', 'program-post-type' ),
			'not_found'                  => __( 'No program categories found.', 'program-post-type' ),
			'items_list_navigation'      => __( 'program categories list navigation', 'program-post-type' ),
			'items_list'                 => __( 'program categories list', 'program-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'program-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
		);

		return apply_filters( 'programposttype_category_args', $args );
	}
}

