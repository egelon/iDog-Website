<?php
require_once('router\include.php');

class liveMapModel
{
	public $template;
	public $mainScreenText;
	public $databaseReply;

	public $data;

	public $dogID;
	public $dogName;
	public $gender;
	public $castrated;
	public $pictureURL;
	public $addedBy;


	public function __construct() 
	{
		$this->template = "templates/liveMapTemplate.php";

		$this->mainScreenText = "Dog location";
		$this->databaseReply = "";



		$this->dogID = "";
		$this->dogName = "";
		$this->gender = "";
		$this->castrated = "";
		$this->pictureURL = "";
		$this->addedBy = "";





		if(!empty($_GET['data']))
		{
			$jsonString = $_GET['data'];	
		}

		$this->data = json_decode($jsonString, true);

		//getDogInfo($this->data['id']);
    }

    public function getDogInfo($id)
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
                name,
                gender,
                castrated,
                picture,
                added_by 
            FROM dog_info 
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
	    	$this->dogID = $row['id'];
	        $this->dogName = $row['name'];
	        $this->gender = $row['gender'];
	        $this->castrated = $row['castrated'];
	        $this->pictureURL = $row['picture'];
	        $this->addedBy = $row['added_by'];
	    }
	    else
	    {
	        $this->databaseReply = 'No dog with ID <b>' . $id . '</b> found';
	    }
    }
}