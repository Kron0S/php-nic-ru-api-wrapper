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
		$content = $request->getContent();
		parse_str($content, $content);
		$content = $content['SimpleRequest'];

		$requestId = date('YmdHis.').getmypid().'@'.$this->partnerWebSite;
		$parameters = array(
			'request-id' => $requestId,
		);
		
		foreach ($parameters as $key=>$param) {
			$content .= "\n";
			$content .= $key.":".$param;
		}
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
