<?php /* Template Name: Soumission de post */ get_header(); ?>

<article class="container submission">
  <h2 class="usp__h2">Soumettre un contenu Dettachée</h2>
  <?php
    if ( is_user_logged_in("true") ) {
      echo do_shortcode('[usp_form id="submit"]');
      echo do_shortcode('[usp_redirect url="http://localhost:8890/ddp/soumission-darticle/"]');
    } else {
      echo do_shortcode("[wpoa_login_form design='CustomDesign1' logged_out_title='Vous devez vous connetez pour pouvoir soumettre un article' logged_in_title='Bienvenue sur Dettachée!' logging_in_title='Bienvenue sur Dettachée!' logging_out_title='Merci de votre visite']");
      echo '<p class="usp__ou"> ou </p>';
      echo do_shortcode('[usp_login_form]');
      echo do_shortcode('[usp_redirect url="http://localhost:8890/ddp/merci/"]');
    }
  ?>
</article>

<?php get_footer(); ?>
