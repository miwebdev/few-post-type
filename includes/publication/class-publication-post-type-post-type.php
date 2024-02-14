<?php
/**
 * People Post Type
 *
 * @package   People_Post_Type
 * @author    Devin Price
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      http://wptheming.com/program-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 */

/**
 * People Post Type.
 *
 * @package People_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Publication_Post_Type_Post_Type extends Gamajo_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'publication';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                  => __( 'Publications', 'program-post-type' ),
			'singular_name'         => __( 'Publication', 'program-post-type' ),
			'menu_name'             => _x( 'Publications', 'admin menu', 'program-post-type' ),
			'name_admin_bar'        => _x( 'Publications', 'add new on admin bar', 'program-post-type' ),
			'add_new'               => __( 'Add New Publication', 'program-post-type' ),
			'add_new_item'          => __( 'Add New Publication', 'program-post-type' ),
			'new_item'              => __( 'New Publication', 'program-post-type' ),
			'edit_item'             => __( 'Edit Publication', 'program-post-type' ),
			'view_item'             => __( 'View Publication', 'program-post-type' ),
			'all_items'             => __( 'All Publications', 'program-post-type' ),
			'search_items'          => __( 'Search Publication', 'program-post-type' ),
			'parent_item_colon'     => __( 'Parent Publication:', 'program-post-type' ),
			'not_found'             => __( 'No publication found', 'program-post-type' ),
			'not_found_in_trash'    => __( 'No publication found in trash', 'program-post-type' ),
			'filter_items_list'     => __( 'Filter publication list', 'program-post-type' ),
			'items_list_navigation' => __( 'Publication list navigation', 'program-post-type' ),
			'items_list'            => __( 'Publication list', 'program-post-type' ),
		);

		$supports = array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'author',
			'custom-fields',
			'revisions',
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'publication', ), // Permalinks format
			'menu_position'   => 22,
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-book' : false ,
			'has_archive'     => true,
			'show_in_rest'    => true,
		);

		return apply_filters( 'publicationposttype_args', $args );
	}

	/**
	 * Return post type updated messages.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type updated messages.
	 */
	public function messages() {
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Publication updated.', 'program-post-type' ),
			2  => __( 'Custom field updated.', 'program-post-type' ),
			3  => __( 'Custom field deleted.', 'program-post-type' ),
			4  => __( 'Publication updated.', 'program-post-type' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Publication restored to revision from %s', 'program-post-type' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Publication published.', 'program-post-type' ),
			7  => __( 'Publication saved.', 'program-post-type' ),
			8  => __( 'Publication submitted.', 'program-post-type' ),
			9  => sprintf(
				__( 'Publication scheduled for: <strong>%1$s</strong>.', 'program-post-type' ),
				/* translators: Publish box date format, see http://php.net/date */
				date_i18n( __( 'M j, Y @ G:i', 'program-post-type' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Publication draft updated.', 'program-post-type' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View publication', 'program-post-type' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview publication', 'program-post-type' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}
