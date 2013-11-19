<?php

namespace ZENben\Bundle\YammerBundle\Service;

use Buzz\Browser;
use ZENben\Bundle\YammerBundle\Buzz\Listener\YammerListener;
use ZENben\Bundle\YammerBundle\Model\Group;

class YammerService
{
    protected $browser;
    
    public function __construct(Browser $browser, $config) {
        $browser->addListener(
            new YammerListener(
                $config['api_base_url'], 
                $config['token']
            )
        );
        $this->browser = $browser;
    }

    public function postMessage($message, $group = null) {
        if ($group instanceof Group) {
            $group = $group->getId();
        }
        $this->browser->post('/messages', [], [
            'body' => $message,
            'group_id' => $group
        ]);
    }

    public function getGroups()
    {
        $groupsJson = $this->browser->get('/groups')->getContent();
        $groups = [];
        foreach ($groupsJson as $groupsJson) {
            $groups[] = new Group(
                $groupsJson['id'],
                $groupsJson['name'],
                $groupsJson['full_name'],
                $groupsJson['description']
            );
        }
        return $groups;
    }

}