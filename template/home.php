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
         ->andwhere( $db->quoteName('created') . ' > "'.date("Y-m-d").'"')
         ->order('created ASC');

  if (!empty($limit)) {
   $query ->setLimit($limit);
  }

  $db->setQuery($query);
  return $db->loadObjectList();
}

function get_category_with_alias($alias, $fields = null) {
  $db = JFactory::getDbo();
  $query = $db->getQuery(true);

  $query ->select(empty($fields) ? '*' : $db->quoteName($fields))
        	->from($db->quoteName('#__categories'))
        	->where($db->quoteName('alias') . ' = ' . $db->quote($alias));
  $db->setQuery($query);
  $list = $db->loadObjectList();
  return empty($list) ? null : $list[0];
}

function get_article_with_alias($alias, $fields = null) {
  $db = JFactory::getDbo();

  $query = $db->getQuery(true);
  $query ->select(empty($fields) ? '*' : $db->quoteName($fields))
         ->from($db->quoteName('#__content'))
         ->where($db->quoteName('alias') . ' = ' . $db->quote($alias))
         ->order('publish_up DESC');
  $db->setQuery($query);
  $list = $db->loadObjectList();
  return empty($list) ? null : $list[0];
}

function get_art_link($article) {
  return JRoute::_(ContentHelperRoute::getArticleRoute($article->id,
              $article->catid, $article->language));
}

function get_cat_link($category) {
  return JRoute::_(ContentHelperRoute::getCategoryRoute($category->id, $category->language).'&layout=blog');
}

function get_cat_link_with_alias($category_alias) {
  return get_cat_link(get_category_with_alias($category_alias, ['id', 'language']));
}

function get_recent_publications($limit = 0, $featured = false){
  $db = JFactory::getDbo();
  $query = $db->getQuery(true);
  $subQuery = $db->getQuery(true);
  $subQuery2 = $db->getQuery(true);

  $subQuery2 ->select('id')
          	->from($db->quoteName('#__categories'))
          	->where($db->quoteName('alias') . ' = ' . $db->quote('publication'));

  $subQuery ->select('id')
            ->from($db->quoteName('#__categories'))
            ->where($db->quoteName('parent_id') . ' IN (' . $subQuery2 .')')
            ->orWhere($db->quoteName('id') . ' IN (' . $subQuery2 .')');

  $query ->select('cat.title as category_title, con.title as content_title, con.introtext, con.images, con.publish_up, con.id, con.catid, con.language')
        	->from($db->quoteName('#__content').' AS con')
        	->innerJoin('#__categories AS cat ON catid = cat.id')
            ->where($db->quoteName('catid') . ' IN (' . $subQuery . ')')
            ->andWhere( $db->quoteName('state') . ' = 1');
  if($featured){
      $query->andWhere($db->quoteName('featured').'='.$db->quote($featured));
  }
  if(!empty($where)){
      $query->andWhere($where,$whereGlue);
  }

  $query ->order('publish_up DESC');
  if (!empty($limit)) {
   $query ->setLimit($limit);
  }

  $db->setQuery($query);
  return $db->loadObjectList();
}


  $base = JURI::base(true);
  $path = $base.'/templates/'.$app->getTemplate().'/';

  $sliders = get_content_from_category('slide', ['id', 'title', 'introtext', 'catid', 'fulltext', 'language', 'images'] );
  $staff_category = get_category_with_alias('staff', ['id', 'description', 'language']);

  $news = get_content_from_category('news', ['id', 'title', 'introtext', 'catid', 'fulltext', 'language', 'images'], 12);
  $quicks = get_content_from_category('page-quick', ['id', 'title', 'introtext', 'catid', 'fulltext', 'language', 'alias', 'attribs'], 3);

  $events = get_events(['id', 'title', 'introtext', 'catid', 'fulltext', 'language', 'created'], 3);

  $recent_publications = get_recent_publications(7);
  $featured_publications = get_recent_publications(7, true);

  //$publications = JCategories::getInstance('Content')->get(get_category_with_alias('publication','id')->id);
  //echo "<pre>".print_r($recent_publications,true)."</pre>";
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
      foreach ($sliders as $update) :
        $images = json_decode($update->images);
        ?>

      <div class="carousel-item<?= $sliders_begin ? ' active' : '' ?>">
        <a href="<?= get_art_link($update) ?>">
          <img class="d-block h-100 m-auto" src="<?= $images->image_intro ?>" alt="<?= $images->image_intro_alt ?>">
          <div class="carousel-text-block">
            <div class="carousel-text-wrap">
              <div class="carousel-text-overlay">
              </div>
              <div class="carousel-text-title pt-5 pb-3 px-4">

                <h5 class="container mb-0 text-white">
                  <?= $update->title ?>
                </h5>
                <p class="text-white">
                  <?= $update->introtext ? strip_tags($update->introtext) : substr(strip_tags($update->fulltext), 0, 100) ?>
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
<div class="container mt-5 text-center">
  <h3 class="text-primary mb-4" style="font-size: 1.8rem">
    <?= $this->params->get('mission') ?>
  </h3>
  <a href="#about"><span class="hoverline">Learn More</span><br><span class="h3"><i class="fas fa-chevron-down"></i></span></a>
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
          <a class="d-block w-auto text-center p-3 btn btn-primary btn-round-border btn-primary-accent btn-hovershadow" href="<?= get_art_link($quicklink) ?>">
            <i class="fa fa-<?= json_decode($quicklink->attribs)->csc_fa_icon_class ?> d-block mb-2" style="font-size: 2rem"></i>
            <?= $quicklink->title ?>
          </a>
        </div>
      <?php
      endforeach;
      ?>
    </div>
  </div>
  <?php endif; ?>
  <div class="background-secondary">
    <div class="container mt-5 py-3">
      <h3 class="mb-3">News &amp; Announcements</h3>
      <div class="row">
      <?php
      if (!empty($news)) :
      foreach ($news as $news_each) : ?>
        <div class="col-3">
          <a class="btn btn-feature" href="<?= get_art_link($news_each) ?>" style="background-image: url(<?= json_decode($news_each->images)->image_intro ?>)">
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
        <a class="link-boss" href="<?= get_cat_link_with_alias('news') ?>">
          More
          <i class="fas fa-caret-right">
          </i>
        </a>
      </div>
    </div>
  </div>
  <div class="bg-primary">
    <div class="container mb-5 py-3">
        <div class="row justify-content-center align-items-start ">
            <?php if (!empty($featured_publications)) :?>
            <div class="col-12 col-md-5 ">
                <h3 class="my-3 text-secondary text-center pb-2" style="border-style:solid; border-width:0 0 3px 0;">Featured Publications</h3>
                <div class="row flex-nowrap noselect align-items-end disable-scrollbars" id="featuredScroll" style="overflow-x:auto;">
                <?php foreach ($featured_publications as $p) : ?>
                        <?php
                            $images = json_decode($p->images,true);
                        ?>
                        <div class="col-6 col-sm-3 col-md-4 m-1 p-0 ">
                            <div class="card bg-secondary h-100">
                            <?php if ($images['image_intro']) :?>
                                <img src="<?=$images['image_intro']?>" class="card-img-top img-fluid" alt="<?=$images['image_intro_alt']?>" draggable="false">
                            <?php endif ?>
                                <div class="card-body p-2">
                                    <p class="card-text text-center mb-0"><?=$p->content_title?></p>
                                    <a href="<?=get_art_link($p)?>" class="stretched-link" draggable="false"></a>
                                </div>
                            </div>
                        </div>
                <?php endforeach;?>
                </div>
            </div>
            <div class="col-0 col-md-1 m-0"></div>
            <?php endif; ?>
            <div class="col-12 <?=!empty($featured_publications) ?  'col-md-5' : ''?> "  >
                <h3 class="my-3 text-secondary text-center pb-2" style="border-style:solid; border-width:0 0 3px 0;">Recent Publications</h3>
                <?php
                if (!empty($recent_publications)) :?>
                <div class="row flex-nowrap noselect align-items-end disable-scrollbars" id="recentScroll" style="overflow-x:auto;">
                <?php foreach ($recent_publications as $p) : ?>
                        <?php
                            $images = json_decode($p->images,true);
                        ?>
                        <div class="<?=!empty($featured_publications) ? "col-6 col-sm-3 col-md-4":"col-4 col-md-2" ?> m-1 p-0 ">
                            <div class="card bg-secondary h-100">
                            <?php if ($images['image_intro']) :?>
                                <img src="<?=$images['image_intro']?>" class="card-img-top img-fluid" alt="<?=$images['image_intro_alt']?>" draggable="false">
                            <?php endif ?>
                                <div class="card-body p-2">
                                    <p class="card-text text-center mb-0"><?=$p->content_title?></p>
                                    <a href="<?=get_art_link($p)?>" class="stretched-link" draggable="false"></a>
                                </div>
                            </div>
                        </div>
                <?php endforeach;?>
                </div>
                <?php else :?>
                <pre class="text-white">There are no featured publications as of this time.</pre>
                <?php endif; ?>
            </div>
        </div>
        <div class="text-right mt-3">
          <a class="link-boss text-white" href="<?= get_cat_link_with_alias('publication') ?>">
            More
            <i class="fas fa-caret-right">
            </i>
          </a>
        </div>
    </div>
  </div>
    <script>
        var cancel = false;
        $.fn.attachDragger = function(){
            var attachment = false, lastPosition, position, difference;
            $(this).on("mousedown mouseup mousemove",function(e){
                if( e.type == "mousedown" ) attachment = true, lastPosition = [e.clientX, e.clientY];
                if( e.type == "mouseup" ) attachment = false;
                if( e.type == "mousemove" && attachment == true ){
                    cancel = true;
                    position = [e.clientX, e.clientY];
                    difference = [ (position[0]-lastPosition[0]), (position[1]-lastPosition[1]) ];
                    $(this).scrollLeft( $(this).scrollLeft() - difference[0] );
                    $(this).scrollTop( $(this).scrollTop() - difference[1] );
                    lastPosition = [e.clientX, e.clientY];
                }
            });
            $(window).on("mouseup", function(){
                attachment = false;
            });
        }
        $(document).ready(function(){
            $("#recentScroll").attachDragger();
            $("#featuredScroll").attachDragger();
            $(".stretched-link").click(function(e){
                cancel && e.preventDefault();
            });
            $(".stretched-link").on("mousedown",function(e){
                cancel=false;
            });
        });
    </script>



  <div class="container mt-5">
    <div class="row mt-4">
      <div class="events col-12 col-md-4">
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
                $date = strtotime($event->created);
              ?>
            <a class="row csc-date-event" href="<?= get_art_link($event) ?>">
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
                <h5 class="font-weight-bold mt-3 mb-0">
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
        </div>
        <div class="text-right mt-3">
          <a class="link-boss" href="<?= get_cat_link_with_alias('event') ?>">
            More
            <i class="fas fa-caret-right"></i>
          </a>
        </div>
      </div>
      <div class="col-8">
        <h3>The Staff</h3>
        <?php if (empty($staff_category)) : ?>
        <pre>Please create category with alias 'staff'</pre>
        <?php else : ?>
        <?= $staff_category->description ?>
        <div class="text-right mt-3">
          <a class="link-boss" href="<?= get_cat_link($staff_category) ?>">
            View Staff
            <i class="fas fa-caret-right"></i>
          </a>
        </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>
<div class="my-5">
  <div id="about" class="mb-4" style="background-image: url(<?= $path ?>img/image1.jpg); background-size: cover; background-position: center;">
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
