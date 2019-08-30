<?php $date = strtotime($this->item->publish_down);
      $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id,
                  $this->item->catid, $this->item->language)) ?>
<div class="row mb-4">
  <a class="col-md-auto" href="<?= $link ?>">
    <div class="image-circle">
      <img src="img/image1.jpg" alt="">
    </div>
  </a>
  <div class="col">
    <div itemprop="startDate" content="<?= (new DateTime($this->item->publish_down))->format('c') ?>">
      <?= $this->item->publish_down == '0000-00-00 00:00:00' ? 'Indefinite' : date('F j, Y', $date) ?>
    </div>
    <h2 class="font-weight-bold"><a href="<?= $link ?>" itemprop="name"><?= $this->item->title ?></a></h2>
  </div>
</div>
