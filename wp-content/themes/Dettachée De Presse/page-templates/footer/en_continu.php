<div class="home__infoencontinu content large--12">
  <h4 class="home__h4 home__h4--infoencontinu">L'info en continu</h4>
  <ul class="home__infoencontinu--ul">
    <?php global $post;
      $args = array(
        'category' => 574,
        'post_per_page' => 20
      );
      $custom_posts = get_posts($args);
      foreach($custom_posts as $post) : setup_postdata($post);
    ?>
     <li class="home__infoencontinu--li">
       <?php the_time('j F Y'); ?>
       <?php the_title(); ?>
       <a href="<?php the_permalink(); ?> ">Lire...</a>
     </li>
   <?php
    endforeach;
   ?>
  </ul>
</div>
