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

		if(isset($_POST['picture']))
		{
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["file"]["name"]);
			$extension = end($temp);
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 20000)
			&& in_array($extension, $allowedExts))
			  {
			  if ($_FILES["file"]["error"] > 0)
			    {
			    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
			    }
			  else
			    {
			    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			    echo "Type: " . $_FILES["file"]["type"] . "<br>";
			    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

			    if (file_exists("upload/" . $_FILES["file"]["name"]))
			      {
			      echo $_FILES["file"]["name"] . " already exists. ";
			      }
			    else
			      {
			      move_uploaded_file($_FILES["file"]["tmp_name"],
			      "upload/" . $_FILES["file"]["name"]);
			      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
			      }
			    }
			  }
			else
			  {
			  echo "Invalid file";
			  }
		}











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


        // An INSERT query is used to add new rows to a database table. 
        // Again, we are using special tokens (technically called parameters) to 
        // protect against SQL injection attacks. 
        $query = " 
            INSERT INTO users ( 
                email, 
                password, 
                salt,
                name,
                phone
                
            ) VALUES ( 
                :email, 
                :password, 
                :salt, 
                :name,
                :phone 
            ) 
        "; 
         
        // A salt is randomly generated here to protect again brute force attacks 
        // and rainbow table attacks.  The following statement generates a hex 
        // representation of an 8 byte salt.  Representing this in hex provides 
        // no additional security, but makes it easier for humans to read. 
        // For more information: 
        // http://en.wikipedia.org/wiki/Salt_%28cryptography%29 
        // http://en.wikipedia.org/wiki/Brute-force_attack 
        // http://en.wikipedia.org/wiki/Rainbow_table 
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
         
        // This hashes the password with the salt so that it can be stored securely 
        // in your database.  The output of this next statement is a 64 byte hex 
        // string representing the 32 byte sha256 hash of the password.  The original 
        // password cannot be recovered from the hash.  For more information: 
        // http://en.wikipedia.org/wiki/Cryptographic_hash_function 
        $password = hash('sha256', $password . $salt); 
         
        // Next we hash the hash value 65536 more times.  The purpose of this is to 
        // protect against brute force attacks.  Now an attacker must compute the hash 65537 
        // times for each guess they make against a password, whereas if the password 
        // were hashed only once the attacker would have been able to make 65537 different  
        // guesses in the same amount of time instead of only one. 
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
         
        // Here we prepare our tokens for insertion into the SQL query.  We do not 
        // store the original password; only the hashed version of it.  We do store 
        // the salt (in its plaintext form; this is not a security risk). 
        $query_params = array( 
            ':email' => $email, 
            ':password' => $password, 
            ':salt' => $salt, 
            ':name' => $name,
            ':phone' => $phone
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
         
        // This redirects the user back to the login page after they register 
        header("Location: .//index.php?route=main"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to .//index.php?route=main"); 
    }

































	}
}