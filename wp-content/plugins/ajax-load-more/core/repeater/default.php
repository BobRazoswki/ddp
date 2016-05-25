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
     <footer class="load__more">
       fb comment
	 </footer>
   </section>
</article>