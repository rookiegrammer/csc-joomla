<?php
$images = json_decode($this->item->images); $introImage = $images->image_intro;
$date = strtotime($this->item->publish_up);
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id,
                  $this->item->catid, $this->item->language));

$attribs = json_decode($this->item->attribs);
                  ?>
<div class="row mb-4">
  <div class="col-12 col-md-8">
    <div itemprop="startDate" content="<?= (new DateTime($this->item->publish_down))->format('c') ?>">
      <?= $this->item->publish_up == '0000-00-00 00:00:00' ? '' : date('F d, Y', $date) ?>
    </div>
    <h2 class="font-weight-bold"><a href="<?= $link ?>" itemprop="name"><?= $this->item->title ?></a></h2>
    <div>
      <?php if ($attribs->csc_publication_price) : ?>
        <strong><?= $attribs->csc_publication_price ?></strong> | 
      <?php endif; ?>
      <?php if ($attribs->csc_publication_isbn) : ?>
        <span>ISBN/ISSN <?= $attribs->csc_publication_isbn ?></span>
      <?php endif; ?>
    </div>
    <p><?= $this->item->introtext ?></p>
  </div>
  <?php if ($introImage) : ?>
    <div class="col-12 col-md-4 px-3">
      <a class="event-img-box px-0" style="max-height: none" href="<?= $link ?>">
        <img src="<?= $introImage ?>" alt="<?= $images->image_intro_alt ?>" style="width: 100%">
      </a>
    </div>
  <?php endif; ?>
</div>
<hr>
