<?php
	$logo_url = get_option('logo_url');
	$logo_url_store = get_option('logo_url_store');
 ?>
 <article class="container header__container">

	<section class="newsletter">
		<span class="newsletter__button--container">
			<button class="newsletter__button--homme" type="button" name="button__homme">H</button>
			<button class="newsletter__button--femme" type="button" name="button__femme">F</button>
		</span>
		<span class="newsletter__homme">
			<?php
				if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 5 ); }
			?>
		</span>
		<span class="newsletter__femme">
			<?php
				if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 6 ); }
			?>
		</span>
	</section>
	
	<section class="post__submission">
		<a href="<?php echo site_url(); ?>/soumission-darticle/">Soumettre un article<span class="post__submission--plus">+</span></a>
	</section>

	<section class="logo__ddp">
		<a href="<?php echo site_url(); ?>">
			<img src="<?php echo $logo_url ?>" alt="" />
			<!-- echo site_url(); ?>/wp-content/uploads/2016/04/300x600.2.png  -->
		</a>
	</section>
	<section class="logo__store">
		<img src="<?php echo $logo_url_store ?>" alt="" />
	</section>

</article>
