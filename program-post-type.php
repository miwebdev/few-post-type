<?php
/**
 * Program Post Type
 *
 * @package   Program_Post_Type
 * @author    Devin Price
 * @license   GPL-2.0+
 * @link      https://wptheming.com/portfolio-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 *
 * @wordpress-plugin
 * Plugin Name: Program, People and Publication Post Type
 * Plugin URI:  https://wptheming.com/portfolio-post-type/
 * Description: Extends "Portfolio Post Type" to program, people and publication custom post types and taxonomies.
 * Version:     1.0.1
 * Author:      Devin Price, Mizanur R
 * Author URI:  https://www.wptheming.com/
 * Text Domain: programposttype
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Required files for registering the post type and taxonomies.


require plugin_dir_path( __FILE__ ) . 'includes/interface-gamajo-registerable.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-taxonomy.php';

// Program Post Type Class
require plugin_dir_path( __FILE__ ) . 'includes/program/class-program-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/program/class-program-post-type-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/program/class-program-post-type-taxonomy-category.php';
require plugin_dir_path( __FILE__ ) . 'includes/program/class-program-post-type-registrations.php';

// People Post Type Class
require plugin_dir_path( __FILE__ ) . 'includes/people/class-people-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/people/class-people-post-type-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/people/class-people-post-type-taxonomy-category.php';
require plugin_dir_path( __FILE__ ) . 'includes/people/class-people-post-type-registrations.php';

// Publication Post Type Class
require plugin_dir_path( __FILE__ ) . 'includes/publication/class-publication-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/publication/class-publication-post-type-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/publication/class-publication-post-type-taxonomy-category.php';
require plugin_dir_path( __FILE__ ) . 'includes/publication/class-publication-post-type-registrations.php';

// Program Post Type

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$program_post_type_registrations = new Program_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$program_post_type = new Program_Post_Type( $program_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $program_post_type, 'activate' ) );

// Initialise registrations for post-activation requests.
$program_post_type_registrations->init();

add_action( 'init', 'program_post_type_init', 100 );
/**
 * Adds styling to the dashboard for the post type and adds program posts
 * to the "At a Glance" metabox.
 *
 * Adds custom taxonomy body classes to program posts on the front end.
 *
 * @since 0.8.3
 */
function program_post_type_init() {
	if ( is_admin() ) {
		global $program_post_type_admin, $program_post_type_registrations;
		// Loads for users viewing the WordPress dashboard
		if ( ! class_exists( 'Gamajo_Dashboard_Glancer' ) ) {
			require_once plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-dashboard-glancer.php';  // WP 3.8
		}
		require plugin_dir_path( __FILE__ ) . 'includes/program/class-program-post-type-admin.php';
		$program_post_type_admin = new Program_Post_Type_Admin( $program_post_type_registrations );
		$program_post_type_admin->init();
	} else {
		// Loads for users viewing the front end
		if ( apply_filters( 'programposttype_add_taxonomy_terms_classes', true ) ) {
			if ( ! class_exists( 'Gamajo_Single_Entry_Term_Body_Classes' ) ) {
				require_once plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-single-entry-term-body-classes.php';
			}
			$program_post_type_body_classes = new Gamajo_Single_Entry_Term_Body_Classes;
			$program_post_type_body_classes->init( 'program' );
		}
	}
}

// People Post Type
// Instantiate registration class, so we can add it as a dependency to main plugin class.
$people_post_type_registrations = new People_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$people_post_type = new People_Post_Type( $people_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $people_post_type, 'activate' ) );

// Initialise registrations for post-activation requests.
$people_post_type_registrations->init();

add_action( 'init', 'people_post_type_init', 101 );
/**
 * Adds styling to the dashboard for the post type and adds program posts
 * to the "At a Glance" metabox.
 *
 * Adds custom taxonomy body classes to program posts on the front end.
 *
 * @since 0.8.3
 */
function people_post_type_init() {
	if ( is_admin() ) {
		global $people_post_type_admin, $people_post_type_registrations;
		// Loads for users viewing the WordPress dashboard
		if ( ! class_exists( 'Gamajo_Dashboard_Glancer' ) ) {
			require_once plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-dashboard-glancer.php';  // WP 3.8
		}
		require plugin_dir_path( __FILE__ ) . 'includes/people/class-people-post-type-admin.php';
		$people_post_type_admin = new People_Post_Type_Admin( $people_post_type_registrations );
		$people_post_type_admin->init();
	} else {
		// Loads for users viewing the front end
		if ( apply_filters( 'peopleposttype_add_taxonomy_terms_classes', true ) ) {
			if ( ! class_exists( 'Gamajo_Single_Entry_Term_Body_Classes' ) ) {
				require_once plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-single-entry-term-body-classes.php';
			}
			$people_post_type_body_classes = new Gamajo_Single_Entry_Term_Body_Classes;
			$people_post_type_body_classes->init( 'people' );
		}
	}
}



// Publication Post Type
// Instantiate registration class, so we can add it as a dependency to main plugin class.
$publication_post_type_registrations = new Publication_Post_Type_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$publication_post_type = new Publication_Post_Type( $publication_post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $publication_post_type, 'activate' ) );

// Initialise registrations for post-activation requests.
$publication_post_type_registrations->init();

add_action( 'init', 'publication_post_type_init', 101 );
/**
 * Adds styling to the dashboard for the post type and adds program posts
 * to the "At a Glance" metabox.
 *
 * Adds custom taxonomy body classes to program posts on the front end.
 *
 * @since 0.8.3
 */
function publication_post_type_init() {
	if ( is_admin() ) {
		global $publication_post_type_admin, $publication_post_type_registrations;
		// Loads for users viewing the WordPress dashboard
		if ( ! class_exists( 'Gamajo_Dashboard_Glancer' ) ) {
			require_once plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-dashboard-glancer.php';  // WP 3.8
		}
		require plugin_dir_path( __FILE__ ) . 'includes/publication/class-publication-post-type-admin.php';
		$publication_post_type_admin = new Publication_Post_Type_Admin( $publication_post_type_registrations );
		$publication_post_type_admin->init();
	} else {
		// Loads for users viewing the front end
		if ( apply_filters( 'publicationposttype_add_taxonomy_terms_classes', true ) ) {
			if ( ! class_exists( 'Gamajo_Single_Entry_Term_Body_Classes' ) ) {
				require_once plugin_dir_path( __FILE__ ) . 'includes/class-gamajo-single-entry-term-body-classes.php';
			}
			$publication_post_type_body_classes = new Gamajo_Single_Entry_Term_Body_Classes;
			$publication_post_type_body_classes->init( 'publication' );
		}
	}
}