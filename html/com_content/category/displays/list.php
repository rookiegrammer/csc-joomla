<ul class="list-unstyled">
  <?php
    foreach ($layout->list as &$item) :
    ?>
    <li class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
      itemscope itemtype="https://schema.org/<?= $layout->csc_item_schema ?>">
      <?php
      csc_load_item($this, $item);
      ?>
    </li>
  <?php endforeach; ?>
</ul>
