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
  function cmp($a, $b) {
    $priority1 = property_exists($a, 'attribs') && property_exists($a->attribs, 'order_priority') ? json_decode($a->attribs)->order_priority : 0;
    $priority2 = property_exists($b, 'attribs') && property_exists($b->attribs, 'order_priority') ? json_decode($b->attribs)->order_priority : 0;
    return $priority1 > $priority2;

  }

  $list = $this->lead_items;
  usort($list, 'cmp');
  $layout->list = $list;
  $layout->csc_item_schema = 'Person';
  include csc_display('list', 'profile'); ?>

<?php
  $list = $this->intro_items;
  usort($list, 'cmp');
  $layout->list = $list;
  $layout->csc_item_schema = 'Person';
  include csc_display('list', 'profile'); ?>



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
            <div class="col-12 col-sm-3 text-center text-sm-right">
                <p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
            </div>
        <?php endif; ?>
        <div class="col-12 col-sm-5"><?php echo $this->pagination->getPagesLinks(); ?> </div>
    </div>
<?php endif; ?>

</div>
