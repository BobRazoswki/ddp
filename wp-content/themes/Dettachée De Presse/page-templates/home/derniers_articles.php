<h3 class="home__h3 home__h3--bleu">Derniers Articles</h3>
<?php // Loop 1
$args1 = array(
  'posts_per_page' => 1,
  'category' => -568
);
$first_query = new WP_Query($args1);
while($first_query->have_posts()) : $first_query->the_post(); ?>
<article class="last__post last__post--12 large--12">
  <figure>
    <!-- <?php the_post_thumbnail(); ?> -->
    <img src="http://fakeimg.pl/960x320/" alt="" />
    <figcaption><?php  the_title();?></figcaption>
  </figure>
</article>
<?php
endwhile;
wp_reset_postdata();
$args2 = array(
  'posts_per_page' => 4,
  'category' => -568,
  'offset' => 3
);
// Loop 2
$second_query = new WP_Query($args2); // exclude category
while($second_query->have_posts()) : $second_query->the_post(); ?>
<article class="last__post last__post--6 large--6">
  <figure>
    <!-- <?php the_post_thumbnail(); ?> -->
    <img src="http://fakeimg.pl/960x320/" alt="" />
    <figcaption><?php  the_title();?></figcaption>
  </figure>
</article>
<?php
endwhile;
wp_reset_postdata();
?>
<div class="large--12 home__button--container">
  <a href="#" class="home__button--voir-plus">Voir plus</a>
</div>
