<!-- EVENEMENTS DDP -->
<?php get_header(); ?>
<article class="container">
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
    <button class="button" data-filter=".oui">À la une</button>
    <?php
      $months = array(
        "1"  => "Janvier",
        "2"  => "Février",
        "3"  => "Mars",
        "4"  => "Avril",
        "5"  => "Mai",
        "6"  => "Juin",
        "7"  => "Juillet",
        "8"  => "Août",
        "9"  => "Septembre",
        "10" => "Octobre",
        "11" => "Novembre",
        "12" => "Décembre",
      );
      foreach( $months as $key => $month) :	setup_postdata($category);
        echo '<button class="button" data-filter=".' . $key . '">' . $month  . '</button>';
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
      global $monthsmeta;
      $meta=$monthsmeta->the_meta(get_the_id());
     ?>
    <div class="element-item <?php echo $meta["s_months"] ?> <?php echo $meta["cb_alaune"] ?>" data-category="<?php $meta["s_months"] ?>" data-post="<?php $meta["cb_alaune"] ?>">
      <div class="category__thumbnail" style="background-image: url('<?php echo the_post_thumbnail_url(); ?>');">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </div>
    </div>
    <?php endforeach;
    wp_reset_postdata();?>
  </div>
</article>
<?php get_footer(); ?>
