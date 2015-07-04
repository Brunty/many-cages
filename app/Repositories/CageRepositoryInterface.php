<?php

namespace App\Repositories;


/**
 * Interface CageRepositoryInterface
 * @package App\Repositories
 */
interface CageRepositoryInterface
{

    /**
     * @return mixed
     */
    function getRandomCageImage();

    /**
     * @param int $count
     *
     * @return mixed
     */
    function getRandomCageImages($count = 5);

    /**
     * @return mixed
     */
    function getAllCageImages();

    /**
     * @return mixed
     */
    function getCageImageCount();

    public function getCageIpsum();
}