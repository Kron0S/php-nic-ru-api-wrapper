<?php

namespace Nic\Api;

class Orders extends AbstractApi
{
    public function create($params)
    {
        return $this->post(array_merge(array(
			'request' => 'order',
			'operation' => 'create',
		), $params));
    }
    public function create($params)
    {
        return $this->post(array_merge(array(
			'request' => 'order',
			'operation' => 'create',
		), $params));
    }
    public function get($params)
    {
        return $this->post(array_merge(array(
			'request' => 'order',
			'operation' => 'get',
		), $params));
    }
    public function delete($params)
    {
        return $this->post(array_merge(array(
			'request' => 'order',
			'operation' => 'delete',
		), $params));
    }
    public function swap($params)
    {
        return $this->post(array_merge(array(
			'request' => 'order',
			'operation' => 'swap',
		), $params));
    }
}
