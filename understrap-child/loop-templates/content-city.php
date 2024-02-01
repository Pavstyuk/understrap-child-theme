<?php

/**
 * Single post partial template
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class(''); ?> id="post-<?php the_ID(); ?>">

    <?php echo get_the_post_thumbnail($post->ID); ?>

    <header class="entry-header mt-5">

        <?php the_title('<h1 class="entry-title mb-0">', '</h1>'); ?>

    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>


        <div class="objects-content ">
            <h3 class="mt-5 mb-2">Актуальные объекты недвижимости в городе <?php the_title(); ?></h3>
            <?php
            $cities_objects = get_posts(array('post_type' => 'realty', 'post_parent' => $post->ID, 'posts_per_page' => -1, 'orderby' => 'date', 'order' => 'ASC'));

            if ($cities_objects) : ?>
            <div class="row">
                <?php foreach ($cities_objects as $index => $object) :
                        if ($index < 10) : ?>

                <div class="col-sm-3 mb-5">
                    <div class="card">
                        <a href="<?php the_permalink($object->ID) ?>" role="bookmark">
                            <?php echo get_the_post_thumbnail($object->ID, 'thumbnail card-img-top'); ?>
                        </a>
                        <div class="card-body">
                            <a class="text-decoration-none" href="<?php the_permalink($object->ID) ?>" role="bookmark">
                                <h5 class="entry-title card-title mb-2"><?php echo $object->post_title; ?></h5>
                            </a>

                            <div>Площадь:
                                <?php echo preg_replace('/[^0-9]/', '', CFS()->get('object_square', $object->ID)); ?>
                                м<sup>2</sup></div>
                            <div>Этаж:
                                <?php echo preg_replace('/[^0-9]/', '', CFS()->get('object_floor', $object->ID)); ?>
                            </div>
                            <div class="mb-2">Цена:
                                <?php echo preg_replace('/[^0-9]/', '', CFS()->get('object_price', $object->ID)); ?>
                                &#8381;
                            </div>
                            <a class="btn btn-secondary" href="<?php the_permalink($object->ID) ?>"
                                role="bookmark">Смотреть</a>
                        </div>
                    </div>

                </div>


                <?php endif;
                    endforeach; ?>
            </div>
            <?php endif;
            wp_reset_postdata();
            ?>
        </div>

    </div><!-- .entry-content -->


    <footer class="entry-footer">

        <?php understrap_entry_footer(); ?>

    </footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->