Feature: Cage ipsum
  In order to worship our One True God
  As a user
  I want to retrieve a the the words of our lord, Nicolas Cage.

  Scenario: Get a paragraph of the words of our Lord
    When I go to "/ipsum"
    Then the response code should be 200
    And the JSON response should contain the key "cage_ipsum"
