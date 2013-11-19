<?php

namespace ZENben\Bundle\YammerBundle\Buzz\Listener;

use Buzz\Message\MessageInterface;
use Buzz\Message\RequestInterface;
use Buzz\Listener\ListenerInterface;
use Buzz\Util\Url;

class YammerListener implements ListenerInterface {

    private $token;
    protected $apiBaseUrl;

    public function __construct($apiBaseUrl, $token) {
        $this->apiBaseUrl = $apiBaseUrl;
        $this->token = $token;
    }

    public function preSend(RequestInterface $request) {
        $raw = $request->getContent();
        $url = new Url($this->apiBaseUrl . $request->getResource() . '.json');

        $request->setContent(json_encode($raw));
        $request->setHost($url->getHost());
        $request->setResource($url->getResource());
        $request->addHeader('Authorization: Bearer ' . $this->token);
        $request->addHeader('Accept: application/json');
        $request->addHeader('Content-Type: application/json');
    }

    public function postSend(RequestInterface $request, MessageInterface $response) {
        $raw = $response->getContent();
        $content = json_decode($raw,true);
        
        if ( ! ($response->isInformational() || $response->isSuccessful() ) ) {
            throw new \Exception(
                sprintf('%s', //TODO: extend
                    $response->getStatusCode()
                )
            );
        }
        $response->setContent($content);
    }

}
