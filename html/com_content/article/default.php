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

// Create shortcuts to some parameters.

// $params  = $this->item->params;
// $images  = json_decode($this->item->images);
// $urls    = json_decode($this->item->urls);
// $canEdit = $params->get('access-edit');
// $user    = JFactory::getUser();
// $info    = $params->get('info_block_position', 0);

defined("CSC_CUSTOM_CATEGORIES") || define("CSC_CUSTOM_CATEGORIES", ['event', 'news', 'page-quick', 'page', 'publication', 'slide', 'staff']);

$item = $this->item;
$user = JFactory::getUser();

$package = array('item'=>$item, 'user'=>$user);

// $this->item->category_alias
if (in_array($this->item->category_alias, CSC_CUSTOM_CATEGORIES)) {
	echo JLayoutHelper::render('custom.'.$this->item->category_alias, $package);
} else {
	echo JLayoutHelper::render('custom.default', $package);
}

?>
