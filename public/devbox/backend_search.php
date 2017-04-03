

    <?php

    /* Attempt MySQL server connection. Assuming you are running MySQL

    server with default setting (user 'root' with no password) */

    $link = mysqli_connect("localhost", "battleuser", "MPLB@ttle", "battleofthebooks");



    // Check connection

    if($link === false){

        die("ERROR: Could not connect. " . mysqli_connect_error());

    }



    // Escape user inputs for security

    $term = mysqli_real_escape_string($link, $_REQUEST['term']);



    if(isset($term)){

        // Attempt select query execution

        $sql = "SELECT DISTINCT author_last_name, author_first_name FROM questions_ajax WHERE author_last_name LIKE '" . $term . "%' LIMIT 5";

        if($result = mysqli_query($link, $sql)){

            if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                    echo "<p>" . $row['author_last_name'] . "</p>";


                }

                // Close result set

                mysqli_free_result($result);

            } else{

                echo "<p>No matches found</p>";

            }

        } else{

            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);

        }

    }



    // close connection

    mysqli_close($link);

    ?>
