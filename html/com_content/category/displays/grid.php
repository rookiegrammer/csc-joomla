<div class="row">
  <?php
    foreach ($layout->list as &$item) :
    ?>
    <div class="col-6 col-md-4 col-lg-3 leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
      itemscope itemtype="https://schema.org/<?= $layout->csc_item_schema ?>">
      <?php
      csc_load_item($this, $item);
      ?>
    </div>
  <?php endforeach; ?>
</div>
