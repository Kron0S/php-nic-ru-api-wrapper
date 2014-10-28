<?php

require_once 'vendor/autoload.php';

$client = new \Nic\Client();
$client->setHeaders(array('Content-Type' => 'application/x-www-form-urlencoded'));
$client->authenticate('370/NIC-REG/adm', 'dogovor');
$client->generateRequestId('test.ru');
$client->addDefaults(array(
	'lang' => 'ru',
));

try {
	$res = $client->api('contracts')->get(array(
		'subject-contract' => '370/NIC-REG',
	));
	echo "\n\n";
	var_dump($res);
	echo "\n\n";
} catch (Exception $e) {
	var_dump($e->getCode());
	var_dump($e->getMessage());
}

