<?php
/* Template Name: Page d'accueil */
get_header();
?>
<div class="container">
  <section id=""class="">
    <?php echo do_shortcode('[wonderplugin_carousel id="1"]'); ?>
    <?php
      // $args = array(
      //   'category' => 569
      // );
      // global $post;
      // $custom_posts = get_posts($args);
      // foreach($custom_posts as $post) : setup_postdata($post);
      ?>
      <?php
      //endforeach;
    ?>
  </section>
  <section class="content large--8 medium--12 small--12 extrasmall--12">
    <div class="home__strate">
      <h3 class="home__h3 home__h3--bleu">Derniers Articles</h3>
      <?php
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
      <article class="last__post last__post--petit last__post--6 large--6 medium--6 small--12 extrasmall--12">
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
    </div>

    <div class="home__strate home__strate--startup">
      <div class="bg__startup"></div>
      <h3 class="home__h3">Start Up du jour</h3>

      <?php global $post;
      $args = array(
        'category' => 535,
        'post_per_page' => 1
      );
      $custom_posts = get_posts($args);
      foreach($custom_posts as $post) : setup_postdata($post);
       ?>
       <div class="home__startup--img large--3">
         <?php the_post_thumbnail(); ?>
       </div>
       <div class="home__textes large--8">
         <h4 class="home__h4"><?php the_title(); ?></h4>
         <p><?php the_excerpt(); ?></p>
         <a href="#" class="home__startup--hastag">#JeSuisTropCool</a>
         <a href="<?php the_permalink(); ?>" class="home__button home__button--gris">Qui est-ce?</a>
       </div>
       <?php
      endforeach;
      ?>

    </div>

    <div class="home__strate">
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
       <div class="home__textes large--8 medium--6 small--5 extrasmall--11">
         <h4 class="home__h4 home__h4--brandfactory"><?php the_title(); ?></h4>
         <p><?php the_excerpt(); ?></p>
         <a href="<?php the_permalink(); ?>" class="home__button home__button--brandfactory">Découvrez</a>
       </div>
       <?php
      endforeach;
      ?>

    </div>

    <div class="home__strate">
      <div class=" home__strate--video">


      <h3 class="home__h3 home__h3--rose">Récentes videos</h3>
      <div class="home__video large--12">
      <?php global $post;
      $args = array(
        'category' => 570,
        'post_per_page' => 3
      );
      $custom_posts = get_posts($args);
      foreach($custom_posts as $post) : setup_postdata($post);
        ?>
        <div class="youtube" id="<?php the_title(); ?>" style="width: 500px; height: 281px;"></div>
        <!-- <span class="home__videoIdPlayer videoID-<?= the_ID(); ?>" data-videoid="<?= the_ID(); ?>"><?php  the_content(); ?></span> -->
       <?php
      endforeach;
      ?>
      <!-- <ul class="home__video--lienscontainer">
      <?php
      //global $post;
      //$args = array(
      //  'category' => 570,
      //  'post_per_page' => 3
      //);
      //$custom_posts = get_posts($args);
      //foreach($custom_posts as $post) : setup_postdata($post);
        ?>
        <li class="home__video--liens videoIDLi-<?= the_ID(); ?>" data-videoid="<?= the_ID(); ?>"><?php the_title(); ?></li>
        <?php //endforeach; ?>
        </ul> -->
</div>
    </div>

    <div class="home__strate">
      <h3 class="home__h3 home__h3--jaune">Life <span class="home__h3--lifestyle">style</span></h3>
      <section class="home__lifestyle--container">
        <div class="home__lifestyle--div home__lifestyle--evasion large--6">
          <span class="home__button home__button--whiterose">Evasion</span>
        </div>
        <div class="home__lifestyle--div home__lifestyle--miss large--3">
          <span class="home__button home__button--miss">Miss Dettachée</span>
        </div>
        <div class="home__lifestyle--div home__lifestyle--mr large--3">
          <span class="home__button home__button--mr">Mr Dettachée</span>
        </div>
        <div class="home__lifestyle--mariage large---12">
          <p class="home__lifestyle--mariage-p">
            Ils se marient !
          </p>
          <span class="home__lifestyle--decouvrir">Découvrir</span>
        </div>
        <div class="home__lifestyle--venteddp large--12">
          <span class="home__button home__button--whiterose">Découvrir</span>
        </div>
      </section>
    </div>

    <div class="home__strate">
      <h3 class="home__h3 home__h3--vert-clair">Au menu du jour</h3>
      <section class="home__aumenu">
        <div class="large--9">
          <?php global $post;
          $args = array(
            'category' => 572,
            'post_per_page' => 1
          );
          $custom_posts = get_posts($args);
          foreach($custom_posts as $post) : setup_postdata($post);
           ?>
           <div class="home__aumenu--1">
             <?php the_post_thumbnail(); ?>
             <span><?php the_title(); ?></span>
           </div>
           <?php
            endforeach;
           ?>
        </div>
        <div class="large--3">
          <?php
          global $post;
            $args = array(
              'category' => 573,
              'post_per_page' => 1
            );
          $custom_posts = get_posts($args);
          foreach($custom_posts as $post) : setup_postdata($post);
          ?>

           <div class="home__aumenu--2">
            <?php
              the_post_thumbnail();
            ?>
            <span><?php the_title(); ?></span>
            <?php
              the_excerpt();
            ?>
            <a class="home__button home__button--aumenu" href="<?php the_permalink(); ?>">Découvrir</a>
           </div>

          <?php
            endforeach;
          ?>
        </div>
      </section>
    </div>
  </section>
  <aside class="sidebar large--3">
    <?php dynamic_sidebar('page-sidebar'); ?>
  </aside>
</div>
<?php
get_footer();
?>
