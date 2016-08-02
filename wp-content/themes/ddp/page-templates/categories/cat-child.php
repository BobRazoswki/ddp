<section class="cat__child">
  <?php
  $thisCat = get_category(get_query_var('cat'));
  $thisCatID = $thisCat->term_id;
  $post_args = array(
    'posts_per_page' => 20,
    'offset'=> 0,
    'category' => $thisCatID
  );
  $myposts = get_posts( $post_args );
  foreach ( $myposts as $post ) : setup_postdata( $post );
  $cat_of_the_post = get_the_category();
   ?>
   <article class="cat__child--article">
    <?php the_post_thumbnail() ?>
    <aside class="cat__child--aside">
      <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
      <p class="cat__child--p">
        the_excerpt();
      </p>
    </aside>
  </article>
  <?php endforeach;
  wp_reset_postdata();?>

</section>
