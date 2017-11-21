<?php

// save array as json
$mapJson = Util::buildMapJson(array(
    array(
        'type' => 1,
        'locations' => $this->data['repairLocs']
    ),
    array(
        'type' => 0,
        'locations' => $this->data['reuseLocs']
    ),
    array(
        'type' => 2,
        'locations' => $this->data['recycleLocs']
    )
));

?>
    <div class="home-map-container">
        <div id="map" data-mapLocs='<?php echo htmlentities($mapJson, ENT_QUOTES, 'UTF-8'); ?>'>
        </div>
    </div>

    <div class="row marketing description">
        <div class="col-md-3 home-text">
            <h4>Key</h4>
            <p class="pin-label">
                <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|47A6B2"
                     class="pin-icon">
                Repair Services
            </p>
            <p class="pin-label">
                <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|F89420"
                     class="pin-icon">
                Organizations Accepting Items for Reuse
            </p>
            <p class="pin-label">
                <img src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|7C903A"
                     class="pin-icon">
                Recycling Centers
            </p>
        </div>

        <div class="col-md-6 home-text">
            <h4>About</h4>
            <p>
                The purpose of the Corvallis-Area ReUse and Repair Directory is to provide the Corvallis and outlying
                community a way to easily locate organizations that will
                1) take reusable items that can be sold to the public as used items, donated to low-income citizens, or
                used for the organization's programs;
                2) take and repair items;
                3) and take recyclable items.
            </p>
            <p>Donated items should be clean and in good, working condition.</p>
        </div>

        <div class="col-md-3 home-text" id="donor-thanks">
            <h4>Sponsors</h4>

            <?php if (count($this->data['donors']) != 0): ?>
            <p>We appreciate the generosity of the following supporters:</p>
            <ul>
                <?php foreach($this->data['donors'] as $donor): ?>
                <li>
                    <a href="<?php echo Util::formatLinksWithHttp($donor['WebsiteURL']); ?>"
                       data-id="<?php echo $donor['ID']; ?>">
                        <?php echo $donor['Name']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>

            <p>
                If you would like to sponsor the Corvallis-Area ReUse and Repair Directory, please
                <a href="contact.php">letus know</a>. We appreciate your support.
            </p>
        </div>
    </div>
