<?php

namespace spec\App\Repositories;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonCageRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('App\Repositories\JsonCageRepository');
    }
}
