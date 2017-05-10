<?php

/*
* Template Name: Sidereal Clock
* Show a sidereal clock at the top of the page
*/
wp_enqueue_script('sidereal', get_template_directory_uri() . '/inc/js/sidereal.js', array(), RELIA_VERSION, true);

get_header();  ?>
<STYLE type="text/css">
<!--
INPUT{
/*font-family : Arial;*/
color : #ff0000;
background-color : #000000;
border-color : #000000;
font-weight : bolder;
}
BUTTON{
/*font-family : Arial;*/
color : #ffffff;
background-color : #000000;
border-style : solid;
border-color : #808080;
font-weight : bolder;
}
TABLE{
/*font-family : Arial;*/
color : #ffffff;
background-color : #0a246c;
/*font-size : xx-small;*/
font-weight : bolder;
}
-->
</STYLE>
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
              <!-- show clock -->
              <FORM name="clock">
                <TABLE border="0" width="200" height="100" cellspacing="5" style="border-size : 4px;border-color : black;border-style : solid;">
                  <tr>
                    <td>Giorno giuliano</td><td><INPUT id="jd" value="Requires Internet Explorer" size="30" style="font-size : medium;" type="text" DISABLED></td>
                  </tr>
                  <tr>
                    <td>Tempo locale</td><td><INPUT id="date" value="Requires Internet Explorer" size="30" style="font-size : medium;" type="text" DISABLED></td>
                  </tr>
                  <tr>
                    <td>UTC</td><td><INPUT id="utc" value="0" size="30" style="font-size : medium;" type="text" DISABLED></td>
                  </tr>
                  <tr>
                    <td>LST</td><td><INPUT id="lst" value="0" size="30" style="font-size : medium;" type="text" DISABLED> Angolo orario <INPUT id="angle" value="0" size="12" style="font-size : medium;" type="text" DISABLED></td>
                  </tr>
                  <tr>
                    <td>GMST</td><td><INPUT id="gmst" value="0" size="30" style="font-size : medium;" type="text" DISABLED> Angolo orario <INPUT id="gmstangle" value="0" size="12" style="font-size : medium;" type="text" DISABLED></td>
                  </tr>
                </table>
              </FORM>
              <!--END CONTENT SECTION-->
              <script>jQuery(document).ready( function () { loadUserSetting(); });</script>
            </div>
            <?php if( have_posts() ) : ?>
              <?php while ( have_posts() ) : the_post(); ?>
                <div class="entry-content">
                  <?php the_content(); ?>
                  <?php
                  wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'relia' ),
                    'after'  => '</div>',
                    ) );
                    ?>
                </div><!-- .entry-content -->
              <?php endwhile; ?>
            <?php endif; ?>

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
