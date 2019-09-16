<!-- EVENT -->
<?php
  extract($displayData);
  $images = json_decode($item->images);;
?>

<?php if ($images->image_fulltext) : ?>
  <a class="event-img-box mb-3" href="<?= $images->image_fulltext ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_fulltext_alt ?>" data-footer="<?= $images->image_fulltext_caption ?>" >
    <img src="<?= $images->image_fulltext ?>" alt="<?= $images->image_fulltext_alt ?>">
  </a>
<?php endif; ?>
<?php if ($images->image_intro) : ?>
  <a href="<?= $images->image_intro ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_intro_alt ?>" data-footer="<?= $images->image_intro_caption ?>" >
  </a>
<?php endif; ?>

<h1 class="title event-title sans-serif font-weight-bold"><?= $item->title ?></h1>
<p class="date event-date h5 font-italic">
  <?= $item->publish_down == '0000-00-00 00:00:00' ? 'Indefinite' : JHtml::_('date', $item->publish_down, 'F j, Y') ?>
</p>
<hr>
<div class="content event-content pr-5">
  <?= $item->text ?>
</div>
