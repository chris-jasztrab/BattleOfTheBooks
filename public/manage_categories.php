<?php
  // 1. Create a database connection
  $dbhost = "localhost";
  $dbuser = "battleuser";
  $dbpass = "MPLB@ttle";
  $dbname = "battleofthebooks";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " .
         mysqli_connect_error() .
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>
<?php require_once("../includes/functions.php"); ?>

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

<?php include("../includes/layouts/header.php"); ?>

    <div id="main">
      <div id="navigation">
        &nbsp;
      </div>
      <div id="page">
        <h2>Manage Categories</h2>
        <p>
          Current Locations
        </p>
        <ul>
  <?php
    // 3. Use returned data (if any)
    while($subject = mysqli_fetch_assoc($result)) {
      // output data from each row
  ?>
      <li><?php echo $subject["location_name"]; ?></li>
  <?php
    }
  ?>
  </ul>

      </div>
    </div>
    <?php
    		  // 4. Release returned data
    		  mysqli_free_result($result);
    		?>
<?php include("../includes/layouts/footer.php"); ?>
