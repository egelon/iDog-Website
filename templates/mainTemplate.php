<?php
// First we execute our common code to connection to the database and start the session 
    //require(".register/common.php"); 
session_start(); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        //header("Location: .//index.php?route=main"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        //die("Redirecting to .//index.php?route=main"); 
    }
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>iDog</title>
  <link type="text/css" rel="stylesheet" href="css/common.css"/>
  <link type="text/css" rel="stylesheet" href="css/pageNav.css"/>
	<link type="text/css" rel="stylesheet" href="css/loginForm.css"/>
  <link type="text/css" rel="stylesheet" href="css/searchForm.css"/>
    <script type="text/javascript" src="js/jquery-1.10.0.min.js"></script>
    
</head>

<body>
 
  <div id="container">

    <div id="pageContent">
      <header>
        <?php require_once('page_navigation.php')?>
      </header>
        <?php echo $mainText; ?><br>
        <table width="100%"> 
          <tr>
            <td>
              <?php 
                  if(empty($_SESSION['user'])) 
                  {
                    //if user is not logged in
                      echo $loginForm;
                  }
                  else
                  {
                      echo 'Hello ' . $_SESSION['email'];
                      echo "logout link here";
                  }
              ?>

            </td>
            <td>
              <?php echo $searchForm; ?>
            </td>
          </tr>
        </table>
      
    </div>

    <footer>
      <?php require_once('page_footer.php')?>
    </footer>

  </div>
</body>
</html>