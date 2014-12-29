<?php
defined('_JEXEC') or die;

class com_tutorialInstallerScript
{
	function install($parent)
	{
		$parent->getParent()->setRedirectURL('index.php?option=com_tutorial');
	}

	function uninstall($parent)
	{
		echo '<p>' . JText::_('COM_TUTORIAL_UNINSTALL_TEXT') . '</p>';
	}

	function update($parent)
	{
		echo '<p>' . JText::_('COM_TUTORIAL_UPDATE_TEXT') . '</p>';
	}

	function preflight($type, $parent)
	{
		echo '<p>' . JText::_('COM_TUTORIAL_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}

	function postflight($type, $parent)
	{
		echo '<p>' . JText::_('COM_TUTORIAL_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}