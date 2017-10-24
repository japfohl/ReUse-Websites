<?php

include_once __dir__ . "/../../vendor/autoload.php";
use \Slim\View;

class ViewRenderer extends View {

	// only required function for the view object
	public function render($template) {
		include($template);
	}
}