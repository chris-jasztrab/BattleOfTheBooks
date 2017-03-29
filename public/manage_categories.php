<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>

<!-- this page will display all the current locations in the database -->

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
        <h2>Manage Categories</h2>
        <p>
          Current Categories
        </p>
        <ul>
  <?php
    // 3. Use returned data (if any)
    while($subject = mysqli_fetch_assoc($result)) {
      // output data from each row
  ?>
      <li><?php echo $subject["category_name"]; ?></li>
  <?php
    }
  ?>
  </ul>
      <a href="add_new_category_entry_screen.php">Add new category</a>
      &nbsp;
			<a href="delete_category_select_screen.php">Delete a category</a>
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
