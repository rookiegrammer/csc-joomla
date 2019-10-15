<?php
$images = json_decode($this->item->images); $introImage = $images->image_intro;
$date = strtotime($this->item->publish_up);
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id,
                  $this->item->catid, $this->item->language));
$attribs = json_decode($this->item->attribs);
                  ?>
<div class="row mb-4">
  <?php if ($introImage) : ?>
    <div class="col-12 pb-3">
      <a class="event-img-box" href="<?= $link ?>">
        <img src="<?= $introImage ?>" alt="<?= $images->image_intro_alt ?>" style="width: 100%">
      </a>
    </div>
  <?php endif; ?>
  <div class="col-12">
    <h2 class="font-weight-bold mb-0 h4"><a href="<?= $link ?>" itemprop="name"><?= $this->item->title ?></a></h2>
    <div itemprop="startDate" content="<?= (new DateTime($this->item->publish_down))->format('c') ?>">
      <?= $this->item->publish_up == '0000-00-00 00:00:00' ? '' : date('F d, Y', $date) ?>
    </div>
    <?php if (isset($attribs->csc_publication_price)) : ?>
    <div>
      <strong><?= $attribs->csc_publication_price ?></strong>
    </div>
    <?php endif; ?>
  </div>
</div>
