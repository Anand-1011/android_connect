<?php
 define('DB_USER', "root"); // db user
 define('DB_PASSWORD', ""); // db password (mention your db password here)
 define('DB_DATABASE', "opinion_client"); // database name
 define('DB_SERVER', "localhost"); // db server
 $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE) or die(mysql_error());
 
 // array for JSON response
 $response = array();
 // check for post data
 
 if (isset($_POST["topic_name"])) {
    $pid = $_POST['topic_name'];
 
    // get a product from products table
    $result = mysqli_query($con,"SELECT topic_id,information FROM topic_info where topic_name = '$pid'");
 
    if (!empty($result)) {
        // check for empty result 
            $result = mysqli_fetch_array($result);
 
            $description = array();
			$description["topic_id"] = $result["topic_id"];
            $description["information"] = $result["information"];
            // success
            $response["success"] = 1;
            // user node
            $response["description"] = array();
 
            array_push($response["description"], $description);
 
            // echoing JSON response
            echo json_encode($response);
        } 
		else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";
 
            // echo no users JSON
            echo json_encode($response);
        }
}
	else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>