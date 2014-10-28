<?php

namespace Nic\Api;

class Accounts extends AbstractApi
{
	protected $type = "account";
    public function get($params)
    {
        return $this->post(array_merge(array(
			'request' => 'account',
			'operation' => 'get',
		), $params));
    }
}
