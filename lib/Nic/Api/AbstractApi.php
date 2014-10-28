<?php

namespace Nic\Api;

use Nic\Client;

/**
 * Abstract class for Api classes
 *
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
abstract class AbstractApi implements ApiInterface
{
    /**
     * Default entries per page
     */
    const PER_PAGE = 20;

    /**
     * The client
     *
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function configure()
    {
    }

    /**
     * {@inheritDoc}
     */
    protected function get(array $parameters = array(), $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->get('', $parameters, $requestHeaders);

        return $response->getContent();
    }

    /**
     * {@inheritDoc}
     */
    protected function post(array $parameters = array(), $requestHeaders = array())
    {
		$content = "";
		$first = true;
		foreach ($parameters as $key=>$param) {
			if (!$first) {
				$content .= "\n";
			} else {
				$first = false;
			}
			$content .= $key.":".$param;
		}
		$content = iconv('UTF-8', 'KOI8-R', $content);
		$content = array(
			'SimpleRequest' => $content,
		);

        $response = $this->client->getHttpClient()->post('', $content, $requestHeaders);

        return $response->getContent();
    }

    /**
     * {@inheritDoc}
     */
    protected function patch(array $parameters = array(), $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->patch('', $parameters, $requestHeaders);

        return $response->getContent();
    }

    /**
     * {@inheritDoc}
     */
    protected function put(array $parameters = array(), $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->put('', $parameters, $requestHeaders);

        return $response->getContent();
    }

    /**
     * {@inheritDoc}
     */
    protected function delete(array $parameters = array(), $requestHeaders = array())
    {
        $response = $this->client->getHttpClient()->delete('', $parameters, $requestHeaders);

        return $response->getContent();
    }
}
