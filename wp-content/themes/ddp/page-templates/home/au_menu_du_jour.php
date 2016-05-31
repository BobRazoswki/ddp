<h3 class="home__h3 home__h3--vert-clair">Au menu du jour</h3>
<section class="home__aumenu">
  <div class="large--9">
    <?php global $post;
    $args = array(
      'category' => 572,
      'post_per_page' => 1
    );
    $custom_posts = get_posts($args);
    foreach($custom_posts as $post) : setup_postdata($post);
     ?>
     <div class="home__aumenu--1">
       <?php the_post_thumbnail(); ?>
       <span><?php the_title(); ?></span>
     </div>
     <?php
      endforeach;
     ?>
  </div>
  <div class="large--3">
    <?php
    global $post;
      $args = array(
        'category' => 573,
        'post_per_page' => 1
      );
    $custom_posts = get_posts($args);
    foreach($custom_posts as $post) : setup_postdata($post);
    ?>

     <div class="home__aumenu--2">
      <?php
        the_post_thumbnail();
      ?>
      <span><?php the_title(); ?></span>
      <?php
        the_excerpt();
      ?>
      <a class="home__button home__button--aumenu" href="<?php the_permalink(); ?>">Découvrir</a>
     </div>

    <?php
      endforeach;
    ?>
  </div>
</section>
