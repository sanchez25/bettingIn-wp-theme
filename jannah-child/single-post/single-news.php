<?php

/* Template Name: Post news */
 /* Template Post Type: News */

get_header(); ?>

<div class="news-page">
	<div class="page-container">
        <div class="news-page__img">
		    <?php echo get_the_post_thumbnail($item->ID); ?>
		</div>
		<div class="news-page__title">
		    <h1><?php the_title(); ?></h1>
		</div>
		<div class="news-page__date">
            <span><?php echo get_field('date'); ?></span>
		</div>
		<div class="news-page__text">
            <?php echo the_content(); ?>
        </div>
	</div>
</div>

<?php get_footer(); ?>
