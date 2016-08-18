<?php
get_header();
 ?>
<div class="container post-page">
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
   <aside class="sidebar large--4">
     <?php dynamic_sidebar('home--1'); ?>
     <?php dynamic_sidebar('home--2'); ?>
     <?php dynamic_sidebar('home--3'); ?>
   </aside>
   <div class="">
     <?php //echo do_shortcode('[ajax_load_more previous_post="true" post_type="post" repeater="default" previous_post_id="'.get_the_ID().'" previous_post_taxonomy="category" ]');?>
     <article class="post" role="main">
       <section class="medium--12 small--12 extrasmall--12">
         <header class="post__header">
           <h4 class="post__h4"><?php the_title(); ?></h4>
           <span class="post__date home__h4--store-hr home__h4--store ">
             <?php the_time('j F Y'); ?>
           </span>
         </header>
         <figure class="post__thumbnails">
          <?php the_post_thumbnail(array('alt' => get_the_title())); ?>
         </figure>
          <?php the_content(); ?>
          <footer class="single__footer">
            <?php
             global $postfooter;
             $meta=$postfooter->the_meta(get_the_id());
           ?>
           <div class="single__footer--meta">
             <h4>Source :</h4>
             <p class="single__footer--source">
               <?php echo $meta["post-source-ddp"] ?>
             </p>
           </div>
           <div class="single__footer--meta">
             <h4>Tags :</h4>
             <ul class="single__footer--tags">
             <?php
              $single_tags = explode(',',$meta["post-tags-ddp"]);
              // var_dump($single_tags.length);
              for ($i=0; $i < sizeof($single_tags); $i++) {
             ?>
                <li class="single__footer--tag"><?php echo $single_tags[$i]; ?></li>
            <?php
              }
            ?>
            </ul>
           </div>
           <aside class="single__footer--meta single__author--container">
             <h4>L'auteur :</h4>
             <div class="single__author--img"><?php echo get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ); ?></div>
             <p class="single__author--description">
               <?php echo the_author_meta('description'); ?>
             </p>
             <div class="single__author--socials">
               <ul>
                 <li class="single__author--twitter" ><a href="<?php echo the_author_meta('twitter'); ?>"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/08/twitter_ddp.png" alt="" /> </a> </li>
                 <li class="single__author--fb" ><a href="<?php echo the_author_meta('facebook'); ?>"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/08/facebook_ddp.png" alt="" /> </a> </li>
                 <li class="single__author--google" ><a href="<?php echo the_author_meta('googleplus'); ?>"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/08/instagram_ddp.png" alt="" /> </a> </li>
                 <li class="single__author--google" ><a href="<?php echo the_author_meta('googleplus'); ?>"><img src="<?php echo site_url(); ?>/wp-content/uploads/2016/08/snapchat_ddp.png" alt="" /> </a> </li>
               </ul>
             </div>
           </aside>
     	    </footer>
          <span class="load__more"></span>
        </section>
     </article>
   </div>
 <?php endwhile; else: ?>

 <p>Ya pas le post!</p>

 <?php endif;
 ?>

</div>
<?php

get_footer();
 ?>
