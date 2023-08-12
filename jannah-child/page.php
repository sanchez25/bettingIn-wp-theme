<?php get_header(); ?>

<div class="single-page__title" style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/img/faq-back.png)">
    <div class="page-container">
        <div class="single-overlay__title">
            <h1><?php the_title(); ?></h1>
            <p class="single-overlay__subtitle"><?php echo get_field( 'subtitle-page' ); ?></p>
        </div>
    </div>
</div>

<?php the_content(); ?>

<?php get_footer(); ?>
