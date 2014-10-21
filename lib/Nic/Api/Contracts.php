<?php

namespace Nic\Api;

class Contracts extends AbstractApi
{
    public function search($params)
    {
        return $this->post(array_merge(array(
			'request' => 'contract',
			'operation' => 'search ',
		), $params));
    }
    public function get($params)
    {
        return $this->post(array_merge(array(
			'request' => 'contract',
			'operation' => 'get',
		), $params));
    }
}
