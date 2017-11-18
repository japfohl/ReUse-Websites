<?php

$mapJson = Util::buildMapJson($this->data['mapLocs']);

?>

<div class="category-container">
    <div id="category-list-container" class="list-group">
        <p class="side-container-title"><?php echo $this->data['sideListTitle']; ?></p>

        <?php foreach ($this->data['itemsCounts'] as $ic): ?>
        <a href="" class="list-group-item list-item-title">
            <?php echo $ic['name']; ?>
            <span class="badge"><?php echo $ic['item_count']; ?></span>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="category-map-container">
        <div id="map" data-mapLocs='<?php echo htmlentities($mapJson, ENT_QUOTES, 'UTF-8'); ?>'></div>
    </div>
</div>