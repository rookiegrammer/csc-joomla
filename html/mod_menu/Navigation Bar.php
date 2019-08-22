<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$id = $params->menutype.'-nav';

if ($tagId = $params->get('tag_id', ''))
{
	$id .= '-'.$tagId;
}

// The menu class is deprecated. Use nav instead
?>
<div class="easynavbar">
<ul class="nav font-weight-bold sans-serif text-uppercase justify-content-center pt-3 menu<?php echo $class_sfx; ?> mod-list" id="<?php echo $id; ?>">
<?php foreach ($list as $i => &$item)
{

	$class = 'item-' . $item->id;

  $active = false;

	if ($item->id == $default_id)
	{
		$class .= ' default';
	}

	if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$active = true;
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$active = true;
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

  if ($item->level <= 1) {
    $class .= ' nav-item';
  } else if ($item->type === 'separator') {
    $class .= ' dropdown-divider';
  }
	if ($item->deeper) {
		$class .= ' dropdown';
	}


	echo '<li class="' . $class . '">';

	switch ($item->type) {
		case 'component':
		case 'heading':
		case 'url':
			if ($item->level <= 1) {
		    if ($item->deeper) {
		      echo '<a id="menu'.$id.'-'.$item->id.'-drop" class="nav-link dropdown-toggle '.( $active?'active':'' ).'" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >'
		              .'<span class="nav-bars">'.$item->title.'</span></a>';
		    } else {
		      echo '<a class="nav-link'.( $active?' active':'' ).'" rel="'.$item->anchor_rel.'" href="'.(JRoute::_($item->flink)).'">'
		              .'<span class="nav-bars">'.$item->title.'</span></a>';
		    }
		  } else {
		    if ($item->deeper) {
		      echo '<a id="menu'.$id.'-'.$item->id.'-drop" role="button" class="dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >'
		              .$item->title.'</a>';
		    } else {
		      echo '<a class="dropdown-item" rel="'.$item->anchor_rel.'" href="'.(JRoute::_($item->flink)).'">'
		              .$item->title.'</a>';
		    }
		  }
		break;
		default:
		break;

	}





	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul aria-labelledby="menu'.$id.'-'.$item->id.'-drop" class="dropdown-menu">';
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else
	{
		echo '</li>';
	}
}
?></ul>
</div>
