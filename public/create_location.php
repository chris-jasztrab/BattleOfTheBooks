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
  if (isset($_POST['submit'])) {
    // process the form submission
    $location_name = $_POST["location"];
    // Escape all the strings
    $location_name = mysql_prep($location_name);
    // Insert the data into the database
    $query  = "INSERT INTO library (";
    $query .= " location_name";
    $query .= ") VALUES (";
    $query .= " '{$location_name}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      redirect_to("manage_locations.php");
    }

  } else {
    // this is probably a GET request
    redirect_to("add_new_location.php");
  }
?>

<?php
  // 5. Close database connection
  if (isset($connection)) {
     mysqli_close($connection); }
?>
