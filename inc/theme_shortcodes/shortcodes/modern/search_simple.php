<?php

/* ------------------------------------------------ */
/* Search Simple */
/* ------------------------------------------------ */
if (!function_exists('search_simple_short')) {

    function search_simple_short() {
        vc_map(array(
            "name" => __("Search - Simple", 'adforest'),
            "base" => "search_simple_short_base",
            "category" => __("Theme Shortcodes", 'adforest'),
            "params" => array(
                array(
                    'group' => __('Shortcode Output', 'adforest'),
                    'type' => 'custom_markup',
                    'heading' => __('Shortcode Output', 'adforest'),
                    'param_name' => 'order_field_key',
                    'description' => adforest_VCImage('search-simple.png') . __('Ouput of the shortcode will be look like this.', 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "attach_image",
                    "holder" => "bg_img",
                    "class" => "",
                    "heading" => __("Background Image", 'adforest'),
                    "param_name" => "bg_img",
                    "description" => __("1280x800", 'adforest'),
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Title", 'adforest'),
                    "description" => __("%count% for total ads.", 'adforest'),
                    "param_name" => "section_title",
                ),
                array(
                    "group" => __("Basic", "adforest"),
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Section Tagline", 'adforest'),
                    "param_name" => "section_tag_line",
                ),
            ),
        ));
    }

}

add_action('vc_before_init', 'search_simple_short');
if (!function_exists('search_simple_short_base_func')) {

    function search_simple_short_base_func($atts, $content = '') {
        extract(shortcode_atts(array(
            'bg_img' => '',
            'section_title' => '',
            'section_tag_line' => '',
                        ), $atts));

        is_array($atts)  ?  extract($atts) :  $atts;
        
        
        global $adforest_theme;
        $style = '';
        if ($bg_img != "") {
            $bgImageURL = adforest_returnImgSrc($bg_img);
            $style = ( $bgImageURL != "" ) ? ' style="background: rgba(0, 0, 0, 0) url(' . $bgImageURL . ') center top no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"' : "";
        }
        $count_posts = wp_count_posts('ad_post');

        $main_title = str_replace('%count%', '<b>' . $count_posts->publish . '</b>', $section_title);
        $sb_search_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_search_page']);
        return '<section id="hero-cats" class="hero-cats" ' . $style . '>
         <div class="content">
            <h1>' . $main_title . '</h1>
            <p>' . esc_html($section_tag_line) . '</p>
            <div class="search-holder">
               <div id="custom-search-input">
                  <div class="col-md-12 col-xs-12 col-sm-12">
				  <form method="get" action="' . urldecode(get_the_permalink($sb_search_page)) . '">
                     <input type="text" autocomplete="off" name="ad_title" class="form-control" placeholder="' . __('What Are You Looking For...', 'adforest') . '" /> <span class="input-group-btn">
                     ' . apply_filters('adforest_form_lang_field', false) . '    
                     <button class="btn btn-theme" type="submit"> <span class="fa fa-search"></span> </button>
                     </span>
					</form>
                  </div>
               </div>
            </div>
         </div>
      </section>
';
    }

}

if (function_exists('adforest_add_code')) {
    adforest_add_code('search_simple_short_base', 'search_simple_short_base_func');
}