<!-- EVENT -->
<?php
  extract($displayData);
?>

<h1 class="title event-title sans-serif font-weight-bold"><?= $item->title ?></h1>
<p class="date event-date">
  <?= $item->publish_down == '0000-00-00 00:00:00' ? 'Indefinite' : JHtml::_('date', $item->publish_down, 'g:i a, F j, Y') ?>
</p>
<div class="content event-content">
  <?= $item->text ?>
</div>
