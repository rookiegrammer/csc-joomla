<!-- PAGE -->
<?php
  extract($displayData);
  $icon = $item->params->get('csc_fa_icon_class','');
?>
  <h1 class="title page-title sans-serif font-weight-bold">
    <?php if ($icon) : ?>
      <i class="fa fa-<?= $icon ?>" style="font-size: 2rem"></i>
    <?php endif; ?>
    <?= $item->title ?></h1>
  <hr>
  <div class="content page-content">
    <?= $item->text ?>
  </div>
