<!-- NEWS -->

<?php
  $item = $displayData["item"]
?>
<div class="container">
  <h1 class="title news-title"><?= $item->title ?></h1>
  <p class="date news-date">
    <?= JHtml::_('date', $item->publish_up, 'g:i a, F j, Y') ?>
  </p>
  <div class="content news-content">
    <?= $item->text ?>
  </div>
</div>
