<section class="home__newsletter content large--12">
  <div class="fullWidth__bg fullWidth__bg--rose"></div>
  <div class="home__newsletter--padding large--6">
    <p>Restez connecté &amp;</p>
    <p>Recevez des bons plans Dettachée</p>
  </div>

  <section class="large--6 newsletter home__newsletter--padding">
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

</section>
