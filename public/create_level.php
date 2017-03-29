<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<<?php
  if (isset($_POST['submit'])) {
    // process the form submission
    $level_name = $_POST["level"];
    // Escape all the strings
    $level_name = mysql_prep($level_name);
    // Insert the data into the database
    $query  = "INSERT INTO levels (";
    $query .= " level_name";
    $query .= ") VALUES (";
    $query .= " '{$level_name}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      redirect_to("manage_levels.php");
    }

  } else {
    // this is probably a GET request
    redirect_to("add_new_level_entry_screen.php");
  }
?>
<?php
  // 5. Close database connection
  if (isset($connection)) {
     mysqli_close($connection); }
?>
