<?php $date = strtotime($this->item->created);
      $link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->id,
                  $this->item->catid, $this->item->language));
      $indefinite = $this->item->created == '0000-00-00 00:00:00';
                  ?>
<div class="row mb-4">
  <a class="col-12 col-md-auto" href="<?= $link ?>">
    <div class="csc-date-event d-none d-md-block">
      <div class="csc-date-circle csc-date-circle-big position-relative">
        <div class="csc-date-text text-white text-center">
          <?php if (!$indefinite) : ?>
            <div class="csc-date-day"><?= date('d', $date) ?></div>
            <div class="csc-date-month"><?= date('M', $date) ?></div>
            <div class="csc-date-month"><?= date('Y', $date) ?></div>
          <?php endif ?>
        </div>
      </div>
    </div>
    <div class="d-block d-md-none" itemprop="startDate" content="<?= (new DateTime($this->item->created))->format('c') ?>">
      <?= $indefinite ? 'Indefinite' : date('F j, Y', $date) ?>
    </div>
  </a>
  <div class="col-12 col-md-8 pt-3">
    <h2 class="font-weight-bold mb-0"><a href="<?= $link ?>" itemprop="name"><?= $this->item->title ?></a></h2>
    <p class="event-description">
      <?= substr(strip_tags($this->item->introtext), 0, 100) ?>
    </p>
  </div>
</div>
