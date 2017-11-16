<?php

$mapJson = Util::buildMapJson($this->data['mapLocs']);

?>

<div class="category-container">
    <div id="category-list-container" class="list-group">
        <p class="side-container-title"><?php echo $this->data['sideListTitle']; ?></p>

        <?php foreach ($this->data['itemsCounts'] as $ic): ?>
        <a href="<?php echo "/locations?type=" . $this->data['itemType'] . "&item=" . $ic['item_id'] . "&category=" . $ic['cat_id'];?>"
           class="list-group-item">
            <strong class="list-group-item-heading"><?php echo $ic['item_name']; ?></strong>
            <?php if($this->data['showItemCats']): ?>
                <small><em class="list-group-item-text"> - <?php echo $ic['cat_name'] ?></em></small>
            <?php endif; ?>
            <span class="badge"><?php echo $ic['item_count']; ?></span>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="category-map-container">
        <div id="map" data-mapLocs='<?php echo htmlentities($mapJson, ENT_QUOTES, 'UTF-8'); ?>'></div>
    </div>
</div>