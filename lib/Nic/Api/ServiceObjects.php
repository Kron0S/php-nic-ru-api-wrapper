<?php

namespace Nic\Api;

class ServiceObjects extends AbstractApi
{
	protected $type = "service";
    public function search($params)
    {
        return $this->post(array_merge(array(
			'request' => 'service-object',
			'operation' => 'search',
		), $params));
    }
}
