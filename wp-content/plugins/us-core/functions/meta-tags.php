<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

add_action( 'wp_head', 'us_output_meta_tags', 5 );
function us_output_meta_tags() {

	// General tags
	$meta_tags = array(
		'viewport' => 'width=device-width',
		'SKYPE_TOOLBAR' => 'SKYPE_TOOLBAR_PARSER_COMPATIBLE',
	);
	if ( us_get_option( 'responsive_layout' ) ) {
		$meta_tags['viewport'] .= ', initial-scale=1';
	}

	// Set color of address bar in Chrome for Android
	if ( $theme_color = us_get_option( 'color_chrome_toolbar', '' ) ) {
		$meta_tags['theme-color'] = $theme_color;
	}

	// Add SEO tags, if enabled
	if ( us_get_option( 'og_enabled', 1 ) ) {

		$post_id = get_the_ID();

		// TODO: add hreflang attributes, if post has several language versions

		// robots
		if ( get_option( 'blog_public' ) AND $robots = get_post_meta( $post_id, 'us_meta_robots', TRUE ) ) {
			$meta_tags['robots'] = strip_tags( $robots );
		}

		// description from meta-box settings
		if ( $description = get_post_meta( $post_id, 'us_meta_description', TRUE ) ) {
			$meta_tags['description'] = trim( strip_tags( $description ) );

			// or Post Excerpt
		} elseif ( has_excerpt() AND $the_excerpt = trim( strip_tags( get_the_excerpt() ) ) ) {
			$meta_tags['description'] = $the_excerpt;

			// or Term Description
		} elseif ( $term_description = trim( strip_tags( term_description() ) ) ) {
			$meta_tags['description'] = $term_description;
		}

		$meta_tags['og:url'] = site_url( $_SERVER['REQUEST_URI'] );
		$meta_tags['og:locale'] = get_locale();
		$meta_tags['og:title'] = wp_get_document_title();
		$meta_tags['og:site_name'] = get_option( 'blogname' );

		// og:type
		if ( function_exists( 'is_product' ) AND is_product() ) {
			$meta_tags['og:type'] = 'product';
		} elseif ( is_single() ) {
			$meta_tags['og:type'] = 'article';
		} else {
			$meta_tags['og:type'] = 'website';
		}

		// og:image
		if ( has_post_thumbnail() ) {
			$meta_tags['og:image'] = get_the_post_thumbnail_url( NULL, 'large' );

		} elseif ( $meta_image = get_post_meta( $post_id, 'us_og_image', TRUE ) ) {
			$meta_tags['og:image'] = (string) $meta_image;
		}
	}

	$meta_tags = apply_filters( 'us_meta_tags', $meta_tags );

	// Output the tags
	if ( is_array( $meta_tags ) ) {
		foreach ( $meta_tags as $tag_name => $tag_content ) {
			if ( $tag_content == '' ) {
				continue;
			}

			if ( strpos( $tag_name, 'og:' ) === 0 ) {
				$tag_atts = array(
					'property' => $tag_name,
					'content' => $tag_content,
				);

				// Add specific attribute for WhatsApp
				if ( $tag_name === 'og:image' ) { 
					$tag_atts['itemprop'] = 'image';
				}

				echo '<meta ' . us_implode_atts( $tag_atts ) . '>';

			} else {
				$tag_atts = array(
					'name' => $tag_name,
					'content' => $tag_content,
				);
				echo '<meta ' . us_implode_atts( $tag_atts ) . '>';
			}
		}
	}
}

add_action( 'save_post', 'us_save_post_add_og_image' );
function us_save_post_add_og_image( $post_id ) {

	// If the post has thumbnail, clear og_image meta data
	if ( has_post_thumbnail( $post_id ) ) {
		update_post_meta( $post_id, 'us_og_image', '' );

		// in other case try to find an image inside post content
	} elseif ( $post = get_post( $post_id ) AND ! empty( $post->post_content ) ) {
		$the_content = $post->post_content;
		$the_content = apply_filters( 'us_content_template_the_content', $the_content );

		if ( preg_match( '/<img [^>]*src=["|\']([^"|\']+)/i', $the_content, $matches ) ) {
			update_post_meta( $post_id, 'us_og_image', $matches[1] );
		} else {
			update_post_meta( $post_id, 'us_og_image', '' );
		}
	}
}
