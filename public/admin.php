<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>

    <div id="main">
      <div id="navigation">
        &nbsp;
      </div>
      <div id="page">
        <h2>Admin Menu</h2>
        <p>
          Welcome to the admin area
        </p>
        <ul>
          <li>
            <a href="manage_categories.php">Manage BOB Categories</a>
          </li>
          <li>
            <a href="manage_users.php">Manage Users</a>
          </li>
          <li>
            <a href="manage_locations.php">Manage Locations</a>
          </li>
          <li>
            <a href="manage_levels.php">Manage Levels</a>
          </li>
          <li>
            <a href="index.php">Exit Admin Area</a>
          </li>
          <li>
            <a href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>

<?php include("../includes/layouts/footer.php"); ?>
