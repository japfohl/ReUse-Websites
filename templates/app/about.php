<div class="about-container">
	<h1 class="center-title">About the Corvallis-Area ReUse and Repair Directory</h1>
	<div class="about-information">
		<img class="about-image" src="../img/bigstockphoto_Footprint.jpg">
		<div id = "about-purpose">
			<h2>Our Purpose</h2>
			<p >The purpose of the Corvallis-Area ReUse and Repair Directory is to provide Corvallis and the outlying community a way to easily locate organizations that will take the following:<p>
			<ul>
				<li>Items for repair</li>
				<li>Reusable items that can be re-sold to the public as used items, donated to low-income citizens, or used for the organization's programs</li>
				<li>Recyclable items</li>
			</ul>
			<p >Please note that reusable items may either be donated or sold on consignment.  Donated items should be clean and in good, working condition.<p>
			<p >To add an organization or service to the directory or to update information included in the directory, <a href="contact.php">contact us with the relevant details</a>.</p>
		</div>
		<div id = "about-donors">
            <h2>Our Donors</h2>

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
                <a href="contact.php">let us know</a>.
            </p>
		</div>
	</div>
</div>