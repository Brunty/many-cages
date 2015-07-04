<?php namespace App\Http\Controllers\Actions\Count;

use App\Http\Controllers\Actions\BaseAction;
use App\Repositories\CageRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;

class IndexAction extends BaseAction
{
    protected $cageRepo;

    public function __construct(CageRepositoryInterface $cageRepo)
    {
        $this->cageRepo = $cageRepo;
    }

    public function act(ResponseFactory $response)
    {
        $cageCount = $this->cageRepo->getCageImageCount();
        $data = [
            'cage_count' => $cageCount
        ];

        return $response->json($data);
    }
}