<?php

include_once __dir__ . "/../../vendor/autoload.php";
use \Slim\View;

class ViewRenderer extends View {

	// only required function for the view object
	public function render($template, $data = null) {

		if ($this->exists($template)) {

			// render the template
			$this->getTemplate($template);
		}

		// TODO: Handle when template does not exist (Return 404).
	}

	private function exists($template) {

		return file_exists(__DIR__ . "/../../templates/$template");
	}

	private function getTemplate($template) {

		require(__DIR__ . "/../../templates/$template");
	}

	public function getComponent($component) {

		require (__DIR__ . "/../../templates/components/$component");
	}
}