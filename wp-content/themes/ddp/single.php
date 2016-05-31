<?php
get_header();
 ?>
<div class="container post-page">
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   <aside class="sidebar large--4">
     <?php dynamic_sidebar('page-sidebar'); ?>
   </aside>
   <div class="">
     <?php echo do_shortcode('[ajax_load_more previous_post="true" post_type="post" repeater="default" previous_post_id="'.get_the_ID().'" previous_post_taxonomy="category" ]');?>
   </div>
 <?php endwhile; else: ?>

 <p>Ya pas le post!</p>

 <?php endif;
 ?>

</div>
<?php

get_footer();
 ?>
