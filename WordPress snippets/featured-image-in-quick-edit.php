//source: https://rudrastyh.com/wordpress/quick-edit-featured-image.html

/*
 * This action hook allows to add a new empty column
 */
add_filter('manage_post_posts_columns', 'misha_featured_image_column');
function misha_featured_image_column( $column_array ) {

	// I want to add my column at the beginning, so I use array_slice()
	// in other cases $column_array['featured_image'] = 'Featured Image' will be enough
	$column_array = array_slice( $column_array, 0, 1, true )
	+ array('featured_image' => 'Featured Image') // our new column for featured images
	+ array_slice( $column_array, 1, NULL, true );
 
	return $column_array;
}
 
/*
 * This hook will fill our column with data
 */
add_action('manage_posts_custom_column', 'misha_render_the_column', 10, 2);
function misha_render_the_column( $column_name, $post_id ) {

	if( $column_name == 'featured_image' ) {

		// if there is no featured image for this post, print the placeholder
		if( has_post_thumbnail( $post_id ) ) {
			
			// I know about get_the_post_thumbnail() function but we need data-id attribute here
			$thumb_id = get_post_thumbnail_id( $post_id );
			echo '<img data-id="' . $thumb_id . '" src="' . wp_get_attachment_url( $thumb_id ) . '" />';
			
		} else {
			
			// data-id should be "-1" I will explain below
			echo '<img data-id="-1" src="' . get_stylesheet_directory_uri() . '/placeholder.png" />';
			
		}
		
	}

}

//some css for style.
add_action( 'admin_head', 'misha_custom_css' );
function misha_custom_css(){

	echo '<style>
		#featured_image{
			width:120px;
		}
		td.featured_image.column-featured_image img{
			max-width: 100%;
			height: auto;
		}

		/* some styles to make Quick Edit meny beautiful */
		#misha_featured_image .title{margin-top:10px;display:block;}
		#misha_featured_image a.misha_upload_featured_image{
			display:inline-block;
			margin:10px 0 0;
		}
		#misha_featured_image img{
			display:block;
			max-width:200px !important;
			height:auto;
		}
		#misha_featured_image .misha_remove_featured_image{
			display:none;
		}
	</style>';

}

//connect pulpupload
add_action( 'admin_enqueue_scripts', 'misha_include_myuploadscript' );
function misha_include_myuploadscript() {
	if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
}

//quickedit box
add_action('quick_edit_custom_box',  'misha_add_featured_image_quick_edit', 10, 2);
function misha_add_featured_image_quick_edit( $column_name, $post_type ) {

	// add it only if we have featured image column
	if ($column_name != 'featured_image') return;

	// we add #misha_featured_image to use it in JavaScript in CSS
	echo '<fieldset id="misha_featured_image" class="inline-edit-col-left">
		<div class="inline-edit-col">
			<span class="title">Featured Image</span>
			<div>
				<a href="#" class="misha_upload_featured_image">Set featured image</a>
				<input type="hidden" name="_thumbnail_id" value="" />
				<a href="#" class="misha_remove_featured_image">Remove Featured Image</a>
			</div>
		</div></fieldset>';

		// please look at _thumbnail_id as a name attribute - I use it to skip save_post action

}

//javascript magic
<?php
add_action('admin_footer', 'misha_quick_edit_js_update');
function misha_quick_edit_js_update() {

	global $current_screen;

	// add this JS function only if we are on all posts page
	if (($current_screen->id != 'edit-post') || ($current_screen->post_type != 'post'))
		return;

		?><script>
		jQuery(function($){

			$('body').on('click', '.misha_upload_featured_image', function(e){
				e.preventDefault();
				var button = $(this),
				 custom_uploader = wp.media({
					title: 'Set featured image',
					library : { type : 'image' },
					button: { text: 'Set featured image' },
				}).on('select', function() {
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					$(button).html('<img src="' + attachment.url + '" />').next().val(attachment.id).parent().next().show();
				}).open();
			});
			
			$('body').on('click', '.misha_remove_featured_image', function(){
				$(this).hide().prev().val('-1').prev().html('Set featured Image');
				return false;
			});

			var $wp_inline_edit = inlineEditPost.edit;
			inlineEditPost.edit = function( id ) {
				$wp_inline_edit.apply( this, arguments );
 				var $post_id = 0;
				if ( typeof( id ) == 'object' ) { 
					$post_id = parseInt( this.getId( id ) );
				}

				if ( $post_id > 0 ) {
					var $edit_row = $( '#edit-' + $post_id ),
							$post_row = $( '#post-' + $post_id ),
							$featured_image = $( '.column-featured_image', $post_row ).html(),
							$featured_image_id = $( '.column-featured_image', $post_row ).find('img').attr('data-id');

					
					if( $featured_image_id != -1 ) {
						
						$( ':input[name="_thumbnail_id"]', $edit_row ).val( $featured_image_id ); // ID
						$( '.misha_upload_featured_image', $edit_row ).html( $featured_image ); // image HTML
						$( '.misha_remove_featured_image', $edit_row ).show(); // the remove link
						
					}
				}
 		}
	});
	</script>
<?php
}