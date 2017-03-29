<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>

<!-- this page will display all the current locations in the databse -->
<!-- in a drop down list -->

<?php
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM library";
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
        <h2>Select a location to delete</h2>
        <p>

        </p>
	<form action="delete_location.php" method="post">
  <?php
    // take results and put them into a drop down
		echo "<select name='location_name'>";
		while($location = mysqli_fetch_array($result)) {
			echo "<option value='" . $location['location_name'] . "'>" . $location['location_name'] . "</option>";
		}
		echo "</select>";
  ?>
		<input type="submit" name="submit" value="Delete Location" />
			<p>
      <a href="manage_locations.php">Back to manage locations</a>
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
