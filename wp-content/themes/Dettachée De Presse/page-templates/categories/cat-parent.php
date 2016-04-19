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
  <button class="button is-checked" data-filter="*">show all</button>
  <?php
  $catIDClicked = "";
    foreach( $categories as $category ) :	setup_postdata($category);
    // var_dump($category);
      // $str = $category->name;
      // $str = strtolower($str);
      // $str = preg_replace('/[^a-zA-Z0-9\']/', '_', $str);
      // $str = str_replace("'", '', $str);
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
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  </div>
  <?php endforeach;
  wp_reset_postdata();?>

</div>
