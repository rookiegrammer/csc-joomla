<div class="blog<?php echo $this->pageclass_sfx; ?> my-0" itemscope itemtype="https://schema.org/<?= $this->csc_disp_schema?> ">
<?php /*

<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header mb-3">
			<h1 class="text-center"> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>

      <?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
        <h2> <?php echo $this->escape($this->params->get('page_subheading')); ?>
          <?php if ($this->params->get('show_category_title')) : ?>
            <span class="subheading-category"><?php echo $this->category->title; ?></span>
          <?php endif; ?>
        </h2>
      <?php endif; ?>
		</div>
	<?php endif; ?>

<?php if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
  <div class="category-desc clearfix">
    <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
      <img src="<?php echo $this->category->getParams()->get('image'); ?>" alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt'), ENT_COMPAT, 'UTF-8'); ?>"/>
    <?php endif; ?>
    <?php echo $beforeDisplayContent; ?>
    <?php if ($this->params->get('show_description') && $this->category->description) : ?>
      <?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
    <?php endif; ?>
    <?php echo $afterDisplayContent; ?>
  </div>
<?php endif; ?>

*/?>

<?php if ($this->params->get('show_category_title', 1)): ?>
<h2><?=$this->category->title?></h2>
<?php endif; ?>

<?php if ($this->params->get('show_description', 1)): ?>
<p><?=$this->category->description?></p>
<?php endif; ?>
<hr/>

<?php
    $withImage = array();
    $withoutImage = array();
    foreach ($this->children[$this->category->id] as $id => $child){
        if ($child->getParams()['image'])
            array_push($withImage, $child);
        else
            array_push($withoutImage, $child);
    }
?>
<?php if ($this->maxLevel != 0 && count($this->children[$this->category->id]) > 0) : ?>
    
    <?php if (count($withImage)) :?>
        <div class="card-columns ">
            <?php foreach ($withImage as $id => $child) : ?>
                <div class="card category-links" style="max-width:300px" data-target="#category<?=$id?>">
                    <img src="<?=$child->getParams()['image']?>" class="card-img-top" alt="<?=$child->getParams()['image_intro_alt']?>">
                    <div class="card-body align-middle p-3 bg-primary">
                      <h6 class="card-title text-center my-auto text-white"><?=$child->title?></h6>
                      <a href="<?=JRoute::_(ContentHelperRoute::getCategoryRoute($child->slug))?>" class="stretched-link"></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif?>
    <?php if (count($withoutImage)): ?>
        <div class="card-columns ">
            <?php foreach ($withoutImage as $id=>$child) : ?>
                <div class="card category-links " style="max-width:300px" data-target="#category<?=$id?>">
                    <div class="card-body align-middle p-3 bg-primary">
                      <h6 class="card-title text-center my-auto text-white "><?=$child->title?></h6>
                      <a href="<?=JRoute::_(ContentHelperRoute::getCategoryRoute($child->slug))?>" class="stretched-link"></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif ?>
    <hr/>   
<?php endif;?>


<script>
jQuery(document).ready(function ($) {
    $( ".category-links" ).hover(
        function() {
            $(this).addClass("shadow");
            //$($(this).data("target")).collapse('show');
        },
        function() {
            $(this).removeClass("shadow");
            //$($(this).data("target")).collapse('hide');
        }
    );
});

</script>

<?php if ($this->category->parent_id!='root' && empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
    <?php if ($this->params->get('show_no_articles', 1)) : ?>
        <p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
    <?php endif; ?>
<?php endif; ?>

<?php
  $layout->csc_item_schema = 'PublicationIssue';
  $layout->list = &$this->intro_items;
  include csc_display('list', 'publication-featured');
  if ($layout->list) echo '<hr>';
  ?>

<?php
  $layout->list = &$this->lead_items;
  include csc_display('grid', 'publication-grid'); ?>

<?php /*<?php if ($this->maxLevel != 0 && !empty($this->children[$this->category->id])) : ?>
  <div class="cat-children">
    <?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
      <h3> <?php echo JText::_('JGLOBAL_SUBCATEGORIES'); ?> </h3>
    <?php endif; ?>
    <?php echo $this->loadTemplate('children'); ?> </div>
<?php endif; ?>*/ ?>

 
<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
  <div class="pagination">
    <?php if ($this->params->def('show_pagination_results', 1)) : ?>
      <p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
    <?php endif; ?>
    <?php echo $this->pagination->getPagesLinks(); ?> </div>
<?php endif; ?>

</div>
