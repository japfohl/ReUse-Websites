<?php

// get a reference to the app
$this->getComponent('appHeader.php');

// include the actual template we want
require($this->data['appTemplate']);

// include the page footer
$this->getComponent('appFooter.php');