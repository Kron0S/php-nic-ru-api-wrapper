<?php

namespace Nic\Api;

class Services extends AbstractApi
{
	protected $type = "service";
    public function search($params)
    {
        return $this->post(array_merge(array(
			'request' => 'service',
			'operation' => 'search',
		), $params));
    }
}
