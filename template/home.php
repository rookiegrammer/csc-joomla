<?php

function get_content_from_category($category, $fields = null, $limit = 0, $order = 'ordering') {
  $db = JFactory::getDbo();

  $query = $db->getQuery(true);
  $subQuery = $db->getQuery(true);

  $subQuery ->select('id')
          	->from($db->quoteName('#__categories'))
          	->where($db->quoteName('alias') . ' = ' . $db->quote($category));

  $query ->select(empty($fields) ? '*' : $db->quoteName($fields))
         ->from($db->quoteName('#__content'))
         ->where($db->quoteName('catid') . ' IN (' . $subQuery . ')')
         ->andwhere( $db->quoteName('state') . ' = 1')
         ->order($order);

  if (!empty($limit)) {
   $query ->setLimit($limit);
  }

  $db->setQuery($query);
  return $db->loadObjectList();
}

function get_events($fields = null, $limit = 0) {
  $db = JFactory::getDbo();

  $query = $db->getQuery(true);
  $subQuery = $db->getQuery(true);

  $subQuery ->select('id')
          	->from($db->quoteName('#__categories'))
          	->where($db->quoteName('alias') . ' = ' . $db->quote('event'));

  $query ->select(empty($fields) ? '*' : $db->quoteName($fields))
         ->from($db->quoteName('#__content'))
         ->where($db->quoteName('catid') . ' IN (' . $subQuery . ')')
         ->andwhere( $db->quoteName('state') . ' = 1')
         ->andwhere( $db->quoteName('publish_down') . ' > "'.date("Y-m-d").'"')
         ->order('publish_down ASC');

  if (!empty($limit)) {
   $query ->setLimit($limit);
  }

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

  $sliders = get_content_from_category('slide', ['id', 'title', 'introtext', 'catid', 'fulltext', 'language'] );
  $about_article = get_article_with_alias('about');

  $news = get_content_from_category('news', ['id', 'title', 'introtext', 'catid', 'fulltext', 'language'], 12);
  $quicks = get_content_from_category('page-quick', ['id', 'title', 'introtext', 'catid', 'fulltext', 'language', 'alias', 'note'], 3);

  $events = get_events(['id', 'title', 'introtext', 'catid', 'fulltext', 'language', 'publish_down'], 3);
?>


<?php if (count($sliders)) : ?>
<div id="csc-slides" class="carousel slide text-white text-center" data-ride="carousel">
  <ol class="carousel-indicators" style="bottom: auto">
    <?php for ($i=0; $i<count($sliders); $i++) : ?>
    <li data-target="#csc-slides" data-slide-to="<?= $i ?>" class="<?= $i==0 ? 'active' : '' ?>"></li>
    <?php endfor; ?>
  </ol>
  <h3 class="sr-only">
    Updates
  </h3>
  <div class="carousel-inner">
    <?php
      $sliders_begin = true;
      foreach ($sliders as $update) :?>

      <div class="carousel-item<?= $sliders_begin ? ' active' : '' ?>">
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
<?php endif; ?>
<div class="container my-5">
  <h3 class="text-center text-primary" style="font-size: 1.8rem">
    <?= $this->params->get('mission') ?>
  </h3>
</div>

<div class="py-5">
  <?php
  if (!empty($quicks)) : ?>
  <div class="container">
    <h3 class="mb-3">Quick Links</h3>
    <div class="row my-4">
      <?php
      foreach ($quicks as $quicklink) : ?>
        <div class="col-4">
          <a class="d-block w-auto text-center p-3 btn btn-primary btn-round-border btn-primary-accent btn-hovershadow" href="<?= get_link($quicklink) ?>">
            <i class="fas fa-<?= $quicklink->note ?> d-block mb-2" style="font-size: 2rem"></i>
            <?= $quicklink->title ?>
          </a>
        </div>
      <?php
      endforeach;
      ?>
      <!-- <div class="col-4">
        <a class="d-block w-auto text-center p-3 btn btn-primary btn-round-border btn-primary-accent btn-hovershadow" href="#">
          <i class="fas fa-flask d-block mb-2" style="font-size: 2rem"></i>
          Research Activities
        </a>
      </div>
      <div class="col-4">
        <a class="d-block w-auto text-center p-3 btn btn-primary btn-round-border btn-primary-accent btn-hovershadow" href="#">
          <i class="fas fa-hands-helping d-block mb-2" style="font-size: 2rem"></i>
          Research Affiliation Program
        </a>
      </div>
      <div class="col-4">
        <a class="d-block w-auto text-center p-3 btn btn-primary btn-round-border btn-primary-accent btn-hovershadow" href="#">
          <i class="fas fa-info-circle d-block mb-2" style="font-size: 2rem"></i>
          Other Program &amp; Services
        </a>
      </div> -->
    </div>
  </div>
  <?php endif; ?>
  <div class="background-secondary">
    <div class="container my-5 py-3">
      <h3 class="mb-3">News &amp; Announcements</h3>
      <div class="row">
      <?php
      if (!empty($news)) :
      foreach ($news as $news_each) : ?>
        <div class="col-3">
          <a class="btn btn-feature" href="<?= get_link($news_each) ?>">
            <span class="gradient-overlay"></span>
            <h5 class="gradient-title m-0 text-white p-2 font-weight-bold">
              <?= $news_each->title ?>
            </h5>
          </a>
        </div>
      <?php
      endforeach;
      else :
      ?>
      <pre>There are no news nor announcements as of this time.</pre>
      <?php endif; ?>
      </div>
      <div class="text-right mt-3">
        <a class="link-boss" href="#">
          More
          <i class="fas fa-caret-right">
          </i>
        </a>
      </div>
    </div>
  </div>
  <div class="container mt-5">
    <div class="row mt-4">
      <div class="col-4">
        <h3>Upcoming</h3>
        <div class="csc-date-rows">
          <?php if (empty($events)) : ?>
            <p style="font-size: 0.8rem">
              No upcoming events.
            </p>
          <?php else : ?>
            <?php
              $e_first = true;
              foreach ($events as $event) :
                $date = strtotime($event->publish_down);
              ?>
            <a class="row csc-date-event" href="<?= get_link($event) ?>">
              <div class="csc-date-prewrap position-relative">
                <div class="csc-date-circle <?= $e_first ? 'csc-date-circle-big' : '' ?> position-relative">
                  <div class="csc-date-text text-white text-center">
                    <div class="csc-date-day"><?= date('d', $date) ?></div>
                    <?php if ($e_first) : ?>
                    <div class="csc-date-month"><?= date('M', $date) ?></div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="pl-3 pt-2">
                <h5 class="font-weight-bold">
                  <?= $event->title ?>
                </h5>
                <p style="font-size: 0.8rem">
                  <?php if ($e_first) : ?>
                  <?= substr(strip_tags($event->introtext), 0, 100) ?>...
                  <?php else : ?>
                    <?= date('F Y', $date) ?>
                  <?php endif; ?>
                </p>
              </div>
            </a>
            <?php
              $e_first = false;
              endforeach; ?>
          <?php endif; ?>
          <!-- <a class="row csc-date-event" href="#">
            <div class="csc-date-prewrap position-relative">
              <div class="csc-date-circle position-relative">
                <div class="csc-date-text text-white text-center">
                  <div class="csc-date-day">01</div>
                </div>
              </div>
            </div>
            <div class="pl-3 pt-2">
              <h5 class="font-weight-bold">
                New Year
              </h5>

            </div>
          </a>
          <a class="row csc-date-event" href="#">
            <div class="csc-date-prewrap position-relative">
              <div class="csc-date-circle position-relative">
                <div class="csc-date-text text-white text-center">
                  <div class="csc-date-day">06</div>
                </div>
              </div>
            </div>
            <div class="pl-3 pt-2">
              <h5 class="font-weight-bold">
                Continuation of Services
              </h5>
            </div>
          </a> -->
        </div>
        <div class="text-right mt-3">
          <a class="link-boss" href="#">
            More
            <i class="fas fa-caret-right"></i>
          </a>
        </div>
      </div>
      <div class="col-8">
        <h3>The Staff</h3>
        <?php if (empty($staff_article)) : ?>
        <pre>Please create article with alias 'staff'</pre>
        <?php else : ?>
        <?= $staff_article->introtext ?>
        <div class="text-right mt-3">
          <a class="link-boss" href="<?= get_link($staff_article) ?>">
            Learn More
            <i class="fas fa-caret-right"></i>
          </a>
        </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>
<div class="my-5">
  <div class="container">

  </div>
  <div class="mb-4" style="background-image: url(<?= $path ?>img/image1.jpg); background-size: cover; background-position: center;">
      <div style="background-color: rgba(255,255,255,0.6); color: black; text-shadow: 0 0 10px #ffffff;">
        <div class="container py-5">
          <h3 class="text-primary pb-3" style="color: inherit !important; font-size: 1.5rem">
            About the <?= $this->params->get('sitetitle') ?>
          </h3>
          <?= nl2br($this->params->get('history')) ?>
        </div>
      </div>
  </div>
</div>
