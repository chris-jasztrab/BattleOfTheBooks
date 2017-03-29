<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>

<!-- this page will display all the current locations in the database -->
<!-- in a drop down list -->

<?php
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM category";
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>
    <div id="main">
      <div id="navigation">
        &nbsp;
      </div>
      <div id="page">
        <h2>Select a category to delete</h2>
        <p>

        </p>
	<form action="delete_category.php" method="post">
  <?php
    // take results and put them into a drop down
		echo "<select name='category_name'>";
		while($category = mysqli_fetch_array($result)) {
			echo "<option value='" . $category['category_name'] . "'>" . $category['category_name'] . "</option>";
		}
		echo "</select>";
  ?>
		<input type="submit" name="submit" value="Delete category" />
			<p>
      <a href="manage_categories.php">Back to manage categories</a>
      &nbsp;
      <a href="admin.php">Back to admin Menu</a>
      </p>
      </div>

    </div>
    <?php
    		  // 4. Release returned data
    		  mysqli_free_result($result);
    		?>
<?php include("../includes/layouts/footer.php"); ?>
