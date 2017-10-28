<?php

include_once __dir__ . "/../../vendor/autoload.php";
use \Slim\View;

class ViewRenderer extends View {

	// only required function for the view object
	public function render($template, $data = null) {

		if ($this->exists($template)) {

			// show the header if not an admin template
			if (!$this->data['isAdminTemplate']) {
				$this->getComponent("header.php");
			}

			// render the template
			$this->getTemplate($template);

			// show the footer if not an admin template
			if (!$this->data['isAdminTemplate']) {
				$this->getComponent("footer.php");
			}
		}

		// TODO: Handle when template does not exist (Return 404).
	}

	private function exists($template) {

		return file_exists(__DIR__ . "/../../templates/$template");
	}

	private function getTemplate($template) {

		require(__DIR__ . "/../../templates/$template");
	}

	private function getComponent($component) {

		require (__DIR__ . "/../../templates/components/$component");
	}
}