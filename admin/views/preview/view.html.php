<?php
defined('_JEXEC') or die;

class TutorialViewPreview extends JViewLegacy
{
	protected $items;

	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');

		TutorialHelper::addSubmenu('preview');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();

		$j3css = <<<ENDCSS
div#toolbar div#toolbar-back button.btn span.icon-back::before {
	content: "";
}
.tutorial_title{
	color: #555555;
	font-family: 'Titillium Maps',Arial;
	font-size: 14pt;
}
.mytutorial{
	padding-bottom: 20px;
	float: left;
	padding-right: 20px;
}
.tutorial_element{
	width: 150px;
	padding-top: 2px;
}
ENDCSS;
		JFactory::getDocument()->addStyleDeclaration($j3css);

		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		$state	= $this->get('State');
		$canDo	= TutorialHelper::getActions();
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_TUTORIAL_MANAGER_TUTORIALS'), '');

		JToolbarHelper::back('COM_TUTORIAL_BUTTON_BACK', 'index.php?option=com_tutorial');

	}

}