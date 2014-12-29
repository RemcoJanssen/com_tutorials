<?php
defined('_JEXEC') or die;

class TutorialViewTutorials extends JViewLegacy
{
	protected $items;

	protected $state;

	protected $pagination;

	public function display($tpl = null)
	{
		$this->items		= $this->get('Items');
		$this->state		= $this->get('State');
		$this->pagination	= $this->get('Pagination');

		TutorialHelper::addSubmenu('tutorials');

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode("\n", $errors));
			return false;
		}

		$this->addToolbar();
		$this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	protected function addToolbar()
	{
		$state	= $this->get('State');

		$canDo	= TutorialHelper::getActions($state->get('filter.category_id'));

		$user	= JFactory::getUser();
		$bar = JToolBar::getInstance('toolbar');

		JToolbarHelper::title(JText::_('COM_TUTORIAL_MANAGER_TUTORIALS'), '');

		if (count($user->getAuthorisedCategories('com_tutorial', 'core.create')) > 0)
		{
			JToolbarHelper::addNew('tutorial.add');
		}

		if ($canDo->get('core.edit'))
		{
			JToolbarHelper::editList('tutorial.edit');
		}
		if ($canDo->get('core.edit.state')) {

			JToolbarHelper::publish('tutorials.publish', 'JTOOLBAR_PUBLISH', true);
			JToolbarHelper::unpublish('tutorials.unpublish', 'JTOOLBAR_UNPUBLISH', true);

			JToolbarHelper::archiveList('tutorials.archive');
			JToolbarHelper::checkin('tutorials.checkin');
		}
		$state	= $this->get('State');
		if ($state->get('filter.state') == -2 && $canDo->get('core.delete'))
		{
			JToolbarHelper::deleteList('', 'tutorials.delete', 'JTOOLBAR_EMPTY_TRASH');
		} elseif ($canDo->get('core.edit.state'))
		{
			JToolbarHelper::trash('tutorials.trash');
		}
		if ($canDo->get('core.admin'))
		{
			JToolbarHelper::preferences('com_tutorial');
		}

		JHtmlSidebar::setAction('index.php?option=com_tutorial&view=tutorials');

		JHtmlSidebar::addFilter(
			JText::_('JOPTION_SELECT_PUBLISHED'),
			'filter_state',
			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), 'value', 'text', $this->state->get('filter.state'), true)
		);
	}

	protected function getSortFields()
	{
		return array(
			'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
			'a.state' => JText::_('JSTATUS'),
			'a.title' => JText::_('JGLOBAL_TITLE'),
			'a.id' => JText::_('JGRID_HEADING_ID')
		);
	}
}