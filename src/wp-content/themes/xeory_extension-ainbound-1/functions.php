<?php

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles() {
    // 親テーマのstyle.css
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');
    // 子テーマのstyle.css
    wp_enqueue_style('style-child', get_stylesheet_directory_uri() . '/style.css', array('style'));
}

// 検索パラメータでカスタムフィールドを有効にする
add_filter('query_vars', 'my_query_vars');
function my_query_vars($public_query_vars) {
    return array_merge($public_query_vars, array('meta_key', 'meta_value'));
}

// カスタムフィールドのrating(数値)から星を表示
function getRatingStar($rating) {
    $ratingString = '';

    if ($rating === '1') {
        $ratingString = '★☆☆☆☆';
    } elseif ($rating === '2') {
        $ratingString = '★★☆☆☆';
    } elseif ($rating === '3') {
        $ratingString = '★★★☆☆';
    } elseif ($rating === '4') {
        $ratingString = '★★★★☆';
    } elseif ($rating === '5') {
        $ratingString = '★★★★★';
    }

    return $ratingString;
}

// 検索用のパラメータを取得
function getSearchParam() {
    $orderby = '';
    $metaKey = '';
    $selected = [];
    $isSelected = 'selected';

    // パラメータ取得
    if (isset($_GET['orderby'])) {
        $orderby = $_GET['orderby'];
    }
    if (isset($_GET['meta_key'])) {
        $metaKey = $_GET['meta_key'];
    }

    if ($orderby === 'title') {
        $selected['title'] = $isSelected;
    } elseif ($orderby === 'date') {
        $selected['date'] = $isSelected;
    } elseif ($metaKey === 'rating') {
        $selected['rating'] = $isSelected;
    } elseif ($metaKey === 'views') {
        $selected['views'] = $isSelected;
    }

    return $selected;
}

// 会員限定判定
function canRead($pageId) {
    // 有料会員
    $payingMembersLevel = '2';

    if ((SwpmMemberUtils::is_member_logged_in() && 
         SwpmMemberUtils::get_logged_in_members_level() === $payingMembersLevel) || 
        !SwpmProtection::get_instance()->is_protected($pageId)) {
        return true;
    } else {
        return false;
    }
}

// サイドバーを表示するか
function isDisplaySidebar() {
    // 有料会員
    $payingMembersLevel = '2';
    
    if (SwpmMemberUtils::is_member_logged_in() && 
        SwpmMemberUtils::get_logged_in_members_level() === $payingMembersLevel) {
        return true;
    } else {
        return false;
    }
}
?>
