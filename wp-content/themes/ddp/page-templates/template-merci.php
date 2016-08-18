<?php
/* Template Name: Merci */
get_header(); ?>

<section class="container">
  <?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

    the_post_thumbnail();

	} // end while
} // end if
?>
</section>

<?php get_footer(); ?>
