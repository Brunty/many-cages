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
    function getRandomCage();

    /**
     * @param int $count
     *
     * @return mixed
     */
    function getRandomCages($count = 5);

    /**
     * @return mixed
     */
    function getAllCages();

    /**
     * @return mixed
     */
    function getCageCount();
}