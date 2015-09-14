<?php

namespace ZENben\Bundle\YammerBundle\Service;

use Buzz\Browser;
use ZENben\Bundle\YammerBundle\Buzz\Listener\YammerListener;
use ZENben\Bundle\YammerBundle\Model\Group;

class YammerService
{
    protected $browser;
    protected $defaultGroupId;
    
    public function __construct(Browser $browser, $config) {
        $browser->addListener(
            new YammerListener(
                $config['api_base_url'], 
                $config['token']
            )
        );
        $this->browser = $browser;
        $this->defaultGroupId = $config['default_group_id'];
    }

    public function postMessage($message, $group = null) {
        if ($group === null) {
            $group = $this->defaultGroupId;
        } else if ($group instanceof Group) {
            $group = $group->getId();
        }
        $this->browser->post('/messages', array(), array(
            'body' => $message,
            'group_id' => $group
        ));
    }

    public function getGroups()
    {
        $groupsJson = $this->browser->get('/groups')->getContent();
        $groups = array();
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