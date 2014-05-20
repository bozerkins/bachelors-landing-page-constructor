<?php

namespace Lib;

class Page extends \Core\General
{
	const DEFAULT_TITLE = 'No title mentioned';
	
	protected $headerOptions = NULL;
	protected $headerTemplate = 'header.php';
	protected $footerOptions = NULL;
	protected $footerTemplate = 'footer.php';
	protected $bodyOptions = NULL;
	protected $bodyTemplate = NULL;
	
	public function header($options = array())
	{
		if (!array_key_exists('title', $options)) {
			$options['title'] = self::DEFAULT_TITLE;
		}
		if (!array_key_exists('menuItem', $options)) {
			$options['menuItem'] = 'Overview';
		}
		$this->headerOptions = $options;
		$this->headerOptions['menu'] = array(
			array(
				'Overview' => 'admin',	
			),
			array(
				'Groups' => 'admin/groups',
				'Elements' => 'admin/elements',
				'Attributes' => 'admin/attributes',
				'Styles' => 'admin/styles',
			),
			array(
				'Linking' => 'admin/linking',
			),
		);
		$this->headerOptions['base_script_url'] = \Helpers\Url::getBaseUrl() . '/../';
		$this->headerOptions['base_url'] = \Helpers\Url::getBaseUrl() . '/';
		return $this;
	}
	
	public function footer(array $options = array())
	{
		$this->footerOptions = $options;
		return $this;
	}
	
	public function body($template, array $options = array())
	{
		$this->bodyTemplate = $template . '.php';
		$this->bodyOptions = $options;
		return $this;
	}
	
	public function render()
	{
		$this->app->render(
			$this->headerTemplate,
			$this->headerOptions
		);
		$this->app->render(
			$this->bodyTemplate,
			$this->bodyOptions
		);
		$this->app->render(
			$this->footerTemplate,
			$this->footerOptions
		);
		return $this;
	}
}