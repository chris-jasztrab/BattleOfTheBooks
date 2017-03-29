<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
  if (isset($_POST['submit'])) {
    // process the form submission
    echo "Processing form";
    $location_name = $_POST["location_name"];
    // Escape all the strings
    echo "Escaping Strings";
    $location_name = mysql_prep($location_name);
    // Delete the data into the database
    echo "Doing SQL Query";
    $query  = "DELETE FROM library";
    $query .= " WHERE location_name";
    $query .= " ='{$location_name}'";

    echo "<p>";
    $result = mysqli_query($connection, $query);
    echo $query;
    echo "after result";
    if ($result) {
      // Success
      redirect_to("manage_locations.php");
    }

  } else {
    // this is probably a GET request
    redirect_to("manage_locations.php");
  }
?>
<?php
  // 5. Close database connection
  if (isset($connection)) {
     mysqli_close($connection); }
?>
