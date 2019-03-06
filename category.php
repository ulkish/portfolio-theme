<?php
/*
*/
 ?>

<?php get_header(); ?>



<?php if ( have_posts() ) : ?>

    <div class="card-group m-4 text-center">
    <?php
    // Start the Loop.
    while ( have_posts() ) : the_post(); ?>

    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 pt-3">
        <div class="card">
            <a class="text-dark" href="<?php the_permalink() ?>">
                <img class="card-img-top" src="<?php the_post_thumbnail_url(); ?>" alt="">
                <h2 class="text-dark"><?php the_title(); ?></h2>
            </a>
            <div class="card-body">
                <p class="card-text"> <?php the_excerpt(); ?></p>
            </div>
			<div class="text-center pb-2 mt-auto">
				<a class="btn btn-secondary" href="<?php the_permalink() ?>"><?php _e('Read more', 'customtheme'); ?></a>
			</div>
        </div>

    </div>

    <?php endwhile;

    // Previous/next page navigation.
    the_posts_pagination( array(
        'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
        'next_text'          => __( 'Next page', 'twentyfifteen' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
    ) );
     ?></div>

<?php 	endif;
?>

<?php get_footer(); ?>
