<html>
   <head>
      <style>
         body  {
         background-image: url("https://media.giphy.com/media/FoVi0LDjy1XS8/giphy.gif");
         background-repeat: no-repeat;
         background-size: cover;
         background-position: center;
         position: relative;
         }
      </style>
      <title>Sensor data</title>
   </head>
   <body>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel = "stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style>
         .pagination.center,
         .pagination.center ul {
         float: left;
         position: relative;
         }
         .pagination.center { left: 50%; }
         .pagination.center ul { left: -50%; }
         .pagination {
         display: inline-block;
         }
         .pagination a {
         background-color: #FFFFFF;
         color: black;
         float: left;
         padding: 8px 16px;
         text-decoration: none;
         transition: background-color .3s;
         margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
         border-radius: 5px;
         border: 1px solid #000000; /* Black */
         font-size: 16px;
         }
         .pagination a.active {
         background-color: #4CAF50;
         color: black;
         border-radius: 5px;
         }
         .pagination a:hover:not(.active) {background-color: #ddd;}
      </style>
      <h1 align="center">Voltage / Current sensor readings</h1>
      <p align="center">These are our values coming from the sensors. They are being inserted into a database using a python script that automatically reads the serial port on the pi,
         that is connected to the Arduino.
      </p>
      <p align="center">The Arduino is pushing the data every five seconds. 
         The shell script is triggering the python script every second and uploading the data and then it's being displayed within this table.
      </p>
      <p align="center"> Voltage is in "V" and Current is in "mA". 
      </p>
      <div id="tableID">
         <?php include_once'table.php'; ?>
      </div>
      <script type='text/javascript'>
         var table = $('#tableID');
         // refresh every 5 seconds
         var refresher = setInterval(function(){
          table.load("table.php"); //should be the same name as the file
         }, 5000);
         setTimeout(function() {
          clearInterval(refresher);
         }, 1800000);
      </script>
   </body>
</html>
