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
class AuthListener implements ListenerInterface
{
    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @param string      $login
     * @param string      $password
     */
    public function __construct($login, $password)
    {
        $this->login  = $login;
        $this->password = $password;
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

		$parameters = array(
			'login' => $this->login,
			'password' => $this->password, 
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
