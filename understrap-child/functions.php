<?php

/**
 * UnderStrap Childe Theme Functions and Definitions
 **/
wp_enqueue_style('basic-child-css', get_stylesheet_directory_uri() . '/style.css');

// wp_enqueue_script('basic-custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array(), true);


/* Custom Post type start */

function register_custom_taxonomy()
{
    $labels_tax = array(
        'name'              => _x('Тип недвижимости', 'taxonomy general name'),
        'singular_name'     => _x('Тип недвижимости', 'taxonomy singular name'),
        'search_items'      => __('Искать Тип'),
        'all_items'         => __('Все типы недвижимости'),
        'parent_item'       => __('Родительский тип'),
        'parent_item_colon' => __('Родительский тип:'),
        'edit_item'         => __('Редактировать тип'),
        'update_item'       => __('Обновить тип'),
        'add_new_item'      => __('Добавить новый тип недвижимости'),
        'new_item_name'     => __('Новый тип'),
        'menu_name'         => __('Тип недвижимости'),
    );
    $args_tax   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels_tax,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => ['slug' => 'type'],
    );
    register_taxonomy('realty_type', 'realty', $args_tax);
}
add_action('init', 'register_custom_taxonomy');


function cpt_realty()
{
    $supports_realty = array(
        'title',
        'editor',
        'excerpt',
        'thumbnail',
        'taxonomies',
        // 'custom-fields',
        'revisions',
    );

    $labels_realty = array(
        'name' => _x('Объекты недвижимости', 'plural'),
        'singular_name' => _x('Объект', 'singular'),
        'menu_name' => _x('Недвижимость', 'admin menu'),
        'name_admin_bar' => _x('Недвижимость', 'admin bar'),
        'add_new' => _x('Добавить объект', 'add new'),
        'add_new_item' => __('Добавить объект'),
        'new_item' => __('Новый объект'),
        'edit_item' => __('Редактировать объект'),
        'view_item' => __('Просмотреть объект'),
        'all_items' => __('Все объекты недвижимости'),
        'search_items' => __('Поиск объектам'),
        'not_found' => __('Объекты недвижимости не найдены'),
    );

    $args_realty = array(
        'supports' => $supports_realty,
        'labels' => $labels_realty,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'realty'),
        'has_archive' => true,
        'hierarchical' => false,
        'show_in_rest' => false,
        'capability_type' => 'post',
        'taxonomies' => array('type'),
        'menu_icon' => 'dashicons-admin-multisite',
        'menu_position' => 5,
    );

    register_post_type('realty', $args_realty);
}

add_action('init', 'cpt_realty');


function cpt_city()
{
    $supports_city = array(
        'title',
        'editor',
        'thumbnail',
        'taxonomies',
        'custom-fields',
        'revisions',
    );

    $labels_city = array(
        'name' => _x('Города', 'plural'),
        'singular_name' => _x('Город', 'singular'),
        'menu_name' => _x('Города', 'admin menu'),
        'name_admin_bar' => _x('Города', 'admin bar'),
        'add_new' => _x('Добавить город', 'add new'),
        'add_new_item' => __('Добавить город'),
        'new_item' => __('Новый город'),
        'edit_item' => __('Редактировать город'),
        'view_item' => __('Просмотреть города'),
        'all_items' => __('Все города'),
        'search_items' => __('Поиск по городам'),
        'not_found' => __('Города не найдены'),
    );

    $args_city = array(
        'supports' => $supports_city,
        'labels' => $labels_city,
        'public' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'city'),
        'has_archive' => true,
        'hierarchical' => true,
        'show_in_rest' => false,
        'capability_type' => 'post',
        'menu_icon' => 'dashicons-building',
        'menu_position' => 4,
    );

    register_post_type('city', $args_city);
}

add_action('init', 'cpt_city');


add_action('add_meta_boxes', function () {
    add_meta_box('objects_city', 'Город объекта', 'post_city_metabox', 'realty', 'side', 'low');
});

// Метабокс с выбором города
function post_city_metabox($post)
{

    $cities = get_posts(array('post_type' => 'city', 'posts_per_page' => -1, 'orderby' => 'post_title', 'order' => 'ASC'));

    if ($cities) {
        echo '
        <select name="post_parent">
        <option value=""></option>
        ';
        foreach ($cities as $city) {
            echo '
            <option value="' . $city->ID . '" ' . selected($city->ID, $post->post_parent)  . '>' . esc_html($city->post_title) . '</option>
            ';
        }
        echo '</select>';
    } else
        echo 'Города не найдены';
}


add_filter('get_the_archive_title', function ($title) {
    return preg_replace('~^[^:]+: ~', '', $title);
});
