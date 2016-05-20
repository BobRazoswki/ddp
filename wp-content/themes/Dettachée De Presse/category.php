<?php get_header(); ?>
<article class="container">
  <?php
    $catInfos = get_category(get_query_var('cat'));
    if ($catInfos->parent == 0) {
      get_template_part('page-templates/categories/cat-parent');
    }
    else {
      get_template_part('page-templates/categories/cat-child');
    }
  ?>
</article>
<?php get_footer(); ?>
