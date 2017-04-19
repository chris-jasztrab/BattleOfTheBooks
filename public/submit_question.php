<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>


    <title>Form Results</title>

</head>

<body>
<pre>
  <?php
    print_r($_POST);
   ?>

</pre>
</body>
</html>
<?php include("../includes/layouts/footer.php"); ?>
