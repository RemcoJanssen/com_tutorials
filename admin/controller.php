<?php
defined('_JEXEC') or die;

class TutorialController extends JControllerLegacy
{
	protected $default_view = 'tutorials';

	public function display($cachable = false, $urlparams = false)
	{
		require_once JPATH_COMPONENT.'/helpers/tutorial.php';

		$view   = $this->input->get('view', 'tutorials');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		if ($view == 'tutorial' && $layout == 'edit' && !$this->checkEditId('com_tutorial.edit.tutorial', $id))
		{
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_tutorial&view=tutorials', false));

			return false;
		}

		parent::display();

		return $this;
	}
}