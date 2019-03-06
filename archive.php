<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="">
				<?php echo do_shortcode('[metaslider id="164"]'); ?>
			</div>


		<?php if ( have_posts() ) : ?>

			<div class="card-deck m-4 text-center">
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post(); ?>

			<?php $link_site = get_field('link_to_site'); ?>
			<?php $link_github = get_field('link_to_github'); ?>
			<?php  $project_image = get_field('project_image');?>
			<?php $size = 'medium'; ?>
			<?php $terms = get_the_terms( $post->ID , 'technology' ); ?>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 pt-3">
				<div class="card">
					<a class="text-dark" href="<?php echo $link_site; ?>">
						<img class="card-img-top" src="<?php echo $project_image['url']; ?>" alt="<?php echo $project_image['alt']; ?>">
						<h3 class="text-dark"><?php the_title(); ?></h3>
					</a>
					<div class="card-body">
						<p class="card-text"> <?php $content = get_the_content(); echo mb_strimwidth($content, 0, 120, '...'); ?></p>
						<?php if (!empty($terms)) { ?>
							<?php foreach ( $terms as $term ) { ?>
									<a class="btn btn-dark btn-sm mb-2" href="<?php echo site_url() ?>/technology/<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
							<?php } ?>
						<?php  }?>
						<div class="text-center pb-2 mt-auto">
							<a class="btn btn-secondary" href="<?php echo $link_github; ?>"><?php _e('Link to GitHub', 'customtheme'); ?></a>
						</div>
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

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
