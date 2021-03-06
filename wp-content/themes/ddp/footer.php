</main>
    <footer class="content">
      <section class="home__newsletter">
        <div class="container">
          <div class="home__newsletter--padding large--6">
            <p>Restez connecté &amp;</p>
            <p>Recevez des bons plans Dettachée</p>
          </div>

          <div class="newsletter newsletter--footer newsletter--homme">
            <div class="newsletter__button--container">
              <button class="newsletter__button newsletter__button--homme newsletter__button--actif" type="button" name="homme">H</button>
              <button class="newsletter__button newsletter__button--femme" type="button" name="femme">F</button>
            </div>
            <div class="newsletter__form newsletter__form--homme">
              <?php
                if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 5 ); }
              ?>
            </div>
            <div class="newsletter__form newsletter__form--femme">
              <?php
                if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 6 ); }
              ?>
            </div>
          </div>
        </div>
      </section>
      <section class="footer__infoencontinu">
        <div class="container">
          <h4 class="home__h4 home__h4--infoencontinu">L'info en continu</h4>
          <ul class="footer__infoencontinu--ul">
            <?php global $post;
              $args = array(
                'category' => 574,
                'post_per_page' => 20
              );
              $custom_posts = get_posts($args);
              foreach($custom_posts as $post) : setup_postdata($post);
            ?>
             <li class="footer__infoencontinu--li">
               <span class="footer__infoencontinu--date"><?php the_time('j F Y'); ?> - </span>
               <span class="footer__infoencontinu--titre"><?php the_title(); ?></span>
               <a href="<?php the_permalink(); ?> ">Lire...</a>
             </li>
           <?php
            endforeach;
           ?>
          </ul>
        </div>
      </section>

      <section class="footer__store">
        <div class="container">
          <h4 class="home__h4 home__h4--store-hr home__h4--store "><a href="#">L'insta<span> Dettachée</span></a></h4>
          <div id="sb_instagram" class="sbi sbi_col_5" style="width:100%; padding-bottom: 12px; " data-id="361637682" data-num="5" data-res="auto" data-cols="5" data-options='{&quot;sortby&quot;: &quot;none&quot;, &quot;headercolor&quot;: &quot;&quot;, &quot;imagepadding&quot;: &quot;6&quot;}'>
            <div id="sbi_images" style="padding: 6px;">
              <div class="sbi_loader fa-spin"></div>
            </div>
          </div>
        </div>
      </section>
      <section class="footer__end">
        <div class="container">
          <div class="footer__sociaux">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-snapchat-ghost" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
          </div>
          <div class="footer__liens">
            <a href="#">S'inscrire</a>
            <a href="#">Se desinscrire</a>
            <a href="#">Qui est Dettachée de Presse ?</a>
            <a href="#">Charte editoriale</a>
            <a href="#">Espace annonceurs</a>
            <br>
            <a href="#">Miss &amp; Mister Dettachée</a>
            <a href="#">Ils se marient</a>
            <a href="#">Vente Dettachée</a>
            <a href="#">Menu du jour</a>
          </div>
        </section>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
