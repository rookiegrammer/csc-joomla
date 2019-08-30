<?php $date = strtotime($this->item->publish_down);
      $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id,
                  $this->item->catid, $this->item->language)) ?>
<div class="row mb-4">
  <a class="col-12 col-md-auto" href="<?= $link ?>">
    <div class="csc-date-event d-none d-md-block">
      <div class="csc-date-circle csc-date-circle-big position-relative">
        <div class="csc-date-text text-white text-center">
          <div class="csc-date-day"><?= date('d', $date) ?></div>
          <div class="csc-date-month"><?= date('M', $date) ?></div>
        </div>
      </div>
    </div>
    <div class="d-block d-md-none" itemprop="startDate" content="<?= (new DateTime($this->item->publish_down))->format('c') ?>">
      <?= $this->item->publish_down == '0000-00-00 00:00:00' ? 'Indefinite' : date('F j, Y', $date) ?>
    </div>
  </a>
  <div class="col-12 col-md-8">
    <h2 class="font-weight-bold"><a href="<?= $link ?>" itemprop="name"><?= $this->item->title ?></a></h2>
  </div>
</div>