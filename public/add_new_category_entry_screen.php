<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
  <div id="navigation">
  </div>
  <div id="page">
	<h2>Create a question category</h2>
  <!-- form for user to input category name -->
		<form action="create_category.php" method="post">
		  <p>Category Name ie. Canadian, Mystery, etc:
		    <input type="text" maxlength="30" name="category" value="" />
		  </p>
		  <input type="submit" name="submit" value="Create Category" />
		</form>
		<br />
		<a href="manage_categories.php">Cancel</a>
	</div>
</div>
