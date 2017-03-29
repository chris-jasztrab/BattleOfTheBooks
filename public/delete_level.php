<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
  if (isset($_POST['submit'])) {
    // process the form submission
    echo "Processing form";
    $level_name = $_POST["level_name"];
    // Escape all the strings
    echo "Escaping Strings";
    $level_name = mysql_prep($level_name);
    // Delete the data into the database
    echo "Doing SQL Query";
    $query  = "DELETE FROM levels";
    $query .= " WHERE level_name";
    $query .= " ='{$level_name}'";

    echo "<p>";
    $result = mysqli_query($connection, $query);
    echo $query;
    echo "after result";
    if ($result) {
      // Success
      redirect_to("manage_levels.php");
    }

  } else {
    // this is probably a GET request
    redirect_to("manage_levels.php");
  }
?>
<?php
  // 5. Close database connection
  if (isset($connection)) {
     mysqli_close($connection); }
?>
