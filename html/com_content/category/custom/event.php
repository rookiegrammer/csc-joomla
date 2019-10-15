<div class="blog<?php echo $this->pageclass_sfx; ?>">

  <h1 class="title page-title sans-serif font-weight-bold">
    <?php echo $this->category->title; ?>
  </h1>

  <div class="category-desc clearfix">
    <?php echo $beforeDisplayContent; ?>
    <?php if ($this->params->get('show_description') && $this->category->description) : ?>
      <?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
    <?php endif; ?>
    <?php echo $afterDisplayContent; ?>
  </div>

<hr>

<?php

  $layout->list = $this->lead_items;
  $layout->csc_item_schema = 'Event';
  include csc_display('list', 'event'); ?>

<?php
  $layout->list = $this->intro_items;
  $layout->csc_item_schema = 'Event';
  include csc_display('list', 'event'); ?>



<?php if ($this->maxLevel != 0 && !empty($this->children[$this->category->id])) : ?>
  <div class="cat-children">
    <?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
      <h3> <?php echo JText::_('JGLOBAL_SUBCATEGORIES'); ?> </h3>
    <?php endif; ?>
    <?php echo $this->loadTemplate('children'); ?> </div>
<?php endif; ?>
<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
    <div class="row align-items-center justify-content-center">
        <?php if ($this->params->def('show_pagination_results', 1)) : ?>
            <div class="col-12 col-sm-3 text-center">
                <p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
            </div>
        <?php endif; ?>
        <div class="col-12 col-sm-6 text-center"><?php echo $this->pagination->getPagesLinks(); ?> </div>
    </div>
<?php endif; ?>

</div>
