<?php get_header(); ?>


<div id="template-actus" class="container">
<h2 class="brazzaville__h2 brazzaville__h2--actualites">
</h2>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="template__actus--actus toggleexcerpt">
			<div class="template__actus toggleexcerpt col-lg-12 col-md-12 col-xs-12">

					<span class="template__actus--date col-md-12 col-xs-6">
						<?php echo get_the_date(); ?>
						<?php echo the_post_thumbnail(); ?>
						<span class="sep-titles actus__sep-hor-right"></span>
					</span>

				<div class="template__actus--txt col-lg-10 col-md-8 col-xs-6">
					<h3 class="template__actus--h3"><?php the_title(); ?></h3>
					<div class="excerpt"><?php the_excerpt(); ?><a href="" class="read">itg</a></div>
     				<div class="content"><?php the_content(); ?><a href="" class="read-less">gtgtg</a></div>
     				<a href="<?php the_permalink(); ?>">pokpo</a>
				</div>

			</div>
		</div>
		<span class="revuedepresse__sep-hor-full"></span>
<?php endwhile; else: ?>
<div class="entry"><h2>okgopr</h2></div>
<?php endif; ?>
</div>


<?php get_footer(); ?>
