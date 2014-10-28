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
			$content = iconv('KOI8-R', 'UTF-8', $response);
			$content = explode("\n", $content);
			
			if (count($content) == 0) {
				return array('state' => '404','statemsg' => 'Error','request-id' => '','type' => 'error','body' => '',);
			}
			$stateStr = trim($content[0]);
			$stateStr = substr($stateStr, 7);
			$state = substr($stateStr, 0, 3);
			$statemsg = substr($stateStr, 4);
			if (count($content) <= 1) {
				return array('state' => $state,'statemsg' => $statemsg,'request-id' => '','type' => 'error','body' => '',);
			}
			$requestId = trim($content[1]);
			$requestId = substr($requestId, 12);
			if (count($content) <= 4) {
				return array('state' => $state,'statemsg' => $statemsg,'request-id' => $requestId,'type' => 'error','body' => '',);
			}
			$type = trim($content[4]);
			$type = substr($type, 1);
			$type = substr($type, 0, -1);
			if (count($content) <= 5) {
				return array('state' => $state,'statemsg' => $statemsg,'request-id' => $requestId,'type' => $type,'body' => '',);
			}
			$body = array();
			for ($i = 5; $i < count($content); $i++) {
				$str = trim($content[$i]);
				$item = explode(':', $str, 2);
				if (count($item) == 2) {
					if (isset($body[$item[0]])) {
						if (is_array($body[$item[0]])) {
							$body[$item[0]][] = $item[1];
						} else {
							$body[$item[0]] = array(
								$body[$item[0]],
								$item[1],
							);
						}
					} else {
						$body[$item[0]] = $item[1];
					}
				}
			}
			
			$res = array(
				'state' => $state,
				'statemsg' => $statemsg,
				'request-id' => $requestId,
				'type' => $type,
				'body' => $body,
			);
			
            return $res;
        } else {
            return $response;
        }
    }
}
