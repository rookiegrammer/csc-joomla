<!-- PAGE -->
<?php
  $item = $displayData["item"]
?>
<div class="container">
  page
  <h1 class="title page-title sans-serif font-weight-bold"><?= $item->title ?></h1>
  <div class="content page-content">
    <?= $item->text ?>
  </div>
</div>
