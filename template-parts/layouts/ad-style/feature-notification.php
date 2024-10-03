<?php
$pid = get_the_ID();
$uid = get_current_user_id();
global $adforest_theme;
if (get_post_status($pid) != 'publish') {
    $not_msg = ( get_post_status($pid) == 'pending' ) ? __('Waiting for admin approval.', 'adforest') : __('Under process by user and only admin can view this.', 'adforest')
    ?>
<div role="alert" class="alert alert-info alert-dismissible alert-warning">
        <i class="fa fa-info-circle"></i>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button><?php echo esc_html($not_msg); ?>
    </div>
    <?php
    return;
}
$sb_packages_page = apply_filters('adforest_language_page_id', $adforest_theme['sb_packages_page']);
$selected_categories = get_user_meta(get_current_user_id(), 'adforest_ads_package_details', true);

$featured_ads_pkg = "";
$pkg_expiry_days = "";

if (!empty($selected_categories) && is_array($selected_categories)) {
    foreach ($selected_categories as $key => $packageDetails) {
        if (is_array($packageDetails)) {
            if (isset($packageDetails['featured_ads']) && !empty($packageDetails['featured_ads'])) {
                $featured_ads_pkg = $packageDetails['featured_ads'];
            }

            if (isset($packageDetails['pkg_expiry_days']) && !empty($packageDetails['pkg_expiry_days'])) {
                $pkg_expiry_days = $packageDetails['pkg_expiry_days'];
            }
        }
    }
}

if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins'))) && get_current_user_id() != "" && get_post_meta($pid, '_adforest_is_feature', true) == '0' && get_post_meta($pid, '_adforest_ad_status_', true) == 'active') {
    if (get_post_field('post_author', $pid) == $uid) {
        if (get_user_meta($uid, '_sb_featured_ads', true) != 0) {
            if (get_user_meta($uid, '_sb_expire_ads', true) != '-1') {
                if (get_user_meta($uid, '_sb_expire_ads', true) < date('Y-m-d')) {
                    ?>
                    <div role="alert" class="alert alert-info alert-dismissible alert-warning">
                        <i class="fa fa-info-circle"></i>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <?php echo __('Your package has been expired, please subscribe the package to make it featured AD. ', 'adforest') . " "; ?>
                        <a href="<?php echo get_the_permalink($sb_packages_page); ?>" class="sb_anchor">
                            <?php echo __('Packages. ', 'adforest'); ?>
                        </a>
                    </div>
                    <?php
                } else {
                    echo adforest_get_feature_text($pid);
                }
            } else {
                echo adforest_get_feature_text($pid);
            }
        } elseif ($featured_ads_pkg > 0) {
            if ($pkg_expiry_days == '-1' || $pkg_expiry_days > date('Y-m-d')) { 
                echo adforest_get_feature_text_new_pkg($pid);
            }
        }  else {
            ?>
            <div role="alert" class="alert alert-info alert-dismissible alert-warning">
                <i class="fa fa-info-circle"></i>
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong><?php echo __('Info', 'adforest'); ?></strong> - 
                <?php echo __('Get your ad featured - visit our ', 'adforest') . " "; ?>
                <a href="<?php echo get_the_permalink($sb_packages_page); ?>" class="sb_anchor"><?php echo __('Packages. ', 'adforest'); ?></a>
            </div>
            <?php
        }
    }
}
?>