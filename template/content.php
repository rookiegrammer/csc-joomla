<div class="container py-5">
  <div class="row">
    <div class="col">
      <jdoc:include type="component" />
    </div>
    <?php
      $contentbar = $this->params->get('contentbar') == 1;
      if (!$contentbar || $contentbar && $app->input->get('view') == 'article') : ?>
    <div class="hide-empty col-12 col-md-4">
      <div class="ml-0 mt-3 ml-lg-4 mt-lg-0"><jdoc:include type="modules" name="sidebar" /></div>
    </div>
    <?php endif; ?>
  </div>
</div>
