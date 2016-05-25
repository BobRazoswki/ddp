<article class="container header__navigation">
	<?php
		wp_nav_menu( array(
			'container' =>false,
			'menu_class' => 'nav',
			'echo' => true,
			'before' => '',
			'after' => '',
			'link_before' => '',
			'link_after' => '',
			'depth' => 0,
			'walker' => new description_walker())
		);
	?>
	<div class="search__form--container">
		<form role="search" method="get" id="searchform" class="search__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		  <div>
		 	 <label class="search__form--label" for="s"><?php _x( 'Recherche pour:', 'label' ); ?>Rechercher: </label>
		 	 <input class="search__form--input" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Tapez votre recherche" />
		 	 <input type="submit" class="search__form--submit" id="searchsubmit" value="<?php echo esc_attr_x( 'Recherche', 'submit button' ); ?>" />
			</div>
 		</form>
		<span class="search__form--showingResults">
			 Résultat de recherche pour: <strong><?php echo get_search_query(); ?></strong>
	 </span>
	</div>
</article>
