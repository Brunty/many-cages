<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use PHPUnit_Framework_Assert as PHPUnit;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{

    /**
     * @Then I should be able to do something with Laravel
     */
    public function iShouldBeAbleToDoSomethingWithLaravel()
    {
        $environmentFileName = app()->environmentFile();
        $environmentName = env('APP_ENV');

        PHPUnit::assertEquals('.env.behat', $environmentFileName);
        PHPUnit::assertEquals('acceptance', $environmentName);
    }


    /**
     * @Then the response code should be :arg1
     */
    public function theResponseCodeShouldBe($arg1)
    {
        $this->assertResponseStatus($arg1);
    }

    /**
     * @Then the JSON response should contain :arg1
     */
    public function theJsonResponseShouldContain($arg1)
    {
        $this->assertResponseContains($arg1);
    }

    /**
     * @Then the JSON response should not contain :arg1
     */
    public function theJsonResponseShouldNotContain($arg1)
    {
        $this->assertResponseNotContains($arg1);
    }

    private function getResponseOutput()
    {
        return $this->getSession()->getDriver()->getContent();
    }

    /**
     * @Then the JSON response should contain the key :arg1
     */
    public function theJsonResponseShouldContainTheKey($itemKey)
    {
        $jsonOutput = $this->getJsonOutputAsArray();
        PHPUnit::assertTrue(isset($jsonOutput[$itemKey]));
    }

    private function getJsonOutputAsArray()
    {
        $output = $this->getResponseOutput();

        return json_decode($output, true);
    }

    /**
     * @Then the JSON response should contain :arg1 items in :arg2
     */
    public function theJsonResponseShouldContainItemsIn($numberOfItems, $itemKey)
    {
        $jsonOutput = $this->getJsonOutputAsArray();

        PHPUnit::assertEquals($numberOfItems, count($jsonOutput[$itemKey]));
    }

    /**
     * @Then the JSON response should not contain the key :arg1
     */
    public function theJsonResponseShouldNotContainTheKey($itemKey)
    {
        $jsonOutput = $this->getJsonOutputAsArray();
        PHPUnit::assertFalse(isset($jsonOutput[$itemKey]));
    }

    /**
     * @Then the JSON response should contain the count of items in the :arg1 key
     */
    public function theJsonResponseShouldContainTheCountOfItemsInTheKey($itemKey)
    {
        $jsonOutput = $this->getJsonOutputAsArray();
        $numberOfItems = $jsonOutput[$itemKey];
        $items = json_decode(file_get_contents(storage_path() . '/app/cages.json'), true);
        $expectedNumber = count($items['cages']);
        PHPUnit::assertEquals($numberOfItems, $expectedNumber);
    }
}