<?php namespace App\Http\Controllers\Actions\Ipsum;

use App\Http\Controllers\Actions\BaseAction;
use App\Repositories\CageRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;

/**
 * Class IndexAction
 * @package App\Http\Controllers\Actions\Random
 */
class IndexAction extends BaseAction
{
    protected $cageRepo;

    public function __construct(CageRepositoryInterface $cageRepo)
    {
        $this->cageRepo = $cageRepo;
    }

    /**
     * @param ResponseFactory $response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function act(ResponseFactory $response)
    {
        $cageIpsum = $this->cageRepo->getCageIpsum();
        $data = [
            'cage_ipsum' => $cageIpsum
        ];

        return $response->json($data);
    }
}