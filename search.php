<?php get_header(); ?>
<section id="content" role="main">
	<?php if ( have_posts() ) : ?>
		<h1><?php printf( __( 'Search Results for: %s', 'totallyblank' ), get_search_query() ); ?></h1>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php echo the_content(); ?>
		<?php endwhile; ?>
	<?php else : ?>
		<article id="post-0" class="post no-results not-found">
			<h2><?php _e( 'Nothing Found', 'totallyblank' ); ?></h2>
			<section class="entry-content">
				<p><?php _e( 'Sorry, nothing matched your search. Please try again.', 'totallyblank' ); ?></p>
				<?php get_search_form(); ?>
			</section>
		</article>
	<?php endif; ?>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>