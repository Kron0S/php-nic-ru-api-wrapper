<?php

namespace Nic\HttpClient\Message;

use Buzz\Message\Response as BaseResponse;

class Response extends BaseResponse
{
    /**
     * {@inheritDoc}
     */
    public function getContent()
    {
        $response = parent::getContent();
        if ($this->getHeader("Content-Type") === "text/plain") {
			$content  = $response;
            // $content  = json_decode($response, true);
    
            // if (JSON_ERROR_NONE !== json_last_error()) {
                // return $response;
            // }
    
            return $content;
        } else {
            return $response;
        }
    }
}
