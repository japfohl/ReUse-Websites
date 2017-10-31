<!DOCTYPE html>
<html lang="en">
<head>
	<!--  These three tags must come first  -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--  Logo / Title  -->
	<link rel="icon" href="img/CSCLogo.png">
	<title>The Corvallis Reuse and Repair Directory</title>

	<!-- CSS -->
	<link rel="stylesheet"
		  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
		  crossorigin="anonymous">
	<link rel="stylesheet"
		  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="css/jumbotron-narrow.css" rel="stylesheet">
	<link href="css/publicSite.css" rel="stylesheet">
	<link href="css/map.css" rel="stylesheet">
</head>

<body>

<div class="container">

	<div class="header clearfix">
		<nav>
<<<<<<< HEAD
			<form action="searchPage.php" method="GET">
				<div class="input-group" style="width:250px">
					<input id="searchTerm" type="text" class="form-control" placeholder="Search" name="term"/>
					<span class="input-group-addon">
						<i class="fa fa-search"></i>
					</span>
				</div>
			</form>
=======
			<div id="searchText" class="input-group" style="width: 250px">
				<input id="searchTerm" type="text" class="form-control" placeholder="Search"/>
				<span class="input-group-addon">
					<i class="fa fa-search"></i>
				</span>
			</div>
>>>>>>> initial working version of home
			<ul class="nav nav-pills pull-right">
				<li role="presentation" class="dropdown header-button">
					<a href="category.php?type=repair" class="dropbtn header-link">
						Repair <span class="caret"></span>
					</a>
					<div class="dropdown-content" id="header-repair-links">
<<<<<<< HEAD
					<?php foreach ($this->data['repair'] as $repair): ?>

						<a href="category.php?type=repair&name=<?php echo rawurlencode($repair['name']); ?>">
							<?php echo $repair['name']; ?>
						</a>
						
					<?php endforeach; ?>
=======
>>>>>>> initial working version of home
					</div>
				</li>
				<li role="presentation" class="dropdown header-button">
					<a href="category.php?type=reuse" class="dropbtn header-link">
						Reuse <span class="caret"></span>
					</a>
					<div class="dropdown-content" id="header-reuse-links">
<<<<<<< HEAD
					<?php foreach ($this->data['reuse'] as $reuse): ?>

						<a href="category.php?type=reuse&name=<?php echo rawurlencode($reuse['name']); ?>">
							<?php echo $reuse['name']; ?>
						</a>

					<?php endforeach; ?>
=======
>>>>>>> initial working version of home
					</div>
				</li>
				<li role="presentation" class="dropdown header-button">
					<a href="recycle.php" class="dropbtn header-link">
						Recycle <span class="caret"></span>
					</a>
					<div class="dropdown-content" id="header-recycle-links">
<<<<<<< HEAD
					<?php foreach($this->data['recycle'] as $recycle): ?>

						<a href="business.php?name=<?php echo rawurlencode($recycle['name']); ?>">
							<?php echo $recycle['name']; ?>
						</a>

					<?php endforeach; ?>
=======
>>>>>>> initial working version of home
					</div>
				</li>
				<li role="presentation" class="header-button">
					<a href="about.php" class="header-link">About</a>
				</li>
				<li role="presentation" class="header-button">
					<a href="contact.php" class="header-link">Contact</a>
				</li>
				<li role="presentation" class="header-button">
					<a href="admin/loginPage.php" class="header-link">Admin</a>
				</li>
				<li role="presentation" class="header-button">
					<a href="http://sustainablecorvallis.org/"
					   target="_blank"
					   class="header-link">
						<img id="header-icon" src="img/CSCRectangular.png">
					</a>
				</li>
			</ul>
			<a href ="home/index.php">
				<img align="left" id="header-icon" src="img/CSCLogo.png">
				<h3 class="text-muted" id="header-title">Corvallis-Area ReUse and Repair Directory</h3>
			</a>
		</nav>
	</div>