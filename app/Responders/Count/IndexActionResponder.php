<?php namespace App\Responders\Count;

use App\Responders\ResponderInterface;
use App\Responders\Responder as BaseResponder;

class IndexActionResponder extends BaseResponder implements ResponderInterface {

    public function respond($data, $request)
    {
        return 'noo';
    }
}