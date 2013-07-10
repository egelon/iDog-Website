<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>iDog</title>
  <link type="text/css" rel="stylesheet" href="css/common.css"/>
  <link type="text/css" rel="stylesheet" href="css/pageNav.css"/>
	<link type="text/css" rel="stylesheet" href="css/loginForm.css"/>
  
  <!--
    <script type="text/javascript" src="js/jquery-1.10.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
  -->
</head>

<body>
 
  <div id="container">

    <div id="pageContent">
      <header>
        <?php require_once('page_navigation.php')?>
      </header>

        <?php echo $adminLoginForm; ?>
    </div>	

    <footer>
      <?php require_once('page_footer.php')?>
    </footer>

  </div>
</body>
</html>