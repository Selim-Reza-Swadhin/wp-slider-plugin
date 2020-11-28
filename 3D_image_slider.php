<?php
/**
 * @package 3D_Image_Sider_Plugin
 * @version 1.0
 */

/*
Plugin Name: 3D Image Sider Plugin
Plugin URI: http://wordpress.org/plugins/3d-image-sider-plugin/
Description: This is a related post plugin.
Author: Selim Reza Swadhin
Version: 1.0
Author URI: https://selimrezaswadhin.com
*/

class selim_slider {

	public function __construct(){

		add_action('init', array($this,'selim_slider_main'), 0);
		add_action('wp_enqueue_scripts', array($this, 'selim_slider_css_js_link'));
		add_shortcode('selim-slider-shortcode-handle', array($this, 'selim_slider_shortcode_function'));
}

public function selim_slider_css_js_link(){
		wp_enqueue_style( 'css', plugins_url('style.css', __FILE__));
		//wp_enqueue_style( 'css', plugins_url('style.css', dirname( __FILE__)));//wrong
		//wp_enqueue_scripts( 'js', plugins_url('stylejs.js', __FILE__), array(jquery()), false);
}
public function selim_slider_shortcode_function(){?>



	<section class="slideshow">

		<div class="content">

			<div class="content-carrousel">

				<?php
				$slider = new WP_Query(array(
					'post_type'=> 'selim_slider_main'//function
				));
				while ($slider->have_posts()):$slider->the_post();
				?>
				<figure class="shadow">
<!--					<img src="dnld/a.jpg" alt="" />-->
					<img src="<?php the_post_thumbnail_url();?>" alt="" />
				</figure>
	<?php endwhile; ?>

			</div>
		</div>

	</section>



<?php }


public function selim_slider_main() {

		$labels = array(
			'name'          => __( 'Selim Slider' ),//menu sidebar name for admin panel
			'singular_name' => __( 'slider' ),//url->post_type=slider
			'add_new'       => __( 'Add Slider' ),//Add Slider side button name
			'add_new_item'  => __( 'Add New Slider' ), //Add Slider->Add New Slider side button name
			'all_items'  => __( 'All Items' ),
			'new_item'  => __( 'New Item' ),
			'edit_item'  => __( 'Edit Item' ),
			'update_item'  => __( 'Update Item' ),
			'view_item'  => __( 'View Item' ),
			'view_items'  => __( 'View Items' ),
			'not_found'  => __( 'Not Found Selim Slider' ),
			'not_found_in_trash'  => __( 'Not Found In Trash' ),
		);

		$args   = array(
			'label'      => __( 'Selim Slider' ),
			'labels'     => $labels,
			'taxonomies' => array( 'category', 'post_tag' ),//category, tags
			'public'     => true,
			'supports'   => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
			'menu_icon'=>'dashicons-laptop'


		);

		register_post_type( 'selim_slider_main', $args );
	}
}
new  selim_slider();
