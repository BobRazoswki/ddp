<h3 class="home__h3 home__h3--orange">Brand Factory</h3>
<?php global $post;
$args = array(
  'category' => 571,
  'post_per_page' => 1
);
$custom_posts = get_posts($args);
foreach($custom_posts as $post) : setup_postdata($post);
 ?>
 <div class="home__brandfactory--img large--3 medium--6 small--5 extrasmall--11">
   <?php the_post_thumbnail(); ?>
 </div>
 <div class="large--1">

 </div>
 <div class="home__textes large--8 medium--6 small--5 extrasmall--11">
   <h4 class="home__h4 home__h4--brandfactory"><?php the_title(); ?></h4>
   <p><?php the_excerpt(); ?></p>
   <a href="<?php the_permalink(); ?>" class="home__button home__button--aumenu">Découvrez</a>
 </div>
 <?php
endforeach;
?>
