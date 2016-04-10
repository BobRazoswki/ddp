<h1>Dettachée de Presse is powerful</h1>

<form method="POST">
    <label for="awesome_text">Awesome Text</label>
    <input type="text" name="awesome_text" id="awesome_text" value="<?php echo $value; ?>">


<input type="submit" value="Save" class="button button-primary button-large">
</form>
<?php global $customizer; ?>
<h1>Hello World DDP</h1>
<div class="my_meta_control">
  <?php global $wpalchemy_media_access; ?>
</div>

<label>Titre</label>
<?php $customizer->the_field('logoddp'); ?>
<input type="text" name="<?php $customizer->the_name(); ?>" value="<?php $customizer->the_value(); ?>"/>


<label>Logo</label>
<div class="img">
  <?php $customizer->the_field('imgurl'); ?>
  <?php $wpalchemy_media_access->setGroupName('imgurl'. $customizer->get_the_index())->setInsertButtonLabel('Insert'); ?>
  <?php echo $wpalchemy_media_access->getField(array('name'=>$customizer->get_the_name(),'value'=>$customizer->get_the_value())); ?>
  <?php echo $wpalchemy_media_access->getButton(); ?>
</div>
