<div class="isotope">
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
  <div class="element-item <?php echo $cat_of_the_post[0]->category_nicename ?>" data-category="<?php echo $cat_of_the_post[0]->category_nicename ?>">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  </div>
  <?php endforeach;
  wp_reset_postdata();?>

</div>
