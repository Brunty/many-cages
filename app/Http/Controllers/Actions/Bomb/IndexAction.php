<?php namespace App\Http\Controllers\Actions\Bomb;

use App\Http\Controllers\Actions\BaseAction;
use App\Repositories\CageRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;

class IndexAction extends BaseAction
{

    protected $cageRepo;

    public function __construct(CageRepositoryInterface $cageRepo)
    {
        $this->cageRepo = $cageRepo;
    }

    public function act(Request $request, ResponseFactory $response, $number = 5)
    {
        $status = 200;
        try {
            $cages = $this->cageRepo->getRandomCageImages($number);
            $data = [
                'cages' => $cages
            ];
        } catch (\InvalidArgumentException $e) {
            $status = 400;
            $data = [
                'error' => $e->getMessage()
            ];
        }

        return $response->json($data, $status);
    }
}