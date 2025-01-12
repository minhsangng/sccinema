<?php
     error_reporting(1);
     
     include_once("view/layout/header.html");
     
     $p = "home";
     
     if (isset($_GET["p"]))
          $p = $_GET["p"];
     else $p = "home";
     
     if ($p == "home")
          include_once("view/page/dashboard/index.php");
     else if (!file_exists("view/page/".$p."/index.php"))
          include_once("view/page/404/index.php");
     else include_once("view/page/".$p."/index.php");
     
     include_once("view/layout/footer.html");
?>