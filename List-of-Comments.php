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
 
  Template Name: List of Comments
 
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
						// count all comments on the system
						$comments = wp_count_comments();
						$howManyComments = 30;
						echo "<p>There are a total of $comments->total_comments comments on this site.<br>Below are the most recent $howManyComments of them, newest at the top.</p>";
						
						// display a list of recent comments
						// make sure there are no pingbacks
						// https://codex.wordpress.org/Function_Reference/get_comments
						$args = array(
							'number' => $howManyComments,
							'type'   => array('comment'),
						);
						$comments = get_comments($args);
						
						foreach($comments as $comment) {
							$title = '<a href="'.get_permalink($comment->comment_post_ID).'">'.get_the_title($comment->comment_post_ID).'</a>';
							$avatar = get_avatar($comment->comment_author_email, 32);
							$commentDate = date_create($comment->comment_date);
							
							echo "<h3>$avatar ".$comment->comment_author." on $title</h3>";
							echo "<p><em>".date_format($commentDate, 'l, jS F Y')."</em></p>";
							echo "<p>$comment->comment_content</p>";
						}
						
						// end of comments
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