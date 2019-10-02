<?php
// no direct access
defined( '_JEXEC' ) or die;

class plgContentCsc_headstart extends JPlugin {

  function onExtensionAfterInstall() {
    $xml_obj = simplexml_load_file(realpath(__DIR__).'/csc_categories.xml');

    foreach($xml_obj->children() as $nodename => $category) {

      $alias = $category->attributes()->alias;
      $title = (string) $category->{'title'};
      $desc = (string) $category->{'description'};

      if ($this->checkCategory($alias))
        $this->addCategory($title, $desc, $alias);
    }

    return true;
  }

  function onExtensionAfterSave() {
    return $this->onExtensionAfterInstall();
  }

  protected function queryCategory($alias) {
    $db = JFactory::getDbo();

    $subQuery = $db->getQuery(true);
    $subQuery ->select('id')
            	->from($db->quoteName('#__categories'))
            	->where($db->quoteName('alias') . ' = ' . $db->quote($alias));

    $db->setQuery($subQuery);

    return $db->loadObjectList();
  }

  protected function checkCategory($alias) {
    return count($this->queryCategory($alias)) <= 0;
  }

  protected function addCategory($title, $desc, $alias, $parent_id = 1, $extension = 'com_content') {

    // JTableCategory is autoloaded in J! 3.0, so...
    if (version_compare(JVERSION, '3.0', 'lt'))
    {
    	JTable::addIncludePath(JPATH_PLATFORM . 'joomla/database/table');
    }

    // Initialize a new category
    $category = JTable::getInstance('Category');
    $category->extension = $extension;
    $category->title = $title;
    $category->description = $desc;
    $category->published = 1;
    $category->access = 1;
    $category->params = '{"target":"","image":""}';
    $category->metadata = '{"page_title":"","author":"","robots":""}';
    $category->language = '*';
    $category->alias = $alias;

    // Set the location in the tree
    $category->setLocation($parent_id, 'last-child');

    // Check to make sure our data is valid
    if (!$category->check())
    {
    	JError::raiseNotice(500, $category->getError());
    	return false;
    }

    // Now store the category
    if (!$category->store(true))
    {
    	JError::raiseNotice(500, $category->getError());
    	return false;
    }

    // Build the path for our category
    $category->rebuildPath($category->id);

  }

  function get_category_of_item($id) {
    $db = JFactory::getDbo();

    $query = $db->getQuery(true);
    $subQuery = $db->getQuery(true);

    $subQuery ->select('catid')
           ->from($db->quoteName('#__content'))
           ->where( $db->quoteName('id') . ' = '.$id);

    $query ->select('path')
           	->from($db->quoteName('#__categories'))
           	->where($db->quoteName('id') . ' IN (' . $subQuery . ')');


    $db->setQuery($query);
    return preg_replace('/\/.+$/', '', $db->loadObjectList()[0]->path);
  }

  function onContentPrepareForm($form, $data)
	{
		$app    = JFactory::getApplication();
		$option = $app->input->get('option');

    if (!$app->isClient('administrator') || $app->input->get('layout') != 'edit') return;

		if ($option == 'com_content') {
      $path = __DIR__ . '/forms';
      $id = $app->input->getInt('id');
      $catg = $id ? trim($this->get_category_of_item($id)) : '';
      JForm::addFormPath($path);
      if ( !$id )
          $form->loadFile('csc', false);
      else if ( file_exists($path.'/csc_'.$catg.'.xml') )
          $form->loadFile('csc_'.$catg, false);
      else
          $form->loadFile('csc_', false);

      return true;
		}

		return true;
	}
}
