<?php
/**
 * People Post Type
 *
 * @package   People_Post_Type
 * @author    Devin Price
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      http://wptheming.com/portfolio-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 */

/**
 * people category taxonomy.
 *
 * @package People_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Publication_Post_Type_Taxonomy_Category extends Gamajo_Taxonomy {
	/**
	 * Taxonomy ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $taxonomy = 'publication_category';

	/**
	 * Return taxonomy default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Taxonomy default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                       => __( 'Publication Categories', 'program-post-type' ),
			'singular_name'              => __( 'Publication Category', 'program-post-type' ),
			'menu_name'                  => __( 'Publication Categories', 'program-post-type' ),
			'edit_item'                  => __( 'Edit Publication Category', 'program-post-type' ),
			'update_item'                => __( 'Update Publication Category', 'program-post-type' ),
			'add_new_item'               => __( 'Add New Publication Category', 'program-post-type' ),
			'new_item_name'              => __( 'New Publication Category Name', 'program-post-type' ),
			'parent_item'                => __( 'Parent Publication Category', 'program-post-type' ),
			'parent_item_colon'          => __( 'Parent Publication Category:', 'program-post-type' ),
			'all_items'                  => __( 'All Publication Categories', 'program-post-type' ),
			'search_items'               => __( 'Search Publication Categories', 'program-post-type' ),
			'popular_items'              => __( 'Popular Publication Categories', 'program-post-type' ),
			'separate_items_with_commas' => __( 'Separate publication categories with commas', 'program-post-type' ),
			'add_or_remove_items'        => __( 'Add or remove publication categories', 'program-post-type' ),
			'choose_from_most_used'      => __( 'Choose from the most used publication categories', 'program-post-type' ),
			'not_found'                  => __( 'No publication categories found.', 'program-post-type' ),
			'items_list_navigation'      => __( 'Publication categories list navigation', 'program-post-type' ),
			'items_list'                 => __( 'Publication categories list', 'program-post-type' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'publication-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_rest'      => true,
		);

		return apply_filters( 'publicationposttype_category_args', $args );
	}
}