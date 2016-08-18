<div class="my_meta_control">
	<p>
		<label>Jour</label>
		<input type="text" name="<?php $mb->the_name('jour-evenement'); ?>" value="<?php $mb->the_value('jour-evenement'); ?>" placeholder="Jour: 1, 10, 23, etc"/>

		<label>Mois</label>
    <?php $mb->the_field('s_months'); ?>
    <select class="" name="<?php $mb->the_name(); ?>">
      <?php $selected = ' selected="selected"'; ?>
      <option value="0">Mois</option>
      <option value="1"<?php if ($mb->get_the_value() == '1') echo $selected; ?>>Janvier</option>
      <option value="2"<?php if ($mb->get_the_value() == '2') echo $selected; ?>>Fevrier</option>
      <option value="3"<?php if ($mb->get_the_value() == '3') echo $selected; ?>>Mars</option>
      <option value="4"<?php if ($mb->get_the_value() == '4') echo $selected; ?>>Avril</option>
    </select>

		<label>Année</label>
		<input type="text" name="<?php $mb->the_name('annee-evenement'); ?>" value="<?php $mb->the_value('annee-evenement'); ?>" placeholder="Année: 2017, 2018, etc"/>

		<label>Événement à la une?</label>
		<?php $mb->the_field('cb_alaune'); ?>
		<input type="checkbox" name="<?php $mb->the_name(); ?>" value="oui"<?php $mb->the_checkbox_state('oui'); ?>/> À la une<br/>
  </p>
</div>
