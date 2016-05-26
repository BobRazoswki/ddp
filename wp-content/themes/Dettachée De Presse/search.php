<?php get_header(); ?>
<section class="container searchpage__container">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article class="searchpage__results large--12">
			<figure><?php the_post_thumbnail(); ?></figure>
			<header>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</header>
			<p>
				<?php the_excerpt(); ?>
			</p>
			<footer>
				Écrit par: <strong><?php the_author(); ?></strong> le:
				<span>
					<strong>
						<?php the_time('j F Y'); ?>
					</strong>
				</span>
			</footer>
		</article>

	<?php endwhile; else: ?>
		<h2>Votre recherche semble être un peu trop Dettachée :)... On a rien trouvé pour vous </h2>
	<?php endif; ?>
</section>

<?php get_footer(); ?>
