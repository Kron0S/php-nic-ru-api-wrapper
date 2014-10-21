<?php

namespace Nic;

use Buzz\Client\Curl;
use Buzz\Client\ClientInterface;

use Nic\Api\ApiInterface;
use Nic\Exception\InvalidArgumentException;
use Nic\HttpClient\HttpClient;
use Nic\HttpClient\HttpClientInterface;
use Nic\HttpClient\Listener\AuthListener;
use Nic\HttpClient\Listener\DefaultsListener;
use Nic\HttpClient\Listener\GenerateRequestIdListener;

/**
 * Simple API wrapper for Nic
 */
class Client
{
    /**
     * @var array
     */
    private $options = array(
        'user_agent'  => 'php-api',
        'timeout'     => 60
    );

    private $base_url = 'https://www.nic.ru/dns/dealer';

    /**
     * The Buzz instance used to communicate with Nic
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Instantiate a new Nic client
     *
     * @param string               $baseUrl
     * @param null|ClientInterface $httpClient Buzz client
     */
    public function __construct(ClientInterface $httpClient = null)
    {
        $httpClient = $httpClient ?: new Curl();
        $httpClient->setTimeout($this->options['timeout']);
        $httpClient->setVerifyPeer(false);

        $this->httpClient   = new HttpClient($this->base_url, $this->options, $httpClient);
    }

    /**
     * @param string $name
     *
     * @return ApiInterface
     *
     * @throws InvalidArgumentException
     */
    public function api($name)
    {
        switch ($name) {
            case 'contracts':
                $api = new Api\Contracts($this);
                break;
            case 'accounts':
                $api = new Api\Accounts($this);
                break;
            case 'domains':
                $api = new Api\Domains($this);
                break;
            case 'orders':
                $api = new Api\Orders($this);
                break;
            case 'service-objects':
                $api = new Api\ServiceObjects($this);
                break;
            case 'services':
                $api = new Api\Services($this);
                break;
            case 'contacts':
                $api = new Api\Contacts($this);
                break;
            case 'servers':
                $api = new Api\Servers($this);
                break;
            case 'redeleg-onlines':
                $api = new Api\RedelegOnlines($this);
                break;

			default:
                throw new InvalidArgumentException();
        }

        return $api;
    }

    /**
     * Authenticate a user for all next requests
     *
     * @param string      $login
     * @param string	  $password
     */
    public function authenticate($login, $password)
    {
        $this->httpClient->addListener(
            new AuthListener(
                $login, $password
            )
        );
    }

    /**
     * add defaults for every request
     *
     * @param array      $options
     */
    public function addDefaults($options)
    {
        $this->httpClient->addListener(
            new DefaultsListener(
                $options
            )
        );
    }
	
    /**
     * generate request-id
     *
     * @param string      $partner-web-site 
     */
    public function generateRequestId($partnerWebSite)
    {
        $this->httpClient->addListener(
            new GenerateRequestIdListener(
                $partnerWebSite
            )
        );
    }

    /**
     * @return HttpClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param HttpClientInterface $httpClient
     */
    public function setHttpClient(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function setBaseUrl($url)
    {
        $this->base_url = $url;
    }
    public function getBaseUrl()
    {
        return $this->base_url;
    }

    /**
     * Clears used headers
     */
    public function clearHeaders()
    {
        $this->httpClient->clearHeaders();
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->httpClient->setHeaders($headers);
    }

    /**
     * @param string $name
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function getOption($name)
    {
        if (!array_key_exists($name, $this->options)) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $name));
        }

        return $this->options[$name];
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @throws InvalidArgumentException
     */
    public function setOption($name, $value)
    {
        if (!array_key_exists($name, $this->options)) {
            throw new InvalidArgumentException(sprintf('Undefined option called: "%s"', $name));
        }

        $this->options[$name] = $value;
    }
}
