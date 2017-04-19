<?php require_once("../includes/functions.php"); ?>
<?php include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php

  $DS = DIRECTORY_SEPARATOR;
  file_exists(__DIR__ . $DS . 'core' . $DS . 'Handler.php') ? require_once __DIR__ . $DS . 'core' . $DS . 'Handler.php' : die('Handler.php not found');
  file_exists(__DIR__ . $DS . 'core' . $DS . 'Config.php') ? require_once __DIR__ . $DS . 'core' . $DS . 'Config.php' : die('Config.php not found');
  use AjaxLiveSearch\core\Config;
  use AjaxLiveSearch\core\Handler;
  if (session_id() == '') {
      session_start();
  }
  $handler = new Handler();
  $handler->getJavascriptAntiBot();
?>

<!-- query database to get levels and categories -->
<?php
	// 2. Perform database query
	$query  = "SELECT * ";
	$query .= "FROM category";
	$result = mysqli_query($connection, $query);
	// Test if there was a query error
	if (!$result) {
		die("Database query failed.");
	}
?>

<?php
	// 2. Perform database query to get levels
	$levelquery  = "SELECT * ";
	$levelquery .= "FROM levels";
	$levelresult = mysqli_query($connection, $levelquery);
	// Test if there was a query error
	if (!$levelresult) {
		die("Database query failed.");
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="description"
          content="AJAX Live Search is a PHP search form that similar to Google Autocomplete feature displays the result as you type">
    <meta name="keywords"
          content="Ajax Live Search, Autocomplete, Auto Suggest, PHP, HTML, CSS, jQuery, JavaScript, search form, MySQL, web component, responsive">
    <meta name="author" content="Ehsan Abbasi">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"/>
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/animation.css">
    <link rel="stylesheet" type="text/css" href="css/ajaxlivesearch.min.css">
    <!--[if IE 7]>
    <link rel="stylesheet" href="css/fontello-ie7.css">
    <![endif]-->
    <title>Enter in a question</title>
    <!-- Live Search Styles -->



</head>
<body>
  <form class="form-horizontal" action="create_question_p2.php" method="post">
    <fieldset>
      <legend>Submit a question</legend>

      <!-- Get Title -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="title">Title</label>
        <div class="col-md-4">
          <input id="title" name="title" placeholder="" class="form-control" required="" type="text">
        </div>
      </div>

      <!-- Get Authors First Name - Ajax Query -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="author_first_name">Author&#8217;s First Name</label>
        <div class="col-md-4">
          <div style="clear: both">
          <!--  <input type="text" class="mySearch" id="ls_query" name="author_first_name">-->
              <input type="text" class="form-control" id="author_first_name" name="author_first_name">
          </div>
        </div>
      </div>

      <!-- Get Authors Last Name - Ajax Query -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="author_last_name">Author&#8217;s Last Name</label>
        <div class="col-md-4">
          <div style="clear: both">
            <input type="text" class='mySearch' id="ls_query_2" name="author_last_name">
          </div>
        </div>
      </div>

      <!-- Get Publication Year -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="book_publication_year">Publication Year</label>
        <div class="col-md-2">
          <input id="book_publication_year" maxlength="4" name="book_publication_year" placeholder="" class="form-control input-md" type="text">
        </div>
      </div>

      <!-- Get Category - Results populated from database -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="question_category">Question Category<br>Hold CTRL to choose multiple</label>
          <div class="col-md-4">
            <?php
              // take results and put them into a drop down
              echo "<select id='question_category' name='question_category' class='form-control' multiple='multiple' size='10'>";
              while($category = mysqli_fetch_array($result)) {
                echo "<option value='" . $category['category_name'] . "'>" . $category['category_name'] . "</option>";
              }
              echo "</select>";
              ?>
          </div>
      </div>

        <!-- Get Question Level - Results populated from database -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="level">Level</label>
        <div class="col-md-4">
          <?php
            // take results and put them into a drop down
            echo "<select id='question_level' name='question_level' class='form-control' multiple='multiple'>";
            while($level = mysqli_fetch_array($levelresult)) {
              echo "<option value='" . $level['level_name'] . "'>" . $level['level_name'] . "</option>";
            }
            echo "</select>";
            ?>
        </div>
      </div>

      <!-- Checkbox for private questions -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="public_or_private">Private Question?</label>
        <div class="col-md-4">
          <label class="checkbox-inline" for="public_or_private-0">
            <input name="public_or_private" id="public_or_private-0" value="" type="checkbox">
            Yes
          </label>
        </div>
      </div>


      <br />
      <!-- Submit Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="submit_button"></label>
        <div class="col-md-4 text-center">
          <button id="submit_button" name="submit_button" class="btn btn-primary">Next Step</button>
        </div>
      </div>
    </fieldset>
  </form>


<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.11.1.min.js"></script>

<!-- Live Search Script -->
<script type="text/javascript" src="js/ajaxlivesearch.min.js"></script>

<script>
  jQuery(document).ready(function()
  {
    jQuery(".mySearch").ajaxlivesearch({
      loaded_at: <?php echo time(); ?>,
      token: <?php echo "'" . $handler->getToken() . "'"; ?>,
      max_input: <?php echo Config::getConfig('maxInputLength'); ?>,
      onResultClick: function(e, data) {
        // get the index 0 (first column) value
        var selectedOne = jQuery(data.selected).find('td').eq('0').text();
        var selectedTwo = jQuery(data.selected).find('td').eq('1').text();
        // set the input value
        jQuery('#ls_query').val(selectedOne);
        jQuery('#ls_query_2').val(selectedTwo);
        // hide the result
        jQuery("#ls_query").trigger('ajaxlivesearch:hide_result');
        },
      onResultEnter: function(e, data) {
        // do whatever you want
        // jQuery("#ls_query").trigger('ajaxlivesearch:search', {query: 'test'});
        },
      onAjaxComplete: function(e, data) {
        }
    });
  })

  function copyTitle(f) {
    if(f.answer_is_title.checked == true) {
      f.question_answer.value = f.title.value;
    }

    if(!f.answer_is_title.checked == true) {
      f.question_answer.value = "";
    }
  }
</script>

</body>
</html>
<?php include("../includes/layouts/footer.php"); ?>
