<?php
/**
 * Created by PhpStorm.
 * User: brunty
 * Date: 04/07/15
 * Time: 15:42
 */

namespace App\Responders;


interface ResponderInterface {

    public function respond($data, $request);
}