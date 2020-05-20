<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Manages product attributes
 *
 * Here all product attributes are defined and managed.
 *
 * @version		1.0.0
 * @package		ecommerce-product-catalog/includes
 * @author 		impleCode
 */
add_action( 'after_product_details', 'show_product_attributes', 10, 1 );

/**
 * Shows product attributes table on product page
 *
 * @param object $post
 * @param array $single_names
 */
function show_product_attributes( $product_id = false ) {
	if ( is_object( $product_id ) && isset( $product_id->ID ) ) {
		$product_id = $product_id->ID;
	}
	ic_show_template_file( 'product-page/product-attributes.php', AL_BASE_TEMPLATES_PATH, $product_id );
	//echo get_product_attributes( $post->ID, $single_names );
}

add_action( 'single_product_begin', 'boxed_template_desc_first', 2, 0 );

/**
 * Sets products description as first tab
 *
 */
function boxed_template_desc_first() {
	$single_options = get_product_page_settings();
	if ( $single_options[ 'template' ] == 'boxed' ) {
		remove_action( 'after_product_details', 'show_product_attributes', 10, 1 );
		add_action( 'after_product_details', 'show_product_attributes', 11, 1 );
	}
}

/**
 * Returns product attributes HTML table
 *
 * @param int $product_id
 * @param array $v_single_names
 * @return string
 */
function get_product_attributes( $product_id, $v_single_names = null ) {
	ob_start();
	show_product_attributes( $product_id );
	return ob_get_clean();
}

/**
 * Returns selected attribute label
 *
 * @param type $i
 * @param type $product_id
 * @return type
 */
function get_attribute_label( $i = 1, $product_id ) {
	$field_name = apply_filters( 'ic_attribute_label_field_name', "_attribute-label" ) . $i;

	$label = ic_get_global( $product_id . $field_name );
	if ( !$label ) {
		$label = get_post_meta( $product_id, $field_name, true );
		ic_save_global( $product_id . $field_name, $label );
	}
	return apply_filters( 'ic_attribute_label', $label, $product_id );
}

/**
 * Returns selected attribute value
 *
 * @param type $i
 * @param type $product_id
 * @return type
 */
function get_attribute_value( $i = 1, $product_id ) {
	$field_name	 = apply_filters( 'ic_attribute_value_field_name', "_attribute" ) . $i;
	$value		 = ic_get_global( $product_id . $field_name );
	if ( !$value ) {
		$value = get_post_meta( $product_id, $field_name, true );
	}
	if ( is_array( $value ) && !function_exists( 'start_attributes_pro' ) ) {
		$value = implode( ',', $value );
	}
	if ( function_exists( 'is_ic_product_page' ) && is_ic_product_page() && !is_array( $value ) ) {
		$value = str_replace( 'rel="nofollow"', '', make_clickable( $value ) );
	}
	ic_save_global( $product_id . $field_name, $value );
	return apply_filters( 'ic_attribute_value', $value, $product_id, $i );
}

/**
 * Returns selected attribute unit
 *
 * @param type $i
 * @param type $product_id
 * @return type
 */
function get_attribute_unit( $i = 1, $product_id ) {
	$field_name = apply_filters( 'ic_attribute_unit_field_name', "_attribute-unit" ) . $i;

	$label = ic_get_global( $product_id . $field_name );
	if ( !$label ) {
		$label = get_post_meta( $product_id, $field_name, true );
		ic_save_global( $product_id . $field_name, $label );
	}
	return $label;
}

if ( !function_exists( 'get_attribute_label_id' ) ) {

	function get_attribute_label_id( $label ) {
		$args[ 'taxonomy' ]	 = 'al_product-attributes';
		$args[ 'name' ]		 = $label;
		$args[ 'parent' ]	 = 0;
		$args[ 'fields' ]	 = 'ids';
		$label_ids			 = get_terms( $args );
		if ( !empty( $label_ids ) && !is_wp_error( $label_ids ) ) {
			return $label_ids[ 0 ];
		}
		return false;
	}

}

if ( !function_exists( 'get_attribute_value_id' ) ) {

	function get_attribute_value_id( $label_id, $value, $by_name = false ) {
		if ( !is_numeric( $label_id ) ) {
			$label_id = get_attribute_label_id( $label_id );
		}

		$args[ 'taxonomy' ] = 'al_product-attributes';
		if ( $by_name ) {
			$args[ 'name' ] = strval( $value );
		} else {
			$args[ 'slug' ] = trim( wp_unslash( sanitize_term_field( 'slug', $value, 0, 'al_product-attributes', 'db' ) ) );
		}
		$args[ 'child_of' ]	 = $label_id;
		$args[ 'fields' ]	 = 'ids';
		$value_ids			 = get_terms( $args );
		if ( !empty( $value_ids ) && !is_wp_error( $value_ids ) ) {
			return $value_ids[ 0 ];
		} else if ( !$by_name ) {
			return get_attribute_value_id( $label_id, $value, true );
		}
		return false;
	}

}

add_action( 'product_details', 'ic_show_size', 9, 1 );

/**
 * Shows product SKU table
 *
 * @param object $post
 * @param array $single_names
 */
function ic_show_size( $product_id = false ) {
	if ( is_object( $product_id ) && isset( $product_id->ID ) ) {
		$product_id = $product_id->ID;
	}
	ic_show_template_file( 'product-page/product-size.php', AL_BASE_TEMPLATES_PATH, $product_id );
}

add_action( 'product_details', 'ic_show_weight', 9, 1 );

/**
 * Shows product SKU table
 *
 * @param object $post
 * @param array $single_names
 */
function ic_show_weight( $product_id = false ) {
	if ( is_object( $product_id ) && isset( $product_id->ID ) ) {
		$product_id = $product_id->ID;
	}
	ic_show_template_file( 'product-page/product-weight.php', AL_BASE_TEMPLATES_PATH, $product_id );
}

add_action( 'classic_grid_product_listing_element_inside', 'ic_listing_add_attributes', 10, 2 );
add_action( 'classic_list_entry_bottom', 'ic_listing_add_attributes', 10, 2 );
add_action( 'modern_grid_entry_inside', 'ic_listing_add_attributes', 10, 2 );

function ic_listing_add_attributes( $product_id, $settings ) {
	if ( $settings[ 'attributes' ] == 1 ) {
		ic_save_global( 'listing_attributes_num', $settings[ 'attributes_num' ] );
		ic_show_template_file( 'product-listing/listing-attributes.php' );
	}
}
