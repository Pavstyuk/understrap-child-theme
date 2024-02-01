<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>

<div class="wrapper" id="page-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">

            <main class="site-main" id="main">
                <section class="jumbotron text-center">
                    <h1><?php bloginfo('name'); ?></h1>
                </section>
                <section class="pt-5 pb-5">
                    <h2>Актуальные объекты недвижимости</h2>
                    <div class="row">
                        <?php if (have_posts()) :
                            query_posts(array('post_type' => 'realty', 'posts_per_page' => 8));
                            while (have_posts()) :
                                the_post() ?>


                                <article <?php post_class('col-lg-3 col-md-4 col-md-6 mb-5'); ?> id="post-<?php the_ID(); ?>">
                                    <div class="card">
                                        <?php $gallery = CFS()->get('object_gallery');
                                        if ($gallery && count($gallery) > 1) : ?>
                                            <div id="gallery-<?php the_ID(); ?>" class="carousel slide lazy-load card-img-top" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <?php foreach ($gallery as $index => $item) :  ?>

                                                        <div class="carousel-item <?php if ($index == 0) {
                                                                                        echo 'active';
                                                                                    } ?>">
                                                            <?php echo wp_get_attachment_image($item['object_gallery_item'], 'medium') ?>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <a class="carousel-control-prev" href="#gallery-<?php the_ID(); ?>" data-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                </a>
                                                <a class="carousel-control-next" href="#gallery-<?php the_ID(); ?>" data-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                </a>
                                            </div>

                                        <?php else : ?>
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <div class="card-img-top">
                                                    <?php echo get_the_post_thumbnail($post->ID); ?>
                                                </div>
                                            </a>
                                        <?php endif; ?>
                                        <div class="card-body">
                                            <a class="text-decoration-none" href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title('<h3 class="entry-title card-title">', '</h3>'); ?>
                                            </a>

                                            <div class="entry-content card-text mb-2">
                                                <?php $fields = CFS()->get();  ?>
                                                <div>Площадь:
                                                    <?php echo preg_replace('/[^0-9]/', '', $fields['object_square']); ?>
                                                    м<sup>2</sup></div>
                                                <div>Этаж: <?php echo preg_replace('/[^0-9]/', '', $fields['object_floor']); ?>
                                                </div>
                                                <div>Цена: <?php echo preg_replace('/[^0-9]/', '', $fields['object_price']); ?>
                                                    &#8381;
                                                </div>
                                            </div><!-- .entry-content -->

                                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary">Смотреть</a>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>

                    <div class="pt-5 pb-5 text-center">
                        <a href="<?php echo get_site_url() . '/' . get_post_type($post); ?>" class="btn btn-primary">Смотреть все
                            объекты</a>
                    </div>

                    <?php wp_reset_query(); ?>
                </section>

                <section>
                    <div class="jumbotron text-center bg-secondary mb-5">
                        <h2 class="text-white">Города</h2>
                    </div>
                    <div class="row mt-5">
                        <?php if (have_posts()) :
                            query_posts(array('post_type' => 'city', 'posts_per_page' => 4));
                            while (have_posts()) :
                                the_post() ?>

                                <article <?php post_class('col-sm-6 mb-5'); ?> id="post-<?php the_ID(); ?>">
                                    <div class="card">
                                        <div class="card-img-top">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php echo get_the_post_thumbnail($post->ID); ?>
                                            </a>
                                        </div>

                                        <div class="card-body">
                                            <a class="text-decoration-none" href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title('<h3 class="entry-title card-title my-2">', '</h3>'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php wp_reset_query(); ?>
                    </div>
                </section>
                <section>
                    <div class="jumbotron text-center bg-secondary mb-5">
                        <h2 class="text-white">Добавить новый объект</h2>
                    </div>
                    <h4>Заполнить данные объекта</h4>
                    <?php echo do_shortcode('[basic_post_form]'); ?>



                </section>

            </main>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
