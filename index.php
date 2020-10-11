<?php
require_once "./vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createMutable(__DIR__);
$dotenv->load();

require_once "./src/config/amqp.php";
require_once "./src/config/mailer.php";
require_once "./src/worker/reciver.php";
