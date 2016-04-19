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
</article>
