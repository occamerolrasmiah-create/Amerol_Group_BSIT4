<?php
/**
 * The template for displaying the Blog Posts Page (home.php)
 *
 * Used when a static page is set as front page and a separate page is set as "Posts page",
 * or when viewing the default blog index.
 *
 * @package Navid
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$blog_page_id = (int) get_option( 'page_for_posts' );
$blog_title   = $blog_page_id ? get_the_title( $blog_page_id ) : '';
if ( empty( $blog_title ) ) {
    $blog_title = __( 'Latest Posts', 'navid' );
}

$blog_desc = $blog_page_id ? get_post_field( 'post_excerpt', $blog_page_id ) : '';
if ( empty( $blog_desc ) ) {
    $blog_desc = get_bloginfo( 'description' );
}
?>

<div class="archive-header" style="text-align:center; padding: 60px 20px 40px;">
  <div class="container" style="max-width: 800px; margin: 0 auto;">
    <h1 class="archive-title" style="margin-bottom: 16px;"><?php echo esc_html( $blog_title ); ?></h1>
    <?php if ( ! empty( $blog_desc ) ) : ?>
      <div class="archive-description"><?php echo wp_kses_post( $blog_desc ); ?></div>
    <?php endif; ?>
  </div>
</div>

<?php if ( have_posts() ) : ?>
<?php
$sidebar_pos  = get_theme_mod( 'navid_archive_sidebar', 'center' );
$has_sidebar  = ( 'right' === $sidebar_pos || 'left' === $sidebar_pos );
$layout_class = 'layout-container';
if ( $has_sidebar ) {
    $layout_class .= ' layout-has-sidebar';
    if ( 'left' === $sidebar_pos ) {
        $layout_class .= ' layout-sidebar-left';
    }
}

$grid_cols    = get_theme_mod( 'navid_grid_columns', '3' );
$content_type = get_theme_mod( 'navid_blog_content_type', 'excerpt' );
$excerpt_len  = (int) get_theme_mod( 'navid_excerpt_length', 25 );

$grid_classes = 'archive-grid bento-grid cols-' . esc_attr( $grid_cols );
if ( $has_sidebar ) {
    $grid_classes .= ' has-sidebar-grid';
} else {
    $grid_classes .= ' container';
}
$grid_inline_style = '';
if ( $has_sidebar && '1' !== $grid_cols ) {
    $grid_inline_style = ' style="grid-template-columns: repeat(2, 1fr);"';
}
?>
<?php if ( $has_sidebar ) : ?>
<div class="<?php echo esc_attr( $layout_class ); ?>" style="padding-top: 0;">
  <div class="layout-main">
<?php endif; ?>

    <div class="<?php echo esc_attr( $grid_classes ); ?>"<?php echo $grid_inline_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
  <?php 
  $count = 0;
  while ( have_posts() ) : the_post(); 
      $count++;
      
      // Only insert inline widgets if 'center' option is selected
      if ( 'center' === $sidebar_pos ) {
          // Insert author widget in the middle column of the first row
          if ( $count === 2 ) :
  ?>
      <!-- Author widget -->
      <div class="widget-author scale-in d2">
        <div class="widget-author-ring">
          <?php echo wp_kses_post( get_avatar( get_the_author_meta( 'ID' ), 200 ) ); ?>
        </div>
        <div>
          <h4><?php the_author(); ?></h4>
          <span class="widget-author-role"><?php esc_html_e( 'Author', 'navid' ); ?></span>
        </div>
        <?php if ( get_the_author_meta( 'description' ) ) : ?>
          <p><?php echo esc_html( wp_trim_words( get_the_author_meta( 'description' ), 20 ) ); ?></p>
        <?php endif; ?>
        <div class="widget-author-socials">
          <?php echo navid_author_socials(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
      </div>
  <?php
          endif;

          // Insert in-feed widget area in the middle column of the second row
          if ( $count === 4 ) :
              if ( is_active_sidebar( 'sidebar-in-feed' ) || is_customize_preview() ) {
                  dynamic_sidebar( 'sidebar-in-feed' );
              } else {
                  // Fallback to Trending widget only if layout is center
  ?>
  <div class="widget-trending scale-in d5">
    <h4><?php esc_html_e( 'Trending Now', 'navid' ); ?></h4>
    <?php
    $trending = get_posts( array( 'posts_per_page' => 4, 'orderby' => 'comment_count', 'order' => 'DESC' ) );
    $tnum     = 0;
    foreach ( $trending as $tpost ) :
        $tnum++;
    ?>
    <div class="trending-item">
      <span class="trending-num"><?php echo str_pad( $tnum, 2, '0', STR_PAD_LEFT ); ?></span>
      <div class="trending-info">
        <h5><a href="<?php echo esc_url( get_permalink( $tpost ) ); ?>"><?php echo esc_html( get_the_title( $tpost ) ); ?></a></h5>
        <span><?php echo esc_html( get_the_date( 'M j', $tpost ) ); ?></span>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php
              }
          endif;

          if ( $count === 6 ) :
              if ( is_active_sidebar( 'sidebar-in-feed-3' ) || is_customize_preview() ) {
                  dynamic_sidebar( 'sidebar-in-feed-3' );
              }
          endif;

          if ( $count === 8 ) :
              if ( is_active_sidebar( 'sidebar-in-feed-4' ) || is_customize_preview() ) {
                  dynamic_sidebar( 'sidebar-in-feed-4' );
              }
          endif;
      } // End sidebar check
  ?>
  <?php if ( 'full' === $content_type ) : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card post-card-full-content anim-up d' . min( $count, 6 ) ); ?>>
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-card-img-wrap">
          <a href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>">
            <img class="clip-reveal" src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'navid-card' ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
          </a>
        </div>
      <?php endif; ?>
      <div class="post-card-body">
        <?php $term = navid_get_post_term(); ?>
        <?php if ( $term ) : ?>
          <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="post-card-tag <?php echo esc_attr( navid_get_tag_class( $term ) ); ?>" style="<?php echo esc_attr( navid_get_tag_style( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
        <?php endif; ?>
        <h3 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="post-card-content single-body entry-content" style="margin: 14px 0;">
          <?php the_content( esc_html__( 'Continue Reading →', 'navid' ) ); ?>
        </div>
        <div class="post-card-meta">
          <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
            <?php echo wp_kses_post( get_avatar( get_the_author_meta( 'ID' ), 48 ) ); ?>
          </a>
          <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a>
          <span class="meta-sep"></span>
          <span><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
        </div>
      </div>
    </article>
  <?php else : ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card anim-up d' . min( $count, 6 ) ); ?>>
      <a href="<?php the_permalink(); ?>">
        <div class="post-card-img-wrap">
          <?php if ( has_post_thumbnail() ) : ?>
            <img class="clip-reveal" src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'navid-card' ) ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
          <?php endif; ?>
        </div>
        <div class="post-card-body">
          <?php $term = navid_get_post_term(); ?>
          <?php if ( $term ) : ?>
            <span class="post-card-tag <?php echo esc_attr( navid_get_tag_class( $term ) ); ?>" style="<?php echo esc_attr( navid_get_tag_style( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></span>
          <?php endif; ?>
          <h3 class="post-card-title"><?php the_title(); ?></h3>
          <?php if ( 'none' !== $content_type ) : ?>
            <p class="post-card-snippet"><?php echo esc_html( wp_trim_words( get_the_excerpt(), $excerpt_len ) ); ?></p>
          <?php endif; ?>
          <div class="post-card-meta">
            <?php echo wp_kses_post( get_avatar( get_the_author_meta( 'ID' ), 48 ) ); ?>
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

<?php if ( $has_sidebar ) : ?>
  </div><!-- .layout-main -->

  <div class="layout-sidebar">
    <?php get_sidebar(); ?>
  </div>
</div><!-- .layout-container -->
<?php endif; ?>

<?php else : ?>
  <div class="error-404" style="min-height:40vh; text-align:center; padding: 60px 20px;">
    <h2><?php esc_html_e( 'No posts found.', 'navid' ); ?></h2>
    <p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'navid' ); ?></p>
  </div>
<?php endif; ?>

<?php get_footer(); ?>
