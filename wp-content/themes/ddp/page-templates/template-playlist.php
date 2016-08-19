<?php /* Template Name: Playlist Dettachée */ get_header(); ?>

<section class="container playlist">
    <article class="large--8">
      <div class="large--12">
        <h2 class="playlist__h2">Notre chaine Youtube Dettachée ! </h2>
        <iframe width="640" height="360" src="https://www.youtube.com/embed/AgCW1idkoDg?list=UU-qB-nW67KCx9CVqHp-0J8A" frameborder="0" allowfullscreen></iframe>
      </div>
      <div class="large--12">
        <h2 class="playlist__h2 playlist__h2--2">Un peu de son Dettachée ? </h2>
          <iframe width="640" height="360" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/users/41830045&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
      </div>
    </article>
    <aside class="sidebar large--3">
      <?php dynamic_sidebar('home--3'); ?>
    </aside>
</section>
<?php get_footer(); ?>
