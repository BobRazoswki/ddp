<div class="container">
      <div class="c_slider"></div>
      <div class="slider">
        <?php
          $args = array(
            'category' => 569
          );
          global $post;
          $custom_posts = get_posts($args);
          foreach($custom_posts as $post) : setup_postdata($post);
          ?><!--
          -->
          <a href="#">
            <figure>
            <?php
              // the_post_thumbnail();
            ?>
            <img src="http://fakeimg.pl/960x320/" alt="" />
             <figcaption>
               <?php the_title(); ?>
               <span class="slider__figcaption--excerpt"><?php the_excerpt(); ?></span>
             </figcaption>
           </figure>
          </a><!--
          -->
          <?php
          endforeach;
        ?>
      </div>
  </div>
<span id="timeline"></span>
