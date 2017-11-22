<?php

$mapJson = Util::buildMapJson($this->data['locations']);
$locations = $this->data['locations'][0]['locations'];

?>

<div class="item-container">
    <div id="item-list-container">
        <p class="side-container-title"><?php echo $this->data['sideListTitle'] ?></p>
        <?php foreach($locations as $loc): ?>
            <div class="list-group-item" style="position:relative;">
                <!-- hidden link to convert div into clickable link -->
                <a href="/location/<?php echo $loc['id']; ?>"><span class="hidden-link-span"></span></a>

                <!-- location name -->
                <p class="list-group-item-text list-item-title"><?php echo $loc['name']; ?></p>

                <?php if ($loc['address_line_1'] != null && $loc['address_line_1'] != "null"): ?>
                <!-- address -->
                <p class="list-group-item-text">
                    <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&amp;chld=%E2%80%A2|F89420" class="pin-icon">
                    <?php echo $loc['address_line_1']; ?>
                </p>
                <p class="second-line-address">
                    <?php echo $loc['city'] . ", " . $loc['abbreviation'] . " " . $loc['zip_code']; ?>
                </p>
                <?php endif; ?>

                <?php if ($loc['phone'] != null && $loc['phone'] != "null"): ?>
                <!-- phone number -->
                <p class="list-group-item-text">
                    <i class="zmdi zmdi-phone"></i>
                    <?php echo $loc['phone']; ?>
                </p>
                <?php endif; ?>

                <?php if ($loc['website'] != null && $loc['website'] != "null"): ?>
                <!-- website -->
                <a href="<?php echo $loc['website']; ?>" class="list-group-item-text location-website-link">
                    <i class="zmdi zmdi-globe"></i>
                    <?php echo $loc['website']; ?>
                </a>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>

    <div class="item-map-container">
        <div id="map" data-mapLocs='<?php echo htmlentities($mapJson, ENT_QUOTES, 'UTF-8'); ?>'></div>
    </div>
</div>