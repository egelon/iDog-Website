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
		session_start();

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
                castrated,
                added_by
                
                
            ) VALUES ( 
                :name, 
                :gender, 
                :castrated,
                :added_by
            ) 
        "; 
         
        
        $query_params = array( 
            ':name' => $name, 
            ':gender' => $gender, 
            ':castrated' => $castrated, 
            ':added_by' => $_SESSION['user']['id']
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

/*

        //Upload the file
		if(isset($_POST['picture']))
		{
			$allowedExts = array("jpeg", "jpg");
			$temp = explode(".", $_FILES["picture"]["name"]);
			$extension = end($temp);
			if ((($_FILES["picture"]["type"] == "image/jpeg") || ($_FILES["picture"]["type"] == "image/jpg")) && ($_FILES["picture"]["size"] < 500000) && in_array($extension, $allowedExts))
			{
				if ($_FILES["picture"]["error"] > 0)
			  	{
			 		$this->databaseReply = "Return Code: " . $_FILES["picture"]["error"] . "<br>";
			  	}
				else
			  	{
			    	
					    echo "Upload: " . $_FILES["picture"]["name"] . "<br>";
					    echo "Type: " . $_FILES["picture"]["type"] . "<br>";
					    echo "Size: " . ($_FILES["picture"]["size"] / 1024) . " kB<br>";
					    echo "Temp file: " . $_FILES["picture"]["tmp_name"] . "<br>";
					
			    	$target = 'dog_img/' . $dogID . '.jpg';
					if(move_uploaded_file($_FILES["picture"]["tmp_name"], $target))
						$this->databaseReply = "Stored in: " . $target;
					else
						$this->databaseReply = "Error uploading file" . $target;
			    }
			}
			else
			{
				$this->databaseReply = "Invalid file";
			}
		}
		*/






		$filename = $_FILES["picture"]["name"];
		$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
		$file_ext = substr($filename, strripos($filename, '.')); // get file name
		$filesize = $_FILES["picture"]["size"];
		$allowed_file_types = array('.jpg','.jpeg');	
	 
		if (in_array($file_ext,$allowed_file_types) && ($filesize < 200000))
		{	
			// Rename file
			$targetDir = 'dog_img/';
			$newfilename = $dogID . $file_ext;
			if (file_exists($targetDir . $newfilename))
			{
				// file already exists error
				echo "You have already uploaded this file.";
			}
			else
			{		
				move_uploaded_file($_FILES["picture"]["tmp_name"], $targetDir . $newfilename);
				echo "File uploaded successfully.";		
			}
		}
		elseif (empty($file_basename))
		{	
			// file selection error
			echo "Please select a file to upload.";
		} 
		elseif ($filesize > 200000)
		{	
			// file size error
			echo "The file you are trying to upload is too large.";
		}
		else
		{
			// file type error
			echo "Only these file typs are allowed for upload: " . implode(', ',$allowed_file_types);
			unlink($_FILES["picture"]["tmp_name"]);
		}


















	}
}