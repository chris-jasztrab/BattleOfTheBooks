<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
  </div>
  <div id="page">
	<h2>Create a level</h2>
  <!-- form for user to input category name -->
		<form action="create_level.php" method="post">
		  <p>Level Name ie. Junior, Senior, etc:
		    <input type="text" maxlength="30" name="level" value="" />
		  </p>
		  <input type="submit" name="submit" value="Create Level" />
		</form>
		<br />
		<a href="manage_levels.php">Cancel</a>
	</div>
</div>
