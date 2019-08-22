<?php $date = strtotime($this->item->publish_down);
      $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id,
                  $this->item->catid, $this->item->language)) ?>
<a href="<?= $link ?>">
  <img class="d-block h-100 m-auto" src="<?= $path ?>img/placeholder.jpg" alt="Image">
  <div class="carousel-text-block">
    <div class="carousel-text-wrap">
      <div class="carousel-text-overlay">
      </div>
      <div class="carousel-text-title pt-5 pb-3">
        <small class="d-block" itemprop="dateline"><?= $this->item->publish_down == '0000-00-00 00:00:00' ? '' : date('F j, Y', $date) ?></small>
        <h5 class="container mb-0 text-white">
          <?= $this->item->title ?>
        </h5>
        <p class="text-white">
          <?= $this->item->introtext ? strip_tags($this->item->introtext) : substr(strip_tags($this->item->fulltext), 0, 100) ?>
        </p>
      </div>
    </div>
  </div>
</a>
