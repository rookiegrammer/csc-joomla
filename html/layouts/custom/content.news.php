<!-- NEWS -->

<?php
  extract($displayData);
?>
  <h1 class="title news-title sans-serif font-weight-bold"><?= $item->title ?></h1>
  <p class="date news-date">
    <?= JHtml::_('date', $item->publish_up, 'g:i a, F j, Y') ?>
  </p>
  <div class="content news-content">
    <?= $item->text ?>
  </div>
