<?php
 
 define('DB_USER', "root"); // db user
 define('DB_PASSWORD', ""); // db password (mention your db password here)
 define('DB_DATABASE', "opinion_client"); // database name
 define('DB_SERVER', "localhost"); // db server
 $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE) or die(mysql_error());
 
 // array for JSON response
 $response = array();
 
 // check for post data
if (isset($_POST["topic_id"])) 
{
    $pid = $_POST["topic_id"];
    // get a product from products table
    $result = mysqli_query($con,"SELECT comment FROM comments_info where topic_id = $pid");
 
    if (!empty($result)) {
        // check for empty result
		$response["success"] = 1;
        $response["comments"] = array();
		while($r = mysqli_fetch_assoc($result))
		{
			$comment = array();
			$comment[] = $r;
            array_push($response["comments"],$comment);
		}
            echo json_encode($response);
        } 
		else {
            // no comment found
            $response["success"] = 0;
            $response["message"] = "No comment found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } 
	else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No comment found";
 
        // echo no users JSON
        echo json_encode($response);
    } 
?>