<?php /* Template Name: Page d'accueil */
get_header();
?>
<article class="container">
  <?php
    get_template_part("page-templates/home/espace_pub");
    get_template_part("page-templates/home/derniers_articles");
    get_template_part("page-templates/home/startup_du_jour");
    get_template_part("page-templates/home/brand_factory");
    get_template_part("page-templates/home/lifestyle");
    get_template_part("page-templates/home/au_menu_du_jour");
    get_template_part("page-templates/home/ventes_ddp");
  ?>
</article>
<aside class="">
  <?php dynamic_sidebar('page-sidebar'); ?>

</aside>
<?php
get_footer();
?>
