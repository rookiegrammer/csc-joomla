<!-- NEWS -->

<?php
  extract($displayData);

  defined('CSC_DATE_DEF') OR define('CSC_DATE_DEF', array('y' => 'year', 'm' => 'month', 'd' => 'day', 'h' => 'hour', 'i' => 'minute'));

  function csc_time_past($time) {
    $diff = date_diff( new DateTime($time), new DateTime('now'), true);
    $time_past = 'a few seconds';
    foreach (array_keys(CSC_DATE_DEF) as $unit) {
      if ($diff->$unit != 0) {
        if ($diff->$unit == 1)
          $time_past = 'a '.CSC_DATE_DEF[$unit];
        else
          $time_past = ''.$diff->$unit.' '.CSC_DATE_DEF[$unit].'s';
        break;
      }
    }
    return $time_past;
  }
  $images = json_decode($item->images);
?>
  <h1 class="title news-title sans-serif font-weight-bold"><?= $item->title ?></h1>
  <p class="date news-date font-italic">
    <span class="h5 font-weight-bold"><?= csc_time_past($item->publish_up) ?> ago</span> - <?= JHtml::_('date', $item->publish_up, 'g:i a, F j, Y') ?>
  </p>
  <?php if ($images->image_fulltext) : ?>
    <div class="mb-3">
      <a class="event-img-box mb-3" href="<?= $images->image_fulltext ?>" data-title="<?= $images->image_fulltext_alt ?>" data-footer="<?= $images->image_fulltext_caption ?>" data-toggle="lightbox" data-gallery="gallery">
        <img src="<?= $images->image_fulltext ?>" alt="<?= $images->image_fulltext_alt ?>">
      </a>

      <small>PHOTO: <span class="font-italic font-weight-bold"><?= $images->image_fulltext_caption ?></span></small>
    </div>
  <?php endif; ?>
  <hr>
  <?php if ($images->image_intro) : ?>
    <a href="<?= $images->image_intro ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_intro_alt ?>" data-footer="<?= $images->image_intro_caption ?>" >
    </a>
  <?php endif; ?>
  <div class="content news-content">
    <?= $item->text ?>
  </div>
