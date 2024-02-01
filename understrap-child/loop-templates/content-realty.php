<?php

/**
 * Single post partial template
 *
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class('mb-5 mt-5'); ?> id="post-<?php the_ID(); ?>">
    <div class="card">
        <div class="card-img-top">
            <?php $gallery = CFS()->get('object_gallery');
            if ($gallery && count($gallery) > 1) : ?>
                <div id="gallery-<?php the_ID(); ?>" class="carousel slide lazy-load" data-ride="carousel">
                    <div class="carousel-inner">
                        <ul class="carousel-indicators">
                            <?php foreach ($gallery as $index => $item) :  ?>
                                <li data-target="#gallery-<?php the_ID(); ?>" data-slide-to="<?= $index ?>" class="<?php if ($index == 0) {
                                                                                                                        echo 'active';
                                                                                                                    } ?>"></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php foreach ($gallery as $index => $item) :  ?>

                            <div class="carousel-item <?php if ($index == 0) {
                                                            echo 'active';
                                                        } ?>">
                                <?php echo wp_get_attachment_image($item['object_gallery_item'], 'full') ?>
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
                <?php echo get_the_post_thumbnail($post->ID); ?>
            <?php endif; ?>
        </div>

        <div class="card-body">
            <header class="entry-header mt-2">
                <?php the_title('<h1 class="entry-title card-title">', '</h1>'); ?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php the_content(); ?>
            </div><!-- .entry-content -->

            <?php $fields = CFS()->get(); ?>
            <div>Адрес:
                <?= $fields['object_address']; ?>
            </div>

            <div>Площадь:
                <?php echo preg_replace('/[^0-9]/', '', $fields['object_square']); ?>
                м<sup>2</sup>
            </div>

            <?php if ($fields['object_square_live']) : ?>
                <div>Жилая площадь:
                    <?php echo preg_replace('/[^0-9]/', '', $fields['object_square_live']); ?>
                    м<sup>2</sup>
                </div>
            <?php endif; ?>

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