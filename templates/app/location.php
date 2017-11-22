<?php

$mapJson = Util::buildMapJson([[
    'type' => 0,
    'locations' => $this->data['locInfo']
]]);
$loc = $this->data['locInfo'][0];

?>

<div class="business-container">
    <div id="business-info-container">
        <p class="side-container-title">
            <?php echo $loc['name']; ?>
        </p>
        <div id="contact-container" class="list-group-item">

            <p class="side-container-subtitle">Contact</p>

            <?php if ($loc['address_line_1'] !== null && $loc['address_line_1'] != "null"): ?>
                <!-- address -->
                <p class="list-group-item-text">
                    <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&amp;chld=%E2%80%A2|F89420" class="pin-icon">
                    <?php echo $loc['address_line_1']; ?>
                </p>
                <p class="second-line-address">
                    <?php echo $loc['city'] . ", " . $loc['abbreviation'] . " " . $loc['zip_code']; ?>
                </p>
            <?php endif; ?>

            <?php if ($loc['phone'] !== null && $loc['phone'] != "null"): ?>
                <!-- phone number -->
                <p class="list-group-item-text">
                    <i class="zmdi zmdi-phone"></i>
                    <?php echo $loc['phone']; ?>
                </p>
            <?php endif; ?>

            <?php if ($loc['website'] !== null && $loc['website'] != "null"): ?>
                <!-- website -->
                <a href="<?php echo $loc['website']; ?>" class="list-group-item-text location-website-link">
                    <i class="zmdi zmdi-globe"></i>
                    <?php echo $loc['website']; ?>
                </a>
            <?php endif; ?>
        </div>

        <?php if ((count($this->data['locItems']['repair']) > 0)
               || (count($this->data['locItems']['reuse']) > 0)
               || (count($this->data['locItems']['recycle']) > 0)): ?>
        <div id="services-container" class="list-group-item">

            <p class="side-container-subtitle">Services</p>

            <?php if (count($this->data['locItems']['reuse']) > 0): ?>
            <p class="list-group-item-text"><strong>Reuses:</strong></p>
            <ul>
                <?php foreach ($this->data['locItems']['reuse'] as $item): ?>
                    <li><?php echo $item['item_name']; ?> - <small><em><?php echo $item['cat_name']; ?></em></small></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if (count($this->data['locItems']['repair']) > 0): ?>
            <p class="list-group-item-text"><strong>Repairs:</strong></p>
            <ul>
                <?php foreach ($this->data['locItems']['repair'] as $item): ?>
                    <li><?php echo $item['item_name']; ?> - <small><em><?php echo $item['cat_name']; ?></em></small></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if (count($this->data['locItems']['recycle']) > 0): ?>
            <p class="list-group-item-text"><strong>Recycles:</strong></p>
            <ul>
                <?php foreach ($this->data['locItems']['recycle'] as $item): ?>
                    <li><?php echo $item['item_name']; ?> - <small><em><?php echo $item['cat_name']; ?></em></small></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

        </div>
        <?php endif; ?>

    </div>

    <div class="business-map-container">
        <div id="map" data-mapLocs='<?php echo htmlentities($mapJson, ENT_QUOTES, 'UTF-8'); ?>'></div>
    </div>
</div>