<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 
  Template Name: All My Articles
 
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?>
                        
                        <?php 
						// show a list of all articles
						// https://codex.wordpress.org/Function_Reference/wp_count_posts
						$totalPosts = wp_count_posts()->publish;
						echo "<h3>Annual Summary</h3>";
						echo "<p>I've written a total of  <strong>$totalPosts articles</strong> for this site and counting!<br> Here's a list of how many articles I've written per year:</p>";
						
						// show annual post archives
						// https://codex.wordpress.org/Template_Tags/wp_get_archives
						$args = array(
							'type'            => 'yearly',
							'limit'           => '',
							'format'          => 'html', 
							'before'          => '',
							'after'           => '',
							'show_post_count' => true,
							'echo'            => 1,
							'order'           => 'DESC'
						);
						wp_get_archives( $args ); 
						// end of annual archives 
						
						echo "<h3>Every article I've ever written for this site</h3>";
						
						// mention word count
						$postWordCount = number_format_i18n (guru_getWordCountFromPosts());
						$commentWordCount = number_format_i18n (guru_getWordCountCommentsCurrentUser());
						$combinedWordCount = number_format_i18n (guru_getWordCountFromPosts()+guru_getWordCountCommentsCurrentUser());
						echo "<p>In all these $totalPosts articles, I've written a whopping <strong>$postWordCount</strong> words on this site alone, not including the <strong>$commentWordCount</strong> that I've written as comments in response to my readers.</p>";
						echo "<p>Combined together, that's a staggering <strong>$combinedWordCount words!</strong> <br>By comparison, an average paperback contains about 50,000 words.</p>";
						
						$args = array(
							'type'            => 'postbypost',
							'limit'           => '',
							'format'          => 'html', 
							'before'          => '',
							'after'           => '',
							'show_post_count' => false,
							'echo'            => 1,
							'order'           => 'DESC'
						);
						wp_get_archives( $args ); 
						// end of all articles 
						
						?>
                        
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->

				<?php // comments_template(); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>