<!-- LECTURE DDP -->
<?php get_header(); ?>
<article class="container lecture">
  <section class="cat__child large--7">
    <h2 class="cat__child--title">La librairie Dettachée</h2>
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
      <?php the_post_thumbnail('cat__thumbnail') ?>
      <aside class="cat__child--aside">
        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <p class="cat__child--p">
          <?php echo get_the_excerpt(); ?>
        </p>
        <a class="cta__lireplus" href="<?php the_permalink(); ?>" target="_blank"> Lire la suite ...</a>
      </aside>
    </article>
    <?php endforeach;
    wp_reset_postdata();?>
  </section>
  <aside class="sidebar lecture__sidebar large--4">
    <?php dynamic_sidebar('sidebar__lecture'); ?>
  </aside>
</article>
<?php get_footer(); ?>
