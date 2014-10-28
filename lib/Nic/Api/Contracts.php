<?php

namespace Nic\Api;

class Contracts extends AbstractApi
{
	protected $type = "contract";
    public function search($params)
    {
        return $this->post(array_merge(array(
			'request' => 'contract',
			'operation' => 'search',
		), $params));
    }
    public function get($params)
    {
        return $this->post(array_merge(array(
			'request' => 'contract',
			'operation' => 'get',
		), $params));
    }
    public function create($params)
    {
        return $this->post(array_merge(array(
			'request' => 'contract',
			'operation' => 'create',
		), $params));
    }
    public function update($params)
    {
        return $this->post(array_merge(array(
			'request' => 'contract',
			'operation' => 'update',
		), $params));
    }
}
