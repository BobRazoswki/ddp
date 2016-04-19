<article class="container">
  <?php

  if ( is_user_logged_in("true") ) {
    echo do_shortcode('[usp_form id="submit"]');
  } else {
    echo do_shortcode("[wpoa_login_form design='CustomDesign1']");
    echo do_shortcode('[usp_login_form]');
  }

  ?>
</article>
