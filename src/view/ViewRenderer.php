<?php

include_once __dir__ . "/../../vendor/autoload.php";
use \Slim\View;

class ViewRenderer extends View {

	// only required function for the view object
	public function render($template, $data = null) {
		if ($this->exists($template)) {
			$this->getTemplate($template);
		}
	}

	private function exists($template) {
		return file_exists(__DIR__ . "/../../templates/$template");
	}

	private function getTemplate($template) {
		require(__DIR__ . "/../../templates/$template");
	}
}