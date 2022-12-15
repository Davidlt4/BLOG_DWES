<?php

session_start();
require_once "autoloader.php";
require_once "config/config.php";
require_once "views/layout/header.php";

use Controllers\FrontController;
FrontController::main();

?>
<link rel="stylesheet" href="css/index.css">
<?php
    require_once("views/layout/footer.php");
?>