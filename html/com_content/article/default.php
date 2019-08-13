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


$item = $this->item;
$user = JFactory::getUser();

$package = array('item'=>$item, 'user'=>$user);

// $this->item->category_alias
echo JLayoutHelper::render('custom.content', $package, '', array('suffixes'=>array($this->item->category_alias)));

?>
