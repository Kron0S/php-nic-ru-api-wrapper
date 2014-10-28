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
		$requestId = date('YmdHis.').getmypid().'@'.$this->partnerWebSite;
		$parameters = array(
			'request-id' => $requestId,
		);
		
		$content_out = "";
		foreach ($parameters as $key=>$param) {
			$content_out .= $key.":".$param;
			$content_out .= "\n";
		}
		
		$content = $request->getContent();
		parse_str($content, $content);
		$content = $content['SimpleRequest'];
		$content = iconv('KOI8-R', 'UTF-8', $content);

		$content = $content_out . $content;

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
