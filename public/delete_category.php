<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
  if (isset($_POST['submit'])) {
    // process the form submission
    echo "Processing form";
    $category_name = $_POST["category_name"];
    // Escape all the strings
    echo "Escaping Strings";
    $category_name = mysql_prep($category_name);
    // Delete the data into the database
    echo "Doing SQL Query";
    $query  = "DELETE FROM category";
    $query .= " WHERE category_name";
    $query .= " ='{$category_name}'";

    echo "<p>";
    $result = mysqli_query($connection, $query);
    echo $query;
    echo "after result";
    if ($result) {
      // Success
      redirect_to("manage_categories.php");
    }

  } else {
    // this is probably a GET request
    redirect_to("manage_categories.php");
  }
?>
<?php
  // 5. Close database connection
  if (isset($connection)) {
     mysqli_close($connection); }
?>
