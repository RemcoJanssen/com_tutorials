<?php
defined('_JEXEC') or die;

class TutorialModelPreview extends JModelList
{
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'title', 'a.title',
				'state', 'a.state',
				'company', 'a.company',
				'url', 'a.url',
				'description', 'a.description',
				'ordering', 'a.ordering'
			);
		}

		parent::__construct($config);
	}

	protected function getListQuery()
	{
		$db		= $this->getDbo();
		$query	= $db->getQuery(true);

		$query->select(
			$this->getState(
				'list.select',
				'a.id, a.title,' .
				'a.state, a.company,' .
				'a.image, a.url, a.ordering,' .
				'a.phone, a.description'
			)
		);
		$query->from($db->quoteName('#__tutorial').' AS a');

		$query->where('(a.state IN (0, 1))');



		return $query;
	}
}
