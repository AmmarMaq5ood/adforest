<?php global $adforest_theme; ?>
<?php
$msg_count = 0;

$tob_bar = isset($adforest_theme['sb_top_bar']) ? $adforest_theme['sb_top_bar'] : false;
$header_type = isset($adforest_theme['sb_header']) ? $adforest_theme['sb_header'] : "white";

$haystack = array('light', 'modern');
if (!$tob_bar || in_array($header_type, $haystack)) {
    return;
}
$sb_sign_in_page = isset($adforest_theme['sb_sign_in_page']) ? $adforest_theme['sb_sign_in_page'] : "";
$sb_profile_page = isset($adforest_theme['sb_profile_page']) ? $adforest_theme['sb_profile_page'] : "";
$sb_sign_in_page = apply_filters('adforest_language_page_id', $sb_sign_in_page);
$sb_profile_page = apply_filters('adforest_language_page_id', $sb_profile_page);
$social_icons = isset($adforest_theme['social_media']) ? $adforest_theme['social_media'] : array();

$header_type = isset($adforest_theme['sb_header']) ? $adforest_theme['sb_header'] : "white";
?>
<div class="sb-header-top1  <?php echo esc_attr($header_type) . "-header" ?>">
    <div class="container">
        <div class="row">
            <div class="sb-top-left col-md-8 col-sm-6 col-xs-12">
                <ul class="list-unstyled list-inline flo-left"><?php
                    if (isset($adforest_theme['top_bar_pages']) && $adforest_theme['top_bar_pages'] != "" && count($adforest_theme['top_bar_pages']) > 0) {
                        foreach ($adforest_theme['top_bar_pages'] as $foot_page) {
                            $foot_page = apply_filters('adforest_language_page_id', $foot_page);
                            echo '<li><a href="' . esc_url(get_the_permalink($foot_page)) . '">' . esc_html(get_the_title($foot_page)) . '</a></li>';
                        }
                    }
                    ?></ul>
                <div class="sb-mob-top-bar-location"><?php do_action('adforest_topbar_location'); ?></div>
            </div>
            <?php
            $menu_flip = '';
            if (is_rtl()) {
                $menu_flip = 'flip';
            }
            ?>
            <div class="sb-top-right col-md-4 col-sm-6 col-xs-12 ">
                <div class="flo-right <?php echo esc_attr($menu_flip); ?>">
                    <ul class="socials-links top-bar-social">

                        <?php
                        if (!is_user_logged_in()) {
                            if (isset($adforest_theme['sb_sign_in_page']) && $adforest_theme['sb_sign_in_page'] != "") {
                                ?><li><a href="<?php echo get_the_permalink($sb_sign_in_page); ?>"><i class="fa fa-sign-in"></i></a></li>
                                <?php
                            }
                            $sb_sign_up_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_sign_up_page']);
                            if (isset($adforest_theme['sb_sign_up_page']) && $adforest_theme['sb_sign_up_page'] != "") {
                                ?>
                                <li><a href="<?php echo get_the_permalink($sb_sign_up_page); ?>"><i class="fa fa-unlock" aria-hidden="true"></i></a></li>
                                <?php
                            }
                        } else {
                            $user_id = get_current_user_id();
                            $user_info = get_userdata($user_id);
                            if (isset($adforest_theme['communication_mode']) && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' )) {
                                ?>
                                <li class="dropdown sb-notify-div"> 
                                    <a class="dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" aria-expanded="true">
                                        <i class="fa fa-envelope"></i>
                                        <div class="sb-notify"><?php
                                            $unread_msgs = ADFOREST_MESSAGE_COUNT;
                                            if ($unread_msgs > 0) {
                                                $msg_count = $unread_msgs;
                                                ?> 
                                                <span class="sb-heartbit"></span><span class="point"></span> <?php } ?>
                                        </div>
                                    </a>
                                    <ul class="dropdown-menu sb-mailbox animated bounceInDown">
                                        <li>
                                            <div class="sb-drop-title"><?php echo __('You have', 'adforest') . " <span class='msgs_count'>" . $unread_msgs . "</span> " . __('new notification(s)', 'adforest'); ?>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="sb-message-center"><?php if ($unread_msgs > 0) { ?><?php
                                                    $notes = $wpdb->get_results("SELECT * FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND  meta_value = 0 ORDER BY meta_id DESC LIMIT 5", OBJECT);
                                                    if (count($notes) > 0) {
                                                        ?>
                                                        <?php
                                                        foreach ($notes as $note) {
                                                            $ad_img = adforest_get_ad_default_image_url('adforest-single-small');
                                                            $get_arr = explode('_', $note->meta_key);
                                                            $ad_id = $get_arr[0];
                                                            $media = adforest_get_ad_images($ad_id);
                                                            if (count($media) > 0) {
                                                                $counting = 1;
                                                                foreach ($media as $m) {
                                                                    if ($counting > 1) {
                                                                        $mid = '';
                                                                        if (isset($m->ID))
                                                                            $mid = $m->ID;
                                                                        else
                                                                            $mid = $m;

                                                                        $image = wp_get_attachment_image_src($mid, 'adforest-single-small');
                                                                        if ($image[0] != "") {
                                                                            $ad_img = $image[0];
                                                                        }
                                                                        break;
                                                                    }
                                                                    $counting++;
                                                                }
                                                            }
                                                            $action = get_the_permalink($sb_profile_page) . '?sb_action=sb_get_messages&page_type=msg' . '&ad_id=' . $ad_id . '&user_id=' . $user_id . '&uid=' . $get_arr[1];
                                                            $poster_id = get_post_field('post_author', $ad_id);
                                                            if ($poster_id == $user_id) {
                                                                $action = get_the_permalink($sb_profile_page) . '?page_type=msg& sb_action=sb_load_messages' . '&ad_id=' . $ad_id . '&uid=' . $get_arr[1];
                                                            }
                                                            $user_data = get_userdata($get_arr[1]);

                                                            $user_pic = '';
                                                            if (function_exists('adforest_get_user_dp')) {
                                                                $user_pic = adforest_get_user_dp($get_arr[1]);
                                                            }
                                                            ?><a href="<?php echo esc_url($action); ?>"><div class="user-img"> <img src="<?php echo esc_url($user_pic); ?>" alt="<?php echo adforest_returnEcho($user_data->display_name); ?>" width="30" height="50" > </div><div class="sb-mail-contnet"><h5><?php echo adforest_returnEcho($user_data->display_name) ?></h5> <span class="mail-desc"><?php echo get_the_title($ad_id); ?></span></div></a>
                                                            <?php } ?>
                                                            <?php
                                                        }
                                                        ?>
                                                </div>
                                        </li>
                                            <?php
                                            if ($unread_msgs > 0 && isset($adforest_theme['sb_notification_page']) && $adforest_theme['sb_notification_page'] != "") {
                                                $sb_notification_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_notification_page']);
                                                ?><li class="sb-all-notify text-center"><a  href="<?php echo get_the_permalink($sb_notification_page); ?>"><strong><?php echo __('See all notifications', 'adforest'); ?></strong>
                                                        <i class="fa fa-angle-right"></i></a></li><?php
                                                    }
                                                }
                                                ?>
                                    </ul>
                                </li>

                                <?php
                            }
                        }

                        if (!empty($social_icons)) {
                            foreach ($social_icons as $index => $val) {
                                if ($val != "") {
                                    ?>
                                    <li><a  <?php do_action('adforest_relation_follow_links') ?>  href="<?php echo esc_url($val); ?>"><i class="<?php echo adforest_social_icons($index) ?>"></i></a></li>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>