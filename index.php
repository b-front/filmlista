<?php
session_start();
require_once("controllers/master_controller.php");
$mc = new master_controller();
echo $mc->init();