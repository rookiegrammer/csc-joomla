<?php

function get_content_from_category($category) {
  $db = JFactory::getDbo();

  $query = $db->getQuery(true);
  $subQuery = $db->getQuery(true);

  $subQuery ->select('id')
          	->from($db->quoteName('#__categories'))
          	->where($db->quoteName('alias') . ' = ' . $db->quote($category));

  $query ->select('*')
         ->from($db->quoteName('#__content'))
         ->where($db->quoteName('catid') . ' IN (' . $subQuery . ')');
  $db->setQuery($query);
  return $db->loadObjectList();
}

  var_dump(get_content_from_category('blog'));
?>
