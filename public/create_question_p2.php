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

  <script type="text/javascript">


      function copyBookTitle(f) {
        if(f.answer_is_title.checked == true) {
          f.question_answer.value = "<?php echo $_POST['title']; ?>";
          document.getElementById("question_answer").disabled = true;
        }

        if(!f.answer_is_title.checked == true) {
          f.question_answer.value = "";
        }
      }

  </script>

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
    <title>AJAX Live Search</title>
    <!-- Live Search Styles -->
</head>

<body>
  <form class="form-horizontal" action="submit_question.php" method="post">
    <fieldset>
      <legend>Submit a question</legend>
      <pre>
        <?php
          print_r($_POST);
         ?>

      </pre>

      <!-- Get the text of the actual question -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="question_text">Question</label>
          <div class="col-md-4">
            <textarea class="form-control input-md" id="question_text" name="question_text" rows="10" type="text"></textarea>
          </div>
      </div>


      <!-- Checkbox asking if the question is the title of the book -->
      <!-- If the box is checked javascript automatically fills in the answer field -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="answer_is_title"></label>
        <div class="col-md-4">
          <div class="checkbox">
            <label for="answer_is_title-0">
              <input name="answer_is_title" id="answer_is_title-0" value="1" type="checkbox" onclick="copyBookTitle(this.form)">
              Book Title is Answer
            </label>
          </div>
        </div>
      </div>

      <!-- Optional field where people can enter in notes about the question -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="notes">Notes</label>
        <div class="col-md-4">
          <textarea class="form-control input-md" id="notes" name="notes" type="text"></textarea>
        </div>
      </div>

      <!-- Question answer -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="question_answer">Question Answer</label>
        <div class="col-md-4">
          <input id="question_answer" name="question_answer" placeholder="" class="form-control input-md" required="" type="text">
        </div>
      </div>

      <br />
      <!-- Submit Button -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="submit_button"></label>
        <div class="col-md-4 text-center">
          <button id="submit_button" name="submit_button" class="btn btn-primary">Submit Question</button>
        </div>
      </div>

      <?php
        $categories = implode(', ', $_POST['question_category']);
      echo "these are the categories: ";
        echo $categories;
       ?>

      <!-- hidden form fields - popluate from previous page -->
          <input id="title" name="title"  type="hidden" value="<?php echo $_POST['title']; ?>">
          <input id="author_first_name" name="author_first_name" type="hidden"  value="<?php echo $_POST['author_first_name_h']; ?>">
          <input id="author_last_name" name="author_last_name" type="hidden"  value="<?php echo $_POST['author_last_name_h']; ?>">
          <input id="book_publication_year" name="book_publication_year" type="hidden" value="<?php echo $_POST['book_publication_year']; ?>">
          <input id="question_category" name="question_category"  type="hidden" value="<?php echo $categories ?>">
          <input id="question_level" name="question_level"  type="hidden" value="<?php echo $_POST['question_level']; ?>">
          <input id="private_question" name="private_question" type="hidden" value="<?php echo $_POST['private_question']; ?>">


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



</script>

</body>
</html>
<?php include("../includes/layouts/footer.php"); ?>
