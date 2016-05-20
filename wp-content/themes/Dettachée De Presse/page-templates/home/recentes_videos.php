<h3 class="home__h3 home__h3--rose">Récentes videos</h3>
<div class="home__video large--12">

<?php global $post;
$args = array(
  'category' => 570,
  'post_per_page' => 4
);
$custom_posts = get_posts($args);
foreach($custom_posts as $post) : setup_postdata($post);
  ?>
  <span class="home__videoIdPlayer videoID-<?php echo the_ID(); ?>" data-videoid="<?php echo the_ID(); ?>"><?php  the_content(); ?></span>
 <?php
endforeach;
?>
<ul class="home__video--lienscontainer">
<?php global $post;
$args = array(
  'category' => 570,
  'post_per_page' => 4
);
$custom_posts = get_posts($args);
foreach($custom_posts as $post) : setup_postdata($post);
  ?>
  <li class="home__video--liens videoIDLi-<?php echo the_ID(); ?>" data-videoid="<?php echo the_ID(); ?>"><?php the_title(); ?></li>
 <?php
endforeach;
?>
  </ul>
