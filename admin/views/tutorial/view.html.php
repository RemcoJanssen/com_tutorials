<?php
defined('_JEXEC') or die;

class TutorialViewTutorial extends JViewLegacy
{
	protected $item;

	protected $form;

	public function display($tpl = null)
	{
		$this->item		= $this->get('Item');
		$this->form		= $this->get('Form');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
		$userId		= $user->get('id');
		$isNew		= ($this->item->id == 0);
		$canDo		= TutorialHelper::getActions($this->item->catid, 0);

		JToolbarHelper::title(JText::_('COM_TUTORIAL_MANAGER_TUTORIAL'), '');

		if ($canDo->get('core.edit')||(count($user->getAuthorisedCategories('com_tutorial', 'core.create'))))
		{
			JToolbarHelper::apply('tutorial.apply');
			JToolbarHelper::save('tutorial.save');
		}
		if (count($user->getAuthorisedCategories('com_tutorial', 'core.create'))){
			JToolbarHelper::save2new('tutorial.save2new');
		}
		// If an existing item, can save to a copy.
		if (!$isNew && (count($user->getAuthorisedCategories('com_tutorial', 'core.create')) > 0))
		{
			JToolbarHelper::save2copy('tutorial.save2copy');
		}

		if (empty($this->item->id))
		{
			JToolbarHelper::cancel('tutorial.cancel');
		}
		else
		{
			JToolbarHelper::cancel('tutorial.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}