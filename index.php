<?php 
if( !session_id() ) session_start();

require_once './app/autoload.php';

require_once './app/init.php';

$app = new App();