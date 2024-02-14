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
 * Register post types and taxonomies.
 *
 * @package People_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class People_Post_Type_Registrations {

	public $post_type;

	public $taxonomies;

	public function init() {
		// Add the portfolio post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 */
	public function register() {
		global $people_post_type_post_type, $people_post_type_taxonomy_category;

		$people_post_type_post_type = new People_Post_Type_Post_Type;
		$people_post_type_post_type->register();
		$this->post_type = $people_post_type_post_type->get_post_type();

		$people_post_type_taxonomy_category = new People_Post_Type_Taxonomy_Category;
		$people_post_type_taxonomy_category->register();
		$this->taxonomies[] = $people_post_type_taxonomy_category->get_taxonomy();
		register_taxonomy_for_object_type(
			$people_post_type_taxonomy_category->get_taxonomy(),
			$people_post_type_post_type->get_post_type()
		);
	}

	/**
	 * Unregister post type and taxonomies registrations.
	 */
	public function unregister() {
		global $people_post_type_post_type, $people_post_type_taxonomy_category;
		$people_post_type_post_type->unregister();
		$this->post_type = null;

		$people_post_type_taxonomy_category->unregister();
		unset( $this->taxonomies[ $people_post_type_taxonomy_category->get_taxonomy() ] );
	}
}
