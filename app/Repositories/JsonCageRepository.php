<?php namespace App\Repositories;

use InvalidArgumentException;

/**
 * Class CageRepository
 * @package App\Repositories
 */
class JsonCageRepository implements CageRepositoryInterface
{

    /**
     *
     */
    CONST MAX_BOMB_CAGES = 10;
    /**
     * @var array
     */
    protected $cages = [];

    /**
     * @var string
     */
    protected $cageFile = '/app/cages.json';

    /**
     * @param null $file
     *
     * @return $this
     */
    public function setCageFilePath($file = null)
    {
        if ( ! $file || ! file_exists(storage_path() . $file)) {
            throw new InvalidArgumentException(sprintf('That file doesn\'t exist: %s', $file));
        }
        $this->cageFile = $file;

        return $this;
    }

    /**
     * @return string
     */
    public function getCageFilePath()
    {
        return storage_path() . $this->cageFile;
    }

    /**
     * @return mixed
     */
    public function getRandomCage()
    {
        $image = $this->getAllCages()[rand(0, $this->getMaxArrayIndex())];

        return $image;
    }

    /**
     * @param int $count
     *
     * @return array
     */
    public function getRandomCages($count = 5)
    {
        /* move this to service class as it's basically validation? Don't like it in repo, oh well... */
        if ($count > self::MAX_BOMB_CAGES) {
            throw new InvalidArgumentException(
                sprintf(
                    'YOU WANT %d?! THAT\'S TOO MANY CAGES. I CAN\'T HANDLE THAT! (Best I can do is %d...)',
                    $count,
                    self::MAX_BOMB_CAGES
                )
            );
        }

        // ALL THE CAGES!
        $cages = $this->getAllCages();

        // Randomise those Cages!
        shuffle($cages);

        return array_slice($cages, 0, $count);
    }

    /**
     * @return array
     */
    public function getAllCages()
    {
        $fileContents = json_decode(file_get_contents($this->getCageFilePath()), true);

        $this->cages = $fileContents['cages'];

        return $this->cages;
    }

    /**
     * Get the total number of Cages we have
     * @return int
     */
    public function getCageCount()
    {
        return count($this->getAllCages());
    }

    /**
     * Get the last index number of the arra of Cages that we have.
     * @return int
     */
    private function getMaxArrayIndex()
    {
        return count($this->getAllCages()) - 1;
    }
}