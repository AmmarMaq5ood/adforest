<?php
/* ------------------------------------------------ */
/* Blog */
/* ------------------------------------------------ */
if (!function_exists('blog_short')) {

    function blog_short() {

        $cat_array = array();

        $cat_array = apply_filters('adforest_ajax_load_categories', $cat_array, 'cat', 'no');

        vc_map(array(
            "name" => __("Blog Posts", 'adforest'),
            "base" => "blog_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('blog.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                     array(
                    "group" => __("Background", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Section Background", 'adforest'),
                    "param_name" => "section_bg",
                    "admin_label" => true,
                    "value" => array(
                    __('White', 'adforest') =>  '',
                    __('Gray', 'adforest')=>   'bg-gray',
                    ),
                ),



                     array(
                    "group" => __("Basic", "adforest"),
                    "type" => "attach_image",
                    "holder" => "bg_img",
                    "class" => "",
                    "heading" => __("Background Image", 'adforest'),
                    "param_name" => "bg_img",
                    'dependency' => array(
                        'element' => 'section_bg',
                        'value' => array('img'),
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Header Style", 'adforest'),
                    "param_name" => "header_style",
                    "admin_label" => true,
                    "value" => array(
                        __('Section Header Style', 'adforest') => '',
                        __('No Header', 'adforest') => '',
                        __('Classic', 'adforest') => 'classic',
                        __('Regular', 'adforest') => 'regular',
                        __('Fancy', 'adforest') => 'fancy',
                        __('new', 'adforest') => 'new',
                    ),
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    "std" => '',
                    "description" => __("Chose header style.", 'adforest'),
                ),


                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Tagline", 'adforest'),
                    "param_name" => "section_tagline",
                    "description" => __('For color ', 'adforest') . '<strong>' . '<strong>' . esc_html('{color}') . '</strong>' . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . esc_html('{/color}') . '</strong>',
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('classic','new'),
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Title", 'adforest'),
                    "param_name" => "section_title",
                    "description" => __('For color ', 'adforest') . '<strong>' . '<strong>' . esc_html('{color}') . '</strong>' . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . esc_html('{/color}') . '</strong>',
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('classic','new'),
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Title", 'adforest'),
                    "param_name" => "section_title_regular",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('regular'),
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "description" => __('For color ', 'adforest') . '<strong>' . esc_html('{color}') . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . esc_html('{/color}') . '</strong>',
                    "heading" => __("Section Title", 'adforest'),
                    "param_name" => "section_title_fancy",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                        'value' => array('fancy'),
                    ),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Description", 'adforest'),
                    "param_name" => "section_description",
                    "value" => "",
                    'edit_field_class' => 'vc_col-sm-12 vc_column',
                    'dependency' => array(
                        'element' => 'header_style',
                       'value' => array('classic','new'),
                    ),
                ),

                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("title limit", 'adforest'),
                    "param_name" => "title_limit",
                    "admin_label" => true,
                    "value" => range(10,100,10),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "dropdown",
                    "heading" => __("Number fo Ads", 'adforest'),
                    "param_name" => "max_limit",
                    "admin_label" => true,
                    "value" => range(1, 500),
                ),
                array
                    (
                    'group' => __('Categories', 'adforest'),
                    'type' => 'param_group',
                    'heading' => __('Select Category', 'adforest'),
                    'param_name' => 'cats',
                    'value' => '',
                    'params' => array
                        (
                        array(
                            "type" => "dropdown",
                            "heading" => __("Category", 'adforest'),
                            "param_name" => "cat",
                            "admin_label" => true,
                            "value" => adforest_cats('category', 'no'),
                        ),
                    )
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'blog_short');
if (!function_exists('blog_short_base_func')) {

    function blog_short_base_func($atts, $content = '') {
     
        require trailingslashit(get_template_directory()) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
         extract(shortcode_atts(array(
            'section_bg'=>'',         
             'section_title' =>'',
              'section_description'=>'',
              'title_limit'=>''
                        ), $atts));
       extract($atts);

     
       
        if (isset($adforest_elementor) && $adforest_elementor) {
            $cats = ($atts['cats']);
        } else {
            $rows = vc_param_group_parse_atts($atts['cats']);
            $rows = apply_filters('adforest_validate_term_type', $rows);
            $is_all = false;
            if (isset($rows) && $rows != '' && is_array($rows) && count($rows) > 0) {
                $cats = array();
                foreach ($rows as $row) {
                    if (isset($row['cat']) && $row['cat'] != '') {
                        if (isset($row['cat']) && $row['cat'] != 'all') {
                            $cats[] = isset($row['cat']) ? $row['cat'] : '';
                        }
                    }
                }
            }
        }


        $title_limit   =  isset($atts['title_limit']) && $atts['title_limit']!= ""  ?  $atts['title_limit']  : 20;
     
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $max_limit,
            'post_status' => 'publish',
            'category__in' => $cats,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $args = apply_filters('adforest_wpml_show_all_posts', $args);
        $posts = new \WP_Query($args);
        $html = '';
        if ($posts->have_posts()) {
            $count = 1;
            while ($posts->have_posts()) {
                $posts->the_post();
                $pid = get_the_ID();

                $image = wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'adforest-ad-related');
                $img_header = '';
                if (isset($image[0]) && $image[0] != "") {
                    $img_header = '<div class="post-img"><a href="' . get_the_permalink() . '"><img class="img-fluid" alt="' . get_the_title() . '" src="' . esc_url($image[0]) . '"></a></div>';
                }

                $html .= '<div class="col-lg-4 col-xl-4 col-md-6 col-sm-6 col-xs-12"> 
                           <div class="blog-post">
                              	' . $img_header . ' 
                                <div class="post-content">    
                              <div class="post-info"><i class="fa fa-calendar" aria-hidden="true"></i><a href="javascript:void(0);">' . get_the_date(get_option('date_format'), $pid) . '</a></div>
                              <h3 class="post-title">
							  <a href="' . get_the_permalink() . '">' . adforest_words_count(get_the_title(),$title_limit)  . '</a> </h3>
                              <p class="post-excerpt"> ' . adforest_words_count(get_the_excerpt(), 140) . '</p>
                           </div>
                           <div class="post-info-date">
                           
                           <a href="javascript:void(0);">' . get_comments_number() . ' ' . __('comments', 'adforest') . '</a>
                               <a href="'.get_the_permalink() .'"><strong>'. __('Read More', 'adforest') .'</strong></a>
                           </div>
                           </div>
                </div>
                        ';
                if ($count % 3 == 0) {
                   // $html .= '<div class="clearfix"></div>';
                } else {
                    $html .= '';
                }
                $count++;
            }
        }
        wp_reset_postdata();

        return  '<section class="custom-padding  latest-blog '.$section_bg.'" >
            <div class="container">
                
                '.$header.'
               <div class="row">			 
			   <div class="col-md-12 col-xs-12 col-sm-12">
               <div class="row">' . $html . '</div>
			</div>
		   </div>
		</div>
		</section>';
    }

}

if (function_exists('adforest_add_code')) {
    adforest_add_code('blog_short_base', 'blog_short_base_func');
}