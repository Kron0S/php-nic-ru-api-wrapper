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
class DefaultsListener implements ListenerInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * @param array      $options
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     *
     * @throws InvalidArgumentException
     */
    public function preSend(RequestInterface $request)
    {
		$url  = $request->getUrl();
		$url .= (false === strpos($url, '?') ? '?' : '&').utf8_encode(http_build_query($this->options, '', '&'));

		$request->fromUrl(new Url($url));
    }

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }
}
