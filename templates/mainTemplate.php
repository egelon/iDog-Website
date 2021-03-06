<?php
session_start(); 
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
                      echo 'Hello ' . $_SESSION['user']['name'] . ' | <a href="./register/user_logout.php" id="logoutLink">Logout</a>';
                      echo $addNewDogForm;
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