<?php

namespace Nic\Model;

use Nic\Api\MergeRequests;
use Nic\Client;
use Nic\Api\AbstractApi as Api;

class Contract extends AbstractModel
{
    protected static $_properties = array(
		'address-r',
		'adm-email',
		'adm-fax',
		'adm-person',
		'adm-person-r',
		'adm-phone',
		'anketa-update-all-fields',
		'bill-person',
		'birth-date',
		'chownerable',
		'city',
		'click-date',
		'code',
		'company',
		'contract-type',
		'country',
		'currency-id',
		'd-addr',
		'e-mail',
		'fax-no',
		'flag-epwd',
		'is-resident',
		'is_paper',
		'is_signed',
		'kpp',
		'mnt-nfy',
		'nic-a',
		'org',
		'org-r',
		'owner',
		'p-addr',
		'parent-org-r',
		'passport',
		'password',
		'person',
		'person-r',
		'phone',
		'reklama',
		'state',
		'street',
		'tech-email',
		'tech-fax',
		'tech-password',
		'tech-person',
		'tech-person-r',
		'tech-phone',
		'zipcode',
	);

    public static function fromArray(Client $client, array $data)
    {
        $item = new static($data['id']);
        $item->setClient($client);

        return $item->hydrate($data);
    }

    public static function create(Client $client, $name, array $params = array())
    {
        $data = $client->api('contracts')->create($name, $params);

        return static::fromArray($client, $data);
    }

    public function __construct($id = null, Client $client = null)
    {
        $this->setClient($client);
        $this->id = $id;
    }

    public function show()
    {
        $data = $this->api('contracts')->show($this->id);

        return static::fromArray($this->getClient(), $data);
    }
}
