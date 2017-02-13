Feature: Cage count
  In order to worship our One True God
  As a user
  I want to retrieve a the number of pictures of Nicolas Cage we have in our system

  Scenario: Get the count of Cage pictures
    When I go to "/count"
    Then the response code should be 200
    And the JSON response should contain the key "cage_count"
    And the JSON response should contain the count of items in the "cage_count" key
