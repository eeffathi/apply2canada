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
add_action( 'init', 'ic_create_product_attributes' );

/**
 * Registers attributes taxonomy
 *
 */
function ic_create_product_attributes() {
	$args		 = array(
		'label'			 => 'Attributes',
		'hierarchical'	 => true,
		'public'		 => false,
		'query_var'		 => false,
		'rewrite'		 => false,
	);
	$post_types	 = apply_filters( 'ic_attributes_register_post_types', product_post_type_array() );
	register_taxonomy( 'al_product-attributes', $post_types, $args );
}

/**
 * Adds product attribute label and returns attribute label ID
 *
 * @param type $label
 * @return type
 */
function ic_add_product_attribute_label( $label ) {
	if ( is_array( $label ) ) {
		foreach ( $label as $single_label ) {
			$term_id = ic_add_product_attribute_label( $single_label );
		}
		return $term_id;
	} else {
		$term_id = get_attribute_label_id( $label );
		if ( !empty( $term_id ) ) {
			return $term_id;
		}
		$term = wp_insert_term( $label, 'al_product-attributes' );
		if ( !is_wp_error( $term ) ) {
			return $term[ 'term_id' ];
		} else if ( !empty( $term->error_data[ 'term_exists' ] ) ) {
			return intval( $term->error_data[ 'term_exists' ] );
		}
	}
	return '';
}

/**
 * Adds product attribute value and returns attribute value ID
 *
 * @param type $label_id
 * @param type $value
 * @return type
 */
function ic_add_product_attribute_value( $label_id, $value ) {
	if ( empty( $label_id ) ) {
		return '';
	}
	if ( is_array( $value ) ) {
		foreach ( $value as $current_value ) {
			$term_id = ic_add_product_attribute_value( $label_id, $current_value );
		}
	} else {
		$term_id = get_attribute_value_id( $label_id, $value, true );
		if ( empty( $term_id ) ) {
			$term = wp_insert_term( strval( $value ), 'al_product-attributes', array( 'parent' => $label_id ) );
			if ( !is_wp_error( $term ) ) {
				$term_id = $term[ 'term_id' ];
			} else if ( !empty( $term->error_data[ 'term_exists' ] ) ) {
				return intval( $term->error_data[ 'term_exists' ] );
			}
		}
	}
	return $term_id;
}

add_filter( 'product_meta_save', 'ic_assign_product_attributes', 2, 2 );

/**
 * Adds product attributes to the database
 *
 * @param type $product_meta
 * @param type $post
 * @return type
 */
function ic_assign_product_attributes( $product_meta, $post, $clear_empty = true ) {
	$max_attr = apply_filters( 'ic_max_indexed_attributes', product_attributes_number() );
	if ( $max_attr > 0 ) {
		$product_id	 = isset( $post->ID ) ? $post->ID : $post;
		$attr_ids	 = array();

		for ( $i = 1; $i <= $max_attr; $i++ ) {
			if ( empty( $product_meta[ '_attribute' . $i ] ) || (is_array( $product_meta[ '_attribute' . $i ] ) && isset( $product_meta[ '_attribute' . $i ][ 0 ] ) && empty( $product_meta[ '_attribute' . $i ][ 0 ] )) ) {
				continue;
			}
			if ( !empty( $product_meta[ '_attribute-label' . $i ] ) ) {
				//$label = is_array( $product_meta[ '_attribute-label' . $i ] ) ? ic_sanitize_product_attribute( $product_meta[ '_attribute-label' . $i ][ 0 ] ) : ic_sanitize_product_attribute( $product_meta[ '_attribute-label' . $i ] );
				$label = ic_sanitize_product_attribute( $product_meta[ '_attribute-label' . $i ] );
				if ( !empty( $label ) ) {
					//$value = is_array( $product_meta[ '_attribute' . $i ] ) ? ic_sanitize_product_attribute( $product_meta[ '_attribute' . $i ][ 0 ] ) : ic_sanitize_product_attribute( $product_meta[ '_attribute' . $i ] );
					$value = ic_sanitize_product_attribute( $product_meta[ '_attribute' . $i ] );
					if ( !empty( $value ) ) {
						$label_id = ic_add_product_attribute_label( $label );
						if ( !empty( $label_id ) ) {
							$attr_ids[] = $label_id;
							if ( !is_array( $value ) ) {
								$value = array( $value );
							}
							foreach ( $value as $val ) {
								$value_id	 = ic_add_product_attribute_value( $label_id, $val );
								$attr_ids[]	 = $value_id;
							}
						}
					}
				}
			}
		}
		if ( !empty( $attr_ids ) ) {
			$attr_ids = array_unique( array_map( 'intval', $attr_ids ) );
			wp_set_object_terms( $product_id, $attr_ids, 'al_product-attributes' );
			if ( $clear_empty ) {
				ic_clear_empty_attributes();
			}
		} else {
			wp_set_object_terms( $product_id, NULL, 'al_product-attributes' );
			if ( $clear_empty ) {
				ic_clear_empty_attributes();
			}
		}
	}
	return $product_meta;
}

add_action( 'ic_scheduled_attributes_clear', 'ic_clear_empty_attributes' );

/**
 * Clears empty product attributes
 *
 */
function ic_clear_empty_attributes() {
	$max_attr	 = product_attributes_number();
	$attributes	 = get_terms( 'al_product-attributes', array(
		'orderby'	 => 'count',
		'hide_empty' => 0,
		'number'	 => $max_attr
	) );
	$schedule	 = false;
	if ( !empty( $attributes ) && is_array( $attributes ) && !is_wp_error( $attributes ) ) {
		foreach ( $attributes as $attribute ) {
			if ( $attribute->count == 0 ) {
				$schedule = true;
				wp_delete_term( $attribute->term_id, 'al_product-attributes' );
			} else {
				$schedule = false;
				break;
			}
		}
		if ( /* !wp_get_schedule( 'ic_scheduled_attributes_clear' ) && */ $schedule ) {
			//wp_schedule_event( time(), 'hourly', 'ic_scheduled_attributes_clear' );
			wp_schedule_single_event( time(), 'ic_scheduled_attributes_clear' );
		} else {
			wp_clear_scheduled_hook( 'ic_scheduled_attributes_clear' );
		}
	} else {
		wp_clear_scheduled_hook( 'ic_scheduled_attributes_clear' );
	}
}

add_action( 'ic_scheduled_attributes_assignment', 'ic_reassign_all_products_attributes' );

/**
 * Scheduled even to reassign all products attributes
 *
 * @return string
 */
function ic_reassign_all_products_attributes() {
	$max_attr = product_attributes_number();
	if ( empty( $max_attr ) ) {
		return;
	}
	$done = get_option( 'ic_product_upgrade_done', 0 );
	if ( empty( $done ) ) {
		update_option( 'ic_product_upgrade_done', -1 );
		wp_schedule_single_event( time(), 'ic_scheduled_attributes_assignment' );
		return '';
	}

	if ( $done < 0 ) {
		$done = 0;
	}

	$products	 = get_all_catalog_products( 'date', 'ASC', 200, $done );
	$max_round	 = intval( 300 / $max_attr );
	if ( $max_round > 100 ) {
		$max_round = 100;
	}
	if ( $done > 100 ) {
		$max_round = apply_filters( 'ic_database_upgrade_max_round', $max_round * 2 );
	}
	$rounds = 1;
	foreach ( $products as $post ) {
		if ( $rounds > $max_round ) {
			break;
		}
		ic_set_time_limit( 30 );
		$product_meta = get_post_meta( $post->ID );
		ic_assign_product_attributes( $product_meta, $post, false );
		$done++;
		$rounds++;
	}
	$products_count = ic_products_count();
	if ( $products_count > $done ) {
		update_option( 'ic_product_upgrade_done', $done );
		wp_schedule_single_event( time(), 'ic_scheduled_attributes_assignment' );
	} else {
		delete_option( 'ic_product_upgrade_done' );
		wp_clear_scheduled_hook( 'ic_scheduled_attributes_assignment' );
		ic_clear_empty_attributes();
	}
}

add_action( 'ic_system_tools', 'ic_system_tools_attributes_upgrade' );

/**
 * Shows database upgrade button in system tools
 *
 */
function ic_system_tools_attributes_upgrade() {
	$done = get_option( 'ic_product_upgrade_done', 0 );
	if ( !empty( $done ) || isset( $_GET[ 'reassign_all_products_attributes' ] ) ) {
		if ( empty( $done ) && isset( $_GET[ 'reassign_all_products_attributes' ] ) ) {
			ic_reassign_all_products_attributes();
		}
		if ( !wp_next_scheduled( 'ic_scheduled_attributes_assignment' ) ) {
			wp_schedule_single_event( time(), 'ic_scheduled_attributes_assignment' );
		}
		echo '<tr>';
		echo '<td>Database Upgrade</td>';
		echo '<td><a class="button" href="' . admin_url( 'edit.php?post_type=al_product&page=system.php&reassign_all_products_attributes=1' ) . '">Speed UP Pending Database Upgrade</a>';
		if ( isset( $_GET[ 'reassign_all_products_attributes' ] ) ) {
			$done = get_option( 'ic_product_upgrade_done', 0 );
			if ( $done < 0 ) {
				$done = 0;
			}
			echo '<p>' . $done . ' Items Done! Another round needed.</p>';
		}
		echo '</td></tr>';
	} else if ( empty( $done ) ) {
		echo '<tr>';
		echo '<td>Reassign Attributes</td>';
		echo '<td><a class="button" href="' . admin_url( 'edit.php?post_type=al_product&page=system.php&reassign_all_products_attributes=1' ) . '">Reassign attributes</a>';
		echo '</td></tr>';
	}
	if ( wp_get_schedule( 'ic_scheduled_attributes_clear' ) ) {
		if ( isset( $_GET[ 'clear_products_attributes' ] ) ) {
			ic_clear_empty_attributes();
		}
	}
	if ( wp_get_schedule( 'ic_scheduled_attributes_clear' ) ) {
		echo '<tr>';
		echo '<td>Clear Attributes</td>';
		echo '<td><a class="button" href="' . admin_url( 'edit.php?post_type=al_product&page=system.php&clear_products_attributes=1' ) . '">Speed UP Clearing Empty Attributes</a></td>';
		echo '</tr>';
	}
}

/**
 * Returns attribute ID by label
 * @param type $label
 * @return boolean
 */
function ic_get_attribute_id( $label ) {
	$attribute = get_term_by( 'name', $label, 'al_product-attributes' );
	if ( $attribute ) {
		return intval( $attribute->term_id );
	}
	return false;
}

/**
 * Returns attribute name when ID is provided
 *
 * @param int $attribute_id
 * @return boolean|string
 */
function ic_get_attribute_name( $attribute_id ) {
	$attribute = get_term_by( 'id', $attribute_id, 'al_product-attributes' );
	if ( $attribute && $attribute->count > 0 ) {
		return $attribute->name;
	}
	return false;
}

/**
 * Returns available attribute values as array
 *
 * @param type $label
 * @return boolean
 */
function ic_get_attribute_values( $label, $format = 'names' ) {
	$cache_key	 = 'attribute_values' . $label . $format;
	$attributes	 = wp_cache_get( $cache_key, 'implecode' );
	if ( false === $attributes ) {
		$attribute_id	 = ic_get_attribute_id( $label );
		//$values			 = get_term_children( $attribute_id, 'al_product-attributes' );
		$values			 = get_terms( array(
			'taxonomy'		 => 'al_product-attributes',
			'hide_empty'	 => true,
			'parent'		 => $attribute_id,
			'fields'		 => $format,
			'ic_post_type'	 => array( get_current_screen_post_type() )
		) );
		if ( empty( $values ) || is_wp_error( $values ) || !is_array( $values ) ) {
			return false;
		}
		/*
		  $attributes = array();
		  foreach ( $values as $value_id ) {
		  if ( !empty( $value_id ) ) {
		  $attr_name = ic_get_attribute_name( $value_id );
		  if ( $attr_name ) {
		  $attributes[] = $attr_name;
		  }
		  }
		  }
		 *
		 */
		$attributes = $values;
		if ( !empty( $cache_key ) ) {
			wp_cache_set( $cache_key, $attributes, 'implecode' );
		}
	}
	return $attributes;
}

/**
 * Sanitize attribute before adding as taxonomy
 *
 * @param type $attribute
 * @return type
 */
function ic_sanitize_product_attribute( $attribute ) {
	if ( is_array( $attribute ) ) {
		$sanitized_attribute = array_map( 'ic_sanitize_product_attribute', $attribute );
		if ( !empty( $sanitized_attribute[ 0 ] ) && is_array( $sanitized_attribute[ 0 ] ) ) {
			return $sanitized_attribute[ 0 ];
		}
		return $sanitized_attribute;
	} else if ( ic_string_contains( $attribute, '{' ) ) {
		$unserialized = unserialize( $attribute );
		if ( !empty( $unserialized ) && is_array( $unserialized ) ) {
			return ic_sanitize_product_attribute( $unserialized );
		}
	}
	$sanitized_attribute = trim( wp_unslash( sanitize_term_field( 'name', $attribute, 0, 'al_product-attributes', 'db' ) ) );
	if ( strlen( $sanitized_attribute ) > 200 ) {
		return '';
	}
	return $sanitized_attribute;
}

function ic_delete_all_attribute_terms() {
	global $wpdb;
	$taxonomy	 = 'al_product-attributes';
	$terms		 = $wpdb->get_results( $wpdb->prepare( "SELECT t.*, tt.* FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy IN ('%s') ORDER BY t.name ASC", $taxonomy ) );

	// Delete Terms
	if ( $terms ) {
		foreach ( $terms as $term ) {
			$wpdb->delete( $wpdb->term_taxonomy, array( 'term_taxonomy_id' => $term->term_taxonomy_id ) );
			$wpdb->delete( $wpdb->term_relationships, array( 'term_taxonomy_id' => $term->term_taxonomy_id ) );
			$wpdb->delete( $wpdb->terms, array( 'term_id' => $term->term_id ) );
		}
	}
}

if ( !function_exists( 'get_all_attribute_labels' ) ) {

	/**
	 * Returns all attrubutes labels
	 *
	 * @return type
	 */
	function get_all_attribute_labels() {
		$post_type			 = get_current_screen_post_type();
		$cache_key			 = 'all_attribute_labels_' . $post_type;
		$attributes_labels	 = ic_get_global( $cache_key );
		if ( false === $attributes_labels ) {
			$attributes_labels = get_terms( array(
				'taxonomy'		 => 'al_product-attributes',
				'parent'		 => 0,
				'fields'		 => 'names',
				'hide_empty'	 => true,
				'ic_post_type'	 => array( $post_type )
			) );
			if ( !empty( $cache_key ) ) {
				ic_save_global( $cache_key, $attributes_labels );
			}
		}
		return $attributes_labels;
	}

}

add_filter( 'wp_unique_term_slug', 'ic_wp_unique_slug_bug_fix', 10, 2 );

function ic_wp_unique_slug_bug_fix( $slug, $term ) {
	global $wpdb;
	if ( !empty( $term->term_id ) ) {
		$query = $wpdb->prepare( "SELECT slug FROM $wpdb->terms WHERE slug = %s AND term_id != %d", $slug, $term->term_id );
	} else {
		$query = $wpdb->prepare( "SELECT slug FROM $wpdb->terms WHERE slug = %s", $slug );
	}

	if ( $wpdb->get_var( $query ) ) {
		$num = 2;
		do {
			$alt_slug	 = $slug . "-$num";
			$num++;
			$slug_check	 = $wpdb->get_var( $wpdb->prepare( "SELECT slug FROM $wpdb->terms WHERE slug = %s", $alt_slug ) );
		} while ( $slug_check );
		$slug = $alt_slug;
	}
	return $slug;
}
