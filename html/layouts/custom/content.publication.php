<!-- PUBLICATION -->
<?php
  extract($displayData);
  $images = json_decode($item->images);
  $meta = json_decode($item->metadata);
?>

<div class="row">
  <?php if ($images->image_intro) : ?>
    <div class="col-3">
      <a class="event-img-box mb-3" href="<?= $images->image_intro ?>" data-title="<?= $images->image_intro_alt ?>" data-footer="<?= $images->image_intro_caption ?>" data-toggle="lightbox" data-gallery="gallery">
        <img src="<?= $images->image_intro ?>" alt="<?= $images->image_intro_alt ?>">
      </a>
    </div>

  <?php endif; ?>
  <div class="col">
    <h1 class="title mb-0"><?= $item->title ?></h1>
    <?php if ($meta->author) : ?>
    <div class="credits font-weight-bold mb-2" style="opacity:0.7">
      By <?= $meta->author ?>
    </div>
    <?php endif; ?>
    <?php if ($item->metadesc) : ?>
    <small class="description font-italic d-block mb-4">
      <?= $item->metadesc ?>
    </small>
    <?php endif; ?>
    <?php $pdf = $item->params->get('csc_pdf_preview'); if ($pdf) :
      ?>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#CSCPDFCenter">
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
               <iframe src="<?= preg_replace('/view\?.+$/','preview', $pdf) ?>" style="width: 100%; height: 75vh"></iframe>
             </div>
           </div>
         </div>
        </div>
    <?php endif; ?>
  </div>
</div>
<hr>
<div class="content">
  <?= $item->text ?>
</div>
<?php if ($images->image_fulltext) : ?>
  <a href="<?= $images->image_fulltext ?>" data-toggle="lightbox" data-gallery="gallery" data-title="<?= $images->image_fulltext_alt ?>" data-footer="<?= $images->image_fulltext_caption ?>" >
  </a>
<?php endif; ?>
