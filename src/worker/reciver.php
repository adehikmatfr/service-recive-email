<?php

$connection = amcpConnect();
$channel = $connection->channel();

$channel->queue_declare('send_email', false, false, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    $base = $msg->body;
    $data = base64_decode($base);
    $decod = json_decode($data);

    mailSend($decod->email, $decod->message);

    echo "\n";
    echo ' [x] name : ', $decod->email, "\n";
    echo ' [x] email : ', $decod->message, "\n";
};

$channel->basic_consume('send_email', '', false, true, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}
