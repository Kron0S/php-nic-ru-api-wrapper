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
	// $res = $client->api('contracts')->get(array(
		// 'subject-contract' => '370/NIC-REG',
	// ));

	/*
	$res = $client->api('contracts')->create(array(
		'contract-type' => 'PRS',
		'password' => 'QWERTY',
		'tech-password' => 'dk3wo2e',
		'person' => 'Sidor S Sidorov',
		'person-r' => 'Сидоров Сидор Сидорович',
		'country' => 'RU',
		'currency-id' => 'RUR',
		'passport' => 'XXX-AB 123456 выдан 123 отделением милиции г.Москвы, 30.01.1990',
		'passport' => 'зарегистрирован по адресу: Москва, ул.Кошкина, д.15, кв.4',
		'birth-date' => '11.11.1965',
		'p-addr' => '123456, Москва, ул.Кошкина, д.15, кв.4',
		'p-addr' => 'Сидорову Сидору Сидоровичу',
		'phone' => '+7 495 1234567',
		'phone' => '+7 495 1234568',
		'phone' => '+7 495 1234569',
		'fax-no' => '+7 495 1234560',
		'fax-no' => '+7 495 1234560',
		'e-mail' => 'adm-group@my-internet-name.ru',
		'e-mail' => 'sidor@test.my-provider.ru',
		'mnt-nfy' => 'adm-group@my-internet-name.ru',
	));
	*/
	/*
	$res = $client->api('contacts')->create(array(
		'subject-contract' => '2107469/NIC-D',
		'status' => 'registrant',
		'org' => '',
		'name' => 'Sidorov, Sidor',
		'country' => 'RU',
		'region' => 'Moscow',
		'city' => 'Moscow',
		'street' => 'Kurchatov sq. 1',
		'zipcode' => '123456',
		'phone' => '+7 495 1234567',
		'fax' => '+7 495 1234567',
		'email' => 'sidor@partner-site.ru',
	));
	*/
	$res = $client->api('orders')->create(array(
		'subject-contract' => '2107469/NIC-D',
		'service' => 'domain_ru',
		'template' => 'client_ru',
		'action' => 'new',
		'domain' => 'test.ru',
		'descr' => 'Domain for test purpose',
		'e-mail' => 'sidor@test.my-provider.ru',
		'phone' => '+7 495 1234567',
		'fax-no' => '+7 495 1234568',
		'nserver' => 'ns.test.ru 195.2.32.144, 194.18.13.68',
		'nserver' => 'ns1.nic.ru',
	));
	echo "\n\n";
	var_dump($res);
	echo "\n\n";
} catch (Exception $e) {
	var_dump($e->getCode());
	var_dump($e->getMessage());
}

echo $client->getHttpClient()->getLastRequest();
echo $client->getHttpClient()->getLastResponse();

