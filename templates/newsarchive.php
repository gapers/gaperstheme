<?php
/**
* Template Name: News Archives
*
* The template for displaying Yearly News Archives
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
*
* @package relia
*/

get_header(); ?>

<div id="primary" class="content-area">

  <main id="main" class="site-main" role="main">

    <div class="container">

      <div class="row">

        <div class="col-sm-12">
          <div class="row">

            <?php get_sidebar( 'left' ); ?>

            <div class="col-sm-<?php echo relia_main_width(); ?>">

              <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                  <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                  <?php the_content(); ?>
                  <ul>
                    <?php
                      $args = array(
                        'type' => 'yearly',
                        'limit' => '',
                        'format' => 'html',
                        'before' => '',
                        'after'  => '',
                        'show_post_count' => true,
                        'echo'  => 1,
                        'order' => 'DESC',
                        'post_type' => 'post'
                      );
                      wp_get_archives($args);
                    ?>
                  </ul>
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
        </div>

      </div><!-- row -->

    </div><!-- container -->

  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
