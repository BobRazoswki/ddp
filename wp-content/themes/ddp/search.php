<?php get_header(); ?>
<section class="container searchpage__container">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article class="searchpage__results large--12">
			<header>
				<?php $title = get_the_title(); $keys= explode(" ",$s); $title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); ?>
				<a href="<?php the_permalink(); ?>"><?php echo $title; ?></a>
			</header>
			<div class="searchpage__text">
				<figure class="large--3"><?php the_post_thumbnail(); ?></figure>
				<p class="searchpage__text--p large--9">
					<?php echo get_the_excerpt(); ?>
				</p>
				<a href="<?php echo get_the_permalink(); ?>" target="_blank" class="searchpage__text--a cta__lireplus">Voir l'article !</a>
			</div>
			<footer>
				Écrit par: <strong class="searchpage__footer--strong"><?php the_author(); ?></strong> le:
				<span>
					<strong class="searchpage__footer--strong">
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
