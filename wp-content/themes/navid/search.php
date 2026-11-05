<?php
/**
 * Search Results Template
 *
 * @package Navid
 */


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
get_header();
?>

<div class="search-results-header">
  <div class="container">
    <h1><?php printf( esc_html__( 'Results for "%s"', 'navid' ), '<em>' . get_search_query() . '</em>' ); ?></h1>
  </div>
</div>

<?php if ( have_posts() ) : ?>
<?php
$grid_cols    = get_theme_mod( 'navid_grid_columns', '3' );
$content_type = get_theme_mod( 'navid_blog_content_type', 'excerpt' );
$excerpt_len  = (int) get_theme_mod( 'navid_excerpt_length', 25 );
?>
<div class="archive-grid cols-<?php echo esc_attr( $grid_cols ); ?>">
  <?php 
  $count = 0;
  while ( have_posts() ) : the_post(); 
      $count++;
  ?>
  <?php if ( 'full' === $content_type ) : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card post-card-full-content anim-up' ); ?>>
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-card-img-wrap">
          <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
            <img class="clip-reveal" src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'navid-card' ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
          </a>
        </div>
      <?php endif; ?>
      <div class="post-card-body">
        <span class="post-card-tag tag-lifestyle"><?php echo esc_html( get_post_type() ); ?></span>
        <h3 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="post-card-content single-body entry-content" style="margin: 14px 0;">
          <?php the_content( esc_html__( 'Continue Reading →', 'navid' ) ); ?>
        </div>
        <div class="post-card-meta">
          <span><?php the_author(); ?></span>
          <span class="meta-sep"></span>
          <span><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
        </div>
      </div>
    </article>
  <?php else : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card anim-up' ); ?>>
      <a href="<?php the_permalink(); ?>">
        <div class="post-card-img-wrap">
          <?php if ( has_post_thumbnail() ) : ?>
            <img class="clip-reveal" src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'navid-card' ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
          <?php endif; ?>
        </div>
        <div class="post-card-body">
          <span class="post-card-tag tag-lifestyle"><?php echo esc_html( get_post_type() ); ?></span>
          <h3 class="post-card-title"><?php the_title(); ?></h3>
          <?php if ( 'none' !== $content_type ) : ?>
            <p class="post-card-snippet"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $excerpt_len ) ); ?></p>
          <?php endif; ?>
          <div class="post-card-meta">
            <span><?php the_author(); ?></span>
            <span class="meta-sep"></span>
            <span><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
          </div>
        </div>
      </a>
    </article>
  <?php endif; ?>
  <?php do_action( 'navid_after_loop_post', $count ); ?>
  <?php endwhile; ?>
</div>

<?php navid_pagination(); ?>

<?php else : ?>
  <div class="error-404" style="min-height:40vh;">
    <h2><?php esc_html_e( 'No results found.', 'navid' ); ?></h2>
    <p><?php esc_html_e( 'Try a different search term.', 'navid' ); ?></p>
  </div>
<?php endif; ?>

<?php get_footer(); ?>
