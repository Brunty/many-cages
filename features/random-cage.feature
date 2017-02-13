Feature: Random Cage
  In order to worship our One True God
  As a user
  I want to retrieve a random picture of Nicolas Cage

  Scenario: Get a Random Cage Picture
    When I go to "/random"
    Then the response code should be 200
    And the JSON response should contain the key "cage"
    And the JSON response should contain 1 item in "cage"
