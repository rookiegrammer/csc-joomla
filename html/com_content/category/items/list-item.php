<?php $date = strtotime($this->item->publish_down);
      $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id,
                  $this->item->catid, $this->item->language));
      $indefinite = $this->item->publish_down == '0000-00-00 00:00:00';
                  ?>
<div class="mb-4">
  <a href="<?= $link ?>" class="d-block">
    <div class="d-block mb-2" itemprop="startDate" content="<?= (new DateTime($this->item->publish_down))->format('c') ?>">
      <?= $indefinite ? '' : date('F j, Y', $date) ?>
    </div>
    <h2 class="font-weight-bold"><?= $this->item->title ?></h2>
  </a>
  <p class="event-description">
    <?= substr(strip_tags($this->item->introtext), 0, 100) ?>
  </p>
</div>
