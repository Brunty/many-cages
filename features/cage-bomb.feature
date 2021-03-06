Feature: Cage Bomb
  In order to worship our One True God
  As a user
  I want to retrieve a multiple random pictures of Nicolas Cage - referred to as a 'Cage Bomb'

  Scenario: Get multiple random Cage Pictures using the default amount
    When I go to "/bomb"
    Then the response code should be 200
    And the JSON response should contain the key "cages"

  Scenario: Get multiple random Cage Pictures using a specific amount
    When I go to "/bomb/2"
    Then the response code should be 200
    And the JSON response should contain "2" items in "cages"

  Scenario: Get multiple random Cage Pictures using a specific amount
    When I go to "/bomb/4"
    Then the response code should be 200
    And the JSON response should contain "4" items in "cages"

  Scenario: Get multiple random Cage Pictures over the limit we have set (which is 10 maximum images)
    When I go to "/bomb/12"
    Then the response code should be 400
    And the JSON response should not contain the key "cages"
    And the JSON response should contain the key "error"
