<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<<?php
  if (isset($_POST['submit'])) {
    // process the form submission
    $category_name = $_POST["category"];
    // Escape all the strings
    $category_name = mysql_prep($category_name);
    // Insert the data into the database
    $query  = "INSERT INTO category (";
    $query .= " category_name";
    $query .= ") VALUES (";
    $query .= " '{$category_name}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      // Success
      redirect_to("manage_categories.php");
    }

  } else {
    // this is probably a GET request
    redirect_to("add_new_category_entry_screen.php");
  }
?>
<?php
  // 5. Close database connection
  if (isset($connection)) {
     mysqli_close($connection); }
?>
