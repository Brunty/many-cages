<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit_Framework_Assert as PHPUnit;

class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{

    use CountTransformer;

    /**
     * @Then the response code should be :code
     */
    public function theResponseCodeShouldBe($code)
    {
        $this->assertResponseStatus($code);
    }

    /**
     * @Then the JSON response should contain :string
     */
    public function theJsonResponseShouldContain($string)
    {
        $this->assertResponseContains($string);
    }

    /**
     * @Then the JSON response should not contain :string
     */
    public function theJsonResponseShouldNotContain($string)
    {
        $this->assertResponseNotContains($string);
    }

    /**
     * @Then the JSON response should contain the key :itemKey
     */
    public function theJsonResponseShouldContainTheKey($itemKey)
    {
        $jsonOutput = $this->getJsonOutputAsArray();
        PHPUnit::assertTrue(isset($jsonOutput[$itemKey]));
    }

    /**
     * @Then the JSON response should contain :numberOfItems item(s) in :itemKey
     */
    public function theJsonResponseShouldContainItemsIn($numberOfItems, $itemKey)
    {
        $jsonOutput = $this->getJsonOutputAsArray();
        PHPUnit::assertEquals($numberOfItems, count($jsonOutput[$itemKey]));
    }

    /**
     * @Then the JSON response should not contain the key :itemKey
     */
    public function theJsonResponseShouldNotContainTheKey($itemKey)
    {
        $jsonOutput = $this->getJsonOutputAsArray();
        PHPUnit::assertFalse(isset($jsonOutput[$itemKey]));
    }

    /**
     * @Then the JSON response should contain the count of items in the :itemKey key
     */
    public function theJsonResponseShouldContainTheCountOfItemsInTheKey($itemKey)
    {
        $jsonOutput = $this->getJsonOutputAsArray();
        $numberOfItems = $jsonOutput[$itemKey];
        $items = json_decode(file_get_contents(storage_path() . '/app/cages.json'), true);
        $expectedNumber = count($items['cages']);
        PHPUnit::assertEquals($numberOfItems, $expectedNumber);
    }

    /**
     * @return string
     */
    private function getResponseOutput()
    {
        return $this->getSession()->getDriver()->getContent();
    }

    /**
     * @return array
     */
    private function getJsonOutputAsArray()
    {
        $output = $this->getResponseOutput();

        return json_decode($output, true);
    }
}
