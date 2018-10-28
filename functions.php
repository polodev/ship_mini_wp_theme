<?php


function register_my_menu() {
  register_nav_menu('main-menu', __('Main Menu'));
}
add_action('init', 'register_my_menu');

$defaults = array(
	'default-image'          => get_template_directory_uri() . '/images/irishmaritime-top-img-01.jpg',
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => true,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );



add_theme_support( 'post-thumbnails' );

function create_posttype() {
  $labels = [
    'name' => __( 'Ships' ),
    'singular_name' => __( 'Ship' ),
    'add_new'            => __( 'Add New Shipping info' ),
    'add_new_item'       => __( 'Add New Shipping info' ),
    'edit_item'          => __( 'Edit Shipping info' ),
  ];

  $supports = [
    'title',
    'editor',
  ];

  $args =[
      'labels' => $labels,
      'supports' => $supports,
      'public' => true,
      'has_archive' => true,
      'menu_icon'            => 'dashicons-calendar-alt',
      'rewrite' => array('slug' => 'ships'),
      'register_meta_box_cb' => 'wp_add_shipping_metabox',

  ];
  register_post_type( 'ship', $args);
}

add_action( 'init', 'create_posttype' );

function wp_add_shipping_metabox() {
  add_meta_box(
    'shipping_name',
    'Shipping Name',
    'shipping_name_callback',
    'ship',
    'normal',
    'default'
  );
 	add_meta_box(
		'shipping_number',
		'Shipping Number',
		'shipping_number_callback',
		'ship',
		'normal',
		'default'
  );
}

// generating 2 field
function shipping_name_callback() {
  global $post;
	// Nonce field to validate form request came from current site
	wp_nonce_field( basename( __FILE__ ), 'shipping_name_field' );
	// Get the shipping_name data if it's already been entered
	$shipping_name = get_post_meta( $post->ID, 'shipping_name', true );
	// Output the field
	echo '<input type="text" name="shipping_name" value="' . esc_textarea( $shipping_name )  . '" class="widefat">';
}

function shipping_number_callback () {

  global $post;
	// Nonce field to validate form request came from current site
	wp_nonce_field( basename( __FILE__ ), 'shipping_number_field' );
	// Get the shipping_name data if it's already been entered
	$shipping_number = get_post_meta( $post->ID, 'shipping_number', true );
	// Output the field
	echo '<input type="text" name="shipping_number" value="' . esc_textarea( $shipping_number )  . '" class="widefat">';
}




/**
 *
 */
function wpt_save_shipping_meta1( $post_id, $post ) {
	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}
	// Verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times.
	if ( ! isset( $_POST['shipping_name'] ) || ! wp_verify_nonce( $_POST['shipping_name_field'], basename(__FILE__) ) ) {
		return $post_id;
	}
	if ( ! isset( $_POST['shipping_number'] ) || ! wp_verify_nonce( $_POST['shipping_number_field'], basename(__FILE__) ) ) {
		return $post_id;
	}
	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $shipping_meta.
	$shipping_meta['shipping_name'] = esc_textarea( $_POST['shipping_name'] );
	$shipping_meta['shipping_number'] = esc_textarea( $_POST['shipping_number'] );
	// Cycle through the $shipping_meta array.
	// Note, in this example we just have one item, but this is helpful if you have multiple.
	foreach ( $shipping_meta as $key => $value ) :
		// Don't store custom data twice
		if ( 'revision' === $post->post_type ) {
			return;
		}
		if ( get_post_meta( $post_id, $key, false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {
			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {
			// Delete the meta key if there's no value
			delete_post_meta( $post_id, $key );
		}
	endforeach;
}
add_action( 'save_post', 'wpt_save_shipping_meta1', 1, 2 );