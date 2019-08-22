<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

$layout = new class(){};

function csc_load_item($blog, &$item) {
	$blog->item = &$item;
	echo $blog->loadTemplate('item');
}

function csc_display($disp, $item_style) {
	JFactory::getApplication()->set('blog_item_style', $item_style);
	return realpath(__DIR__).'/displays/'.$disp.'.php';
}

JFactory::getApplication()->set('blog_item_style', '');

if (file_exists(realpath(__DIR__).'/custom/'.$this->category->alias.'.php')) {
	include realpath(__DIR__).'/custom/'.$this->category->alias.'.php';
} else {
	include realpath(__DIR__).'/custom/default.php';
}
