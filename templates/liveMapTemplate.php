<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>iDog</title>
  <link type="text/css" rel="stylesheet" href="css/common.css"/>
  <link type="text/css" rel="stylesheet" href="css/pageNav.css"/>
    <script type="text/javascript" src="js/jquery-1.10.0.min.js"></script>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map { top:50%;height: 50% }
    </style>

    
</head>

<body>
 
  <div id="container">

    <div id="pageContent">
      <header>
        <?php require_once('page_navigation.php')?>
      </header>
        <?php echo $mainText; ?><br>
        id: <?php echo $id; ?><br>
        lat: <div id="lat"><?php echo $lat; ?></div><br>
        lon: <div id="lon"><?php echo $lon; ?></div><br>
        
    </div>

    <footer>
      <?php require_once('page_footer.php')?>
    </footer>

  </div>


<div id="map"></div>

        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script src="js/gmaps.js"></script>


</body>
</html>