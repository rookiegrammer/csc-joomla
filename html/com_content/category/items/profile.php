<?php $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id,
                  $this->item->catid, $this->item->language));

      $attribs = json_decode($this->item->attribs);

      $title = $attribs->csc_title_name;
      $f_name = $attribs->csc_first_name;
      $s_name = $attribs->csc_second_name;
      $l_name = $this->item->title;
      $name_suff = $attribs->csc_name_suffix;

      $name = $title.' '.$f_name.' '.$s_name.' '.$l_name.($name_suff ? ', '.$name_suff : '');
      $thumb = $attribs->csc_profile;
                  ?>
<div class="row mb-4 align-items-center">
  <a class="col-12 col-md-auto" href="<?= $link ?>">
    <div class="image-circle<?= $thumb ? '' : ' invisible' ?>">
      <img <?= $thumb ? 'src="'.$thumb.'"' : ''  ?> alt="profile image">
    </div>
  </a>
  <div class="col-12 col-md-8">
    <a href="<?= $link ?>" itemprop="name">
      <h2 class="staff-name serif font-weight-bold mb-0"><?= $name ?></h2>
    </a>
      <div class="staff-position sans-serif d-block">
        <?= $attribs->csc_position; ?>
      </div>

  </div>
</div>
