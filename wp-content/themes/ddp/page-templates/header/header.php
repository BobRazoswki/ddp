<?php
global $customizer;
$meta=$customizer->the_meta(get_the_id());
?>
<article class="container">

	<section class="logo__ddp">
		<a href="<?php echo site_url(); ?>">
			<!-- <h1><?php// echo $meta["logoddp"] ?></h1> -->
			<!-- <img src="<?php //echo $meta["logoddp"] ?>" alt="" /> -->
			<!-- echo site_url(); ?>/wp-content/uploads/2016/04/300x600.2.png  -->
		</a>
	</section>
<h1><?php
$value = get_option('awesome_text');
echo $value
 ?></h1>
	<section class="logo__store">
		<img src="<?php echo site_url(); ?>/wp-content/uploads/2016/04/150x300.3.png" alt="" />
	</section>

	<section class="post__submission">
		<a href="<?php echo site_url(); ?>/soumission-darticle/">Soumettre un article</a>
	</section>

	<section class="newsletter">
		<button class="newsletter__button--homme" type="button" name="button__homme">H</button>
		<button class="newsletter__button--femme" type="button" name="button__femme">F</button>
		<span id="newsletter__homme">
			<?php
				if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 5 ); }
			?>
		</span>
		<span id="newsletter__femme">
			<?php
				if( function_exists( 'ninja_forms_display_form' ) ){ ninja_forms_display_form( 6 ); }
			?>
		</span>
	</section>
</article>
