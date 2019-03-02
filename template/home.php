<?php

function get_content_from_category($category, $fields = null) {
  $db = JFactory::getDbo();

  $query = $db->getQuery(true);
  $subQuery = $db->getQuery(true);

  $subQuery ->select('id')
          	->from($db->quoteName('#__categories'))
          	->where($db->quoteName('alias') . ' = ' . $db->quote($category));

  $query ->select(empty($fields) ? '*' : $db->quoteName($fields))
         ->from($db->quoteName('#__content'))
         ->where($db->quoteName('catid') . ' IN (' . $subQuery . ')')
         ->order('publish_up DESC');
  $db->setQuery($query);
  return $db->loadObjectList();
}

function get_article_with_alias($alias, $fields = null) {
  $db = JFactory::getDbo();

  $query = $db->getQuery(true);
  $query ->select(empty($fields) ? '*' : $db->quoteName($fields))
         ->from($db->quoteName('#__content'))
         ->where($db->quoteName('alias') . ' = ' . $db->quote($alias))
         ->order('publish_up DESC');
  $db->setQuery($query);
  return $db->loadObjectList()[0];
}

function get_link($article) {
  return JRoute::_(ContentHelperRoute::getArticleRoute($article->id,
              $article->catid, $article->language));
}

  $base = JURI::base(true);
  $path = $base.'/templates/'.$app->getTemplate().'/';

  $news = get_content_from_category('news', ['id', 'title', 'introtext', 'catid', 'fulltext', 'language'] );
  $about_article = get_article_with_alias('about');
?>


<?php if (count($news)) : ?>
<div id="csc-slides" class="carousel slide text-white text-center" data-ride="carousel">
  <ol class="carousel-indicators" style="bottom: auto">
    <?php for ($i=0; $i<count($news); $i++) : ?>
    <li data-target="#csc-slides" data-slide-to="<?= $i ?>" class="<?= $i==0 ? 'active' : '' ?>"></li>
    <?php endfor; ?>
  </ol>
  <h3 class="sr-only">
    Updates
  </h3>
  <div class="carousel-inner">
    <?php
      $news_begin = true;
      foreach ($news as $update) :?>

      <div class="carousel-item<?= $news_begin ? ' active' : '' ?>">
        <a href="<?= get_link($update) ?>">
          <img class="d-block h-100 m-auto" src="<?= $path ?>img/placeholder.jpg" alt="Image">
          <div class="carousel-text-block">
            <div class="carousel-text-wrap">
              <div class="carousel-text-overlay">
              </div>
              <div class="carousel-text-title pt-5 pb-3">

                <h5 class="container mb-0 text-white">
                  <?= $update->title ?>
                </h5>
                <p class="text-white">
                  <?= $update->fulltext ? strip_tags($update->introtext) : substr(strip_tags($update->introtext), 0, 100) ?>
                </p>
              </div>
            </div>
          </div>
        </a>
      </div>
  <?php
    $news_begin = false;
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
<?php endif; ?>
