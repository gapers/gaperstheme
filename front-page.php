<?php
/**
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package relia
*/
get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <?php $front = get_option('show_on_front'); ?>

    <?php
    do_action( 'relia_jumbotron' );
    do_action( 'relia_homepage' );
    ?>

    <div class="container-fluid front-page-content">
      <div class="row">
        <header>
          <h2 class="wow fadeInDown feature-content-title">Prossimi eventi in programma</h2>
        </header>
      </div>
      <div class="container">
        <div class="row">
          <div class="homepage-page-content col-sm-12">

            <?php
            // La Query
            $args = array(
              'post_type' => 'tribe_events'
            );
            $the_query = new WP_Query( $args );

            echo '<div class="relia-blog-content">';
            // Il Loop
            while ( $the_query->have_posts() ) :
              $the_query->the_post();
              get_template_part('template-parts/content-blog', get_post_format());
            endwhile;
            echo '</div>';
            ?>
            <div class="col-sm-4">
              <div>
                <div class="pagination-links">
                  <?php echo paginate_links(); ?>
                </div>
              </div>
            </div>
            <?php
            // Ripristina Query & Post Data originali
            wp_reset_query();
            wp_reset_postdata();
            ?>

          </div>
        </div><!-- row -->
      </div><!-- container -->

      <div class="row">

        <div class="col-sm-12">

          <h2 class="wow fadeInDown feature-content-title">

            <?php if ( get_theme_mod( 'relia_homepage_content_title_toggle', 'show' ) == 'show' ) : ?>

              <?php echo esc_attr( get_theme_mod( 'relia_homepage_content_title', __( 'Featured Content', 'relia' ) ) ); ?>

            <?php endif; ?>

          </h2>

        </div>

        <div class="container">

          <div class="row">

            <div class="homepage-page-content col-sm-12">

              <?php if (have_posts()) : ?>

                <?php echo $front == 'posts' ? '<div class="relia-blog-content">' : ''; ?>

                  <?php /* Start the Loop */ ?>
                  <?php while (have_posts()) : the_post(); ?>

                    <?php
                    if ($front == 'posts') :
                      get_template_part('template-parts/content-blog', get_post_format());
                    else:
                      get_template_part('template-parts/content-page-home', get_post_format());
                    endif;
                    ?>

                  <?php endwhile; ?>

                  <?php echo $front == 'posts' ? '</div>' : ''; ?>

                  <?php if ($front == 'posts') : ?>
                    <div class="col-sm-4">
                      <div>
                        <div class="pagination-links">
                          <?php echo paginate_links(); ?>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>

                <?php else : ?>

                  <?php get_template_part('template-parts/content', 'none'); ?>

                <?php endif; ?>
              </div>
            </div><!-- row -->
          </div><!-- container-->
        </div> <!-- row -->
      </div><!-- container-fluid -->

    </main><!-- #main -->
  </div><!-- #primary -->


  <?php get_footer(); ?>
