<?php
     error_reporting(1);
     session_start();
     
     include_once("model/connect.php");
     include_once("model/mAPI.php");
     include_once("model/mLogin.php");
     include_once("controller/cAPI.php");
     include_once("controller/cLogin.php");
     
     $ctrlAPI = new cAPI();
     $ctrlLogin = new cLogin();
     
     include_once("view/layout/header.php");
     
     $p = "home";
     
     if (isset($_GET["p"]))
          $p = $_GET["p"];
     else $p = "home";
     
     if ($p == "home")
          include_once("view/page/home/index.php");
     else if (!file_exists("view/page/".$p."/index.php"))
          include_once("view/page/404/index.php");
     else include_once("view/page/".$p."/index.php");
     
     include_once("view/layout/footer.php");
?>