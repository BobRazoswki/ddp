<?php /* Template Name: Page d'accueil */
get_header();
?>
<article class="container">
  <section id="slideshow"class="large--12">
    <div class="container">
          <div class="c_slider"></div>
          <div class="slider">
            <?php
              $args = array(
                'category' => 569
              );
              global $post;
              $custom_posts = get_posts($args);
              foreach($custom_posts as $post) : setup_postdata($post);
              ?><!--
              -->
              <a href="#">
                <figure>
                <?php
                  // the_post_thumbnail();
                ?>
                <img src="http://fakeimg.pl/960x320/" alt="" />
                 <figcaption>
                   <?php the_title(); ?>
                   <span class="slider__figcaption--excerpt"><?php the_excerpt(); ?></span>
                 </figcaption>
               </figure>
              </a><!--
              -->
              <?php
              endforeach;
            ?>
          </div>
      </div>
    <span id="timeline"></span>
  </section>
  <aside class="sidebar large--3">
    <?php dynamic_sidebar('page-sidebar'); ?>
  </aside>
  <section class="content large--9">
    <?php get_template_part("page-templates/home/espace_pub"); ?>
  </section>
  <section class="content large--9">
    <?php get_template_part("page-templates/home/derniers_articles"); ?>
  </section>
  <section class="content large--9">
    <?php get_template_part("page-templates/home/startup_du_jour"); ?>
  </section>
  <section class="content large--9">
    <?php get_template_part("page-templates/home/brand_factory"); ?>
  </section>
  <section class="content large--9">
    <?php get_template_part("page-templates/home/lifestyle"); ?>
  </section>
  <section class="content large--9">
    <?php get_template_part("page-templates/home/au_menu_du_jour"); ?>
  </section>
  <section class="content large--9">
    <?php get_template_part("page-templates/home/ventes_ddp"); ?>
  </section>
</article>
<?php
get_footer();
?>
