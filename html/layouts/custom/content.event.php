<!-- EVENT -->
<?php
  extract($displayData);
  $images = json_decode($item->images);
  $location = $item->params->get('csc_location');
  $finish = $item->params->get('csc_date_finish');

  $time = strtotime($item->created);
  $current_year = date('Y', $time) != date('Y');
?>

<div itemscope itemtype="http://schema.org/Event">
<?php if ($images->image_intro) : ?>
  <a class="event-img-box mb-3" href="<?= $images->image_intro ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_intro_alt ?>" data-footer="<?= $images->image_intro_caption ?>" >
    <img src="<?= $images->image_intro ?>" alt="<?= $images->image_intro_alt ?>">
  </a>
<?php endif; ?>
<?php if ($images->image_fulltext) : ?>
  <a href="<?= $images->image_fulltext ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_fulltext_alt ?>" data-footer="<?= $images->image_fulltext_caption ?>" >
  </a>
<?php endif; ?>

<h1 class="title event-title sans-serif font-weight-bold" itemprop="name"><?= $item->title ?></h1>
<p class="date event-date h5">
  <span class="badge badge-primary sans-serif text-uppercase">
    Starts
  </span>
  <span class="align-middle" itemprop="startDate">
    <?= $item->created == '0000-00-00 00:00:00' ? 'Indefinite' : date('g:i a, F j'.($current_year ? ', Y' : ''), $time) ?>
  </span>
  <?php if ($finish != '0000-00-00 00:00:00' && $finish) :
    $finish_time = strtotime($finish);
    $format = 'g:i a';
    if (date('z', $finish_time) != date('z', $time)) {
      $format .= ', F j';
    }
    if (date('Y', $finish_time) != date('Y')) {
      $format .= ', Y';
    }
    ?>
    <span class="badge badge-secondary sans-serif text-uppercase">
      Until
    </span>
    <span class="align-middle" itemprop="endDate">
      <?= date($format, $finish_time) ?>
    </span>
  <?php endif; ?>
  <?php if ($location) : ?>
    <span class="badge badge-primary sans-serif text-uppercase">
      At
    </span>
    <span class="align-middle" itemprop="location">
      <?= $location ?>
    </span>
  <?php endif; ?>
</p>
<p>

</p>
<hr>
<div class="content event-content pr-5">
  <?= $item->text ?>
</div>
</div>
