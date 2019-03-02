<!-- PAGE -->
<?php
  $item = $displayData["item"]
?>
<div class="container">
  <h1 class="title page-title"><?= $item->title ?></h1>
  <div class="content page-content">
    <?= $item->text ?>
  </div>
</div>
