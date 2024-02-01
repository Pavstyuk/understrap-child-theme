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
</article><!-- #post-<?php the_ID(); ?> -->