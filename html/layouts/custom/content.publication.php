<!-- PUBLICATION -->
<?php
  extract($displayData);
  $images = json_decode($item->images);
  $meta = json_decode($item->metadata);
  $price = $item->params->get('csc_publication_price');
  $isbn = $item->params->get('csc_publication_isbn');
  $notice = $item->params->get('csc_publication_notices');
  $other = $item->params->get('csc_alt_titles');
?>
<div itemscope="" itemtype="http://schema.org/Book">
<div class="row">
  <?php if ($images->image_intro) : ?>
    <div class="col-3">
      <a class="event-img-box mb-3" href="<?= $images->image_intro ?>" data-title="<?= $images->image_intro_alt ?>" data-footer="<?= $images->image_intro_caption ?>" data-toggle="lightbox" data-gallery="gallery">
        <img src="<?= $images->image_intro ?>" alt="<?= $images->image_intro_alt ?>">
      </a>
    </div>

  <?php endif; ?>
  <div class="col">
    <div class="mb-2">
      <h1 class="title mb-2 d-inline-block" itemprop="name"><?= $item->title ?></h1>
      <?php if ($price) : ?>
        <span class="price badge badge-secondary mt-2 ml-2 float-right" style="font-size: 1.2rem" itemprop="price">
          <strong><?= $price ?></strong>
        </span>
      <?php endif; ?>
    </div>
    <?php $author = $item->params->get('csc_publication_author'); if ($author) : ?>
    <div class="font-weight-bold mb-4">
      By
      <span class="credits" itemprop="author" style="opacity:0.7">
      <?= $author ?>
      </span>
    </div>
    <?php endif; ?>
    <?php if ($other) : ?>
      <div>
        Other Titles: <?= $other ?>
      </div>
    <?php endif; ?>
    <div class="mb-2">
      <?php if ($item->created) : ?>
        Published
        <span itemprop="datePublished">
          <?= $item->created == '0000-00-00 00:00:00' ? 'Indefinite' : JHtml::_('date', $item->created, 'F j, Y') ?>
        </span>
      <?php endif; ?>
      <?php if ($isbn) : ?>
         |  <span itemprop="isbn">ISBN/ISSN <?= $isbn ?></span>
      <?php endif; ?>
    </div>
    <?php $toc = $item->params->get('csc_toc'); if ($toc) : ?>
      <div itemprop="appendix">
        <h2 class="h6 font-weight-bold">Contents</h2>
        <small class="appendix border-left border-primary font-italic d-block mb-4 pl-2">
          <?= $toc ?>
        </small>
      </div>
    <?php endif; ?>
    <div>
    <?php $pdf = $item->params->get('csc_pdf_preview'); if ($pdf) :
      ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#CSCPDFCenter">
         Preview
        </button>

        <!-- Modal -->
        <div class="modal fade" id="CSCPDFCenter" tabindex="-1" role="dialog" aria-labelledby="CSCPDFCenterTitle" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
           <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="CSCPDFLongTitle">Publication Preview</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
               <iframe src="<?= preg_replace('/view\?.+$/','preview', $pdf) ?>" style="width: 100%; height: 75vh; border: none"></iframe>
             </div>
           </div>
         </div>
        </div>
    <?php endif; ?>

    <?php if ($notice) : ?>
      <small class="float-right mt-3 ml-3">
        Copyright &copy; <?= $notice ?>
      </small>
    <?php endif; ?>
    </div>
  </div>
</div>
<hr>
<div class="content" itemprop="description">
  <?= $item->text ?>
</div>
<?php if ($images->image_fulltext) : ?>
  <a href="<?= $images->image_fulltext ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_fulltext_alt ?>" data-footer="<?= $images->image_fulltext_caption ?>" >
  </a>
<?php endif; ?>
</div>
