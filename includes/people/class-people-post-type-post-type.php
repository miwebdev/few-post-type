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
class People_Post_Type_Post_Type extends Gamajo_Post_Type {
	/**
	 * Post type ID.
	 *
	 * @since 1.0.0
	 *
	 * @type string
	 */
	protected $post_type = 'people';

	/**
	 * Return post type default arguments.
	 *
	 * @since 1.0.0
	 *
	 * @return array Post type default arguments.
	 */
	protected function default_args() {
		$labels = array(
			'name'                  => __( 'People', 'program-post-type' ),
			'singular_name'         => __( 'People', 'program-post-type' ),
			'menu_name'             => _x( 'People', 'admin menu', 'program-post-type' ),
			'name_admin_bar'        => _x( 'People', 'add new on admin bar', 'program-post-type' ),
			'add_new'               => __( 'Add New People', 'program-post-type' ),
			'add_new_item'          => __( 'Add New People', 'program-post-type' ),
			'new_item'              => __( 'New People', 'program-post-type' ),
			'edit_item'             => __( 'Edit People', 'program-post-type' ),
			'view_item'             => __( 'View People', 'program-post-type' ),
			'all_items'             => __( 'All People', 'program-post-type' ),
			'search_items'          => __( 'Search People', 'program-post-type' ),
			'parent_item_colon'     => __( 'Parent People:', 'program-post-type' ),
			'not_found'             => __( 'No person found', 'program-post-type' ),
			'not_found_in_trash'    => __( 'No person found in trash', 'program-post-type' ),
			'filter_items_list'     => __( 'Filter people list', 'program-post-type' ),
			'items_list_navigation' => __( 'People list navigation', 'program-post-type' ),
			'items_list'            => __( 'People list', 'program-post-type' ),
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
			'rewrite'         => array( 'slug' => 'people', ), // Permalinks format
			'menu_position'   => 21,
			'menu_icon'       => ( version_compare( $GLOBALS['wp_version'], '3.8', '>=' ) ) ? 'dashicons-buddicons-buddypress-logo' : false ,
			'has_archive'     => true,
			'show_in_rest'    => true,
		);

		return apply_filters( 'peopleposttype_args', $args );
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
			1  => __( 'Person updated.', 'program-post-type' ),
			2  => __( 'Custom field updated.', 'program-post-type' ),
			3  => __( 'Custom field deleted.', 'program-post-type' ),
			4  => __( 'Person updated.', 'program-post-type' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Person restored to revision from %s', 'program-post-type' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Person published.', 'program-post-type' ),
			7  => __( 'Person saved.', 'program-post-type' ),
			8  => __( 'Person submitted.', 'program-post-type' ),
			9  => sprintf(
				__( 'Person scheduled for: <strong>%1$s</strong>.', 'program-post-type' ),
				/* translators: Publish box date format, see http://php.net/date */
				date_i18n( __( 'M j, Y @ G:i', 'program-post-type' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Person draft updated.', 'program-post-type' ),
		);

		if ( $post_type_object->publicly_queryable ) {
			$permalink         = get_permalink( $post->ID );
			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );

			$view_link    = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'View person', 'program-post-type' ) );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Preview person', 'program-post-type' ) );

			$messages[1]  .= $view_link;
			$messages[6]  .= $view_link;
			$messages[9]  .= $view_link;
			$messages[8]  .= $preview_link;
			$messages[10] .= $preview_link;
		}

		return $messages;
	}
}
