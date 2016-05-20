<?php /* Template Name: Page d'accueil */
get_header();
?>
<article class="container">
  <section id="slideshow"class="large--12">
  <?php get_template_part('page-templates/home/slider') ?>
  </section>
  <aside class="sidebar large--3">
    <?php dynamic_sidebar('page-sidebar'); ?>
  </aside>
  <div class="large--1"></div>
  <section class="content large--8">
    <?php get_template_part("page-templates/home/derniers_articles"); ?>
  </section>
  <div class="large--1"></div>
  <section class="content large--8 home__startup">
    <div class="home__startup--bg"></div>
    <?php get_template_part("page-templates/home/startup_du_jour"); ?>
  </section>
  <div class="large--1"></div>
  <section class="content large--8">
    <?php get_template_part("page-templates/home/brand_factory"); ?>
  </section>
  <div class="large--1"></div>
  <section class="content large--8 home__video--block">
    <?php get_template_part("page-templates/home/recentes_videos"); ?>
  </section>
  <div class="large--1"></div>
  <section class="content large--8">
    <?php get_template_part("page-templates/home/lifestyle"); ?>
  </section>
  <div class="large--1"></div>
  <section class="content large--8">
    <?php get_template_part("page-templates/home/au_menu_du_jour"); ?>
  </section>
  <div class="large--1"></div>
  <section class="content large--8">
    <?php get_template_part("page-templates/home/ventes_ddp"); ?>
  </section>
</article>
<?php
get_footer();
?>
