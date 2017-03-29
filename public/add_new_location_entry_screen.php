<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
  </div>
  <div id="page">
	<h2>Create Location</h2>
  <!-- form for user to input location name -->
		<form action="create_location.php" method="post">
		  <p>Location Name ie. HHPL or MPL:
		    <input type="text" maxlength="10" name="location" value="" />
		  </p>
		  <input type="submit" name="submit" value="Create Location" />
		</form>
		<br />
		<a href="manage_locations.php">Cancel</a>
	</div>
</div>
