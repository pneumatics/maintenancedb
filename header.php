<?php
//header information file
session_start();
include("config/config.php");
require("config/aux_funcs.php");

date_default_timezone_set("$default_time_zone");

echo "<html>
        <head>
            <title>Maintenance dB</title>";
?>  

<link type="text/css" href="<?php echo "$root_dir/";?>jqueryUI/css/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
    <script type="text/javascript" src="<?php echo "$root_dir/";?>jqueryUI/js/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="<?php echo "$root_dir/";?>jqueryUI/js/jquery-ui-1.8.16.custom.min.js"></script>
    <style type="text/css">
	body{ font: 80% "Trebuchet MS", sans-serif; margin: 50px;}
	.datepicker{ font: 65% "Trebuchet MS", sans-serif; margin: 50px;}
	.datepicker2{ font: 65% "Trebuchet MS", sans-serif; margin: 50px;}
	.demoHeaders { margin-top: 2em; }
	#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
	#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
	ul#icons {margin: 0; padding: 0;}
	ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
	ul#icons span.ui-icon {float: left; margin: 0 4px;}
	
	table, th
{
border:2px solid black;
border-collapse:collapse;
}

td
{
border:1px solid black;
border-collapse:collapse;
}

th
{
background-color:3399FF;
color:white;
}
	
	</style>
	
<script type="text/javascript">
$(function(){

    // Datepicker
    $("#datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#datepicker2").datepicker({ dateFormat: 'dd-mm-yy' });
    // Tabs
    $('#tabs').tabs();
    
});
</script>

<SCRIPT TYPE="text/javascript">
<!--
// copyright 1999 Idocs, Inc. http://www.idocs.com
// Distribute this script freely but keep this notice in place
function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);

// control keys
if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;

// numbers
else if ((("0123456789").indexOf(keychar) > -1))
   return true;

// decimal point jump
else if (dec && (keychar == "."))
   {
   myfield.form.elements[dec].focus();
   return false;
   }
else
   return false;
}

//-->
</SCRIPT>

<?php

// check to see if $_SESSION['timeout'] is set
if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $session_timeout)
        { echo "<P>Login time out. Please <a href=\"logout.php\">click here</a> for the main page.";
            die;
         }
}

$_SESSION['timeout'] = time();

if ((!isset($_SESSION["valid_user"])) && ($_SERVER['PHP_SELF'] != "$root_dir/login.php"))
{
        // User not logged in:
        echo "<a href=\"$root_dir/login.php\"> login</a>";
        echo "<HR>";
        echo "no user logged in!";
        require("footer.php");
        die();
}
else {
    if (!isset($_SESSION['valid_user'])){
        echo "<a href=\"$root_dir/login.php\"> login</a>";  
    }
    else {
    $user = $_SESSION['valid_user'];
    
    echo "<form method=\"post\"  action=\"$root_dir/advancedsearchresults.php?q=3\" style='margin: 0; padding: 0'><a href = \"$root_dir/dashboard.php\">Dashboard</a> | <a href = \"$root_dir/searchresults.php\">My Orders</a>  | <a href = \"$root_dir/userprofile.php\">My Profile</a> | Search WO Summary: <input name=\"wosummary\" id=\"wosummary\" type=\"text\"><input name=\"wosummarybutton\" id=\"wosummarybutton\" type=\"submit\"> | logged in as $user [<a href = \"$root_dir/logout.php\">logout</a>]";
    
    //if main admin user, show site admin option:   
    
    require("db.php");
    //extract user lv0 (i.e. plant)
    
   
    if (is_dpt_admin($user) OR is_site_admin($user) OR is_plant_admin($user) OR is_system_admin($user))
        echo "[<a href = \"$root_dir/admin_modules/siteconfig.php\">site config</a>]</form>";
    else echo "</form>";
    }
}

//if ((!isset($_SESSION["valid_user"])) && ($_SERVER['PHP_SELF'] != "/login.php"))
//{
//        // User not logged in:
//        echo "<a href=\"$root_dir/login.php\"> login</a>";
//        echo "<HR>";
//        echo "no user logged in!";
//        require("footer.php");
//        die();
//}
//else {
//    if (!isset($_SESSION['valid_user'])){
//        echo "<a href=\"$root_dir/login.php\"> login</a>";  
//    }
//    else {
//    $user = $_SESSION['valid_user'];
//    echo "<form method=\"post\"  action=\"advancedsearchresults.php?q=3\" style='margin: 0; padding: 0'><a href = \"$root_dir/dashboard.php\">Dashboard</a> | <a href = \"$root_dir/searchresults.php\">My Orders</a>  | <a href = \"$root_dir/userprofile.php\">My Profile</a> | Search WO Summary: <input name=\"wosummary\" id=\"wosummary\" type=\"text\"><input name=\"wosummarybutton\" id=\"wosummarybutton\" type=\"submit\"> | logged in as $user [<a href = \"$root_dir/logout.php\">logout</a>]</form>";
//    }
//}

echo "<HR>";

?>
