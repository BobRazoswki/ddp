<?php get_header(); ?>
<article class="container">
  <?php
    $catInfos = get_category(get_query_var('cat'));
    if ($catInfos->parent == 0) {
       ?>
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
         <?php
         $catIDClicked = "";
           foreach( $categories as $category ) :	setup_postdata($category);
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
           <div class="category__thumbnail" style="background-image: url('<?php echo the_post_thumbnail_url(); ?>');">
             <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
           </div>

         </div>
         <?php endforeach;
         wp_reset_postdata();?>

       </div>
    <?php
    }
    else {
      ?>
      <section class="cat__child large--7">
        <h2 class="cat__child--title">Nos derniers articles Dettachée</h2>
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
      <aside class="sidebar cat__sidebar large--4">
        <?php dynamic_sidebar('home--1'); ?>
        <?php dynamic_sidebar('home--2'); ?>
        <?php dynamic_sidebar('home--3'); ?>
      </aside>
  <?php
    }
  ?>
</article>
<?php get_footer(); ?>
