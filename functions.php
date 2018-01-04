<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'title-tag' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu', 'blankslate' ) )
);
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
// add_filter( 'wp_default_scripts', 'dequeue_jquery_migrate' );
//
// function dequeue_jquery_migrate( &$scripts){
// 	if(!is_admin()){
// 		$scripts->remove( 'jquery');
// 		//$scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
// 	}
// }
/////////////////////////////
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h5 class="widget-title">',
'after_title' => '</h5>',
) );
}

function wpb_custom_new_menu() {
  register_nav_menu('my-custom-menu',__( 'My Custom Menu' ));
}
add_action( 'init', 'wpb_custom_new_menu' );

function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

function theme_styles(){
  wp_enqueue_style( 'boostrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css' );
	// wp_dequeue_script( 'jquery' );
	// wp_deregister_script('jquery');
  // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.1.1.slim.min.js', '' , '',true);
	wp_enqueue_script('tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', '' , '',true);
  wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/9c4a6d22fb.js',  '', ' ', true);
  wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js',  '', ' ', true);
  wp_enqueue_script('bootstrap_min', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js', '' , ' ', true);

  wp_enqueue_style('global', get_template_directory_uri() . '/css/global.css', array(), '', 'all' );
}

add_action( 'wp_enqueue_scripts', 'theme_styles' );

// function theme_styles22(){
//   wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.1.1.slim.min.js', '' , '',true);
// }
//
// add_action( 'admin_enqueue_scripts', 'theme_styles22' );

define('WP_SCSS_ALWAYS_RECOMPILE', true);

// Our custom post type function
function create_posttype() {

    register_post_type( 'design',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'design' ),
                'singular_name' => __( 'design' )
            ),
            'public' => true,
            'has_archive' => true,
            'taxonomies' => array( 'category' ),
            'rewrite' => array('slug' => 'design'),
        )
    );

    register_post_type( 'art',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'art' ),
                'singular_name' => __( 'art' )
            ),
            'public' => true,
            'has_archive' => true,
            'taxonomies' => array( 'category' ),
            'rewrite' => array('slug' => 'art'),
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

function my_extra_gallery_fields( $args, $attachment_id, $field ){
    $args['alt'] = array('type' => 'text', 'label' => 'Altnative Text', 'name' => 'alt', 'value' => get_field($field . '_alt', $attachment_id) ); // Creates Altnative Text field
    $args['class'] = array('type' => 'text', 'label' => 'Custom Classess', 'name' => 'class', 'value' => get_field($field . '_class', $attachment_id) ); // Creates Custom Classess field
    return $args;
}
add_filter( 'acf_photo_gallery_image_fields', 'my_extra_gallery_fields', 10, 3 );

//
// [shortcode]

function do_gallery( $atts ) {

    $exp = explode(',', $atts['src']);

    $html = '<div class="bd-example galeria_duza_kontener">
            <div id="nawigacja_karuzeli_galerii_duzej_1"
            class="carousel slide" data-ride="carousel"
            >
            <ol class="carousel-indicators">';
            $ind = 0;

          while($ind<count($exp)){

            $src = $exp[$ind];
            // $image_url = $exp[$ind];
            // wp_make_link_relative($image_url);
            // global $wpdb;
            // $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
            // $src = wp_get_attachment_image_src( $attachment[0], 'thumbnail', false );

                  if($ind == 0){

                    $html .= '<div data-target="#nawigacja_karuzeli_galerii_duzej_1" data-slide-to="' . $ind . '" class="active" style="bottom:-5%;">
                      <img src="'.$src.'" alt="" style="height:5vh; margin-left:0.2em; margin-right:0.2em;">
                    </div>';
                  }
                  if($ind > 0){
                    $html .= '<div data-target="#nawigacja_karuzeli_galerii_duzej_1" data-slide-to="' . $ind . '" class="" style="bottom:-5%;">
                      <img src="'.$src.'" alt="" style="height:5vh; margin-left:0.2em; margin-right:0.2em;">
                    </div>';
                  }
            $ind++;
          }
          $ind = 0;
          $html .= '</ol>';
          $html .= '<div class="carousel-inner" role="listbox">';
          while($ind<count($exp)){

            $src2  = $exp[$ind];
            // $image_url2 = $exp[$ind];
            // wp_make_link_relative($image_url2);
            // global $wpdb;
            // $attachment2 = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
            // $src2 = wp_get_attachment_image_src( $attachment2[0], 'large', false );

            if($ind == 0){
              $html .= '
                <div class="carousel-item active">
                  <img id="" class="d-block img-fluid galeria_zdj" data_src="'.$src2.'" alt=""
                  src="" data-holder-rendered="true" style="background-image:url('.$src2.');height:60vh;"
                   onclick="window.open(this.data_src)">
                  <div class="carousel-caption d-md-block opis_karuzela black_high">
                    <h3></h3>
                    <p></p>
                  </div>
                </div>';
            }
            if($ind > 0){
              $html .= '
                <div class="carousel-item">
                  <img id="" class="d-block img-fluid galeria_zdj" data_src="'.$src2.'" alt=""
                  src="" data-holder-rendered="true" style="background-image:url('.$src2.');height:60vh;"
                   onclick="window.open(this.data_src)">
                  <div class="carousel-caption d-md-block opis_karuzela black_high">
                    <h3></h3>
                    <p></p>
                  </div>
                </div>';
            }
            $ind++;
          }

          $html .= '</div>';
          $html .='<a class="carousel-control-prev" data-target="#nawigacja_karuzeli_galerii_duzej_1" role="button" data-slide="prev"
          style="">
                    <span class="carousel-control-prev-icon" aria-none="true" style=""></span>
                    <span class="sr-only">Previous</span>
                  </a>

              <a class="carousel-control-next" data-target="#nawigacja_karuzeli_galerii_duzej_1" role="button" data-slide="next"
              style="">
                <span class="carousel-control-next-icon" aria-none="true" style=""></span>
                <span class="sr-only">Next</span>
              </a>';

      $html .= "</div></div>
			<script>
			$(document).ready(function() {
			  $('.carousel').carousel({ interval: 1500, cycle: true });
			});
			</script>";

      return $html;
}

function get_attachment_id_from_url( $attachment_url ) {

	global $wpdb;
	$attachment_id = false;

	// If there is no url, return.
	if ( '' == $attachment_url )
		return;

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

	}

	return $attachment_id;
}

add_shortcode( 'do_gallery', 'do_gallery' );

//
function get_img_id($image_url) {
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
        return $attachment[0];
}
