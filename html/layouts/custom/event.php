<!-- EVENT -->

<?php
  $item = $displayData["item"]
?>
<div class="container">
  <h1 class="title event-title"><?= $item->title ?></h1>
  <p class="date event-date">
    <?= $item->publish_down == '0000-00-00 00:00:00' ? 'Indefinite' : JHtml::_('date', $item->publish_down, 'g:i a, F j, Y') ?>
  </p>
  <div class="content event-content">
    <?= $item->text ?>
  </div>
</div>
