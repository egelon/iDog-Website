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
  <link type="text/css" rel="stylesheet" href="css/registrationForm.css"/>
  <link type="text/css" rel="stylesheet" href="css/searchForm.css"/>
    <script type="text/javascript" src="js/jquery-1.10.0.min.js"></script>
    
</head>

<body>
 
  <div id="container">

    <div id="pageContent">
      <header>
        <?php require_once('page_navigation.php')?>
      </header>


          <?php 
                  if(empty($_SESSION['user'])) 
                  {
                    //if user is not logged in
                      $url = 'index.php?route=main';
                      header("Location: $url");
                  }
                  else
                  {
                      echo 'Hello ' . $_SESSION['user']['name'] . ' | <a href="./register/user_logout.php" id="logoutLink">Logout</a><br><br>';
                      echo $mainText;
                      echo '<br>';
                      echo 
                      '
                      <table width="100%">
                      <tr>
                      <td>


                      ';
                      echo $updateForm;
                      echo '<br>';
                      echo $databaseReplyText;

                      echo 
                      '
                        </td>
                        <td>
                        <div class="cf addform">
                      ';


                      echo '<ul>';
                      foreach ($usersDogs as $aDog)
                      {
                        echo  '<li><a href="index.php?route=main&action=search&dogId='. $aDog['id']. '">'.$aDog['id']. ' - ' .$aDog['name']. '</a></li>';
        
                      } 
                      echo '</ul></td></tr></table>';
                  }
              ?>




        
    
   </div>

    <footer>
      <?php require_once('page_footer.php')?>
    </footer>

  </div>
</body>
</html>