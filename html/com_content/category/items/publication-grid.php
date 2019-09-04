<?php
$images = json_decode($this->item->images); $introImage = $images->image_intro;
$date = strtotime($this->item->publish_up);
$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id,
                  $this->item->catid, $this->item->language)) ?>
<div class="row mb-4">
  <?php if ($introImage) : ?>
    <a class="col-12 pb-3" href="<?= $link ?>">
      <img src="<?= $introImage ?>" alt="<?= $images->image_intro_alt ?>" style="width: 100%">
    </a>
  <?php endif; ?>
  <div class="col-12">
    <h2 class="font-weight-bold mb-0 h4"><a href="<?= $link ?>" itemprop="name"><?= $this->item->title ?></a></h2>
    <div itemprop="startDate" content="<?= (new DateTime($this->item->publish_down))->format('c') ?>">
      <?= $this->item->publish_up == '0000-00-00 00:00:00' ? '' : date('F Y', $date) ?>
    </div>
  </div>
</div>
