<html>
   <body>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel = "stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <?php
         $servername = "localhost";
         $username = "pmauser";
         $password = "8675Taker!";
         $dbname = "sensors";
         
         $conn = new mysqli($servername, $username, $password, $dbname);
         
         if ($conn->connect_error){
            die("Connection failed: " .$conn->connect_error);   
         }
         $limit = 20;
           	 if (isset($_GET["page"])) { $page = $_GET["page"];} else {$page = 1;};
           	 $start_from = ($page-1) * $limit;
           	 
           	 $total_pages_sql = "SELECT COUNT(*) FROM sensorInfo";
           	 $results_pages = $conn->query($total_pages_sql);
           	 $total_row = $results_pages->fetch_array();
           	 $total_records = $total_row[0];
           	 $total_pages = ceil($total_records / $limit);
           	 
           	 $sql = "SELECT * FROM	sensorInfo ORDER BY time DESC LIMIT $start_from, $limit";
           	 $result_data = $conn->query($sql);
           	  ?>
      <table border="1" cellspacing="1" cellpadding="1" align="center" bgcolor="#FFFFFF">
         <thead>
            <tr>
               <th>&nbsp;Timestamp&nbsp;</th>
               <th>&nbsp;Solar Panel Voltage&nbsp;</th>
               <th>&nbsp;Solar Panel Current&nbsp;</th>
               <th>&nbsp;Solar Panel Power&nbsp;</th>
               <th>&nbsp;Turbine Voltage&nbsp;</th>
               <th>&nbsp;Turbine Current&nbsp;</th>
               <th>&nbsp;Turbine Power&nbsp;</th>
               <th>&nbsp;Grid Voltage&nbsp;</th>
               <th>&nbsp;Grid Current&nbsp;</th>
               <th>&nbsp;Grid Power&nbsp;</th>
               <th>&nbsp;Pump Voltage&nbsp;</th>
               <th>&nbsp;Pump Current&nbsp;</th>
               <th>&nbsp;Pump Power&nbsp;</th>
            </tr>
         </thead>
         <tbody>
            <?php
               while($row = $result_data->fetch_array()) {
                  printf("<tr><td> &nbsp;%s </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td>
               <td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td>
               <td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td>
               <td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td><td> &nbsp;%s&nbsp; </td></tr>",
                 $row["time"], $row["sp_voltage"], $row["sp_current"], $row["sp_power"], 
                 $row["t_voltage"], $row["t_current"], $row["t_power"], 
                 $row["g_voltage"], $row["g_current"], $row["g_power"], 
                 $row["p_voltage"], $row["p_current"], $row["p_power"]);
               }
               $conn->close();
               ?>
         </tbody>
      </table>
      <?php
         $pagLink = "<div class='pagination center'>";
            for ($i = 1; $i <= $total_pages; $i++) {
               $pagLink .= "<a href='index.php?page=".$i."'>".$i."</a>"; 
         
            };
         echo $pagLink . "</div>"; 
         ?>
   </body>
</html>
