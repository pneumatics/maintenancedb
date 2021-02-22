<?php
//departments.php - let user create, edit and disable deparments

    require("../header.php");
    require("../db.php");

    if (is_main_admin($_SESSION['valid_user']) == "Y"){
        //START OF ACCESSIBLE PAGE CONTENTS
        
        echo "Upload logo:";
        echo "User dashboards shows: 1. orders tagged with... 2. user's own orders 3. let user choose";
        echo "";
        
        //END OF ACCESSIBLE PAGE CONTENTS
    }
    else {
        //user not authorized
        echo "You're not authorized to access this file!";
    }
    
    require("../footer.php");

?>
