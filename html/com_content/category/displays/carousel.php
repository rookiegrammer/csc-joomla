<div id="csc-slides" class="carousel slide text-white text-center" data-ride="carousel">
  <ol class="carousel-indicators" style="bottom: auto">
    <?php for ($i=0; $i<count($layout->list); $i++) : ?>
    <li data-target="#csc-slides" data-slide-to="<?= $i ?>" class="<?= $i==0 ? 'active' : '' ?>"></li>
    <?php endfor; ?>
  </ol>
  <div class="carousel-inner">
    <?php
      $sliders_begin = true;
      foreach ($layout->list as &$item) :?>
      <div class="carousel-item<?= $sliders_begin ? ' active' : '' ?>" style="min-height: 20rem" itemscope itemtype="https://schema.org/<?= $layout->csc_item_schema ?>">
        <?php
        csc_load_item($this, $item);
        ?>
      </div>
  <?php
    $sliders_begin = false;
    endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#csc-slides" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#csc-slides" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
