<?php

/**
 * Single post partial template
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class('col-sm-6 mb-5'); ?> id="post-<?php the_ID(); ?>">
    <div class="card">
        <div class="card-img-top">
            <?php $gallery = CFS()->get('object_gallery');
            if ($gallery && count($gallery) > 1) : ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <div id="gallery-<?php the_ID(); ?>" class="carousel slide lazy-load" data-ride="carousel">
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
            </a>
            <?php else : ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark">
                <?php echo get_the_post_thumbnail($post->ID); ?>
            </a>
            <?php endif; ?>
        </div>

        <div class="card-body">
            <a class="text-decoration-none" href="<?php the_permalink(); ?>" rel="bookmark">
                <?php the_title('<h3 class="entry-title card-title">', '</h3>'); ?>
            </a>

            <?php $fields = CFS()->get(); ?>
            <div>Площадь:
                <?php echo preg_replace('/[^0-9]/', '', $fields['object_square']); ?>
                м<sup>2</sup></div>
            <div>Этаж:
                <?php echo preg_replace('/[^0-9]/', '', $fields['object_floor']); ?>
            </div>
            <div class="mb-2">Цена:
                <?php echo preg_replace('/[^0-9]/', '', $fields['object_price']); ?>
                &#8381;
            </div>
        </div>

    </div>
</article><!-- #post-<?php the_ID(); ?> -->