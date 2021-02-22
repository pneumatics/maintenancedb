<?php
require("header.php");

if (!isset($_SESSION["valid_user"]))
        {
        echo "<P>No user logged in!";
        }
else{

    //connect to db
    require("db.php");
    //user is logged, depending on the user level, show different options
    //refer to specs.odt for a description of the different options
    echo "<H1>DashBoard</H1>";
    
    //1. Determine current user level (this user level is on the dB but can be configured by
    //admin, i.e. admin can create user levels with different permissions and then users are assigned 
    //to those predefined user levels
    $username = $_SESSION["valid_user"];
    $query = "SELECT * FROM users WHERE username = \"$username\"";
    $resx = mysql_query($query);
    $userlevel = mysql_result($resx,0,'usergroup'); //1: admin users, 2: level 1 users, 3: level 3 users
    $userid = mysql_result($resx,0,'users_id');
    
    //2. show dashboard for user admin:
    if ($userlevel == 1){
    echo "<b>Users:</b> <a href=\"admin_modules/registerusers.php\">Create User</a> | Edit User | Disable User";
    echo "<BR>";
    echo "<b>Maintenance Plans:</b> <a href = \"createwomp.php?op=mp\">Create MP</a> | Edit MP | Delete MP";
    echo "<BR>";
    echo "<b>Work Orders:</b> <a href = \"createwomp.php?op=wo\">Create WO</a>";
    echo "<BR>";
    echo "<b>Show Reports:</b> <a href = \"sreports.php?op=new\">Create Show Report</a> | <a href = \"browsesreports.php\">Browse Reports</a>";
    echo "<BR>";
    echo "<b>Spares:</b> <a href = \"spares.php\">Search and Manage Spares</a>";
    echo "<BR>";    
    echo "<b>Search:</b> <a href = \"searchresults.php\">Search/ Edit your WOs</a> | <a href = \"advancedsearch.php\">Advanced WO Search</a>";
    
    echo "<P><B>System Stats: </B>";
    echo " You have a total of ";
    $query = "SELECT * FROM workorders WHERE wostatus NOT LIKE \"6\" AND woassignedto LIKE \"$userid\"";
    $resx = mysql_query($query);
    $num = mysql_num_rows($resx);

    echo "$num open orders";
    
    }
    
    //2. show dashboard for users level 2:
    if ($userlevel == 2){
    echo "<b>Work Orders:</b> <a href = \"createwomp.php?op=wo\">Create WO</a>";
    echo "<BR>";
    echo "<b>Show Reports: </b> <a href = \"browsesreports.php\">Browse Reports</a>";
    echo "<BR>";
    echo "<b>Spares:</b> <a href = \"spares.php\">Search Spares</a>";
    echo "<BR>";     
    echo "<b>Search:</b> <a href = \"searchresults.php\">Search/ Edit your WOs</a> | Search Spares";
    
    echo "<P><B>System Stats: </B>";
    echo " You have a total of ";
    $query = "SELECT * FROM workorders WHERE wostatus NOT LIKE \"5\" AND wostatus NOT LIKE \"6\" AND woassignedto LIKE \"$userid\"";
    $resx = mysql_query($query);
    $num = mysql_num_rows($resx);

    echo "$num open orders";
    
    }
    
    //content that is common to all users and shows up on the main dashboard page goes here:
    
    //Get all orders that are from daily maintenance plans (tagged [M Plan D]) that have WO Status set to ASSIGNED:
    $query = "SELECT * FROM workorders WHERE wostatus LIKE \"2\" AND wosummary LIKE \"[MPlan D]%\"";
    $resx = mysql_query($query);
    $num_rows = mysql_num_rows($resx);
    echo " | There are $num_rows open daily orders";
    
    /********************PRINT ORDER LIST*******************/
    
    while ($row = mysql_fetch_array($resx)) {
    
    //wopriority
            $wopriority = $row[4];
            $query = "SELECT * FROM wopriority WHERE wopriorityid = \"$wopriority\"";
            $res2 = mysql_query($query);
            $wopriority = mysql_result($res2,0,'wopriorityname');
            
            if ($wopriority == "1")
            echo "<table style=\"text-align: left; background-color: rgb(255, 204, 153); width: 100%;\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\"> <tbody>";
            
            else
            echo "<table style=\"text-align: left; width: 100%;\" border=\"1\" cellpadding=\"1\" cellspacing=\"1\"> <tbody>";
    
    echo "<tr>
      <th style=\"text-align: center;\">WO Number</th>
      <th style=\"text-align: center;\">WO Date</th>
      <th style=\"text-align: center;\">WO Type</th>
      <th style=\"text-align: center;\">WO Priority</th>
      <th style=\"text-align: center;\">0</th>
      <th>1</th>
      <th style=\"text-align: center;\">System</th>
      <th style=\"text-align: center;\">Flr</th>
      <th style=\"text-align: center;\">Quad</th>
      <th style=\"text-align: center;\">Subsystem</th>
      <th style=\"text-align: center;\">Exp</th>
      <th style=\"text-align: center;\">Component</th>
      <th style=\"text-align: center;\">WO Status</th>
      <th></th>
    </tr>
    <tr>
      <td style=\"text-align: center;\">";
      
      //woid
      echo "".$row[0]."";      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wocreatedate
      $wocreatedate = date("d/m/Y H:i", $row[1]);
      echo "$wocreatedate";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wotype
      $wotypeindex = $row[3];
      $query = "SELECT * FROM wotype WHERE wotypeid = \"$wotypeindex\"";
      $res2 = mysql_query($query);
      $wotype = mysql_result($res2,0,'wotypename');
      echo "$wotype";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wopriority
      echo "$wopriority";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv0
      $wolv0 = $row[5];
      $query = "SELECT * FROM lv0 WHERE lv0id = \"$wolv0\"";
      $res2 = mysql_query($query);
      $wolv0 = mysql_result($res2,0,'lv0name');
      echo "$wolv0";
      
      echo "</td>
      <td style=\"text-align: center;\">";
      
      //wolv1
      $wolv1 = $row[6];
      $query = "SELECT * FROM lv1 WHERE lv1id = \"$wolv1\"";
      $res2 = mysql_query($query);
      $wolv1 = mysql_result($res2,0,'lv1name');
      echo "$wolv1";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv2
      $wolv2 = $row[7];
      $query = "SELECT * FROM lv2 WHERE lv2id = \"$wolv2\"";
      $res2 = mysql_query($query);
      $wolv2 = mysql_result($res2,0,'lv2name');
      echo "$wolv2";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv3
      $wolv3 = $row[8];
      $query = "SELECT * FROM lv3 WHERE lv3id = \"$wolv3\"";
      $res2 = mysql_query($query);
      $wolv3 = mysql_result($res2,0,'lv3name');
      echo "$wolv3";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv4
      $wolv4 = $row[9];
      $query = "SELECT * FROM lv4 WHERE lv4id = \"$wolv4\"";
      $res2 = mysql_query($query);
      $wolv4 = mysql_result($res2,0,'lv4name');
      echo "$wolv4";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv5
      $wolv5 = $row[10];
      $query = "SELECT * FROM lv5 WHERE lv5id = \"$wolv5\"";
      $res2 = mysql_query($query);
      $wolv5 = mysql_result($res2,0,'lv5name');
      echo "$wolv5";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wolv6
      $wolv6 = $row[11];
      $query = "SELECT * FROM lv6 WHERE lv6id = \"$wolv6\"";
      $res2 = mysql_query($query);
      $wolv6 = mysql_result($res2,0,'lv6name');
      echo "$wolv6";
      
      echo"</td>
      <td style=\"text-align: center;\">";
      
      //wolv7
      $wolv7 = $row[12];
      $query = "SELECT * FROM lv7 WHERE lv7id = \"$wolv7\"";
      $res2 = mysql_query($query);
      $wolv7 = mysql_result($res2,0,'lv7name');
      echo "$wolv7";
            
      echo" </td>
      <td style=\"text-align: center;\">";
      
      //wostatus
      $wostatus = $row[15];
      $query = "SELECT * FROM wostatus WHERE wostatusid = \"$wostatus\"";
      $res2 = mysql_query($query);
      $wostatus = mysql_result($res2,0,'wostatusname');
      echo "$wostatus";
      
      echo "</td>
      <td><a href= \"editorder.php?woid=".$row[0]."&p=daily\">EDIT</a></td>
    </tr>
    <tr>
      <td style=\"text-align: right;\">Summary</td>
      <td colspan=\"12\" rowspan=\"1\">";
      
      //wosummary</td>
      $wossummary = $row[13];
      echo "$wossummary";      
           
      echo" </td><td></td>
    </tr>
  </tbody>
</table><BR>";
  }  
    /*****************END PRINT ORDER LIST *****************/
        
}

require("footer.php");
?>
