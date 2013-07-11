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
	        $url = 'index.php?route=liveMap&data=' . json_encode ($row);
	        header( "Location: $url" );
	    }
	    else
	    {
	        $this->databaseReply = 'No dog with ID <b>' . $id . '</b> found';
	    }
	}
}