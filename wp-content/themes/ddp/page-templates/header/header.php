<?php
	$logo_url = get_option('logo_url');
	$logo_url_store = get_option('logo_url_store');
 ?>
 <section class="container header__container">

	<div class="newsletter newsletter--header newsletter--homme">
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

	<div class="post__submission">
		<a href="<?php echo site_url(); ?>/soumission-darticle/">Soumettre un article<span class="post__submission--plus">+</span></a>
	</div>

	<div class="logo__ddp">
		<a href="<?php echo site_url(); ?>">
			<img src="<?php echo $logo_url ?>" alt="" />
		</a>
	</div>

	<div class="logo__store">
		<a href="http://www.dettacheestore.fr/" target="_blank">
			<img src="<?php echo $logo_url_store ?>" alt="" />
		</a>
	</div>

</section>
