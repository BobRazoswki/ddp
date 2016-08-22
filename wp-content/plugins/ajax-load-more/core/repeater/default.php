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
           <?php if ($meta["post-source-ddp"] != null) { ?>
             <div class="single__footer--meta single__footer--source-container">
               <h4>Source :</h4>
               <p class="single__footer--source">
                 <?php echo $meta["post-source-ddp"] ?>
               </p>
             </div>
          <?php }
           if ($meta["post-tags-ddp"] != null) { ?>
             <div class="single__footer--meta">
               <h4>Tags :</h4>
               <ul class="single__footer--tags">
               <?php
                $single_tags = explode(',',$meta["post-tags-ddp"]);
                // var_dump($single_tags.length);
                for ($i=0; $i < sizeof($single_tags); $i++) {
               ?>
                  <li class="single__footer--tag"><?php echo $single_tags[$i]; ?></li>
              <?php } ?>
              </ul>
             </div>
           <?php } ?>
             <aside class="single__footer--meta single__author--container">
               <h4>L'auteur : <?php echo the_author_meta('first_name');?> <?php  echo the_author_meta('last_name'); ?></h4>
               <div class="single__author--img"><?php echo get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ); ?></div>
               <p class="single__author--description">
                 <?php echo the_author_meta('description'); ?>
               </p>
             </aside>
             <div class="fb-comments" data-href="https://www.facebook.com/DettacheePresse/" data-numposts="5"></div>
     	    </footer>
          <span class="load__more"></span>
        </section>
     </article>