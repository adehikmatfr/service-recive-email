<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;

function amcpConnect()
{
    return new AMQPStreamConnection($_ENV["RMQ_HOST"], $_ENV["RMQ_PORT"], $_ENV["RMQ_USER"], $_ENV["RMQ_PASSWORD"]);
}
