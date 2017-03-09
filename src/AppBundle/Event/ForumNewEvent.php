<?php

namespace AppBundle\Event;

use AppBundle\Entity\Forum;
use Symfony\Component\EventDispatcher\Event;

class ForumNewEvent extends Event
{
    protected $forum;

    public function __construct(Forum $forum)
    {
        $this->forum = $forum;
    }

    public function getForum()
    {
        return $this->forum;
    }
}

