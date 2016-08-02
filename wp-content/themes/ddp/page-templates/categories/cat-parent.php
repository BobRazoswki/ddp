<?php
  $thisCat = get_category(get_query_var('cat'));
  $thisCatID = $thisCat->term_id;
  $args = array(
    'orderby' => 'name',
    'order'   => 'ASC',
    'parent'   => $thisCatID,
    'hide_empty' => 0
  );
  $categories =  get_categories($args);
?>
<div id="filters" class="button-group">
  <button class="button is-checked" data-filter="*">Tous</button>
  <?php
  $catIDClicked = "";
    foreach( $categories as $category ) :	setup_postdata($category);
      $catIDClicked = $category->id;
      echo '<button class="button" data-filter=".' . $category->category_nicename . '">' . $category->name  . '</button>';
    endforeach;
  ?>
</div>

<div class="isotope">
  <?php
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
    <div class="category__thumbnail" style="background-image: url('<?php echo the_post_thumbnail_url(); ?>');">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </div>

  </div>
  <?php endforeach;
  wp_reset_postdata();?>

</div>
