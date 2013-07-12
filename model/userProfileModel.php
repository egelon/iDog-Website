<?php
require_once('router\include.php');

class userProfileModel
{
	public $template;
	public $mainScreenText;
	public $databaseReply;

    public $dogsAdded;

	public function __construct() 
	{
		$this->template = "templates/userProfileTemplate.php";


        session_start();


		$this->mainScreenText = "On this page you can change your profile information, as well as view the dogs you have added to the database.";
		$this->databaseReply = " ";
        $this->dogsAdded = array();

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
                name
            FROM dog_info 
            WHERE 
                added_by = :added_by 
        "; 
             
        // The parameter values 
        $query_params = array( 
             ':added_by' => $_SESSION['user']['id']
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
        while($row = $stmt->fetch()) 
        {
            array_push($this->dogsAdded, $row);
        }
    }

    public function changeUserData($email, $password, $name, $phone)
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

        



        // At the top of the page we check to see whether the user is logged in or not 
        if(empty($_SESSION['user'])) 
        { 
            // If they are not, we redirect them to the login page. 
            $url = 'index.php?route=main';
            header("Location: $url"); 
             
            // Remember that this die statement is absolutely critical.  Without it, 
            // people can view your members-only content without logging in. 
            die("Redirecting to " . $url); 
        } 
     
         
        // If the user is changing their E-Mail address, we need to make sure that 
        // the new value does not conflict with a value that is already in the system. 
        // If the user is not changing their E-Mail address this check is not needed. 
        if($email != $_SESSION['user']['email']) 
        { 
            // Define our SQL query 
            $query = " 
                SELECT 
                    1 
                FROM users 
                WHERE 
                    email = :email 
            "; 
             
            // Define our query parameter values 
            $query_paramsCheck = array( 
                ':email' => $email 
            ); 
             
            try 
            { 
                // Execute the query 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_paramsCheck); 
            } 
            catch(PDOException $ex) 
            { 
                // Note: On a production website, you should not output $ex->getMessage(). 
                // It may provide an attacker with helpful information about your code.  
                die("Failed to run query: " . $ex->getMessage()); 
            } 
             
            // Retrieve results (if any) 
            $row = $stmt->fetch(); 
            if($row) 
            { 
                die("This E-Mail address is already in use"); 
            } 
        } 
         
        // If the user entered a new password, we need to hash it and generate a fresh salt 
        // for good measure. 
        if(!empty($password)) 
        { 
            $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
            $password = hash('sha256', $password . $salt); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $password = hash('sha256', $password . $salt); 
            } 
        } 
        else 
        { 
            // If the user did not enter a new password we will not update their old one. 
            $password = null; 
            $salt = null; 
        } 
         
        // Initial query parameter values 
        $query_params = array( 
            ':user_id' => $_SESSION['user']['id']
        ); 
         
        // Note how this is only first half of the necessary update query.  We will dynamically 
        // construct the rest of it depending on whether or not the user is changing 
        // their password. 
        $query = " 
            UPDATE users 
            SET 
                
        "; 
         
        // If the user is changing their password, then we extend the SQL query 
        // to include the password and salt columns and parameter tokens too. 

        if($email !== null)
        {
            $query_params[':email'] = $email;
            $query .= "
                email = :email
            ";
        }


        if($password !== null) 
        { 
            $query_params[':password'] = $password; 
            $query_params[':salt'] = $salt; 
            $query .= " 
                , password = :password 
                , salt = :salt 
            "; 
        } 

        if($name !== null) 
        { 
            $query_params[':name'] = $name;
            $query .= " 
                , name = :name 
                 
            "; 
        } 

        if($phone !== null) 
        { 
            $query_params[':phone'] = $phone;
            $query .= " 
                , phone = :phone 
               
            "; 
        } 


         
        // Finally we finish the update query by specifying that we only wish 
        // to update the one record with for the current user. 
        $query .= " 
            WHERE 
                id = :user_id 
        "; 
         
        try 
        { 
            // Execute the query 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        // Now that the user's E-Mail address has changed, the data stored in the $_SESSION 
        // array is stale; we need to update it so that it is accurate. 
        if($email !== null)
            $_SESSION['user']['email'] = $email;
        if($name !== null)
            $_SESSION['user']['name'] = $name; 
        if($phone !== null)
            $_SESSION['user']['phone'] = $phone;
         
        // This redirects the user back to the members-only page after they register 
        $url = 'index.php?route=main';
        header("Location: $url"); 
         
        // Calling die or exit after performing a redirect using the header function 
        // is critical.  The rest of your PHP script will continue to execute and 
        // will be sent to the user if you do not die or exit. 
        die("Redirecting to main.php");
    }     
}