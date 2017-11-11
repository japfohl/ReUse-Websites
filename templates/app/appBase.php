<?php

// get a reference to the app
$this->getComponent('header.php');

// include the actual template we want
require($this->data['appTemplate']);

// include the page footer
$this->getComponent('footer.php');