<?php

namespace Nic\Api;

class Servers extends AbstractApi
{
	protected $type = "server";
    public function create($params)
    {
        return $this->post(array_merge(array(
			'request' => 'server',
			'operation' => 'create',
		), $params));
    }
    public function update($params)
    {
        return $this->post(array_merge(array(
			'request' => 'server',
			'operation' => 'update',
		), $params));
    }
    public function search($params)
    {
        return $this->post(array_merge(array(
			'request' => 'server',
			'operation' => 'search',
		), $params));
    }
    public function delete($params)
    {
        return $this->post(array_merge(array(
			'request' => 'server',
			'operation' => 'delete',
		), $params));
    }
}
