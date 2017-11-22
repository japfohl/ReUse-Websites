<!DOCTYPE html>
<html lang="en">
<head>
	<!--  These three tags must come first  -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--  Logo / Title  -->
	<link rel="icon" href="/img/CSCLogo.png">
	<title>The Corvallis Reuse and Repair Directory</title>

	<!-- External CSS -->
	<link rel="stylesheet"
		  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
		  crossorigin="anonymous">
	<link rel="stylesheet"
		  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Internal application CSS -->
    <link rel="stylesheet" href="/css/app.min.css">

    <?php if ($this->data['cssSpecial']): ?>
        <?php foreach ($this->data['cssSpecial'] as $css): ?>
            <!-- Inject custom CSS if there is any -->
            <link rel="stylesheet" href="<?php echo $css; ?>">
        <?php endforeach; ?>
    <?php endif; ?>


</head>

<body>
    <div class="container">
        <div class="header clearfix">
            <nav>
                <form action="/search" method="GET">
                    <div class="input-group" style="width:250px">
                        <input id="searchTerm" type="text" class="form-control" placeholder="Search" name="q"/>
                        <span class="input-group-addon">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </form>
                <ul class="nav nav-pills pull-right">
                    <li role="presentation" class="dropdown header-button">
                        <a href="/items?type=1" class="dropbtn header-link">
                            Repair <span class="caret"></span>
                        </a>
                        <div class="dropdown-content" id="header-repair-links">
                        <?php foreach ($this->data['repairCats'] as $r): ?>
                            <a href="/items?type=1&category=<?php echo rawurlencode($r['id']); ?>">
                                <?php echo $r['name']; ?>
                            </a>
                        <?php endforeach; ?>
                        </div>
                    </li>
                    <li role="presentation" class="dropdown header-button">
                        <a href="/items?type=0" class="dropbtn header-link">
                            Reuse <span class="caret"></span>
                        </a>
                        <div class="dropdown-content" id="header-reuse-links">
                        <?php foreach ($this->data['reuseCats'] as $r): ?>
                            <a href="/items?type=0&category=<?php echo rawurlencode($r['id']); ?>">
                                <?php echo $r['name']; ?>
                            </a>
                        <?php endforeach; ?>
                        </div>
                    </li>
                    <li role="presentation" class="dropdown header-button">
                        <a href="/locations?type=2" class="dropbtn header-link">
                            Recycle <span class="caret"></span>
                        </a>
                        <div class="dropdown-content" id="header-recycle-links">
                        <?php foreach($this->data['recycleLocs'] as $r): ?>
                            <a href="/location/<?php echo rawurlencode($r['id']); ?>">
                                <?php echo $r['name']; ?>
                            </a>
                        <?php endforeach; ?>
                        </div>
                    </li>
                    <li role="presentation" class="header-button">
                        <a href="/about" class="header-link">About</a>
                    </li>
                    <li role="presentation" class="header-button">
                        <a href="/contact" class="header-link">Contact</a>
                    </li>
                    <li role="presentation" class="header-button">
                        <a href="/admin/loginPage.php" class="header-link">Admin</a>
                    </li>
                    <li role="presentation" class="header-button">
                        <a href="http://sustainablecorvallis.org/"
                           target="_blank"
                           class="header-link">
                            <img id="header-icon" src="/img/CSCRectangular.png">
                        </a>
                    </li>
                </ul>
                <a href ="/">
                    <img align="left" id="header-icon" src="/img/CSCLogo.png">
                    <h3 class="text-muted" id="header-title">Corvallis-Area ReUse and Repair Directory</h3>
                </a>
            </nav>
	    </div>