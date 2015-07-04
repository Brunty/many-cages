<?php

namespace spec\App\Http\Controllers\Actions\Random;

use App\Http\Controllers\Actions\Random\IndexAction;
use App\Repositories\CageRepository;
use App\Services\CageService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IndexActionSpec extends ObjectBehavior
{

    function let(CageRepository $cageRepo)
    {
        $this->beConstructedWith($cageRepo);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('App\Http\Controllers\Actions\Random\IndexAction');
    }
}
