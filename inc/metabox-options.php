<?php if ( ! defined( 'ABSPATH' )  ) { die; } // Cannot access directly.

//
// Metabox of the PAGE
// Set a unique slug-like ID
//
$prefix = '_bpptable_';

//
// Create a metabox
//
CSF::createMetabox( $prefix, array(
  'title'        => 'Pricing Table Settings',
  'post_type'    => 'bppt-pricing-table',
  'show_restore' => true,
) );


//
// section: Pricing Table section
//
CSF::createSection( $prefix, array(
  'fields' => array(
  // A Notice
  array(
    'type'    => 'notice',
    'style'   => 'info',
    'content' => '<h3>Please, Click on the "Add New Pricing Table" button to create new pricing table Items.</h3>',
  ),
  array(
    'id'        => 'pricing_demo',
    'type'      => 'image_select',
    'title'     => 'Choose Pricing Table Style',
    'options'   => array(
      'demo-1' => plugins_url( '../public/img/demo-1.png' , __FILE__ ),
      'demo-2' => plugins_url( '../public/img/demo-2.png' , __FILE__ ),
      'demo-3' => plugins_url( '../public/img/demo-3.png' , __FILE__ ),
      'demo-4' => plugins_url( '../public/img/demo-4.png' , __FILE__ ),
      'demo-5' => plugins_url( '../public/img/demo-5.png' , __FILE__ ),
    ),
    'default'   => array( 'demo-1')
  ),
 // Pricing Table controls
    array(
      'id'          => 'pricing_table',
      'type'        => 'group',
      'title'       => esc_html__('Pricing Table','bpricing'),
      'button_title'=> esc_html__('Add New Pricing Table', 'bpricing'),
      'accordion_title_number'  => true,
      'accordion_title_prefix'  => esc_html__('Pricing Table :: ', 'bpricing'),
      'fields'      => array(
        // A Submessage

        array(
          'id'      => 'plan_name',
          'type'    => 'text',
          'title'   => esc_html__('Plan Name', 'bpricing'),
          'desc'    => esc_html__('Input Your Pricing Plan Name', 'bpricing'),
          'default' => esc_html__('Basic Plan', 'bpricing'),
        ),
        array(
          'id'      => 'plan_price',
          'type'    => 'text',
          'title'   => esc_html__('Plan Price', 'bpricing'),
          'desc'    => esc_html__('Set Your Plan Price', 'bpricing'),
          'default' => 22,
        ),
        array(
          'id'       => 'plan_currency',
          'type'     => 'button_set',
          'title'    => esc_html__('Currency', 'bpricing'),
          'options'  => array(
            '$'     => '$',
            '¥'    => '¥',
            '€'     => '€',
            '৳'     => '৳',
            '﷼'     => 'rial',
          ),
          'default'  =>'$',
        ),
        array(
          'id'      => 'plan_price_unit',
          'type'    => 'text',
          'title'   => esc_html__('Plan Price Unit Text', 'bpricing'),
          'desc'    => esc_html__('Set Your Plan Price Unit', 'bpricing'),
          'default' => esc_html__('Per Month', 'bpricing'),
        ),
        array(
          'id'       => 'plan_color_opt1',
          'type'     => 'button_set',
          'title'    => esc_html__('Color scheme', 'bpricing'),
          'options'  => array(
            'none'      => 'default',
            'basic'     => 'cyan',
            'standard'  => 'Blue',
            'ultimite'  => 'Red',
          ),
          'default'  => 'none',
          'dependency'  => array('pricing_demo', '==', 'demo-1', 'all'),
        ),
        array(
          'id'       => 'plan_color_opt2',
          'type'     => 'button_set',
          'title'    => esc_html__('Color scheme', 'bpricing'),
          'options'  => array(
            'none'    => 'default',
            'pink'    => 'Pink',
            'purple'  => 'Purple',
            'sky'     => 'Sky blue',
            'lemon'   => 'Lemon',
          ),
          'default'  => 'none',
          'dependency'  => array('pricing_demo', '==', 'demo-2', 'all'),
        ),
        array(
          'id'       => 'plan_color_opt3',
          'type'     => 'button_set',
          'title'    => esc_html__('Color scheme', 'bpricing'),
          'options'  => array(
            'none'    => 'default',
            'purple'  => 'Purple',
            'pink'    => 'Pink',
          ),
          'default'  => 'none',
          'dependency'  => array('pricing_demo', '==', 'demo-3', 'all'),
        ),
        array(
          'id'       => 'plan_color_opt4',
          'type'     => 'button_set',
          'title'    => esc_html__('Color scheme', 'bpricing'),
          'options'  => array(
            'none'    => 'default',
            'orange'  => 'Orange',
            'purple'  => 'Purple',
          ),
          'default'  => 'none',
          'dependency'  => array('pricing_demo', '==', 'demo-4', 'all'),
        ),
        array(
          'id'       => 'plan_color_opt5',
          'type'     => 'button_set',
          'title'    => esc_html__('Color scheme', 'bpricing'),
          'options'  => array(
            'none'   => 'default',
            'green'  => 'Green',
            'blue'   => 'Blue',
          ),
          'default'  => 'none',
          'dependency'  => array('pricing_demo', '==', 'demo-5', 'all'),
        ),
        array(
          'id'      => 'plan_recommended',
          'type'    => 'switcher',
          'title'   => esc_html__('Recommended Plan','bpricing'),
          'text_on'  => 'Yes',
          'text_off' => 'No',
          'default' => false,
          'dependency'  => array('pricing_demo', '==', 'demo-1', 'any'),
        ),
        array(
          'id'      => 'plan_recommded_text',
          'type'    => 'text',
          'title'   => esc_html__('Input Featured text','bpricing'),
          'default' => 'Hot',
          'dependency' => array( 'plan_recommended', '==', 'true' ),
        ),
        array(
          'id'      => 'plan_btn_text',
          'type'    => 'text',
          'title'   => esc_html__('Plan Button Text', 'bpricing'),
          'desc'    => esc_html__('Input Your Plan Button  Label text', 'bpricing'),
          'default' => esc_html__('Order Now', 'bpricing'),
        ),
        array(
          'id'      => 'plan_btn_link',
          'type'    => 'text',
          'title'   => esc_html__('Plan Button Link', 'bpricing'),
          'desc'    => esc_html__('Input Your Button Link', 'bpricing'),
          'dependency' => array( 'plan_btn_text', '!=', '' ),
        ),

        // A Heading
        array(
          'type'    => 'subheading',
          'content' => 'Plan Features',
        ),

        // Plan features
        array(
          'id'     => 'plan_features',
          'type'   => 'group',
          'title'  => 'Plan Feature Items',
          'button_title'  => __('Add Features', 'bpricing'),
          'accordion_title_number'  => true,
          'fields' => array(

            array(
              'id'    => 'feat_item_chk',
              'type'  => 'checkbox',
              'title' => esc_html__('Enable/Disable', 'bpricing'),
              'desc'  => esc_html__('Check this box to Enable this item', 'bpricing'),
              'class' => 'pt_item_check',
              'dependency' => array( 'pricing_demo', 'any', 'demo-4,demo-5', 'all'),
            ),       
            array(
              'id'    => 'feat_item',
              'type'  => 'text',
              'title' => esc_html__('Item', 'bpricing'),
            ), 

          ),
        ),
    
      ),

    ),

    
  ) // End fields


) );
