<?php

namespace Nic\HttpClient\Listener;

use Nic\Client;
use Nic\Exception\InvalidArgumentException;

use Buzz\Listener\ListenerInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Buzz\Util\Url;

/**
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class GenerateRequestIdListener implements ListenerInterface
{
    /**
     * @var array
     */
    private $partnerWebSite;

    /**
     * @param array      $partnerWebSite
     */
    public function __construct($partnerWebSite)
    {
        $this->partnerWebSite = $partnerWebSite;
    }

    /**
     * {@inheritDoc}
     *
     * @throws InvalidArgumentException
     */
    public function preSend(RequestInterface $request)
    {
		$url  = $request->getUrl();
		$requestId = date('YmdHis.').getmypid().'@'.$this->partnerWebSite;
		$query = array(
			'request-id' => $requestId,
		);
		$url .= (false === strpos($url, '?') ? '?' : '&').utf8_encode(http_build_query($query, '', '&'));

		$request->fromUrl(new Url($url));
    }

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }
}
