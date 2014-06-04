<?php

namespace Core;

class ControllerAjax extends ControllerClient
{
	protected $pageRecord = NULL;
	protected $pageId = NULL;
	public function __construct() {
		parent::__construct();
		$pageId = array_key_exists('pageId', $_REQUEST) ? intval($_REQUEST['pageId']) : NULL;
		$mdlPage = new \Mdl\Page();
		$pageRecord = $mdlPage->one($pageId);
		if (!$pageRecord) {
			echo 'Invalid page id passed';
			return;
		}
		$this->pageRecord = $pageRecord;
		$this->pageId = $pageId;
	}
}