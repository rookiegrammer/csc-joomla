<!-- PUBLICATION -->
<?php
  extract($displayData);
  $images = json_decode($item->images);
  $meta = json_decode($item->metadata);
?>

<div class="row">
  <?php if ($images->image_intro) : ?>
    <div class="col-3">
      <a class="event-img-box mb-3" href="<?= $images->image_intro ?>" data-title="<?= $images->image_intro_alt ?>" data-footer="<?= $images->image_intro_caption ?>" data-toggle="lightbox" data-gallery="gallery">
        <img src="<?= $images->image_intro ?>" alt="<?= $images->image_intro_alt ?>">
      </a>
    </div>
    <?php if ($images->image_fulltext) : ?>
      <a href="<?= $images->image_fulltext ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_fulltext_alt ?>" data-footer="<?= $images->image_fulltext_caption ?>" >
      </a>
    <?php endif; ?>
  <?php endif; ?>
  <div class="col">
    <h1 class="title mb-0"><?= $item->title ?></h1>
    <?php if ($meta->author) : ?>
    <div class="credits font-weight-bold mb-3" style="opacity:0.7">
      By <?= $meta->author ?>
    </div>
    <?php endif; ?>
    <?php if ($item->metadesc) : ?>
    <small class="description font-italic">
      <?= $item->metadesc ?>
    </small>
    <?php endif; ?>
  </div>
</div>
<hr>
<div class="content">
  <?= $item->text ?>
</div>
