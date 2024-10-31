<?php

/**
 * Plugin Name:       My Pricing Table
 * Plugin URI:        https://wordpress.org/plugins/my-pricing-table
 * Description:       Make beautiful Pricing table with this plugin.
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            bPlugins
 * Author URI:        http://abuhayatpolash.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       bpricing
 */

//  Initialize Plugin
define( 'BPPT_PLUGIN_DIR', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) . '/' );
define( 'BPPT_PLUGIN_VERSION', '1.0.1' );

add_action( 'plugin_loaded', 'bppt_textdomain' );
function bppt_textdomain() {
    load_textdomain( 'bpricing', BPPT_PLUGIN_DIR . 'languages' );
}

// REGISTER STYLE AND SCRIPT
function bppt_register_assets() {
    wp_register_style( 'google_font', plugin_dir_url( __FILE__ ) . '//fonts.googleapis.com/css?family=Lato:400,700' );
    wp_register_style( 'bppt_pt_style_1', plugin_dir_url( __FILE__ ) . 'public/css/pricing-table-1.css' );
    wp_register_style( 'bppt_pt_style_2', plugin_dir_url( __FILE__ ) . 'public/css/pricing-table-2.css' );
    wp_register_style( 'bppt_pt_style_3', plugin_dir_url( __FILE__ ) . 'public/css/pricing-table-3.css' );
    wp_register_style( 'bppt_pt_style_4', plugin_dir_url( __FILE__ ) . 'public/css/pricing-table-4.css' );
    wp_register_style( 'bppt_pt_style_5', plugin_dir_url( __FILE__ ) . 'public/css/pricing-table-5.css' );
}
add_action( 'wp_enqueue_scripts', 'bppt_register_assets' );

// Additional admin style
function bppt_admin_style() {
    wp_register_style( 'bppt-custom-style', plugin_dir_url( __FILE__ ) . 'public/css/custom-style.css' );
    wp_enqueue_style( 'bppt-custom-style' );
}
add_action( 'admin_enqueue_scripts', 'bppt_admin_style' );

// Shortcode for Pricing Table
function bppt_bprincing_table( $atts ) {
    $a = shortcode_atts( array(
        'id' => null,
    ), $atts );
    ob_start();?>

<?php
// Pricing table meta data
    $pricing_metas = get_post_meta( $a['id'], '_bpptable_', true );
    ?>

<?php if ( !empty( $pricing_metas ) && is_array( $pricing_metas ) ): 
  
  $myPricingMetas  = $pricing_metas['pricing_table'] ? $pricing_metas['pricing_table'] : array();
  
  ?>

    <?php if ( $pricing_metas['pricing_demo'] === 'demo-1' ):
        wp_enqueue_style( 'bppt_pt_style_1' );
        wp_enqueue_style( 'google_font' );
        ?>

				<div class="bppt_pricing">
				  <?php
    
    foreach ( $myPricingMetas as $pricing_meta ):
            $color_scheme1 = $pricing_meta['plan_color_opt1'] ? $pricing_meta['plan_color_opt1'] : '';
            ?>
              <!--price tab-->
              <div class="plan <?php echo esc_attr( $color_scheme1 ); ?>">
                <div class="plan-inner">

                <?php if ( $pricing_meta['plan_recommended'] === '1' ): ?>
                <div class="hot"><?php echo esc_html( $pricing_meta['plan_recommded_text'] ); ?></div>
                <?php endif;?>

				          <div class="plan-entry-title">
				            <h3><?php echo esc_html( $pricing_meta['plan_name'] ); ?></h3>
				            <div class="price"><?php echo esc_html( $pricing_meta['plan_currency'] ); ?><?php echo esc_html( $pricing_meta['plan_price'] ); ?><span>/<?php echo esc_html( $pricing_meta['plan_price_unit'] ); ?></span>
				            </div>
				          </div>

				          <?php if ( isset( $pricing_meta['plan_features'] ) ): ?>
				          <div class="plan-entry-content">
				            <ul>
				              <?php foreach ( $pricing_meta['plan_features'] as $features_item ): ?>
				                <li><?php echo esc_html($features_item['feat_item']); ?></li>
				              <?php endforeach;?>
                    </ul>
          </div>
          <?php endif;?>

          <div class="bttn">
            <a href="<?php echo esc_url( $pricing_meta['plan_btn_link'] ); ?>"><?php echo esc_html( $pricing_meta['plan_btn_text'] ); ?></a>
          </div>

        </div>
      </div>
      <!-- end of price tab-->
      <?php endforeach;?>


    </div>
    <?php endif;?>

    <!-- Pricing table demo-2 -->
    <?php if ( $pricing_metas['pricing_demo'] === 'demo-2' ):
        wp_enqueue_style( 'bppt_pt_style_2' );?> 

			<div class="bppt_container">

            <?php foreach ( $myPricingMetas as $pricing_meta ):
            $color_scheme2 = $pricing_meta['plan_color_opt2'] ? $pricing_meta['plan_color_opt2'] : '';   ?>

              <div class="pricingTable <?php echo esc_attr( $color_scheme2 ); ?>">
                <div>
                    <div class="pricingTable-header">
                        <h3 class="title"><?php echo esc_html( $pricing_meta['plan_name'] ); ?></h3>
                    </div>
                    <div class="price-value"><?php echo esc_html( $pricing_meta['plan_currency'] ); ?><?php echo esc_html( $pricing_meta['plan_price'] ); ?><span>/<?php echo esc_html( $pricing_meta['plan_price_unit'] ); ?></span>
                    </div>

                    <?php if ( !empty( $pricing_meta['plan_features'] ) ): ?>
                      <div class="pricing-content">
                        <ul>
                          <?php foreach ( $pricing_meta['plan_features'] as $features_item ): ?>
                            <li><?php echo esc_html( $features_item['feat_item'] ); ?></li>
                          <?php endforeach;?>
                        </ul>
                      </div>
                    <?php endif;?>

                  <div class="pricingTable-signup">
                    <a href="<?php echo esc_url( $pricing_meta['plan_btn_link'] ); ?>"><?php echo esc_html( $pricing_meta['plan_btn_text'] ); ?></a>
                  </div>
                </div>
            </div>
        <?php endforeach;?>
      </div>
    <?php endif;?>
    <!--End Pricing table demo-2 -->

    <!--Pricing table demo-3 -->
<?php if ( $pricing_metas['pricing_demo'] === 'demo-3' ):
        wp_enqueue_style( 'bppt_pt_style_3' );?>

  <div class="bppt_table3">
          <?php foreach ( $myPricingMetas as $pricing_meta ):
          $color_scheme3 = $pricing_meta['plan_color_opt3'] ? $pricing_meta['plan_color_opt3'] : '';
          ?>

        <div class="pricingTable">
          <div class="pricingTable-header">
            <h3 class="title"><?php echo esc_html( $pricing_meta['plan_name'] ); ?></h3>
          </div>

          <div class="price-value">
            <span class="amount"><?php echo esc_html( $pricing_meta['plan_currency'] ); ?><?php echo esc_html( $pricing_meta['plan_price'] ); ?></span>
            <span class="duration"><?php echo esc_html( $pricing_meta['plan_price_unit'] ); ?></span>
          </div>

          <div class="pricing-content">
            <ul>
              <?php foreach ( $pricing_meta['plan_features'] as $features_item ): ?>
                <li><?php echo esc_html( $features_item['feat_item'] ); ?></li>
                <?php endforeach;?>
              </ul>

          </div>

          <div class="pricingTable-signup">
                <a href="<?php echo esc_url( $pricing_meta['plan_btn_link'] ); ?>"><?php echo esc_html( $pricing_meta['plan_btn_text'] ); ?></a>
          </div>
        </div>

        <?php endforeach;?>
  </div>

<?php endif;?>
<!--End Pricing table demo-3 -->


<!--Pricing table demo-4 -->
<div class='priceTableBGBefore columns-3 columns-tablet-2 columns-mobile-1'>

    <?php if ( $pricing_metas['pricing_demo'] === 'demo-4' ):
        wp_enqueue_style( 'bppt_pt_style_4' );?>

				    <?php foreach ( $myPricingMetas as $pricing_meta ):
            $color_scheme4 = $pricing_meta['plan_color_opt4'] ? $pricing_meta['plan_color_opt4'] : '';

            ?>
								          <div class='pricingTable <?php echo esc_attr( $color_scheme4 ); ?>'>
								              <div class='pricingContent'>
								                  <div>
								                      <div class='pricingHeader'>
								                          <h3 class='title'><?php echo esc_html( $pricing_meta['plan_name'] ); ?></h3>
								                      </div>
								                      <?php if ( !empty( $pricing_meta['plan_features'] ) ): ?>

								                      <ul class='pricingFeatures'>
								                        <?php foreach ( $pricing_meta['plan_features'] as $features_item ): ?>
								                        <?php if ( $features_item['feat_item_chk'] === '1' ): ?>
								                            <li><?php echo esc_html( $features_item['feat_item'] ); ?></li>
								                          <?php else: ?>
				                          <li class='disable'><?php echo esc_html( $features_item['feat_item'] ); ?></li>
				                        <?php endif?>
                        <?php endforeach;?>
                      </ul>

                      <?php endif;?>
                  </div>
                  <div>
                    <div class='pricingValue'><span class='amount'><?php echo wp_kses_post( $pricing_meta['plan_currency'] ); ?><?php echo esc_html( $pricing_meta['plan_price'] ); ?></span>
                        <span class='duration'><?php echo esc_html( $pricing_meta['plan_price_unit'] ); ?></span>
                    </div>
                    <div class='pricingSignUp'>
                    <a href="<?php echo esc_url( $pricing_meta['plan_btn_link'] ); ?>"><?php echo esc_html( $pricing_meta['plan_btn_text'] ); ?></a>
                    </div>
                </div>
              </div>
          </div><!-- Pricing Table -->
          <?php endforeach;?>

        <?php endif;?>
        <!--End Pricing table demo-4 -->

      </div><!-- Pricing Table Container-->


    <div class='priceTableGradient columns-3 columns-tablet-2 columns-mobile-1'>
    <!--Pricing table demo-5 -->
    <?php if ( $pricing_metas['pricing_demo'] === 'demo-5' ):
        wp_enqueue_style( 'bppt_pt_style_5' );
        ?>

				    <?php foreach ( $myPricingMetas as $pricing_meta ):
            $color_scheme5 = $pricing_meta['plan_color_opt5'] ? $pricing_meta['plan_color_opt5'] : '';?>

		        <div class='pricingTable <?php echo esc_attr( $color_scheme5 ); ?>'>
		          <div>
		          <div class='pricingHeader'>
		              <h3 class='title'><?php echo esc_html( $pricing_meta['plan_name'] ); ?></h3>
		          </div>
		          <div class='pricingValue'>
		              <span class='amount'><?php echo esc_html($pricing_meta['plan_currency'] ); ?><?php echo esc_html( $pricing_meta['plan_price'] ); ?></span>
		              <span class='duration'>/<?php echo esc_html( $pricing_meta['plan_price_unit'] ); ?></span>
		          </div>

		          <?php if ( !empty( $pricing_meta['plan_features'] ) ): ?>
		            <ul class='pricingFeatures'>

		              <?php foreach ( $pricing_meta['plan_features'] as $features_item ): ?>
		                <?php if ( $features_item['feat_item_chk'] === '1' ): ?>
		                  <li><?php echo esc_html( $features_item['feat_item'] ); ?></li>
		                <?php else: ?>
	            <li class='disable'><?php echo esc_html( $features_item['feat_item'] ); ?></li>
	            <?php endif?>
              <?php endforeach;?>

              </ul>
            <?php endif;?>
          </div>

        <div class='pricingSignUp'>
        <a href="<?php echo esc_url( $pricing_meta['plan_btn_link'] ); ?>"><?php echo esc_html( $pricing_meta['plan_btn_text'] ); ?></a>
        </div>
      </div>
      <?php endforeach;?>

      <?php endif;?>
      <!--End Pricing table demo-5 -->
    </div>

<?php endif;?>

<?php
return ob_get_clean();
}
add_shortcode( 'bp-table', 'bppt_bprincing_table' );

//  Post-type for bppt
function bppt_pricing_table() {
    $labels = array(
        'name'           => __( 'Pricing Table', 'bpricing' ),
        'menu_name'      => __( 'Pricing Table', 'bpricing' ),
        'name_admin_bar' => __( 'Pricing Table', 'bpricing' ),
        'add_new'        => __( 'Add New Pricing Table', 'bpricing' ),
        'add_new_item'   => __( 'Add New Pricing Table ', 'bpricing' ),
        'new_item'       => __( 'New Pricing Table ', 'bpricing' ),
        'edit_item'      => __( 'Edit Pricing Table ', 'bpricing' ),
        'view_item'      => __( 'View Pricing Table ', 'bpricing' ),
        'all_items'      => __( 'All Pricing Tables', 'bpricing' ),
        'not_found'      => __( 'Sorry, we couldn\'t find the Feed you are looking for.', 'bpricing' ),
    );
    $args = array(
        'labels'          => $labels,
        'description'     => __( 'Pricing Table Options.', 'bpricing' ),
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'menu_icon'       => 'dashicons-list-view',
        'query_var'       => true,
        'rewrite'         => array( 'slug' => 'my-pricing-table' ),
        'capability_type' => 'post',
        'has_archive'     => false,
        'hierarchical'    => false,
        'menu_position'   => 20,
        'supports'        => array( 'title' ),
    );
    register_post_type( 'bppt-pricing-table', $args );
}
add_action( 'init', 'bppt_pricing_table' );

// External files Inclusion

// Option panel
require_once 'inc/csf/csf-config.php';
require_once 'inc/metabox-options.php';

/*-------------------------------------------------------------------------------*/
/*   Additional Features
/*-------------------------------------------------------------------------------*/

// Hide & Disabled View, Quick Edit and Preview Button
function bppt_remove_row_actions( $idtions ) {
    global $post;
    if ( $post->post_type == 'bppt-pricing-table' ) {
        unset( $idtions['view'] );
        unset( $idtions['inline hide-if-no-js'] );
    }
    return $idtions;
}

if ( is_admin() ) {
    add_filter( 'post_row_actions', 'bppt_remove_row_actions', 10, 2 );}

// HIDE everything in PUBLISH metabox except Move to Trash & PUBLISH button
function bppt_hide_publishing_actions() {
    $my_post_type = 'bppt-pricing-table';
    global $post;
    if ( $post->post_type == $my_post_type ) {
        ?>
            <style type="text/css">
                #misc-publishing-actions,
                #minor-publishing-actions{
                    display:none;
                }
            </style>
        <?php
    }
}
add_action( 'admin_head-post.php', 'bppt_hide_publishing_actions' );
add_action( 'admin_head-post-new.php', 'bppt_hide_publishing_actions' );

/*-------------------------------------------------------------------------------*/
// Remove post update massage and link
/*-------------------------------------------------------------------------------*/

function bppt_updated_messages( $messages ) {
    $messages['bppt-pricing-table'][1] = __( 'Shortcode updated ', 'bpricing' );
    return $messages;
}
add_filter( 'post_updated_messages', 'bppt_updated_messages' );

/*-------------------------------------------------------------------------------*/
/* Change publish button to save.
/*-------------------------------------------------------------------------------*/
add_filter( 'gettext', 'bppt_change_publish_button', 10, 2 );
function bppt_change_publish_button( $translation, $text ) {
    if ( 'bppt-pricing-table' == get_post_type() ) {
        if ( $text == 'Publish' ) {
            return 'Save';
        }
    }

    return $translation;
}

/*-------------------------------------------------------------------------------*/
/* Footer Review Request .
/*-------------------------------------------------------------------------------*/

add_filter( 'admin_footer_text', 'bppt_admin_footer' );
function bppt_admin_footer( $text ) {
    if ( 'bppt-pricing-table' == get_post_type() ) {
        $url = 'https://wordpress.org/support/plugin/my-pricing-table/reviews/?filter=5#new-post';
        $text = sprintf( __( 'If you like <strong> My Pricing Table </strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'bpricing' ), $url );
    }

    return $text;
}

/*-------------------------------------------------------------------------------*/
/* ONLY CUSTOM POST TYPE POSTS .
/*-------------------------------------------------------------------------------*/

add_filter( 'manage_bppt-pricing-table_posts_columns', 'bppt_columns_head_only_pricing', 10 );
add_action( 'manage_bppt-pricing-table_posts_custom_column', 'bppt_columns_content_only_pricing', 10, 2 );

// CREATE TWO FUNCTIONS TO HANDLE THE COLUMN
function bppt_columns_head_only_pricing( $defaults ) {
    $defaults['directors_name'] = 'ShortCode';
    return $defaults;
}
function bppt_columns_content_only_pricing( $column_name, $post_ID ) {
    if ( $column_name == 'directors_name' ) {
        // show content of 'directors_name' column
        echo '<input onClick="this.select();" value="[bp-table id=' .esc_attr($post_ID ). ']" >';
    }
}

/*-------------------------------------------------------------------------------*/
/* Shortcode Generator area  .
/*-------------------------------------------------------------------------------*/

add_action( 'edit_form_after_title', 'bppt_shortcode_area' );
function bppt_shortcode_area() {
    global $post;
    if ( $post->post_type == 'bppt-pricing-table' ): ?>
		<div class="shortcode_gen">
			<label for="bppt_shortcode"><?php esc_html_e( 'Copy this shortcode and paste it into your post, page, or text widget content', 'bpricing' )?>:</label>

			<span>
				<input type="text" id="bppt_shortcode" onfocus="this.select();" readonly="readonly"  value="[bp-table id=<?php echo esc_attr($post->ID); ?>]" />
			</span>

		</div>
	<?php endif;
}

/*-------------------------------------------------------------------------------*/
/* Admin notice   .
/*-------------------------------------------------------------------------------*/
global $pagenow;
if ( $pagenow === 'plugins.php' ):
    function bppt_admin_notice() {
        ?>
				    <div class="notice notice-success is-dismissible">
				    <h2><?php esc_html_e( 'Checking Notice', 'bpricing' );?></h2>
				    </div>

				    <?php
    }
    add_action( 'admin_notices', 'bppt_admin_notice' );

endif;