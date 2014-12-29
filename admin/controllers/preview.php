<?php
defined('_JEXEC') or die;

class TutorialControllerPreview extends JControllerAdmin
{
	public function getModel($name = 'Preview', $prefix = 'TutorialModel', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);
		return $model;
	}
}