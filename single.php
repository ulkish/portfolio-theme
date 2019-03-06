<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="container">

    <?php the_post_thumbnail(array(9999,700)); ?>
    <h1><?php the_title(); ?></h1>
    <div class="blog-text">
        <?php echo get_the_content(); ?>
    </div>
    <div class="text-center p-4"><?php echo get_the_date(); ?></div>
</div>

<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>
