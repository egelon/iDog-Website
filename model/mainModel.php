<?php
require_once('router\include.php');

class mainModel
{
	public $template;
	public $mainScreenText;
	public $databaseReply;

	public function __construct() 
	{
		$this->template = "templates/mainTemplate.php";

		$this->mainScreenText = "Hello, welcome to iDog!";
		$this->databaseReply = "Enter a dog's ID and press Search";

    }

    public function getDogCoordinates($id)
    { 
    	$username = "root"; 
	    $password = "901205"; 
	    $host = "localhost"; 
	    $dbname = "idog"; 

	    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
	     
	    try 
	    { 
	        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
	    } 
	    catch(PDOException $ex) 
	    { 
	        die("Failed to connect to the database: " . $ex->getMessage()); 
	    } 
	     
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	    
	    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $query = " 
            SELECT 
            	id,
                lat, 
                lon
            FROM dog_location 
            WHERE 
                id = :dogId 
        "; 
	         
	    // The parameter values 
	    $query_params = array( 
	         ':dogId' => $id
	    ); 
	         
	    try 
	    { 
	        // Execute the query against the database 
	        $stmt = $db->prepare($query); 
	        $result = $stmt->execute($query_params); 
	    } 
	    catch(PDOException $ex) 
	    { 
		   // Note: On a production website, you should not output $ex->getMessage(). 
	       // It may provide an attacker with helpful information about your code.  
	        echo 'Failed to run query: ' . $ex->getMessage(); 
	    } 
	         
	    // Retrieve the dog location data from the database.
	    $row = $stmt->fetch(); 

	    if($row)
	    {
	    	//$arr = array('lat' => $row['lat'], 'lon' => $row['lon']);
	        $url = './index.php?route=livemap&data=' . json_encode ($row);
	        header( "Location: $url" );
	    }
	    else
	    {
	        $this->databaseReply = 'No dog with ID <b>' . $id . '</b> found';
	    }
	}

	public function addNewDog($name, $gender, $castrated, $lat, $lon)
	{

		$username = "root"; 
	    $password = "901205"; 
	    $host = "localhost"; 
	    $dbname = "idog"; 

	    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
	     
	    try 
	    { 
	        $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options); 
	    } 
	    catch(PDOException $ex) 
	    { 
	    	$this->databaseReply = "Failed to connect to the database: " . $ex->getMessage();
	        die("Failed to connect to the database: " . $ex->getMessage()); 
	    } 
	     
	    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
	    
	    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


        $query = " 
            INSERT INTO dog_info ( 
                name, 
                gender, 
                castrated
                
                
            ) VALUES ( 
                :name, 
                :gender, 
                :castrated
                
            ) 
        "; 
         
        
        $query_params = array( 
            ':name' => $name, 
            ':gender' => $gender, 
            ':castrated' => $castrated, 
            
        ); 
         
        try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 



        $dogID = $db->lastInsertId();



        $query = " 
            INSERT INTO dog_location ( 
                id, 
                lat, 
                lon
                
                
            ) VALUES ( 
                :id, 
                :lat, 
                :lon
                
            ) 
        "; 
         
        
        $query_params = array( 
            ':id' => $dogID, 
            ':lat' => $lat, 
            ':lon' => $lon, 
            
        ); 
         
        try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        }



        //Upload the file
		if(isset($_POST['picture']))
		{
			$allowedExts = array("jpeg", "jpg");
			$temp = explode(".", $_FILES["file"]["name"]);
			$extension = end($temp);
			if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg")) && ($_FILES["file"]["size"] < 20000) && in_array($extension, $allowedExts))
			{
				if ($_FILES["file"]["error"] > 0)
			  	{
			 		echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			  	}
				else
			  	{
			    	/*
					    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
					    echo "Type: " . $_FILES["file"]["type"] . "<br>";
					    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
					    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
					*/
			    	
					move_uploaded_file($_FILES["file"]["tmp_name"],
					"dog_img/" . $dogID . ".jpg");
					echo "Stored in: " . "dog_img/" . $dogID . ".jpg";
			      	
			    }
			}
			else
			{
				echo "Invalid file";
			}
		}
		
}