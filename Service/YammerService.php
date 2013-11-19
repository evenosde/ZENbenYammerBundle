<?php

namespace ZENben\Bundle\YammerBundle\Service;

use ZENben\Bundle\YammerBundle\Buzz\Listener\YammerListener;

class YammerService
{
    protected $browser;
    
    public function __construct(\Buzz\Browser $browser, $config) {
        $browser->addListener(
            new YammerListener(
                $config['api_base_url'], 
                $config['username'], 
                $config['password']
            )
        );
        $this->browser = $browser;
    }

    public function postMessage($message, $groupId = null) {
        $this->browser->post('',[
            'body' => $message,
            'group_id' => $groupId
        ]);
    }

}