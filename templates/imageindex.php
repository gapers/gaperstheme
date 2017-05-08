<?php

/*
* Template Name: Gallery index
* Show subpages of current page, hopefully with thumbnails
*/

function gapers_index_remove_share() {
  remove_filter ('the_excerpt', 'sharing_display', 19 );
}
add_action ('loop_start', 'gapers_index_remove_share');

get_header();  ?>

<div id="primary" class="content-area">

  <main id="main" class="site-main" role="main">

    <div class="container">

      <div class="row">

        <?php get_sidebar( 'left' ); ?>

        <div class="col-sm-<?php echo relia_main_width(); ?>">

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
              <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header><!-- .entry-header -->

            <div class="row">
              <div class="homepage-page-content col-sm-12">

                <?php
                // La Query
                $args = array(
                  'post_type' => 'page',
                  'post_parent' => get_the_ID(),
                  'post_status' => 'publish',
                  'posts_per_page' => -1,
                  'orderby' => 'menu_order',
                  'order' => 'ASC'
                );
                $the_query = new WP_Query( $args );

                if ($the_query->have_posts()) {
                  echo '<div class="relia-blog-content">';
                  // Il Loop
                  while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                    get_template_part('template-parts/content-imageindex', get_post_format());
                  endwhile;
                  echo '</div>';
                }
                // Ripristina Query & Post Data originali
                wp_reset_query();
                wp_reset_postdata();
                ?>
              </div>
            </div>

            <div class="entry-content">
              <?php the_content(); ?>
              <?php
              wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'relia' ),
                'after'  => '</div>',
                ) );
                ?>
              </div><!-- .entry-content -->

              <footer class="entry-footer">
                <?php
                edit_post_link(
                sprintf(
                /* translators: %s: Name of current post */
                esc_html__( 'Edit %s', 'relia' ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
              ),
              '<span class="edit-link">',
              '</span>'
            );
            ?>
          </footer><!-- .entry-footer -->
        </article><!-- #post-## -->

      </div>

      <?php get_sidebar( 'right' ); ?>

    </div>

  </div><!-- container -->
</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>
