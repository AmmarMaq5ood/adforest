<?php
global $adforest_theme;

$sb_sign_in_page = apply_filters('adforest_language_page_id', isset($adforest_theme['sb_sign_in_page']) ? $adforest_theme['sb_sign_in_page'] : "");
$sb_sign_up_page = apply_filters('adforest_language_page_id', isset($adforest_theme['sb_sign_up_page']) ? $adforest_theme['sb_sign_up_page'] : "");
$sb_notification_page = apply_filters('adforest_language_page_id', isset($adforest_theme['sb_notification_page']) ? $adforest_theme['sb_notification_page'] : "");
$site_logo = isset($adforest_theme['sb_site_logo']['url']) ? $adforest_theme['sb_site_logo']['url'] : ADFOREST_IMAGE_PATH . "/footer-logo.png";
$responsive_logo = isset($adforest_theme['sb_site_logo_mobile']['url']) ? $adforest_theme['sb_site_logo_mobile']['url'] : ADFOREST_IMAGE_PATH . "/footer-logo.png";
$home_page_logo = isset($adforest_theme['sb_home_logo']['url']) ? $adforest_theme['sb_home_logo']['url'] : ADFOREST_IMAGE_PATH . "/logo.png";
$sb_profile_page = apply_filters('adforest_language_page_id', isset($adforest_theme['sb_profile_page']) ? $adforest_theme['sb_profile_page'] : "");
$user_id = get_current_user_id();
$is_sticky_header = isset($adforest_theme['sb_sticky_header']) && $adforest_theme['sb_sticky_header'] ? '' : 'no-sticky  ';
?>
<div class="clearfix"></div>
<div class="sb-header-top2">
    <section class="sb-dec-top-bar"> 
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-xxl-9 col-lg-9 col-xs-12 col-sm-12 col-md-12 offset-xl-3 offset-lg-3">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-9 col-sm-9 col-8 col-xs-12">
                            <div class="sb-top-bar-social-icons">
                                <ul class="list-inline list-style">
                                    <?php
                                    if (isset($adforest_theme['social_media']) && !empty($adforest_theme['social_media']) && is_array($adforest_theme['social_media'])) {
                                        foreach ($adforest_theme['social_media'] as $index => $val) {
                                            ?>
                                            <?php
                                            if ($val != "") {
                                                ?><li><a <?php do_action('adforest_relation_follow_links'); ?>href="<?php echo esc_url($val); ?>"><i class="<?php echo adforest_social_icons($index); ?>"></i></a></li> <?php
                                            }
                                        }
                                    }
                                    ?>
                                    <li class="sb-mob-top-bar-location"><?php do_action('adforest_topbar_location'); ?></li>  
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-3 col-sm-3 col-4 col-xs-12">
                            <div class="sb-dec-top-ad-post">
                                <?php
                                if (isset($adforest_theme['ad_in_menu']) && $adforest_theme['ad_in_menu']) {
                                    $sb_post_ad_page = apply_filters('adforest_ad_post_verified_id', $adforest_theme['sb_post_ad_page']);
                                    $sb_post_ad_page = apply_filters('adforest_language_page_id', $sb_post_ad_page);
                                    $sb_ad_post_url = isset($sb_post_ad_page) && !empty($sb_post_ad_page) ? apply_filters('adforest_ad_post_verified_link', get_the_permalink($sb_post_ad_page)) : home_url('/');
                                    ?><a class="btn btn-theme" href="<?php echo esc_url($sb_ad_post_url); ?>"><i class="fa fa-plus"></i><?php echo esc_html($adforest_theme['ad_in_menu_text']); ?></a><?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="sb-header sb-header-9   <?php echo esc_attr($is_sticky_header); ?>">
    <div class="container">
        <!-- sb header -->
        <div class="sb-header-container">
            <!--Logo-->

            <div class="row">
                <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12">

                    <div class="logo" data-mobile-logo="<?php echo esc_url($responsive_logo) ?>" data-sticky-logo="<?php echo esc_url($responsive_logo) ?>">

                        <a href="<?php echo home_url('/'); ?>"><img class = "sb_site_logo" src="<?php echo esc_url($site_logo); ?>" alt="<?php echo esc_html__('logo', 'adforest') ?>"></a>
                    </div>
                    <div class="burger-menu">
                        <div class="line-menu line-half first-line"></div>
                        <div class="line-menu"></div>
                        <div class="line-menu line-half last-line"></div>
                    </div>
                    <!--Navigation menu-->      
                    <nav class="sb-menu menu-caret submenu-top-border submenu-scale mega-menu">
                        <?php get_template_part('template-parts/layouts/main', 'nav'); ?>
                    </nav>
                </div>
                <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12">
                    <div class="sign-in-up">
                        <ul class="list-sign-in ">

                            <?php
                            if (is_user_logged_in()) {
                                $user_id = get_current_user_id();
                                $user_info = get_userdata($user_id);
                                if (is_user_logged_in() && isset($adforest_theme['communication_mode']) && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )) {
                                    ?>
                                    <li class="p-relative"> 
                                        <a href="<?php echo get_the_permalink($sb_notification_page); ?>"><i class="fa fa-envelope"></i>
                                            <div class="sb-notify"><?php
                                                $unread_msgs = ADFOREST_MESSAGE_COUNT;
                                                if ($unread_msgs > 0) {
                                                    $msg_count = $unread_msgs;
                                                    ?>
                                                    <span class="sb-heartbit"></span><span class="point"></span></div>
                                            <?php } ?></a> </li><?php
                                }
                            }

                            if (!is_user_logged_in()) {
                                echo '<li class="login-me"><a href="' . get_the_permalink($sb_sign_in_page) . '"><i class="fa fa-sign-in color-point"></i> ' . esc_html__('Login', 'adforest') . '</a></li>
                                      <li class="register-me"><a href="' . get_the_permalink($sb_sign_up_page) . '" class=""><i class="fa fa-user-plus color-point"></i>' . esc_html__('Register', 'adforest') . '</a></li>
                                         ';
                            } else {
                                ?>
                                <li>
                                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top"  class="login-user">
                                        <?php
                                        $dp = '';
                                        $unread_msgs = ADFOREST_MESSAGE_COUNT;
                                        if (function_exists('adforest_get_user_dp')) {
                                            $dp = adforest_get_user_dp($user_id);
                                        }
                                        ?> 
                                        <img class="img-circle" src="<?php echo esc_url($dp); ?>" alt="<?php __('user prfile picture', 'adforest'); ?>" width="32" height="32"></span></a>                                  

                                    <ul class="dropdown-user-login">
                                        <li><a href="<?php echo get_the_permalink($sb_profile_page); ?>"><i class="fa fa-user"></i> <?php echo __("Profile", "adforest"); ?></a></li>
                                        <?php echo apply_filters('adforest_vendor_dashboard_profile', '', $user_id); ?>
                                        <?php
                                        if (isset($adforest_theme['communication_mode']) && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )) {
                                            ?>
                                            <li><a href="<?php echo adforest_set_url_param(trailingslashit(get_the_permalink($sb_profile_page)), 'page_type', 'msg'); ?>"><i class="fa fa-envelope"></i> <?php echo __('Messages', 'adforest'); ?> <span class="badge"><?php echo esc_html($unread_msgs); ?></span></a></li>
                                            <?php
                                        } if (isset($adforest_theme['sb_cart_in_menu']) && $adforest_theme['sb_cart_in_menu'] && in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
                                            global $woocommerce;
                                            ?>
                                            <li><a href="<?php echo wc_get_cart_url(); ?>"><i class="fa fa-shopping-cart"></i> <?php echo __('Cart', 'adforest'); ?> <span class="badge"><?php echo adforest_returnEcho($woocommerce->cart->cart_contents_count); ?></span></a></li> <?php } ?>
                                    
                                        <li><a href="<?php echo wp_logout_url(get_the_permalink($sb_sign_in_page)); ?>"><i class="fa fa-power-off"></i> <?php echo __("Logout", "adforest"); ?></a></li>
                                    </ul>
                                </li>
                            <?php } ?>

                        </ul>
                    </div>
                </div>
            </div>   
        </div>
    </div>
    <div class="header-shadow-wrapper">
    </div>
</div>