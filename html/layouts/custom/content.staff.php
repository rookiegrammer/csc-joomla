<!-- STAFF -->
<?php
  extract($displayData);
  $images = json_decode($item->images);;

  $title = $item->params->get('csc_title_name');
  $f_name = $item->params->get('csc_first_name');
  $s_name = $item->params->get('csc_second_name');
  $l_name = $item->title;
  $name_suff = $item->params->get('csc_name_suffix');

  $name = $title.' '.$f_name.' '.$s_name.' '.$l_name.($name_suff ? ', '.$name_suff : '');
  $thumb = $item->params->get('csc_profile');
?>
  <div class="text-center">
    <a class="d-inline-block" style="overflow: hidden; width: 100px; height: 100px; border-radius: 50px;" href="<?= $thumb ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $name ?>">
      <img class="w-100" src="<?= $thumb ?>" alt="profile image">
    </a>
    <h1 class="title sans-serif font-weight-bold mt-4">
      <?= $name ?>
    </h1>
    <span class="staff-position h5 font-italic">
      <?= $item->params->get('csc_position') ?>
    </span>
  </div>

  <hr>
  <div class="content page-content">
    <?= $item->text ?>
  </div>

  <?php if ($images->image_fulltext) : ?>
    <a href="<?= $images->image_fulltext ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_fulltext_alt ?>" data-footer="<?= $images->image_fulltext_caption ?>" >
    </a>
  <?php endif; ?>
  <?php if ($images->image_intro) : ?>
    <a href="<?= $images->image_intro ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_intro_alt ?>" data-footer="<?= $images->image_intro_caption ?>" >
    </a>
  <?php endif; ?>
