<?php

require_once 'vendor/autoload.php';

$client = new \Nic\Client();
$client->setHeaders(array('Content-Type' => 'application/x-www-form-urlencoded'));
$client->authenticate('370/NIC-REG/adm', 'dogovor');
$client->generateRequestId('test.ru');
$client->addDefaults(array(
	'lang' => 'ru',
));

$client->api('contracts')->get(array(
	'subject-contract' => '370/NIC-REG',
));

echo "\n\n";
echo $client->getHttpClient()->getLastRequest();
echo $client->getHttpClient()->getLastResponse();
echo "\n\n";
