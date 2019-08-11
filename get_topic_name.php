<?php
 
 define('DB_USER', "root"); // db user
 define('DB_PASSWORD', ""); // db password (mention your db password here)
 define('DB_DATABASE', "opinion_client"); // database name
 define('DB_SERVER', "localhost"); // db server
 $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD,DB_DATABASE) or die(mysql_error());
// array for JSON response
$response = array();
 
$result = mysqli_query($con,"SELECT topic_name FROM topic_info");
 
    if (!empty($result)) 
	{	 
        $response["success"] = 1;
        $response["topics"] = array();
		while($r = mysqli_fetch_assoc($result))
		{
			$topics = array();
            $topics[] = $r;
            array_push($response["topics"], $topics);
 
		}
		echo json_encode($response);
	}	
	else 
	{
            // no product found
            $response["success"] = 0;
            $response["message"] = "No topics found";
 
            // echo no users JSON
            echo json_encode($response);
    }
?>