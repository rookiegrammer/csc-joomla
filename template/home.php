<?php

function get_content_from_category($category, $limit = 0) {
  $db = JFactory::getDbo();

  $query = $db->getQuery(true);
  $subQuery = $db->getQuery(true);

  $subQuery ->select('id')
          	->from($db->quoteName('#__categories'))
          	->where($db->quoteName('alias') . ' = ' . $db->quote($category));

  $query ->select('*')
         ->from($db->quoteName('#__content'))
         ->where($db->quoteName('catid') . ' IN (' . $subQuery . ')')
         ->order($db->quoteName('id').' DESC');

  if (!empty($limit)) {
    $query ->setLimit($limit);
  }
  
  $db->setQuery($query);
  return $db->loadObjectList();
}
  var_dump(get_content_from_category('blog'));
  var_dump(get_content_from_category('event'));
  var_dump(get_content_from_category('news'));
  var_dump(get_content_from_category('page-quick'));
  var_dump(get_content_from_category('page'));
  var_dump(get_content_from_category('publication'));
  var_dump(get_content_from_category('staff'));
?>
