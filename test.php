<?php

require_once 'vendor/autoload.php';

$client = new \Nic\Client();
$client->authenticate('370/NIC-REG/adm', 'dogovor');
$client->generateRequestId('test.ru');
$client->addDefaults(array(
	'lang' => 'ru',
));

$client->api('contracts')->get(array(
	'subject-contract' => '3470/NIC-D',
));

// subject-contract:3457/NIC-D
// request-id:20011220103455.12345@nic.ru
