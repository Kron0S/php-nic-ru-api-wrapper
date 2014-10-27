<?php

namespace Nic\Api;

class Servers extends AbstractApi
{
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
    public function domainSearch($params)
    {
        return $this->post(array_merge(array(
			'request' => 'server',
			'operation' => 'domain-search',
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
