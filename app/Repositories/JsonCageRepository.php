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

    protected $cageIpsum;

    protected $cageQuotes;

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
    public function getRandomCageImage()
    {
        $image = $this->getAllCageImages()[rand(0, $this->getMaxImageIndex())];

        return $image;
    }

    /**
     * @param int $count
     *
     * @return array
     */
    public function getRandomCageImages($count = 5)
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
        $cages = $this->getAllCageImages();

        // Randomise those Cages!
        shuffle($cages);

        return array_slice($cages, 0, $count);
    }

    /**
     * @return array
     */
    public function getAllCageImages()
    {
        $fileContents = json_decode(file_get_contents($this->getCageFilePath()), true);

        $this->cages = $fileContents['cages'];

        return $this->cages;
    }

    public function getAllCageQuotes()
    {

        $fileContents = json_decode(file_get_contents($this->getCageFilePath()), true);

        $this->cageQuotes = $fileContents['cage_quotes'];

        return $this->cageQuotes;
    }

    /**
     * Get the total number of Cages we have
     * @return int
     */
    public function getCageImageCount()
    {
        return count($this->getAllCageImages());
    }

    /**
     * Get the last index number of the arra of Cages that we have.
     * @return int
     */
    private function getMaxImageIndex()
    {
        return count($this->getAllCageImages()) - 1;
    }

    public function getRandomCageQuote()
    {
        return $this->getAllCageQuotes()[rand(0, $this->getMaxQuoteIndex())];
    }

    public function getCageIpsum($sentences = 10)
    {
        $quotes = $this->getAllCageQuotes();
        $wordString = implode(' ', $quotes);
        $wordString = str_replace('.', '', $wordString);
        $wordArray = explode(' ', $wordString);
        $ipsum = [];

        while (count($ipsum) < $sentences) {
            $wordsInSentence = rand(6, 11);
            $wordsForSentence = [];

            while (count($wordsForSentence) < $wordsInSentence) {
                shuffle($wordArray);
                $wordsForSentence[] = $wordArray[0];
            }

            $string = implode(' ', $wordsForSentence);
            $string = ucfirst($string);
            $string = trim($string, ',\'\"'); // trim off any trailing punctuation, so we don't end up messy.
            $ipsum[] = $string;
        }

        return implode('. ', $ipsum) . '.';
    }

    private function getMaxQuoteIndex()
    {
        return count($this->getAllCageQuotes()) - 1;
    }
}