<?php
/**
 * @package parallax-one
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-single-page'); ?>>
	<header class="entry-header single-header">
		<?php the_title( '<h1 itemprop="headline" class="entry-title single-title">', '</h1>' ); ?>
		<div class="clearfix"></div>
		<div class="entry-meta list-post-entry-meta">
			<div class="parallax-one-post-meta" itemprop="datePublished" datetime="<?php the_time( 'Y-m-d\TH:i:sP' ); ?>" title="<?php the_time( _x( 'l, F j, Y, g:i a', 'post time format', 'parallax-one' ) ); ?>">
				<?php echo get_the_date('F j, Y');?> 
			</div>
			<span class="posted-in entry-terms-categories" itemprop="articleSection">
				 &#8226; In 
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( esc_html__( ', ', 'parallax-one' ) );
					$pos = strpos($categories_list, ',');
					if ( $pos ) {
						echo substr($categories_list, 0, $pos);
					} else {
						echo $categories_list;
					}
				?>
			</span>
			<span itemscope itemprop="author" itemtype="http://schema.org/Person" class="entry-author post-author">
				<span  itemprop="name" class="entry-author author vcard">
					 &#8226; By <a itemprop="url" class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>" rel="author"><?php the_author(); ?> </a>
				</span>
			</span>
			<div class="comments-wrap"> &#8226; 
				<a href="<?php comments_link(); ?>" class="post-comments">
					<?php comments_number( esc_html__('No comments','parallax-one'), esc_html__('One comment','parallax-one'), esc_html__('% comments','parallax-one') ); ?>
				</a>
			</div>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div itemprop="text" class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'parallax-one' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php llorix_one_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
