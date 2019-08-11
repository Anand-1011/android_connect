<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 define('DB_USER', "root"); // db user
 define('DB_PASSWORD', ""); // db password (mention your db password here)
 define('DB_DATABASE', "opinion_client"); // database name
 define('DB_SERVER', "localhost"); // db server
 $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE) or die(mysql_error());
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['topic_id']) && isset($_POST['comments'])) {
 
    $topic_id= $_POST['topic_id'];
    $comment = $_POST['comments'];
	
    // connecting to db
    // $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysqli_query($con,"INSERT INTO comments_info(topic_id, comment) VALUES('$topic_id', '$comment')");
 
    // check if row inserted or not
    if ($result) 
	{
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Your Opinion would create a Difference.";
 
        // echoing JSON response
        echo json_encode($response);
    }	
	else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>