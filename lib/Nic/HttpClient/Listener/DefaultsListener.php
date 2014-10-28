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
		$content = $request->getContent();
		parse_str($content, $content);
		$content = $content['SimpleRequest'];

		$parameters = $this->options;
		
		foreach ($parameters as $key=>$param) {
			$content .= "\n";
			$content .= $key.":".$param;
		}
		$content = iconv('UTF-8', 'KOI8-R', $content);
		$content = array(
			'SimpleRequest' => $content,
		);
		// var_dump($content);die;
	
		$request->setContent(http_build_query($content));
    }

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {
    }
}
