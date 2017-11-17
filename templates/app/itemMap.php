<?php

$mapJson = Util::buildMapJson($this->data['mapLocs']);

?>

<div class="category-container">
    <div id="category-list-container">
        <p class="side-container-title"></p>
    </div>

    <div class="category-map-container">
        <div id="map" data-mapLocs='<?php echo htmlentities($mapJson, ENT_QUOTES, 'UTF-8'); ?>'></div>
    </div>
</div>