<nav class="navbar navbar-expand-lg navbar-dark fixed-top border-bottom  bg-dark">
	<div class="container">
		<a class="navbar-brand page-scroll" href="#page-top">
			<img src="res/database_logo.png" alt="NSTU" height="32px" width="32px">
		</a><span class="brand-name">BPND</span>
		<button class="navbar-toggler" id="menu-toggle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon" id="changeToggleIcon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto mt-2 mt-lg-0 py-2">
				<!-- History -->
					<?php
					 if (isset($_SESSION['id'])) {
						?>
				<li class='nav-item'>
					<a class='nav-link' href='index.php'>Home</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='download.php'>Downloads</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='about.php'>About Dataset</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='pos_tagger_ui.php'>Contribute Dataset</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='logout.php'>Sign Out <?php echo $_SESSION['name']; ?></a>
				</li>
				<?php
				} else {
				?>
				<li class='nav-item'>
					<a class='nav-link' href='index.php'>Home</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='download.php'>Downloads</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='about.php'>About Dataset</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='login.php'>Sign In</a>
				</li>

				<?php
				}
				?>
			</ul>
		</div>
	</div>
</nav>
