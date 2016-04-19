<?php  global $mb; ?>
<h1>Hello World</h1>
<div class="my_meta_control">
  <?php global $wpalchemy_media_access; ?>
</div>
<label>Logo</label>
<div class="img">
  <?php $mb->the_field('imgurl'); ?>
  <?php $wpalchemy_media_access->setGroupName('imgurl'. $mb->get_the_index())->setInsertButtonLabel('Insert'); ?>
  <?php echo $wpalchemy_media_access->getField(array('name'=>$mb->get_the_name(),'value'=>$mb->get_the_value())); ?>
  <?php echo $wpalchemy_media_access->getButton(); ?>
</div>
