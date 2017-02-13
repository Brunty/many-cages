Feature: Cage quote
  In order to worship our One True God
  As a user
  I want to retrieve a random quote of the words of our lord, Nicolas Cage.

  Scenario: Get a random quote of the words of our Lord
    When I go to "/quote"
    Then the response code should be 200
    And the JSON response should contain the key "cage_quote"
