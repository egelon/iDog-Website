<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>iDog</title>
  <link type="text/css" rel="stylesheet" href="css/common.css"/>
  <link type="text/css" rel="stylesheet" href="css/pageNav.css"/>
  <link type="text/css" rel="stylesheet" href="css/map.css"/>
    <script type="text/javascript" src="js/jquery-1.10.0.min.js"></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />

    
</head>

<body>
 
  <div id="container">

    <div id="pageContent">
      <header>
        <?php require_once('page_navigation.php')?>
      </header>

      <br><h2><?php echo $mainText; ?></h2><br>

      <table width="100%" border="0">
        <tr>
          <td align="left">
            <img src="<?php echo $picture; ?>">
          </td>

          <td rowspan="2" align="center">
            <div id="map"></div>
          </td>

        </tr>
        <tr>

          <td width="50%">
            <span class="dogInformation">
              <ul>
                <li>id: <?php echo $id; ?></li>
                <li>lat: <div id="lat"><?php echo $lat; ?></div></li>
                <li>lon: <div id="lon"><?php echo $lon; ?></div></li>
                <li>name: <div id="dogName"><?php echo $name; ?></div></li>

                <li>gender: <?php echo $gender; ?></li>
                <li>castrated: <?php echo $castrated; ?></li>
                <li>added by: <?php echo $addedBy; ?></li>
              </ul>
            </span>
          </td>

          

        </tr>
    </table>
    </div>
    
    <footer>
      <?php require_once('page_footer.php')?>
    </footer>

  </div>




        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script src="js/gmaps.js"></script>


</body>
</html>