<?php

namespace Nic\HttpClient\Listener;

use Buzz\Listener\ListenerInterface;
use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Nic\Exception\ErrorException;
use Nic\Exception\RuntimeException;

/**
 * @author Joseph Bielawski <stloyd@gmail.com>
 */
class ErrorListener implements ListenerInterface
{
    /**
     * @var array
     */
    private $options;

    /**
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->options = $options;
    }

    /**
     * {@inheritDoc}
     */
    public function preSend(RequestInterface $request)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function postSend(RequestInterface $request, MessageInterface $response)
    {
		$content = $response->getContent();
		if (is_array($content) && isset($content['state']) && $content['state'] !== '200') {
			throw new RuntimeException($content['statemsg'], (int)$content['state']);
		}
        /** @var $response \Nic\HttpClient\Message\Response */
        if ($response->isClientError() || $response->isServerError()) {
            $content = $response->getContent();
            if (is_array($content) && isset($content['message'])) {
                if (400 == $response->getStatusCode()) {
                    throw new ErrorException($content['message'], 400);
                }
            }

            $errorMessage = null;
            if (isset($content['error'])) {
                $errorMessage = implode("\n", $content['error']);
            } elseif (isset($content['message'])) {
                $errorMessage = $content['message'];
            } else {
                $errorMessage = $content;
            }

            throw new RuntimeException($errorMessage, $response->getStatusCode());
        }
    }
}
