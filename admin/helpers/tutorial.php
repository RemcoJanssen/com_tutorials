<?php
defined('_JEXEC') or die;

class TutorialHelper
{
	public static function getActions($categoryId = 0)
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		if (empty($categoryId))
		{
			$assetName = 'com_tutorial';
			$level = 'component';
		}
		else
		{
			$assetName = 'com_tutorial.category.'.(int) $categoryId;
			$level = 'category';
		}

		$actions = JAccess::getActions('com_tutorial', $level);

		foreach ($actions as $action)
		{
			$result->set($action->name,	$user->authorise($action->name, $assetName));
		}

		return $result;
	}

	public static function addSubmenu($vName = 'tutorials')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_TUTORIAL_SUBMENU_TUTORIALS'),
			'index.php?option=com_tutorial&view=tutorials',
			$vName == 'tutorials'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_TUTORIAL_SUBMENU_CATEGORIES'),
			'index.php?option=com_categories&extension=com_tutorial',
			$vName == 'categories'
		);
		if ($vName == 'categories')
		{
			JToolbarHelper::title(
				JText::sprintf('COM_CATEGORIES_CATEGORIES_TITLE', JText::_('com_tutorial')),
				'tutorials-categories');
		}
		JHtmlSidebar::addEntry(
			JText::_('COM_TUTORIAL_SUBMENU_PREVIEW'),
			'index.php?option=com_tutorial&view=preview',
			$vName == 'preview'
		);
	}
}